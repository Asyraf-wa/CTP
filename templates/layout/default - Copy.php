<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
	
	<?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css') ?>
	<?= $this->Html->css('dark.css') ?>
	<?php echo $this->Html->css(['custom']) ?>
	<?= $this->Html->script('qr-code-styling-1-5-0.min.js'); ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Squada+One&family=Tourney:wght@100&display=swap" rel="stylesheet">
	
	<?php //echo $this->Html->script('https://code.jquery.com/jquery-3.2.1.slim.min.js',['integrity' => 'sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN', 'crossorigin' => 'anonymous', 'block' => 'scriptBottom']); ?>
	<?php echo $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', ['block' => 'scriptBottom']); ?>
	<?php echo $this->Html->script('dark.js', ['block' => 'scriptBottom']); ?>
	
	<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'); ?>
	<?php //echo $this->Html->script('https://code.jquery.com/jquery-3.2.1.slim.min.js', ['block' => 'scriptBottom']); ?>
	<?php //echo $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', ['block' => 'scriptBottom']); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div class="col-auto">
<div id="logo" src="" alt="logo"></div>
</div>

<!--Header-->
<div class="header bg-picture">
    <div class="container">
            <div class="container fw-bold">
            <div class="row top-bar-padding">
                <div class="col-10">
					<div class="site-name-bg">
						<b class="gradient-animate">&lt;&#47;&gt; Code The Pixel</b>
					</div>
                </div>
                <div class="col-2 text-end">
                
                </div>
            </div>
            </div>
    </div>
</div>


<!--Navigation-->
<div class="container-fluid sticky-top navbar-light bg-light">
<nav class="container navbar navbar-expand-sm sticky-top navbar-light bg-light">
<div class="container">
	<a class="navbar-brand" href="#"><b class="gradient-animate-small">&lt;&#47;&gt; CTP</b></a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="main_nav">
		<ul class="navbar-nav">
			<li class="nav-item"><?= $this->Html->link('Home',['controller' => 'articles', 'action' => 'index', '_full' => true],['class' => 'nav-link']); ?> </li>
			<li class="nav-item"><?= $this->Html->link('Blog',['controller' => 'blogs', 'action' => 'index', '_full' => true],['class' => 'nav-link']); ?> </li>
			<li class="nav-item"><?= $this->Html->link('Project',['controller' => 'projects', 'action' => 'index', '_full' => true],['class' => 'nav-link']); ?> </li>
			<li class="nav-item"><?= $this->Html->link('Contact',['controller' => 'contacts', 'action' => 'index', '_full' => true],['class' => 'nav-link']); ?> </li>
			<li class="nav-item dropdown has-megamenu">
				<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Mega menu  </a>
				<div class="dropdown-menu megamenu" role="menu">
					<div class="container">
					  <div class="row">
						<div class="col">
						  CakePHP<br>
						  <?= $this->Html->link('Home',['controller' => 'articles', 'action' => 'index', '_full' => true],['class' => 'nav-link']); ?>
						</div>
						<div class="col">
						  Joomla!
						</div>
						<div class="col">
						  Column
						</div>
					  </div>
					</div>
				</div> <!-- dropdown-mega-menu.// -->
			</li>
		</ul>
		<ul class="navbar-nav ms-auto">
			<li class="nav-item"><a class="nav-link" href="#"> Menu item </a></li>
			<li class="nav-item dropdown">
				<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> Dropdown right </a>
			    <ul class="dropdown-menu dropdown-menu-end">
				  <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
				  <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
			    </ul>
			</li>
		</ul>
	</div>
</div>
</nav>
</div>
<!--Main Content-->
    <main class="main">
        <div class="">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

<!--Footer-->
<div class="container-fluid bg-dark text-light">
<div class="container footer"> 
<div class="badge bg-primary text-wrap">© Copyright <?= date('Y'); ?> Code The Pixel</div>
<div class="badge bg-danger text-wrap">Powered by CakePHP</div>
</div>
</div>




    <!-- Placed at the end of the document so the pages load faster -->
<div class="position-fixed py-2 px-3 bg-dark text-white rounded-pill" style="bottom:1rem;left:1rem;">
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="darkMode">
  <label id="darkModeLabel" for="darkMode">Light</label>
</div>
</div>
	<?= $this->fetch('scriptBottom') ?>

</body>

</html>
