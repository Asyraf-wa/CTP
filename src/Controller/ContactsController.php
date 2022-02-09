<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Routing\Router;
use Cake\Http\ServerRequest;
use Cake\Event\EventManager;
use Cake\Utility\Security;
use Cake\Http\Client;
//use Cake\ORM\TableRegistry;
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
		//$this->Authentication->addUnauthenticatedActions(['add','check','hCaptchaResult','hcaptcha']);
		$this->Authentication->allowUnauthenticated(['add','check']);
	}
	public function initialize(): void
	{
		parent::initialize();
		$this->loadComponent('Paginator');
		$this->loadComponent('Search.Search', [
			'actions' => ['search','check','index'],
		]);
		
		//$this->loadComponent('Captcha.Captcha', ['actions' => ['add']]);
		//$this->viewBuilder()->setHelpers(['Captcha.Captcha' => ['ext' => 'png']]);
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
	public function add()
	{
		$this->loadModel('Settings');
			$setting = $this->Settings->find('all')->first();
			//$hcaptcha_sitekey =	$setting->get('hcaptcha_sitekey');
			$hcaptcha_secretkey = $setting->get('hcaptcha_secretkey');				
		$contact = $this->Contacts->newEmptyEntity();
		if ($this->request->is('post')) {
			// Get the hcaptcha from request data
			$hcaptcha = $this->request->getData('h-captcha-response');
			$name = $this->request->getData('name');
			// create an httpClient and create a POST request for the API endpoint
			$httpClient = new Client();
			$response = $httpClient->post('https://hcaptcha.com/siteverify', [
				'secret' => $hcaptcha_secretkey,
				'response' => $hcaptcha,
			]);
			// Get the response data as JSON
			$hCaptchaResult = $response->getJson();

			// Check if the result is *success* and save your contact/go on wih your business logic
			if ($hCaptchaResult['success']) {
				$contact = $this->Contacts->patchEntity($contact, $this->request->getData());
					//variables for email use
					$ticket = $this->request->getData('ticket');
					$subject = $this->request->getData('subject');
					$name = $this->request->getData('name');
					$email = $this->request->getData('email');
					$notes = $this->request->getData('notes');
					$ip = $this->request->clientIp();
					//save ip address to db
					$contact->ip = $ip;	
				if ($this->Contacts->save($contact)) {
					$mailer = new Mailer('default');
						$mailer
							->setTransport('smtp')//smtp
							->setViewVars([
								'ticket' => $ticket,
								'subject' => $subject,
								'name' => $name,
								'email' => $email,
								'notes' => $notes,
								'ip' => $ip,
								])
							->setFrom(['noreply@codethepixel.com' => 'Code The Pixel'])
							->setTo('asyraf.wahianuar@gmail.com') //your email
							->setEmailFormat('html')
							->setSubject('New Support Ticket')
							->viewBuilder()
								->setTemplate('contact_new');
						$mailer->deliver();
							
						//send notification to Telegram Bot - CodeThePixelBot				
						$this->loadModel('Settings');
						$setting = $this->Settings->find('all')->first();
						$botToken =	$setting->get('telegram_bot_token');
						$chatId = $setting->get('telegram_chatid');
						$website = "https://api.telegram.org/bot".$botToken;
						$emoji = "\xF0\x9F\x93\xA7"; //Email Emoji
						$params = [
						  'chat_id' => $chatId, 
						  'parse_mode' => 'markdown', //parse_mode = markdown for telegram format, parse_mode = html for html format
						  'text' => $emoji . ' *NEW CONTACT MESSAGE*'.PHP_EOL.'Subject: ' . $subject . ''.PHP_EOL.'From: ' . $name . ''.PHP_EOL.'Ticket: ' . $ticket . '',
						];
						$ch = curl_init($website . '/sendMessage');
						curl_setopt($ch, CURLOPT_HEADER, false);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						$result = curl_exec($ch);
						curl_close($ch);
						
					$this->Flash->success(__('The contact has been submitted. CTP moderator will respond to your ticket. Thank you.'));

                return $this->redirect(['action' => 'add']);
				}
			} else {
			  $this->Flash->error(__('Captcha not fill'));
			}
			$this->Flash->error(__('The contact form could not be submit. Please, try again.'));
		}
		$users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'users'));
	}
/* 	public function add_betul() {
        $contact = $this->Contacts->newEmptyEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contacts->patchEntity($contact, $this->request->getData());
			//variables for email use
			$ticket = $this->request->getData('ticket');
			$subject = $this->request->getData('subject');
			$name = $this->request->getData('name');
			$email = $this->request->getData('email');
			$notes = $this->request->getData('notes');
			$ip = $this->request->clientIp();
			//save ip address to db
			$contact->ip = $ip;	

            if ($this->Contacts->save($contact)) {
                $mailer = new Mailer('default');
				$mailer
					->setTransport('smtp')//smtp
					->setViewVars([
						'ticket' => $ticket,
						'subject' => $subject,
						'name' => $name,
						'email' => $email,
						'notes' => $notes,
						'ip' => $ip,
						])
					->setFrom(['noreply@codethepixel.com' => 'Code The Pixel'])
					->setTo('asyraf.wahianuar@gmail.com') //your email
					->setEmailFormat('html')
					->setSubject('New Support Ticket')
					->viewBuilder()
						->setTemplate('contact_new');
				$mailer->deliver();
				
				//send notification to Telegram Bot - CodeThePixelBot				
				$this->loadModel('Settings');
				$setting = $this->Settings->find('all')->first();
				$botToken =	$setting->get('telegram_bot_token');
				$chatId = $setting->get('telegram_chatid');
				$website = "https://api.telegram.org/bot".$botToken;
				$emoji = "\xF0\x9F\x93\xA7"; //Email Emoji
				$params = [
				  'chat_id' => $chatId, 
				  'parse_mode' => 'markdown', //parse_mode = markdown for telegram format, parse_mode = html for html format
				  'text' => $emoji . ' *NEW CONTACT MESSAGE*'.PHP_EOL.'Subject: ' . $subject . ''.PHP_EOL.'From: ' . $name . ''.PHP_EOL.'Ticket: ' . $ticket . '',
				];
				$ch = curl_init($website . '/sendMessage');
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$result = curl_exec($ch);
				curl_close($ch);
				
				$this->Flash->success(__('The contact has been submitted. CTP administrator will respond to your ticket ASAP. Thank you.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The contact could not be submit. Please, try again.'));
        }
        $users = $this->Contacts->Users->find('list', ['limit' => 200]);
        $this->set(compact('contact', 'users'));
	}
	 */
/*     public function addx()
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
    } */
	
/* 	public function add3()
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
    } */
	
/*     public function add2()
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
    } */
	
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
