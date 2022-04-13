<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\EventInterface;
//use Cake\Core\Configure;
use Cake\Utility\Hash;
use Cake\ORM\Query;
use Cake\ORM\Locator\LocatorAwareTrait;
/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
	
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['search'],
		]);
		
		$this->loadComponent('RequestHandler');
	}
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index2()
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
/* 		
	$articles = $this->paginate($this->Articles
		->find('search', ['search' => $this->request->getQuery()])
		->contain(['Tags'])
		//->where(['published' => '1'])
	);
	 */
	$query = $this->Articles->find('search', ['search' => $this->request->getQuery()])->contain(['Tags']);
	$articles = $this->paginate($query)->toArray();
	
	//$query = $this->Articles->find('search', ['search' => $this->request->getQuery()])->contain(['Tags']);
		
	//$articles = $this->paginate($this->Articles);
	$categories = $this->Articles->Categories->find('list', ['limit' => 200]);
	
	$tags = $this->Articles->Tagged->find()->distinct(['Tags.slug', 'Tags.label'])->contain(['Tags'])->toArray();
	$tags = Hash::combine($tags, '{n}.tag.slug', '{n}.tag.label');
	
	$this->set(compact('articles','categories','tags'));
	
	$this->set('_serialize', ['users']); 
	

	
