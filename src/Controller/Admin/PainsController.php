<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;

/**
 * Pains Controller
 *
 * @property \App\Model\Table\PainsTable $Pains
 * @method \App\Model\Entity\Pain[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PainsController extends AppController
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
        $this->paginate = [
            'contain' => ['Users'],
        ];
		
		$query = $this->Pains->find('search', ['search' => $this->request->getQuery()])->contain(['Users']);
		$pains = $this->paginate($query)->toArray();
        //$pains = $this->paginate($this->Pains);

        $this->set(compact('pains'));
		
//January
	$this->set('jan_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jan_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
//February
	$this->set('feb_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('feb_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
//March
	$this->set('mar_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('mar_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
//April
	$this->set('apr_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('apr_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());		
//May
	$this->set('may_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
//June
	$this->set('jun_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
//July
	$this->set('jul_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jul_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
//August
	$this->set('aug_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('aug_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
//September
	$this->set('sep_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('sep_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
//October
	$this->set('oct_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('oct_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
//November
	$this->set('nov_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('nov_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
//December
	$this->set('dec_1', $this->Pains->find()
		->where(['DAY(date)' => date('1'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_2', $this->Pains->find()
		->where(['DAY(date)' => date('2'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_3', $this->Pains->find()
		->where(['DAY(date)' => date('3'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_4', $this->Pains->find()
		->where(['DAY(date)' => date('4'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_5', $this->Pains->find()
		->where(['DAY(date)' => date('5'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_6', $this->Pains->find()
		->where(['DAY(date)' => date('6'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_7', $this->Pains->find()
		->where(['DAY(date)' => date('7'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_8', $this->Pains->find()
		->where(['DAY(date)' => date('8'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_9', $this->Pains->find()
		->where(['DAY(date)' => date('9'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_10', $this->Pains->find()
		->where(['DAY(date)' => date('10'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_11', $this->Pains->find()
		->where(['DAY(date)' => date('11'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_12', $this->Pains->find()
		->where(['DAY(date)' => date('12'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_13', $this->Pains->find()
		->where(['DAY(date)' => date('13'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_14', $this->Pains->find()
		->where(['DAY(date)' => date('14'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_15', $this->Pains->find()
		->where(['DAY(date)' => date('15'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_16', $this->Pains->find()
		->where(['DAY(date)' => date('16'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_17', $this->Pains->find()
		->where(['DAY(date)' => date('17'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_18', $this->Pains->find()
		->where(['DAY(date)' => date('18'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_19', $this->Pains->find()
		->where(['DAY(date)' => date('19'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_20', $this->Pains->find()
		->where(['DAY(date)' => date('20'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_21', $this->Pains->find()
		->where(['DAY(date)' => date('21'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_22', $this->Pains->find()
		->where(['DAY(date)' => date('22'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_23', $this->Pains->find()
		->where(['DAY(date)' => date('23'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_24', $this->Pains->find()
		->where(['DAY(date)' => date('24'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_25', $this->Pains->find()
		->where(['DAY(date)' => date('25'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_26', $this->Pains->find()
		->where(['DAY(date)' => date('26'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_27', $this->Pains->find()
		->where(['DAY(date)' => date('27'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_28', $this->Pains->find()
		->where(['DAY(date)' => date('28'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_29', $this->Pains->find()
		->where(['DAY(date)' => date('29'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_30', $this->Pains->find()
		->where(['DAY(date)' => date('30'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
	$this->set('dec_31', $this->Pains->find()
		->where(['DAY(date)' => date('31'), 'MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());

//Count By Month
	$this->set('january', $this->Pains->find()->where(['MONTH(date)' => date('1'), 'YEAR(date)' => date('Y')])->count());
	$this->set('february', $this->Pains->find()->where(['MONTH(date)' => date('2'), 'YEAR(date)' => date('Y')])->count());
	$this->set('march', $this->Pains->find()->where(['MONTH(date)' => date('3'), 'YEAR(date)' => date('Y')])->count());
	$this->set('april', $this->Pains->find()->where(['MONTH(date)' => date('4'), 'YEAR(date)' => date('Y')])->count());
	$this->set('may', $this->Pains->find()->where(['MONTH(date)' => date('5'), 'YEAR(date)' => date('Y')])->count());
	$this->set('jun', $this->Pains->find()->where(['MONTH(date)' => date('6'), 'YEAR(date)' => date('Y')])->count());
	$this->set('july', $this->Pains->find()->where(['MONTH(date)' => date('7'), 'YEAR(date)' => date('Y')])->count());
	$this->set('august', $this->Pains->find()->where(['MONTH(date)' => date('8'), 'YEAR(date)' => date('Y')])->count());
	$this->set('september', $this->Pains->find()->where(['MONTH(date)' => date('9'), 'YEAR(date)' => date('Y')])->count());
	$this->set('october', $this->Pains->find()->where(['MONTH(date)' => date('10'), 'YEAR(date)' => date('Y')])->count());
	$this->set('november', $this->Pains->find()->where(['MONTH(date)' => date('11'), 'YEAR(date)' => date('Y')])->count());
	$this->set('december', $this->Pains->find()->where(['MONTH(date)' => date('12'), 'YEAR(date)' => date('Y')])->count());
    }

    /**
     * View method
     *
     * @param string|null $id Pain id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pain = $this->Pains->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('pain'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pain = $this->Pains->newEmptyEntity();
        if ($this->request->is('post')) {
            $pain = $this->Pains->patchEntity($pain, $this->request->getData());
//join medcine as array
			$medication_array =  $this->request->getData('medication');
			$medication_string = join(", ",$medication_array);
//debug($medication_string);
//exit;
			$pain->medication = $medication_string;
			$pain->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id'); //capture auth id
            if ($this->Pains->save($pain)) {
                $this->Flash->success(__('The pain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pain could not be saved. Please, try again.'));
        }
        $users = $this->Pains->Users->find('list', ['limit' => 200]);
        $this->set(compact('pain', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pain id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pain = $this->Pains->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pain = $this->Pains->patchEntity($pain, $this->request->getData());
            if ($this->Pains->save($pain)) {
                $this->Flash->success(__('The pain has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pain could not be saved. Please, try again.'));
        }
        $users = $this->Pains->Users->find('list', ['limit' => 200]);
        $this->set(compact('pain', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pain id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pain = $this->Pains->get($id);
        if ($this->Pains->delete($pain)) {
            $this->Flash->success(__('The pain has been deleted.'));
        } else {
            $this->Flash->error(__('The pain could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
