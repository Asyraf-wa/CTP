<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\EventInterface;
//use Cake\Core\Configure;
use Cake\Utility\Hash;

class DashboardsController extends AppController
{
	public function index()
	{
		$this->loadModel('Articles');
		$this->loadModel('Blogs');
		$this->loadModel('Users');
		
		//$user = $this->Authentication->getIdentity();
		//debug($user);
		//exit;
		
		$auth_user = $this->Users->find('all')
			->where([
				'status' => 1,
				'id' => '1',
				])
			->order(['id' => 'DESC'])
			->limit(10);
		
		$articles = $this->Articles->find('all')
			->where([
				'published' => 1,
				//'category_id' => '1',
				])
			->order(['hits' => 'DESC'])
			->limit(5);
			
		$article_last = $this->Articles->find('all')
			->where([
				//'published' => 1,
				//'category_id' => '1',
				])
			->order(['created' => 'DESC'])
			->limit(5);
			
		$blogs = $this->Blogs->find('all')
			->where([
				'published' => 1,
				])
			->order(['hits' => 'DESC'])
			->limit(5);
			
		$blog_last = $this->Blogs->find('all')
			->where([
				//'published' => 1,
				//'category_id' => '1',
				])
			->order(['created' => 'DESC'])
			->limit(5);
			
		$total_quantity = $this->Articles->find();
		$count_quantity =$total_quantity->select(['sum' => $total_quantity->func()->sum('Articles.hits')])->first();
		$sum_quantity = $count_quantity->sum;
			
		$this->set(compact('articles','blogs','article_last','blog_last','auth_user','sum_quantity'));
		
	$this->set('article_count_all', $this->Articles->find()->count());
	$this->set('article_active', $this->Articles->find()->where(['published' => '1'])->count());
	$this->set('article_disabled', $this->Articles->find()->where(['published' => '3'])->count());
	$this->set('article_archived', $this->Articles->find()->where(['published' => '3'])->count());
	$this->set('article_featured', $this->Articles->find()->where(['featured' => '1'])->count());
	$this->set('article_unpublish', $this->Articles->find()->where(['published' => '3'])->count());
	
	$this->set('blog_count_all', $this->Blogs->find()->count());
	$this->set('blog_active', $this->Blogs->find()->where(['published' => '1'])->count());
	//$this->set('blog_disabled', $this->Blogs->find()->where(['published' => '3'])->count());
	//$this->set('blog_archived', $this->Blogs->find()->where(['published' => '3'])->count());
	//$this->set('blog_featured', $this->Blogs->find()->where(['featured' => '1'])->count());
	//$this->set('blog_unpublish', $this->Blogs->find()->where(['published' => '3'])->count());
	
//for chart article:
	$this->set('article_jan', $this->Articles->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_feb', $this->Articles->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_mar', $this->Articles->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_apr', $this->Articles->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_may', $this->Articles->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_jun', $this->Articles->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_jul', $this->Articles->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_aug', $this->Articles->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_sep', $this->Articles->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_oct', $this->Articles->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_nov', $this->Articles->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('article_dec', $this->Articles->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
//for chart blog:
	$this->set('blog_jan', $this->Blogs->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_feb', $this->Blogs->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_mar', $this->Blogs->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_apr', $this->Blogs->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_may', $this->Blogs->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_jun', $this->Blogs->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_jul', $this->Blogs->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_aug', $this->Blogs->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_sep', $this->Blogs->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_oct', $this->Blogs->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_nov', $this->Blogs->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
	$this->set('blog_dec', $this->Blogs->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());
	
	//article by month for kotak2 warna warni
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

	}
}