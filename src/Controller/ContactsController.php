<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
/**
 * Contacts Controller
 *
 * @property \App\Model\Table\ContactsTable $Contacts
 * @method \App\Model\Entity\Contact[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContactsController extends AppController
{
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['add','check']);
	}
	public function initialize(): void
	{
		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('Search.Search', [
			'actions' => ['search','check','index'],
		]);
		
		$this->loadComponent('Captcha.Captcha', ['actions' => ['add']]);
		$this->viewBuilder()->setHelpers(['Captcha.Captcha' => ['ext' => 'png']]);
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => '',
        ];
        $contacts = $this->paginate($this->Contacts);

        $this->set(compact('contacts'));
    }

    /**
     * View method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('contact'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
/*     public function add()
    {
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'users'));
    } */
/*     public function add()
    {
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
			//$formdata = $this->getRequest()->getData();
			//$contact = $this->Contacts->patchEntity($contact, $formdata);
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
				$subject = $this->request->getData('subject');
				$name = $this->request->getData('name');
				$email = $this->request->getData('email');
				$notes = $this->request->getData('notes');
				$ip = $this->request->clientIp();
            if ($this->Contacts->save($contact)) {
				$contact->subject = $subject;
				$contact->name = $name;
				$contact->email = $email;
				$contact->notes = $notes;	
				$contact->ip = $ip;	
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('contact', 'users'));
    } */
	public function add() {
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
			
			$subject = $this->request->getData('subject');
			$name = $this->request->getData('name');
			$email = $this->request->getData('email');
			$notes = $this->request->getData('notes');
			$ip = $this->request->clientIp();

            if ($this->Contacts->save($contact)) {
				$contact->subject = $subject;
				$contact->name = $name;
				$contact->email = $email;
				$contact->notes = $notes;	
				$contact->ip = $ip;	
			
                $mailer = new Mailer('default');
				$mailer->setTransport('smtp');
				$mailer->setFrom(['noreply@codethepixel.com' => 'Code The Pixel'])
			    ->setTo('asyraf.wahianuar@gmail.com') //your email
			    ->setEmailFormat('html')
			    ->setSubject('New Support Ticket')
			    ->deliver('Hi Moderator/Administrator<br/><br/>New contact ticket has been submitted via contact us form. Please check and respond the to the ticket.<br/>Login to <a href="http://localhost/dev/users/verification/">Code The Pixel</a> to respond.<br/><br/>Thank you.');
				
				$this->Flash->success(__('The contact has been submitted. CTP administrator will respond to your ticket ASAP. Thank you.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The contact could not be submit. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'users'));
	}
	
    public function addx()
    {
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
			
			$subject = $this->request->getData('subject');
			$name = $this->request->getData('name');
			$email = $this->request->getData('email');
			$notes = $this->request->getData('notes');
			$ip = $this->request->clientIp();

            if ($this->Contacts->save($contact)) {
				$contact->subject = $subject;
				$contact->name = $name;
				$contact->email = $email;
				$contact->notes = $notes;	
				$contact->ip = $ip;	
			
                $mailer = new Mailer('default');
				$mailer->setTransport('smtp');
				$mailer->setFrom(['noreply@codethepixel.com' => 'Code The Pixel'])
			    ->setTo('asyraf.wahianuar@gmail.com') //your email
			    ->setEmailFormat('html')
			    ->setSubject('New Support Ticket')
			    ->deliver('Hi Moderator/Administrator<br/><br/>New contact ticket has been submitted via contact us form. Please check and respond the to the ticket.<br/>Login to <a href="http://localhost/dev/users/verification/">Code The Pixel</a> to respond.<br/><br/>Thank you.');
				
				$this->Flash->success(__('The contact has been submitted. CTP administrator will respond to your ticket ASAP. Thank you.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The contact could not be submit. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'users'));
    }
	
	public function add3()
    {
		$contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            if ($this->Recaptcha->verify()) { // if configure enable = false, it will always return true
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
			
			$subject = $this->request->getData('subject');
			$name = $this->request->getData('name');
			$email = $this->request->getData('email');
			$notes = $this->request->getData('notes');
			$ip = $this->request->clientIp();

            if ($this->Contacts->save($contact)) {
				$contact->subject = $subject;
				$contact->name = $name;
				$contact->email = $email;
				$contact->notes = $notes;	
				$contact->ip = $ip;	
			
                $mailer = new Mailer('default');
				$mailer->setTransport('smtp');
				$mailer->setFrom(['noreply@codethepixel.com' => 'Code The Pixel'])
			    ->setTo('asyraf.wahianuar@gmail.com') //your email
			    ->setEmailFormat('html')
			    ->setSubject('New Support Ticket')
			    ->deliver('Hi Moderator/Administrator<br/><br/>New contact ticket has been submitted via contact us form. Please check and respond the to the ticket.<br/>Login to <a href="http://localhost/dev/users/verification/">Code The Pixel</a> to respond.<br/><br/>Thank you.');
				
				$this->Flash->success(__('The contact has been submitted. CTP administrator will respond to your ticket ASAP. Thank you.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The contact could not be submit. Please, try again.'));
            }
            $this->Flash->error(__('Please pass Google Recaptcha first'));
        }
		$users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'users'));
    }
	
    public function add2()
    {
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
			
			$subject = $this->request->getData('subject');
			$name = $this->request->getData('name');
			$email = $this->request->getData('email');
			$notes = $this->request->getData('notes');
			$ip = $this->request->clientIp();

            if ($this->Contacts->save($contact)) {
				$contact->subject = $subject;
				$contact->name = $name;
				$contact->email = $email;
				$contact->notes = $notes;	
				$contact->ip = $ip;	
			
                $mailer = new Mailer('default');
				$mailer->setTransport('smtp');
				$mailer->setFrom(['noreply@codethepixel.com' => 'Code The Pixel'])
			    ->setTo('asyraf.wahianuar@gmail.com') //your email
			    ->setEmailFormat('html')
			    ->setSubject('New Support Ticket')
			    ->deliver('Hi Moderator/Administrator<br/><br/>New contact ticket has been submitted via contact us form. Please check and respond the to the ticket.<br/>Login to <a href="http://localhost/dev/users/verification/">Code The Pixel</a> to respond.<br/><br/>Thank you.');
				
				$this->Flash->success(__('The contact has been submitted. CTP administrator will respond to your ticket ASAP. Thank you.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The contact could not be submit. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'users'));
    }
	
	public function check()
	{
		//$this->paginate['maxLimit'] = 999;
        $this->paginate = [
            'contain' => '',
        ];

        //$contacts = $this->paginate($this->Contacts);

		
		$contacts = $this->paginate($this->Contacts->find('search', ['search' => $this->request->getQuery()]));
	
		$ticket = $this->request->getQuery('ticket');
		
		if ($ticket != NULL) {
			$this->set('count_ticket', $this->Contacts->find()->where(['ticket' => $ticket])->count());
		} elseif ($ticket == null) {
			$this->set('count_ticket', '0');
		} else
			$this->set('count_ticket', '2');
		
		$this->set(compact('contacts'));
		$this->set('_serialize', ['contacts']);
	}

    /**
     * Edit method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contact = $this->Contacts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('The contact has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contact could not be saved. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Contact id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contacts->get($id);
        if ($this->Contacts->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The contact could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
