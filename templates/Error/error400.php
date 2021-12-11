<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Database\StatementInterface $error
 * @var string $message
 * @var string $url
 */
use Cake\Core\Configure;
use Cake\Error\Debugger;

$this->layout = 'error';

if (Configure::read('debug')) :
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.php');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString) ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?php Debugger::dump($error->params) ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php

$this->end();
endif;
?>
<h2><?php //echo h($message) ?></h2>


<!-- partial:index.partial.html -->
<div id="wrap">
    <div id="wordsearch">
      <ul>
        <li>k</li>

        <li>v</li>

        <li>n</li>

        <li>z</li>

        <li>i</li>

        <li>x</li>

        <li>m</li>

        <li>e</li>

        <li>t</li>

        <li>a</li>

        <li>x</li>

        <li>l</li>

        <li class="one">4</li>

        <li class="two">0</li>

        <li class="three">4</li>

        <li>y</li>

        <li>y</li>

        <li>w</li>

        <li>v</li>

        <li>b</li>

        <li>o</li>

        <li>q</li>

        <li>d</li>

        <li>y</li>

        <li>p</li>

        <li>a</li>

        <li class="four">p</li>

        <li class="five">a</li>

        <li class="six">g</li>

        <li class="seven">e</li>

        <li>v</li>

        <li>j</li>

        <li>a</li>

        <li class="eight">n</li>

        <li class="nine">o</li>

        <li class="ten">t</li>

        <li>s</li>

        <li>c</li>

        <li>e</li>

        <li>w</li>

        <li>v</li>

        <li>x</li>

        <li>e</li>

        <li>p</li>

        <li>c</li>

        <li>f</li>

        <li>h</li>

        <li>q</li>

        <li>e</li>

        <li class="eleven">f</li>

        <li class="twelve">o</li>

        <li class="thirteen">u</li>

        <li class="fourteen">n</li>

        <li class="fifteen">d</li>

        <li>s</li>

        <li>w</li>

        <li>q</li>

        <li>v</li>

        <li>o</li>

        <li>s</li>

        <li>m</li>

        <li>v</li>

        <li>f</li>

        <li>u</li>
      </ul>
    </div>

    <div id="main-content">
      <h1>We couldn't find what you were looking for.</h1>
		<p><strong><?= __d('cake', 'Error') ?>: </strong><?= __d('cake', 'The requested address {0} was not found on this server.', "<strong>'{$url}'</strong>") ?></p>
      <p>Unfortunately the page you were looking for could not be found. It may be
      temporarily unavailable, moved or no longer exist.</p>

      <p>Check the URL you entered for any mistakes and try again. Alternatively, navigate to the available resources:</p>

      <div id="navigation">
		<?php echo $this->Html->link('Home',['controller' => 'articles', 'action' => '', '_full' => true, 'prefix' => false],['class' => 'navigation']); ?>
		<?php echo $this->Html->link('Blog',['controller' => 'blogs', 'action' => '', '_full' => true, 'prefix' => false],['class' => 'navigation']); ?>
		<?php echo $this->Html->link('Project',['controller' => 'projects', 'action' => '', '_full' => true, 'prefix' => false],['class' => 'navigation']); ?>
		<?php echo $this->Html->link('Contact',['controller' => 'contact', 'action' => '', '_full' => true, 'prefix' => false],['class' => 'navigation']); ?>
		<?php echo $this->Html->link('Sitemap',['controller' => 'Sitemaps', 'action' => 'index', '_full' => true],['class' => 'navigation']); ?>
		<?php echo $this->Html->link(__('Back'), 'javascript:history.back()', ['class' => 'navigation']) ?>
      </div>
    </div>
  </div>
<!-- partial -->
  

