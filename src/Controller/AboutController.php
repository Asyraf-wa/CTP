<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * About Controller
 *
 */
class AboutController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('articles');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index']);
    }



    public function index()
    {
        $this->set('title', 'About Me');
    }
}
