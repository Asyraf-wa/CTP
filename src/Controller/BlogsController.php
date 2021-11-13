<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Event\EventInterface;

/**
 * Blogs Controller
 *
 * @property \App\Model\Table\BlogsTable $Blogs
 * @method \App\Model\Entity\Blog[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BlogsController extends AppController
{
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['index','view']);
	}
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['search'],
		]);
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
/*         $this->paginate = [
            'contain' => ['Users'],
        ];
        $blogs = $this->paginate($this->Blogs);
 */
		$this->paginate = [
			'contain' => ['Users'],
			'maxLimit' => 20,
			'order' => ['created' => 'DESC'],
		];
		
		$query = $this->Blogs
			->find('search', ['search' => $this->request->getQuery()])->contain(['Users'])
			->where(['published' => '1']);
		$blogs = $this->paginate($query)->toArray();
        $this->set(compact('blogs'));
    }

    /**
     * View method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null)
    {
        /* $blog = $this->Blogs->get($id, [
            'contain' => ['Users'],
        ]); */
		$blog = $this->Blogs
			->findBySlug($slug)
			->contain(['Users'])
			->firstOrFail();
		
//hits
		$blogs = TableRegistry::get('Blogs');
		$query = $blogs->query();
		$query->update()
			->set($query->newExpr('hits = hits + 1'))
			->where(['slug' => $slug])
			->execute();
//popular
		$popular = $this->Blogs->find('all')
			->where([
				'published' => 1,
				//'category_id' => '1',
				])
			->order(['hits' => 'DESC'])
			->limit(5);
//latest
		$latest = $this->Blogs->find('all')
			->where(['published' => 1])
			->order(['publish_on' => 'DESC'])
			->limit(5);
		/* $this->set('latest', $this->paginate($this->Articles->find('all')
			->where([
				'published' => '1', 
				//'category_id' => '1',
				])
			->order(['publish_on' => 'DESC']),
		)); */
		
//random
		$random = $this->Blogs->find('all')
			->where(['published' => 1])
			->order('rand()')
			->limit(4);

        $this->set(compact('blog','popular','random','latest'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $blog = $this->Blogs->newEmptyEntity();
        if ($this->request->is('post')) {
            $blog = $this->Blogs->patchEntity($blog, $this->request->getData());
			$blog->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id'); //capture auth id
            if ($this->Blogs->save($blog)) {
                $this->Flash->success(__('The blog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blog could not be saved. Please, try again.'));
        }
        $users = $this->Blogs->Users->find('list', ['limit' => 200]);
        $this->set(compact('blog', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $blog = $this->Blogs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blog = $this->Blogs->patchEntity($blog, $this->request->getData());
            if ($this->Blogs->save($blog)) {
                $this->Flash->success(__('The blog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blog could not be saved. Please, try again.'));
        }
        $users = $this->Blogs->Users->find('list', ['limit' => 200]);
        $this->set(compact('blog', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blog = $this->Blogs->get($id);
        if ($this->Blogs->delete($blog)) {
            $this->Flash->success(__('The blog has been deleted.'));
        } else {
            $this->Flash->error(__('The blog could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
