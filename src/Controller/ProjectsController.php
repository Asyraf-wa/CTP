<?php
declare(strict_types=1);

namespace App\Controller;

class ProjectsController extends AppController
{
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
		$this->Authentication->addUnauthenticatedActions(['index','view']);
	}
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['search'],
		]);
	}
    public function index()
    {
		$this->paginate = [
		'contain' => ['Users'],
		'maxLimit' => 200,
		'order' => ['publish_on' => 'DESC'],
		];
		
        $projects = $this->paginate($this->Projects);

        $this->set(compact('projects'));
    }

    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('project'));
    }
}
