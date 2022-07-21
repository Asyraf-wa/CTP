<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;

/**
 * Publications Controller
 *
 * @property \App\Model\Table\PublicationsTable $Publications
 * @method \App\Model\Entity\Publication[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PublicationsController extends AppController
{
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
        // $this->paginate = [
        //     'contain' => ['Users'],
        // ];
        // $publications = $this->paginate($this->Publications);
        $query = $this->Publications
        ->find('search', ['search' => $this->request->getQuery()]);
        //->where(['status' => '1']);
        $publications = $this->paginate($query)->toArray();

        $this->set(compact('publications'));
    }

    /**
     * View method
     *
     * @param string|null $id Publication id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $publication = $this->Publications->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('publication'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $publication = $this->Publications->newEmptyEntity();
        if ($this->request->is('post')) {
            $publication = $this->Publications->patchEntity($publication, $this->request->getData());
            $publication->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id'); //capture auth id
            if ($this->Publications->save($publication)) {
                $this->Flash->success(__('The publication has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The publication could not be saved. Please, try again.'));
        }
        $users = $this->Publications->Users->find('list', ['limit' => 200]);
        $this->set(compact('publication', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Publication id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $publication = $this->Publications->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $publication = $this->Publications->patchEntity($publication, $this->request->getData());
            if ($this->Publications->save($publication)) {
                $this->Flash->success(__('The publication has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The publication could not be saved. Please, try again.'));
        }
        $users = $this->Publications->Users->find('list', ['limit' => 200]);
        $this->set(compact('publication', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Publication id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $publication = $this->Publications->get($id);
        if ($this->Publications->delete($publication)) {
            $this->Flash->success(__('The publication has been deleted.'));
        } else {
            $this->Flash->error(__('The publication could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
