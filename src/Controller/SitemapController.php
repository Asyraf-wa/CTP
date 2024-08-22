<?php

declare(strict_types=1);

namespace App\Controller;


use Cake\Routing\Router;

/**
 * Sitemap Controller
 *
 */
class SitemapController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    public function index()
    {
        $this->set('title', 'Sitemap');
        $articles = $this->fetchTable('Articles');
        //debug($articles);
        //exit;
        $articles = $articles->find('all');
        //debug($articles);
        //exit;
        //->where(['user_id' => $userID])
        //->orderBy(['created' => 'DESC']);
        // Set response type to XML
        $this->response = $this->response->withType('xml');

        // Disable CakePHP layout for the XML file
        $this->viewBuilder()->setLayout('')->setClassName('Xml');

        //Get the base URL of your website
        $url = Router::url('/', true);
        //debug($url);
        //exit;
        $this->set('articles', $articles, 'url', $url);
    }
}
