<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fitnesses Controller
 *
 * @property \App\Model\Table\FitnessesTable $Fitnesses
 * @method \App\Model\Entity\Fitness[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FitnessesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $fitnesses = $this->paginate($this->Fitnesses);

        $this->set(compact('fitnesses'));
    }

    /**
     * View method
     *
     * @param string|null $id Fitness id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fitness = $this->Fitnesses->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('fitness'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fitness = $this->Fitnesses->newEmptyEntity();
        if ($this->request->is('post')) {
            $fitness = $this->Fitnesses->patchEntity($fitness, $this->request->getData());
            if ($this->Fitnesses->save($fitness)) {
                $this->Flash->success(__('The fitness has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fitness could not be saved. Please, try again.'));
        }
        $users = $this->Fitnesses->Users->find('list', ['limit' => 200]);
        $this->set(compact('fitness', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fitness id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fitness = $this->Fitnesses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fitness = $this->Fitnesses->patchEntity($fitness, $this->request->getData());
            if ($this->Fitnesses->save($fitness)) {
                $this->Flash->success(__('The fitness has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fitness could not be saved. Please, try again.'));
        }
        $users = $this->Fitnesses->Users->find('list', ['limit' => 200]);
        $this->set(compact('fitness', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fitness id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fitness = $this->Fitnesses->get($id);
        if ($this->Fitnesses->delete($fitness)) {
            $this->Flash->success(__('The fitness has been deleted.'));
        } else {
            $this->Flash->error(__('The fitness could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
