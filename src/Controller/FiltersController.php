<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

class FiltersController extends AppController
{
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['index']);
	}
	
    public function index()
    {
		$articleTbl = TableRegistry::getTableLocator()->get('Articles');
        $articles = $articleTbl->find()->select(['title','slug']);
        $this->set('articles', $articles);
		
		$query = $this->Articles
			->find('search', ['search' => $this->request->getQuery()])
			->where(['published' => '1']);
    }
}
?>