//January
	$this->set('jan_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
//February
	$this->set('feb_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
//March
	$this->set('mar_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
//April
	$this->set('apr_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());		
//May
	$this->set('may_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
//June
	$this->set('jun_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
//July
	$this->set('jul_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
//August
	$this->set('aug_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
//September
	$this->set('sep_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
//October
	$this->set('oct_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
//November
	$this->set('nov_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
//December
	$this->set('dec_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

//Count By Month
	$this->set('january', $this->Articles->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('february', $this->Articles->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('march', $this->Articles->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('april', $this->Articles->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may', $this->Articles->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun', $this->Articles->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('july', $this->Articles->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('august', $this->Articles->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('september', $this->Articles->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('october', $this->Articles->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('november', $this->Articles->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('december', $this->Articles->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());


		

	$this->loadModel('Blogs');	
	$this->set('blog_jan_1', $this->Blogs->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
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
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Users', 'Categories'],
        ]);
//hits
		$articles = TableRegistry::get('Articles');
		$query = $articles->query();
		$query->update()
			->set($query->newExpr('hits = hits + 1'))
			->where(['id' => $id])
			->execute();
//popular
		$popular = $this->Articles->find('all')
			->where([
				'published' => 1,
				//'category_id' => '1',
				])
			->order(['hits' => 'DESC'])
			->limit(5);
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
		//$category->tag_list = ['One', 'Two', 'Four'];
		
        $this->set(compact('article','popular','random','latest','tags'));
    }
	
    public function kudos($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);
		
		$articles = TableRegistry::get('Articles');
		$query = $articles->query();
		$query->update()
			->set($query->newExpr('kudos = kudos + 1'))
			->where(['id' => $id])
			->execute();
			
		return $this->redirect($this->referer());

        $this->set(compact('article'));
    }
	
	public function articlePublished($id=null,$published)
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
	
	public function articleFeatured($id=null,$featured)
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
	
	public function report()
	{
//January
	$this->set('jan_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jan_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
//February
	$this->set('feb_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('feb_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
//March
	$this->set('mar_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('mar_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
//April
	$this->set('apr_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('apr_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());		
//May
	$this->set('may_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
//June
	$this->set('jun_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
//July
	$this->set('jul_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jul_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
//August
	$this->set('aug_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('aug_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
//September
	$this->set('sep_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('sep_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
//October
	$this->set('oct_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('oct_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
//November
	$this->set('nov_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('nov_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
//December
	$this->set('dec_1', $this->Articles->find()
		->where(['DAY(created)' => date('1'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_2', $this->Articles->find()
		->where(['DAY(created)' => date('2'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_3', $this->Articles->find()
		->where(['DAY(created)' => date('3'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_4', $this->Articles->find()
		->where(['DAY(created)' => date('4'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_5', $this->Articles->find()
		->where(['DAY(created)' => date('5'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_6', $this->Articles->find()
		->where(['DAY(created)' => date('6'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_7', $this->Articles->find()
		->where(['DAY(created)' => date('7'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_8', $this->Articles->find()
		->where(['DAY(created)' => date('8'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_9', $this->Articles->find()
		->where(['DAY(created)' => date('9'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_10', $this->Articles->find()
		->where(['DAY(created)' => date('10'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_11', $this->Articles->find()
		->where(['DAY(created)' => date('11'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_12', $this->Articles->find()
		->where(['DAY(created)' => date('12'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_13', $this->Articles->find()
		->where(['DAY(created)' => date('13'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_14', $this->Articles->find()
		->where(['DAY(created)' => date('14'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_15', $this->Articles->find()
		->where(['DAY(created)' => date('15'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_16', $this->Articles->find()
		->where(['DAY(created)' => date('16'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_17', $this->Articles->find()
		->where(['DAY(created)' => date('17'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_18', $this->Articles->find()
		->where(['DAY(created)' => date('18'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_19', $this->Articles->find()
		->where(['DAY(created)' => date('19'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_20', $this->Articles->find()
		->where(['DAY(created)' => date('20'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_21', $this->Articles->find()
		->where(['DAY(created)' => date('21'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_22', $this->Articles->find()
		->where(['DAY(created)' => date('22'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_23', $this->Articles->find()
		->where(['DAY(created)' => date('23'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_24', $this->Articles->find()
		->where(['DAY(created)' => date('24'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_25', $this->Articles->find()
		->where(['DAY(created)' => date('25'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_26', $this->Articles->find()
		->where(['DAY(created)' => date('26'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_27', $this->Articles->find()
		->where(['DAY(created)' => date('27'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_28', $this->Articles->find()
		->where(['DAY(created)' => date('28'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_29', $this->Articles->find()
		->where(['DAY(created)' => date('29'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_30', $this->Articles->find()
		->where(['DAY(created)' => date('30'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	$this->set('dec_31', $this->Articles->find()
		->where(['DAY(created)' => date('31'), 'MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

//Count By Month
	$this->set('january', $this->Articles->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('february', $this->Articles->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('march', $this->Articles->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('april', $this->Articles->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('may', $this->Articles->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('jun', $this->Articles->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('july', $this->Articles->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('august', $this->Articles->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('september', $this->Articles->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('october', $this->Articles->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('november', $this->Articles->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('december', $this->Articles->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());


	
	
/**Count Current Year Articles and Group by Month and Sort ASC - Table View**/
	$query = $this->Articles->find();
	$query
		->select([
			'month' => $query->func()->MONTHNAME(['created' => 'identifier']),
			'view' => $query->func()->sum('Articles.hits'),
			'total' => $query->func()->count('Articles.id')
		])
		->where(['YEAR(created)' => date('Y')])
		->group(['month'])
		->order(['created' => 'ASC']);
	$monthly = $query;
	//debug($monthly);
	//exit;
//////////////////////////////////////////////////////

///////////////////////////////////////////////////////
/**Count Current Year Articles Views/Hits and Group by Month - Chart JSON View**/
	$monthly_count_hits = $this->Articles->find('list', [
				'keyField' => 'month',
				'valueField' => 'hits',
				'fields'=>[
					'month' => 'MONTHNAME(created)',
					'hits' => 'SUM(hits)'
				],
				'group' => ['month'],
				'order'=>['MONTH(created)'=>'ASC'],
			])
			->where(['YEAR(created)' => date('Y')])
			->toArray();
	$months = json_encode(array_keys($monthly_count_hits));
	$count_monthly = json_encode(array_values($monthly_count_hits));
	$this->set('months', $months);
	$this->set('count_monthly', $count_monthly);
	
/**Count Current Year Total Articles and Group by Month - Chart JSON View**/
 	$monthly_count_articles = $this->Articles->find('all', [
				//'keyField' => 'month',
				//'valueField' => 'id',
				'fields'=>[
					'month' => 'MONTHNAME(created)',
					'total' => 'count(Articles.id)'
				],
				'group' => ['month'],
				'order'=>['MONTH(created)'=>'ASC'],
			])
			->where(['YEAR(created)' => date('Y')])
			->toArray();
	
	$monthly_articles = json_encode($monthly_count_articles);
	//debug($monthly_articles);
	//exit;	
	$this->set('monthly_articles', $monthly_articles); 
	

//xxxxxxxxxxxxxxxxxxxxxxx
		//Count Articles and Group by Year		
		$query = $this->Articles->find();
		$query
			->select([
				'year' => $query->func()->YEAR(['created' => 'identifier']),
				'view' => $query->func()->sum('Articles.hits'),
				'total' => $query->func()->count('Articles.id')
			])
			->group(['year'])
			->order(['created' => 'ASC']);
		$yearly = $query;
			//debug($cicak->toArray());
			//exit;
			
			
//BELAJAR
	$count_total_monthly = $this->Articles->find('list', [
				'keyField' => 'month',
				'valueField' => 'hits',
				'fields'=>[
					'month' => 'MONTHNAME(created)',
					'hits' => 'SUM(hits)'
				],
				'group' => ['month'],
				'order'=>['MONTH(created)'=>'ASC'],
			])
			->where(['YEAR(created)' => date('Y')])
			->toArray();
	$months = json_encode(array_keys($count_total_monthly));
	$count_monthly = json_encode(array_values($count_total_monthly));
	$this->set('print_month', $months);
	$this->set('count_monthly', $count_monthly);	


//count monthly hits
	$monthly_hits = $this->Articles->find();
		$count_hits_jan =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_jan = $count_hits_jan->sum;
		
	$monthly_hits = $this->Articles->find();	
		$count_hits_feb =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_feb = $count_hits_feb->sum;

	$monthly_hits = $this->Articles->find();	
		$count_hits_mar =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_mar = $count_hits_mar->sum;
		
	$monthly_hits = $this->Articles->find();	
		$count_hits_apr =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_apr = $count_hits_apr->sum;
		
	$monthly_hits = $this->Articles->find();	
		$count_hits_may =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_may = $count_hits_may->sum;
		
	$monthly_hits = $this->Articles->find();	
		$count_hits_jun =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_jun = $count_hits_jun->sum;
		
	$monthly_hits = $this->Articles->find();	
		$count_hits_jul =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_jul = $count_hits_jul->sum;
		
	$monthly_hits = $this->Articles->find();	
		$count_hits_aug =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_aug = $count_hits_aug->sum;
		
	$monthly_hits = $this->Articles->find();	
		$count_hits_sep =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_sep = $count_hits_sep->sum;
		
	$monthly_hits = $this->Articles->find();	
		$count_hits_oct =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_oct = $count_hits_oct->sum;
		
	$monthly_hits = $this->Articles->find();	
		$count_hits_nov =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_nov = $count_hits_nov->sum;
		
	$monthly_hits = $this->Articles->find();	
		$count_hits_dec =$monthly_hits->select(['sum' => $monthly_hits->func()->sum('Articles.hits')])
								->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])
								->first();
		$sum_hits_dec = $count_hits_dec->sum;
		
//view hits to array
	$hits = $this->Articles->find('list', [
		'keyField' => 'id',
		'valueField' => 'hits'])	
		->toArray();
	$view_hits = json_encode(array_values($hits));
	$this->set('view_hits', $view_hits);	

//view article title to array
	$title = $this->Articles->find('list', [
		'keyField' => 'id',
		'valueField' => 'title'])	
		->toArray();
	$title_hits = json_encode(array_values($title));
	$this->set('title_hits', $title_hits);
	
		
//Get article title and hits in array used in treemap
$query = $this->Articles->find('list', [
    //'keyField' => 'slug',
    'valueField' => function ($row) {
			return '{x:"' . $row->title . '",y:' . $row->hits  . '}';
			//return $row->title . ',' . $row->hits;
		}]);

foreach ($query->all() as $row) {
}
$results = $query->all();
$hit_stats = $results->toList();
$hit_stats = $query->toArray();
$this->set('hit_stats', $hit_stats);
	
	$this->set(compact('monthly','yearly','sum_hits_jan','sum_hits_feb','sum_hits_mar','sum_hits_apr','sum_hits_may','sum_hits_jun','sum_hits_jul','sum_hits_aug','sum_hits_sep','sum_hits_oct','sum_hits_nov','sum_hits_dec'));	
	}
}
