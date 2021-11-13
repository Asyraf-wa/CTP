<?php
declare(strict_types=1);

namespace App\Controller\Admin;
use App\Controller\AppController;

/**
 * Fitnesses Controller
 *
 * @property \App\Model\Table\FitnessesTable $Fitnesses
 * @method \App\Model\Entity\Fitness[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FitnessesController extends AppController
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
			'maxLimit' => 20,
			'order' => ['registered_on' => 'DESC'],
        ];
        $fitnesses = $this->paginate($this->Fitnesses);
//start count/sum		
//count overall
		$get_fitnesses = $this->Fitnesses->find();
		$overall_fitnesses =$get_fitnesses->select(['sum' => $get_fitnesses->func()->sum('Fitnesses.counter')])
		//->where(['YEAR(registered_on)' => date('Y')])
		->first();
		$sum_overall_fitnesses = $overall_fitnesses->sum;
		
		$this->set('sum_overall_fitnesses_event', $this->Fitnesses->find()->count());
//count current year
		$get_fitnesses = $this->Fitnesses->find();
		$current_year =$get_fitnesses->select(['sum' => $get_fitnesses->func()->sum('Fitnesses.counter')])
		->where(['type IN' => ['Sit-Up','Pushups','Planks','Star-Jumps','Squats','Burpees'], 'YEAR(registered_on)' => date('Y')])
		->first();
		$sum_current_year_fitnesses = $current_year->sum;
		
		$this->set('sum_current_year_fitnesses_event', $this->Fitnesses->find()
			->where(['YEAR(registered_on)' => date('Y')])->count());
//count current Runnings
		$get_fitnesses = $this->Fitnesses->find();
		$current_year_running =$get_fitnesses->select(['sum' => $get_fitnesses->func()->sum('Fitnesses.counter')])
		->where(['type' => 'Running', 'YEAR(registered_on)' => date('Y')])
		->first();
		$sum_current_year_running = $current_year_running->sum;
//count current Cycling
		$get_fitnesses = $this->Fitnesses->find();
		$current_year_cycling =$get_fitnesses->select(['sum' => $get_fitnesses->func()->sum('Fitnesses.counter')])
		->where(['type' => 'Cycling', 'YEAR(registered_on)' => date('Y')])
		->first();
		$sum_current_year_cycling = $current_year_cycling->sum;
//count current planks
		$get_fitnesses = $this->Fitnesses->find();
		$current_year_planks =$get_fitnesses->select(['sum' => $get_fitnesses->func()->sum('Fitnesses.counter')])
		->where(['type' => 'Planks', 'YEAR(registered_on)' => date('Y')])
		->first();
		$sum_current_year_planks = $current_year_planks->sum;
//count current Sit-Up
		$get_fitnesses = $this->Fitnesses->find();
		$current_year_sit_up =$get_fitnesses->select(['sum' => $get_fitnesses->func()->sum('Fitnesses.counter')])
		->where(['type' => 'Sit-Up', 'YEAR(registered_on)' => date('Y')])
		->first();
		$sum_current_year_sit_up = $current_year_sit_up->sum;
//count current Pushups
		$get_fitnesses = $this->Fitnesses->find();
		$current_year_pushups =$get_fitnesses->select(['sum' => $get_fitnesses->func()->sum('Fitnesses.counter')])
		->where(['type' => 'Pushups', 'YEAR(registered_on)' => date('Y')])
		->first();
		$sum_current_year_pushups = $current_year_pushups->sum;
//count current Star-Jumps
		$get_fitnesses = $this->Fitnesses->find();
		$current_year_star =$get_fitnesses->select(['sum' => $get_fitnesses->func()->sum('Fitnesses.counter')])
		->where(['type' => 'Star-Jumps', 'YEAR(registered_on)' => date('Y')])
		->first();
		$sum_current_year_star = $current_year_star->sum;		
//count current Squats
		$get_fitnesses = $this->Fitnesses->find();
		$current_year_squats =$get_fitnesses->select(['sum' => $get_fitnesses->func()->sum('Fitnesses.counter')])
		->where(['type' => 'Squats', 'YEAR(registered_on)' => date('Y')])
		->first();
		$sum_current_year_squats = $current_year_squats->sum;	
//count current Burpees
		$get_fitnesses = $this->Fitnesses->find();
		$current_year_burpees =$get_fitnesses->select(['sum' => $get_fitnesses->func()->sum('Fitnesses.counter')])
		->where(['type' => 'Burpees', 'YEAR(registered_on)' => date('Y')])
		->first();
		$sum_current_year_burpees = $current_year_burpees->sum;	
		
		//debug($current_year_planks);
		//exit;
		
		
		$query = $this->Fitnesses
		->find('search', ['search' => $this->request->getQuery()])->contain(['Users']);
		//->where(['status' => '1']);
		$fitnesses = $this->paginate($query)->toArray();

        $this->set(compact('fitnesses','sum_overall_fitnesses','sum_current_year_fitnesses','sum_current_year_planks','sum_current_year_sit_up','sum_current_year_pushups','sum_current_year_star','sum_current_year_squats','sum_current_year_burpees','sum_current_year_running','sum_current_year_cycling'));
		
//Count Running By Month, Current Year (CY)
	//count kekerapan running
	$this->set('running_event', $this->Fitnesses->find()->where(['type' => 'Running', 'YEAR(registered_on)' => date('Y')])->count());
	
	$this->set('jan_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_run_cy', $this->Fitnesses->find()->where(['type' => 'Running', 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	
	//count kekerapan running
	$this->set('cycling_event', $this->Fitnesses->find()->where(['type' => 'Cycling', 'YEAR(registered_on)' => date('Y')])->count());
	
	$this->set('jan_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_cycling_cy', $this->Fitnesses->find()->where(['type' => 'Cycling', 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
		
//Count Sit-Up By Month, Current Year (CY)
	$this->set('jan_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_sit_cy', $this->Fitnesses->find()->where(['type' => 'Sit-Up', 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	
//Count Pushups By Month, Current Year (CY)
	$this->set('jan_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_pushups_cy', $this->Fitnesses->find()->where(['type' => 'Pushups', 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	
//Count Planks By Month, Current Year (CY)
	$this->set('jan_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_planks_cy', $this->Fitnesses->find()->where(['type' => 'Planks', 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	
//Count Star-Jumps By Month, Current Year (CY)
	$this->set('jan_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_star_cy', $this->Fitnesses->find()->where(['type' => 'Star-Jumps', 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());

//Count Squats By Month, Current Year (CY)
	$this->set('jan_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_squats_cy', $this->Fitnesses->find()->where(['type' => 'Squats', 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());	
	
//Count Burpees By Month, Current Year (CY)
	$this->set('jan_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_burpees_cy', $this->Fitnesses->find()->where(['type' => 'Burpees', 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());	
	
//DAILY COUNTER
//January
	$this->set('jan_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jan_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('1'), 'YEAR(registered_on)' => date('Y')])->count());
//February
	$this->set('feb_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('feb_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('2'), 'YEAR(registered_on)' => date('Y')])->count());
//March
	$this->set('mar_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('mar_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('3'), 'YEAR(registered_on)' => date('Y')])->count());
//April
	$this->set('apr_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('apr_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('4'), 'YEAR(registered_on)' => date('Y')])->count());		
//May
	$this->set('may_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('may_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('5'), 'YEAR(registered_on)' => date('Y')])->count());
//June
	$this->set('jun_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jun_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('6'), 'YEAR(registered_on)' => date('Y')])->count());
//July
	$this->set('jul_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('jul_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('7'), 'YEAR(registered_on)' => date('Y')])->count());
//August
	$this->set('aug_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('aug_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('8'), 'YEAR(registered_on)' => date('Y')])->count());
//September
	$this->set('sep_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('sep_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('9'), 'YEAR(registered_on)' => date('Y')])->count());
//October
	$this->set('oct_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('oct_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('10'), 'YEAR(registered_on)' => date('Y')])->count());
//November
	$this->set('nov_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('nov_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('11'), 'YEAR(registered_on)' => date('Y')])->count());
//December
	$this->set('dec_1', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('1'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_2', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('2'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_3', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('3'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_4', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('4'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_5', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('5'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_6', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('6'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_7', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('7'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_8', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('8'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_9', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('9'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_10', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('10'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_11', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('11'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_12', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('12'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_13', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('13'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_14', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('14'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_15', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('15'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_16', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('16'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_17', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('17'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_18', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('18'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_19', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('19'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_20', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('20'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_21', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('21'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_22', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('22'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_23', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('23'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_24', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('24'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_25', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('25'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_26', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('26'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_27', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('27'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_28', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('28'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_29', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('29'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_30', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('30'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());
	$this->set('dec_31', $this->Fitnesses->find()
		->where(['DAY(registered_on)' => date('31'), 'MONTH(registered_on)' => date('12'), 'YEAR(registered_on)' => date('Y')])->count());

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
		//$this->Authentication->getIdentity('id');
		//debug($this->Authentication->getIdentity('id')->getIdentifier('id'));
		//exit;
		
        $fitness = $this->Fitnesses->newEmptyEntity();
        if ($this->request->is('post')) {
            $fitness = $this->Fitnesses->patchEntity($fitness, $this->request->getData());
			$fitness->user_id = $this->Authentication->getIdentity('id')->getIdentifier('id'); //capture auth id
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
