<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Utility\Hash;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout('articles');
        $this->loadComponent('Search.Search', [
            'actions' => ['index'],
        ]);
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index', 'view']);
    }

    /*public function viewClasses(): array
    {
        return [JsonView::class];
		return [JsonView::class, XmlView::class];
    }*/

    public function json()
    {
        $this->viewBuilder()->setLayout('json');
        $this->set('articles', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'articles');
    }

    public function csv()
    {
        $this->response = $this->response->withDownload('articles.csv');
        $articles = $this->Articles->find();
        $_serialize = 'articles';

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('articles', '_serialize'));
    }

    public function pdfList()
    {
        $this->viewBuilder()->enableAutoLayout(false);
        $this->paginate = [
            'contain' => ['Users', 'Categories'],
            'maxLimit' => 10,
        ];
        $articles = $this->paginate($this->Articles);
        $this->viewBuilder()->setClassName('CakePdf.Pdf');
        $this->viewBuilder()->setOption(
            'pdfConfig',
            [
                'orientation' => 'portrait',
                'download' => true,
                'filename' => 'articles_List.pdf'
            ]
        );
        $this->set(compact('articles'));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->set('title', 'Articles List');
        $this->paginate = [
            'maxLimit' => 20,
        ];
        /*  $query = $this->Articles->find('search', search: $this->request->getQueryParams())
            ->contain(['Users', 'Categories', 'Tags'])
            ->where(['Articles.status' => 1])
            ->orderBy(['Articles.publish_on' => 'DESC']);
        $articles = $this->paginate($query); */

        $query = $this->Articles
            ->find('search', search: $this->request->getQueryParams())
            //->contain(['Tags'])
            ->contain(['Users', 'Categories', 'Tags'])
            ->where(['Articles.status' => 1])
            ->where(['category_id' => '1', '2', '3', '4'])
            ->orderBy(['Articles.publish_on' => 'DESC']);
        $articles = $this->paginate($query);
        //$articles = $this->paginate($query)->toArray();

        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $tags = $this->Articles->Tagged->find()->distinct(['Tags.slug', 'Tags.label'])->contain(['Tags'])->toArray();
        $tags = Hash::combine($tags, '{n}.tag.slug', '{n}.tag.label');
        //$this->set(compact('articles','categories'));
        //$this->set(compact('articles', 'categories', 'tags'));

        //$this->set('_serialize', ['users']);

        //count
        $this->set('total_articles', $this->Articles->find()->count());
        $this->set('total_articles_archived', $this->Articles->find()->where(['status' => 2])->count());
        $this->set('total_articles_active', $this->Articles->find()->where(['status' => 1])->count());
        $this->set('total_articles_disabled', $this->Articles->find()->where(['status' => 0])->count());


        $query = $this->Articles->find();

        $expectedMonths = [];
        for ($i = 11; $i >= 0; $i--) {
            $expectedMonths[] = date('M-Y', strtotime("-$i months"));
        }

        $query->select([
            'count' => $query->func()->count('*'),
            'date' => $query->func()->date_format(['created' => 'identifier', "%b-%Y"]),
            'month' => 'MONTH(created)',
            'year' => 'YEAR(created)'
        ])
            ->where([
                'created >=' => date('Y-m-01', strtotime('-11 months')),
                'created <=' => date('Y-m-t')
            ])
            ->groupBy(['year', 'month'])
            ->orderBy(['year' => 'ASC', 'month' => 'ASC']);

        $results = $query->all()->toArray();

        $totalByMonth = [];
        foreach ($expectedMonths as $expectedMonth) {
            $found = false;
            $count = 0;

            foreach ($results as $result) {
                if ($expectedMonth === $result->date) {
                    $found = true;
                    $count = $result->count;
                    break;
                }
            }

            $totalByMonth[] = [
                'month' => $expectedMonth,
                'count' => $count
            ];
        }

        $this->set([
            'results' => $totalByMonth,
            '_serialize' => ['results']
        ]);

        //data as JSON arrays for report chart
        $totalByMonth = json_encode($totalByMonth);
        $dataArray = json_decode($totalByMonth, true);
        $monthArray = [];
        $countArray = [];
        foreach ($dataArray as $data) {
            $monthArray[] = $data['month'];
            $countArray[] = $data['count'];
        }

        $allTags = $this->fetchTable('TagsTags');
        //$taggung_kira = $taggung->find()->all()->count();
        $tagging = $allTags->find('all')->orderBy(['label' => 'ASC']);





        //debug($tagging);
        //exit;


        //$tagging = $this->TagsTags->find('all');

        /* ->where([
				'status' => 1,
				'id' => '1',
				]) */
        //    ->order(['label' => 'ASC']);
        //debug($tagging);
        //exit;
        $tags = $this->Articles->Tagged->find('cloud')->toArray();

        $this->set(compact('articles', 'categories', 'tags', 'monthArray', 'countArray', 'tags', 'tagging'));
    }

    public function blog()
    {
        $this->set('title', 'Blog');
        $this->paginate = [
            'maxLimit' => 20,
        ];
        $query = $this->Articles
            ->find('search', search: $this->request->getQueryParams())
            //->contain(['Tags'])
            ->contain(['Users', 'Categories', 'Tags'])
            ->where(['Articles.status' => 1])
            ->where(['category_id' => '1', '2', '3', '4'])
            ->orderBy(['Articles.publish_on' => 'DESC']);
        $blogs = $this->paginate($query);
        //$articles = $this->paginate($query)->toArray();

        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $tags = $this->Articles->Tagged->find()->distinct(['Tags.slug', 'Tags.label'])->contain(['Tags'])->toArray();
        $tags = Hash::combine($tags, '{n}.tag.slug', '{n}.tag.label');

        //count
        $this->set('total_articles', $this->Articles->find()->count());
        $this->set('total_articles_archived', $this->Articles->find()->where(['status' => 2])->count());
        $this->set('total_articles_active', $this->Articles->find()->where(['status' => 1])->count());
        $this->set('total_articles_disabled', $this->Articles->find()->where(['status' => 0])->count());


        $query = $this->Articles->find();

        $expectedMonths = [];
        for ($i = 11; $i >= 0; $i--) {
            $expectedMonths[] = date('M-Y', strtotime("-$i months"));
        }

        $query->select([
            'count' => $query->func()->count('*'),
            'date' => $query->func()->date_format(['created' => 'identifier', "%b-%Y"]),
            'month' => 'MONTH(created)',
            'year' => 'YEAR(created)'
        ])
            ->where([
                'created >=' => date('Y-m-01', strtotime('-11 months')),
                'created <=' => date('Y-m-t')
            ])
            ->groupBy(['year', 'month'])
            ->orderBy(['year' => 'ASC', 'month' => 'ASC']);

        $results = $query->all()->toArray();

        $totalByMonth = [];
        foreach ($expectedMonths as $expectedMonth) {
            $found = false;
            $count = 0;

            foreach ($results as $result) {
                if ($expectedMonth === $result->date) {
                    $found = true;
                    $count = $result->count;
                    break;
                }
            }

            $totalByMonth[] = [
                'month' => $expectedMonth,
                'count' => $count
            ];
        }

        $this->set([
            'results' => $totalByMonth,
            '_serialize' => ['results']
        ]);

        //data as JSON arrays for report chart
        $totalByMonth = json_encode($totalByMonth);
        $dataArray = json_decode($totalByMonth, true);
        $monthArray = [];
        $countArray = [];
        foreach ($dataArray as $data) {
            $monthArray[] = $data['month'];
            $countArray[] = $data['count'];
        }

        $allTags = $this->fetchTable('TagsTags');
        $tagging = $allTags->find('all')->orderBy(['label' => 'ASC']);
        $tags = $this->Articles->Tagged->find('cloud')->toArray();

        $this->set(compact('blogs', 'categories', 'tags', 'monthArray', 'countArray', 'tags', 'tagging'));
    }
    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($slug = null, $id = null)
    {
        $this->set('title', 'Articles Details');

        $article = $this->Articles
            ->findBySlug($slug)
            ->contain(['Users', 'Categories'])
            ->firstOrFail();

        $query = $this->Articles->find();
        $totalHits = $query->select(['total' => $query->func()->sum('hits')])->first()->total;

        $popular = $this->Articles->find()
            ->where([
                'status' => 1,
                //'category_id' => '1',
            ])
            ->orderBy(['hits' => 'DESC'])
            ->limit(7);

        $latest = $this->Articles->find()
            ->where(['status' => 1])
            ->orderBy(['publish_on' => 'DESC'])
            ->limit(12)
            ->all();


        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $tags = $this->Articles->Tagged->find()->distinct(['Tags.slug', 'Tags.label'])->contain(['Tags'])->toArray();
        $tags = Hash::combine($tags, '{n}.tag.slug', '{n}.tag.label');
        //$this->set(compact('articles','categories'));
        //$this->set(compact('articles', 'categories', 'tags'));



        //$articleHits = $this->request->getData('Articles.hits');

        //debug($articleHits);
        //exit;

        //$percentage_hits = $articleHits * 100 / $totalHits;

        $quotes = $this->fetchTable('Quotes');
        $random_quote = $quotes->find()
            ->where(['status' => 1])
            ->limit(1)
            ->orderBy('rand()');
        //->firstOrFail();

        $this->set(compact('article', 'popular', 'latest', 'totalHits', 'tags', 'random_quote'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->set('title', 'New Articles');
        /*EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Add']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Articles']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});*/
        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200])->all();
        $categories = $this->Articles->Categories->find('list', ['limit' => 200])->all();
        $this->set(compact('article', 'users', 'categories'));
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
        $this->set('title', 'Articles Edit');
        /*EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Articles']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});*/
        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list', limit: 200)->all();
        $categories = $this->Articles->Categories->find('list', limit: 200)->all();
        $this->set(compact('article', 'users', 'categories'));
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
        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $log) {
                $log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
                $log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Articles']);
                $log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
                $log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
                $log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
            }
        });
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function archived($id = null)
    {
        $this->set('title', 'Articles Edit');
        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $log) {
                $log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
                $log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Articles']);
                $log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
                $log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
                $log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
            }
        });
        $article = $this->Articles->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $article->status = 2; //archived
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been archived.'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The article could not be archived. Please, try again.'));
        }
        $this->set(compact('article'));
    }
}
