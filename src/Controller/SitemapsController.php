<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

class SitemapsController extends AppController
{
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['index']);
	}
	
    public function index()
    {
        $this->viewBuilder()->setLayout('sitemap');
        $this->RequestHandler->respondAs('xml');
        
        $articleTbl = TableRegistry::getTableLocator()->get('Articles');
        $articles = $articleTbl->find()->select(['slug','modified']);
        $this->set('articles', $articles);
		
		$blogTbl = TableRegistry::getTableLocator()->get('Blogs');
        $blogs = $blogTbl->find()->select(['slug','modified']);
        $this->set('blogs', $blogs);
		
		$projectTbl = TableRegistry::getTableLocator()->get('Projects');
        $projects = $projectTbl->find()->select(['slug','modified']);
        $this->set('projects', $projects);
		
		//debug($articles);
		//exit;

        //Get the base URL of your website
        $url = Router::url('/', true);
        $this->set('url', $url);

    }

}

?>