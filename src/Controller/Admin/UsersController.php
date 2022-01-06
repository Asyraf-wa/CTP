<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\EventInterface;
//use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\View\Helper;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['login','add']);
	}
	
	public function login()
	{
		$this->request->allowMethod(['get', 'post']);
		$result = $this->Authentication->getResult();
		if ($result->isValid()) {
			$redirect = $this->request->getQuery('redirect', [
				'prefix' => 'Admin',
				'controller' => 'Dashboards',
				'action' => 'index',
			]);
			$this->updateLoginFields();
			return $this->redirect($redirect);
		}
		if ($this->request->is('post') && !$result->isValid()) {
			$this->Flash->error(__('Invalid username or password'));
		}
	}
	
	protected function updateLoginFields(){
		$userTable = TableRegistry::get('Users');
		$user = $this->Authentication->getIdentity();
		$this->Authentication->getIdentity($user);
			$this->request->getSession()->write('User.last_login', date("Y-m-d H:i:s"));
			$this->request->getSession()->write('User.ip_address', $this->request->clientIp());
			//$this->request->getSession()->write('Auth.User.fullname', $user->user_detail->fullname);
			$updateData = [
				'last_login' => date("Y-m-d H:i:s"),
				'ip_address' => $this->request->clientIp(),
			]; 
			$this->Users->query()->update()->set($updateData)->where(['id' => $user['id']])->execute();
    }

	public function logout()
	{
		$result = $this->Authentication->getResult();
		if ($result->isValid()) {
			$this->Authentication->logout();
			return $this->redirect(['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'login']);
		}
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Articles','UserGroups'],
        ]; 
		
		
        $users = $this->paginate($this->Users);
		$userGroups = $this->Users->UserGroups->find('list', ['limit' => 200]);
		//$articles = $articles->find('all');

        $this->set(compact('users','userGroups'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profile($slug = null)
    {
        $user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups', 'Articles', 'Blogs', 'Contacts', 'Fitnesses', 'Pains', 'Projects'])
			//'contain' => ['UserGroups', 'Articles', 'Blogs', 'Contacts', 'Emails', 'Fitnesses', 'Pains', 'Projects', 'Recipients', 'UserLogs'],
			->firstOrFail();
			
		$this->loadModel('Articles');
		$articles = $this->Articles->find('all')
			->where([
				'published' => 1,
				'user_id' => $user->id,
				//'user_id' => $this->Authentication->getIdentity('id')->getIdentifier('id'), //capture auth id
				//'category_id' => '1',
				])
			->order(['publish_on' => 'DESC'])
			->limit(5);
			
		

        $this->set(compact('user','articles'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200]);
        $this->set(compact('user','userGroups'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function updateProfile($slug = null)
    {
        /* $user = $this->Users->get($id, [
            'contain' => [],
        ]); */

		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
			
		//$userSlug = $this->Authentication->getIdentity('slug')->getIdentifier('slug');
		//$userId = $this->getRequest()->getAttribute('identity')['slug'] ?? null;
		//$userId2 = $this->request->getAttribute('identity')->getIdentifier('slug');
		//debug($userId);
		//exit;			
			
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'profile', $this->getRequest()->getAttribute('identity')['slug'] ?? null]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'userGroups'));
    }
	
	public function removeAvatar($slug = null)
	{
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
		
		//$userSlug = $this->Authentication->getIdentity('slug')->getIdentifier('slug');
		$userSlug = $this->getRequest()->getAttribute('identity')['slug'] ?? null;
		if($slug != $userSlug){
				$this->Flash->error(__('You are not authorized to view'));
				//return $this->redirect(['action' => 'profile', $this->Auth->user('slug')]);
		}

		if ($this->request->is(['patch', 'post', 'put'])) {
			$formdata = $this->getRequest()->getData();
			$user = $this->Users->patchEntity($user, $formdata);
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Your profile has been updated'));
				return $this->redirect(['action' => 'profile', $this->getRequest()->getAttribute('identity')['slug'] ?? null]);
			}
			$this->Flash->error(__('Your profile could not be saved. Please, try again.'));
		}
		$userGroups = $this->Users->UserGroups->find('list', ['limit' => 200]);
        $this->set(compact('user','userGroups'));
	}
	
	public function changePassword($slug = null)
	{
		$userTable = TableRegistry::get('Users');
		$userGroup = $this->Authentication->getIdentity('slug')->getIdentifier('slug');
		if($userGroup != '1'){
				$this->Flash->error(__('You are not authorized to view'));
				return $this->redirect(['action' => 'dashboard', 'prefix' => false]);
		}
		
		$user = $this->Users
			->findBySlug($slug)
			->contain(['UserGroups'])
			->firstOrFail();
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(),['validate' => 'password']);
			
			$slug = $this->request->getData('slug');
			$username = $this->request->getData('username');
			
            if ($this->Users->save($user)) {
				$this->Flash->success(__(''.$username. ' password has been updated'));
                return $this->redirect(['action' => 'profile', $this->getRequest()->getAttribute('identity')['slug'] ?? null]);
            }
			$this->Flash->error(__(''.$username. ' password could not be update. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'userGroups'));
	}

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
