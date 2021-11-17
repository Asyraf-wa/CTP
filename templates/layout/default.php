<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
$c_name = $this->request->getParam('controller');
$a_name = $this->request->getParam('action');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $this->fetch('title'); ?></title>
		<?php if ($c_name == 'Articles' && $a_name == 'view'){
			echo $this->Html->meta('keywords', $article->meta_key, ['block' => true]);
			echo $this->Html->meta('description', $article->meta_description, ['block' => true]);
		}elseif ($c_name == 'Blogs' && $a_name == 'view'){
			echo $this->Html->meta('keywords', $blog->meta_key, ['block' => true]);
			echo $this->Html->meta('description', $blog->meta_description, ['block' => true]);
		}else
			echo $this->Html->meta('keywords', $meta_keyword, ['block' => true]);
			echo $this->Html->meta('description', $meta_desc, ['block' => true]);
		?>
		<?= $this->Html->meta('copyright', $meta_copyright, ['block' => true]); ?>
		<?php //echo $this->Html->meta('icon') ?>
		<?php echo $this->Html->meta('favicon.ico','/favicon.ico',['type' => 'icon']); ?>
		<?= $this->fetch('meta') ?>
	<?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js') ?>
	<?= $this->Html->css('dark.css') ?>
	<?php echo $this->Html->css(['custom']) ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Squada+One&family=Tourney:wght@100&display=swap" rel="stylesheet">
	<?php echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js', ['block' => 'scriptBottom']); ?>
	<?php echo $this->Html->script('dark.js', ['block' => 'scriptBottom']); ?>
	<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'); ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126181298-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-126181298-1');
	</script>
</head>
<body>
<div class="col-auto">
<div id="logo" src="" alt="logo"></div>
</div>
<!--Header-->
<div class="header bg-picture">
    <div class="container">
            <div class="container fw-bold">
            <div class="row pt-3 pb-3">
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
<!--Navigation bar-->
<?php echo $this->element('nav'); ?>
<!--Main Content-->
    <main class="main">
        <div class="">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
<!--Footer-->
<?php echo $this->element('footer'); ?>
<!-- Placed at the end of the document so the pages load faster -->
<div class="position-fixed py-2 px-3 bg-dark text-white rounded-pill" style="bottom:2.5rem;left:1rem;">
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="darkMode">
  <label id="darkModeLabel" for="darkMode">Light</label>
</div>
</div>
<script>
logoFade = document.getElementById("logoFade");

var myScrollFunc = function () {
	var y = window.scrollY;
	if (y >= 60) {
		logoFade.className = "logo-fade show"
	} else {
		logoFade.className = "logo-fade hide"
	}
};

window.addEventListener("scroll", myScrollFunc);
</script>
	<?= $this->fetch('scriptBottom') ?>
</body>
</html>
