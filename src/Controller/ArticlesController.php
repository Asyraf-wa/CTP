<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Event\EventInterface;
use Cake\Utility\Hash;
use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['index','view','listing','pdf','like','email']);
	}
	
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['search','listing'],
		]);
	}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index_asal()
    {
        $this->paginate = [
            'contain' => ['Users', 'Categories'],
			'maxLimit' => 20,
			'order' => ['publish_on' => 'DESC'],
        ];
        //$articles = $this->paginate($this->Articles);
		
		$articles = $this->paginate($this->Articles->find('search',['search' => $this->request->getQuery()]));
		
		//$this->set('general', $this->paginate($this->Articles->find('all')->where(['category_id' => '1'])));

        $this->set(compact('articles'));
    }
	
	public function index()
	{
	/* 	$this->paginate = [
			'contain' => ['Users', 'Categories'],
			'maxLimit' => 20,
			'order' => ['publish_on' => 'DESC'],
		];
			
		$query = $this->Articles
			->find('search', ['search' => $this->request->getQueryParams()])
			->contain(['Users', 'Categories'])
			->where(['published' => '1']);

		$categories = $this->Articles->Categories->find('list', ['limit' => 200]);
		//debug($query);
		//exit;
		$this->set('articles', $this->paginate($query), 'categories');
		//$this->set(compact('users', 'categories','tags'));
		
		 */
		 
		$this->paginate = [
			'contain' => ['Users', 'Categories'],
			'maxLimit' => 20,
			'order' => ['publish_on' => 'DESC'],
		];
			
	/* 	$articles = $this->paginate($this->Articles
			->find('search', ['search' => $this->request->getQuery()])
			->where(['published' => '1'])
		); */
		
		$query = $this->Articles
			->find('search', ['search' => $this->request->getQuery()])->contain(['Tags'])
			->where(['published' => '1']);
		$articles = $this->paginate($query)->toArray();
			
		//$articles = $this->paginate($this->Articles);
		$categories = $this->Articles->Categories->find('list', ['limit' => 200]);
		$tags = $this->Articles->Tagged->find()->distinct(['Tags.slug', 'Tags.label'])->contain(['Tags'])->toArray();
		$tags = Hash::combine($tags, '{n}.tag.slug', '{n}.tag.label');
		//$this->set(compact('articles','categories'));
		$this->set(compact('articles','categories','tags'));
		
		$this->set('_serialize', ['users']); 
	}
	
	public function listing()
	{
		$this->paginate = [
			'contain' => ['Users', 'Categories'],
			'maxLimit' => 20,
			'order' => ['publish_on' => 'DESC'],
		];

		$query = $this->Articles
			->find('search', ['search' => $this->request->getQuery()])->contain(['Tags'])
			->where(['published' => '1']);
		$articles = $this->paginate($query)->toArray();
			
		//$articles = $this->paginate($this->Articles);
		$categories = $this->Articles->Categories->find('list', ['limit' => 200]);
		$tags = $this->Articles->Tagged->find()->distinct(['Tags.slug', 'Tags.label'])->contain(['Tags'])->toArray();
		$tags = Hash::combine($tags, '{n}.tag.slug', '{n}.tag.label');
		//$this->set(compact('articles','categories'));
		$this->set(compact('articles','categories','tags'));
		
		$this->set('_serialize', ['users']); 
	}

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
/* 	 
    public $paginate = [
        'limit' => 5,
    ];
	 */
    public function view($slug = null)
    {
        /* $article = $this->Articles->get($slug, [
            'contain' => ['Users', 'Categories'],
        ]); */
		$article = $this->Articles
			->findBySlug($slug)
			->contain(['Users', 'Categories'])
			->firstOrFail();
//hits
		$articles = TableRegistry::get('Articles');
		$query = $articles->query();
		$query->update()
			->set($query->newExpr('hits = hits + 1'))
			->where(['slug' => $slug])
			->execute();
//popular
		$popular = $this->Articles->find('all')
			->where([
				'published' => 1,
				//'category_id' => '1',
				])
			->order(['hits' => 'DESC'])
			->limit(7);
//latest
		$latest = $this->Articles->find('all')
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
		$random = $this->Articles->find('all')
			->where(['published' => 1])
			->order('rand()')
			->limit(4);
			
		$tags = $this->Articles->Tagged->find('cloud')->toArray();
		//$tags = $this->Articles->Tagged->find()->distinct(['Tags.slug', 'Tags.label'])->contain(['Tags'])->toArray();
		//$tags = Hash::combine($tags, '{n}.tag.slug', '{n}.tag.label');
	
		//$category->tag_list = ['One', 'Two', 'Four'];
		
        $this->set(compact('article','popular','random','latest','tags'));
    }
	
	public function pdf($slug = null)
	{
 	$this->viewBuilder()->enableAutoLayout(false); 
		$article = $this->Articles
			->findBySlug($slug)
			->contain(['Users', 'Categories'])
			->firstOrFail();
			
		//$article = $this->Reports->get($slug);
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, // This can be omitted if "filename" is specified.
				'filename' => $slug . '.pdf' //// This can be omitted if you want file name based on URL.
			]
		);
		//Write and Save PDF to folder
		$CakePdf = new \CakePdf\Pdf\CakePdf();
		$CakePdf->template('article', 'default');
		$CakePdf->viewVars([
			'title' => $article->title,
			'body' => $article->body,
		]);
		// Get the PDF string returned
		$pdf = $CakePdf->output();
		// Or write it to file directly
		$pdf = $CakePdf->write('files' . DS . 'pdf' . DS . $slug . '.pdf');
		
		$this->set('article', $article, 'title', 'body');
	} 
	
	public function email($slug = null)
	{
		$this->viewBuilder()->enableAutoLayout(false); 
		$article = $this->Articles
			->findBySlug($slug)
			->contain(['Users', 'Categories'])
			->firstOrFail();
			
		//Write and Save PDF to folder
		$CakePdf = new \CakePdf\Pdf\CakePdf();
		$CakePdf->template('article', 'default');
		$CakePdf->viewVars([
			'title' => $article->title,
			'body' => $article->body,
			'publish_on' => $article->publish_on,
			'slug' => $article->slug,
			'fullname' => $article->user->fullname
		]);
		// Get the PDF string returned
		$pdf = $CakePdf->output();
		// Or write it to file directly
		$pdf = $CakePdf->write('files' . DS . 'pdf' . DS . $slug . '.pdf');
		
		$email_address = $this->request->getData('email_address');

		//email with attachment
		$mailer = new Mailer('default');
		$mailer->setTransport('smtp'); //smtp
		$mailer->setAttachments(['files' . DS . 'pdf' . DS . $slug . '.pdf']);
		$mailer->setFrom(['noreply@codethepixel.com' => 'Code The Pixel'])
			->setTo($email_address) //receiver email
			->setEmailFormat('html')
			->setSubject('CTP Share: ' . $article->title)
			->deliver('Good day,<br><br>Article title <b>' . $article->title . '</b> has been share as PDF.<br><br>Original link:https://codethepixel.com/articles/' . $article->slug . '<br><br>Code The Pixel<br><a href="https://codethepixel.com">https://codethepixel.com</a>');
		//$mailer->setAttachments(['files' . DS . 'pdf' . DS . $slug . '.pdf']);
		//$mailer->setAttachments(['files' . DS. 'pdf' . DS . 'CakePHP-4-Audit-Trail-Using-AuditStash-Plugin.pdf']);
		
		
		
		$this->Flash->success(__('Share completed'));
		
		return $this->redirect($this->referer());
		
		$this->set('article', $article);
	}
	
    public function like($slug = null)
    {
        $article = $this->Articles
			->findBySlug($slug)
			->contain(['Users', 'Categories'])
			->firstOrFail();
		
		$articles = TableRegistry::get('Articles');
		$query = $articles->query();
		$query->update()
			->set($query->newExpr('kudos = kudos + 1'))
			->where(['slug' => $slug])
			->execute();
			
		return $this->redirect($this->referer());

        $this->set(compact('article'));
    }
	
	public function articlePublished($id=null,$published=null)
	{
		$this->request->allowMethod(['post']);
		$article = $this->Articles->get($id);
		
		if($published == 1 )
			$article->published = 0;
		else
			$article->published = 1;
		
		if($this->Articles->save($article))
		{
			$this->Flash->success(__('The articles published status has updated.'));
		}
		return $this->redirect($this->referer());
	}
	
	public function articleFeatured($id=null,$featured=null)
	{
		$this->request->allowMethod(['post']);
		$article = $this->Articles->get($id);
		
		if($featured == 1 )
			$article->featured = 0;
		else
			$article->featured = 1;
		
		if($this->Articles->save($article))
		{
			$this->Flash->success(__('The articles featured status has updated.'));
		}
		return $this->redirect($this->referer());
	}

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
			$article->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id'); //capture auth id
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200]);
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
		$tags = $this->Articles->Tags->find('list', ['keyField' => 'slug']);
		//debug($categories);
		//exit;
        $this->set(compact('article', 'users', 'categories','tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Tags'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200]);
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
		
		$tags = $this->Articles->Tags->find('list', ['keyField' => 'slug']);
		$tag_cloud = $this->Articles->Tagged->find('cloud')->toArray();
		//debug($tag_cloud);
		//exit;
        $this->set(compact('article', 'users', 'categories', 'tags','tag_cloud'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
