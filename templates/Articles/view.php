<?php 
$this->assign('title', $article->title);
use Cake\Routing\Router;
echo $this->Html->css('prism.css');
echo $this->Html->script('prism.js', ['block' => 'scriptBottom']); 
echo $this->Html->script('clipboard.min.js'); 
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
?>
    <section class="header-view text-light shadow">
	  <div class="row g-0">
		<div class="col-md-2">
		  
		</div>
		<div class="col-md-6">
			<div class="article-header-text text-secondary">
			  <h2 class="fw-bold text-light"><?= h($article->title) ?></h2>
			  <?= h($article->user->fullname) ?> - <?= date('F d, Y', strtotime($article->publish_on)); ?>
			  <hr>
			  <button type="button" class="btn article-header-circle"><i class="far fa-folder"></i> <?= h($article->category->title) ?></button>
			  <button type="button" class="btn article-header-circle"><i class="far fa-eye"></i> <?= h($article->hits) ?></button>
			  <?= $this->Html->link(__('<i class="far fa-thumbs-up"></i> Like'), ['action' => 'like', $article->slug], ['class' => 'btn hits article-header-circle', 'escape' => false, 'title' => 'Like']) ?>
			  <?php if ($article->featured == 1){
					echo '<button type="button" class="btn article-header-circle-star text-white" title="Recommended"><i class="fas fa-star"></i> </button> ';
				}else
					'';
				?>
				<?= $this->Html->link(__('<i class="far fa-file-pdf"></i> PDF'), ['action' => 'pdf', $article->slug], ['class' => 'btn hits article-header-circle', 'escape' => false, 'title' => 'Save as PDF']) ?>
<?php
if ($this->Identity->isLoggedIn()) { ?>
<button class="btn btn-sm shadow-none bg-danger text-light btn-outline-secondary rounded-circle mt-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	<i class="fas fa-bars"></i>
</button>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('List'), ['prefix' => 'Admin', 'controller' => 'Projects', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['prefix' => 'Admin', 'action' => 'edit', $article->id], ['class' => 'dropdown-item', 'escape' => false]) ?> 
	<?= $this->Form->postLink(__('<i class="far fa-trash-alt"></i> Delete'), ['prefix' => 'Admin', 'action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'dropdown-item', 'escape' => false]) ?> 
	<?= $this->Form->create ?>
<?php if ($article->published == 1) {
	echo $this->Form->postLink(__('<i class="fas fa-exclamation-triangle"></i> Unpublish'), ['action' => 'articlePublished', $article->id, $article->published], ['block' => true, 'confirm' => __('Are you sure you want to unpublish # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title'=>'Unpublish Article']);
}else
	echo $this->Form->postLink(__('<i class="fas fa-check"></i> Publish'), ['action' => 'articlePublished', $article->id, $article->published], ['block' => true, 'confirm' => __('Are you sure you want to publish # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title'=>'Publish Article']); ?>

<?php if ($article->featured == 1) {
	echo $this->Form->postLink(__('<i class="fas fa-exclamation-triangle"></i> Unfeatured'), ['action' => 'articleFeatured', $article->id, $article->featured], ['block' => true, 'confirm' => __('Are you sure you want to unfeatured # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title'=>'Unfeatured Article']);
}else
	echo $this->Form->postLink(__('<i class="fas fa-check"></i> Featured'), ['action' => 'articleFeatured', $article->id, $article->featured], ['block' => true, 'confirm' => __('Are you sure you want to featured # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title'=>'Featured Article']); ?>
		
<?= $this->Form->end() ?>
	<?= $this->fetch('postLink'); ?>
	
	<?= $this->Form->create ?>
<?php if ($article->published == 1) {
	echo $this->Form->postLink(__('<i class="fas fa-exclamation-triangle"></i> Unpublish'), ['action' => 'articlePublished', $article->id, $article->published], ['block' => true, 'confirm' => __('Are you sure you want to unpublish # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title'=>'Unpublish Article']);
}else
	echo $this->Form->postLink(__('<i class="fas fa-check"></i> Publish'), ['action' => 'articlePublished', $article->id, $article->published], ['block' => true, 'confirm' => __('Are you sure you want to publish # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title'=>'Publish Article']); ?>

<?php if ($article->featured == 1) {
	echo $this->Form->postLink(__('<i class="fas fa-exclamation-triangle"></i> Unfeatured'), ['action' => 'articleFeatured', $article->id, $article->featured], ['block' => true, 'confirm' => __('Are you sure you want to unfeatured # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title'=>'Unfeatured Article']);
}else
	echo $this->Form->postLink(__('<i class="fas fa-check"></i> Featured'), ['action' => 'articleFeatured', $article->id, $article->featured], ['block' => true, 'confirm' => __('Are you sure you want to featured # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title'=>'Featured Article']); ?>
		
<?= $this->Form->end() ?>
	<?= $this->fetch('postLink'); ?>
  </ul>
<?php } ?>
				<br><br>
<small class="text-muted">
Estimated reading time: 
<?php
    $content = $article->body;

    $words = str_word_count(strip_tags($content));
    $minutes = floor( $words / 200 );
    $seconds = floor( $words % 200 / ( 200 / 60 ) );

    if (1 <= $minutes) {
        $estimated_time = $minutes . ' minute' . ($minutes == 1 ? '' : 's') . ', ' . $seconds . ' second' . ($seconds == 1 ? '' : 's');
    } else {
        $estimated_time = $seconds . ' second' . ($seconds == 1 ? '' : 's');
    }
    echo $estimated_time;
?>
<!--Breadcrumbs-->
<?php
    $this->Breadcrumbs->add([
        [
            'title' => 'Home', 
            'url' => ['controller' => 'Articles', 'action' => 'index'],
            'options' => ['class'=> 'breadcrumb-item']
        ],
        [
            'title' => $article->title, 
            'url' => ['controller' => 'articles', 'action' => 'view', $article->id],
            'options' => [
                'class' => 'breadcrumb-item',
                'innerAttrs' => [
                    'class' => 'breadcrumb',
                    'id' => 'the-products-crumb'
                ]
            ]
        ]
    ]);
?>
<div class="breadcrumb-gradient ps-2 mt-2">
	<?php
		$this->Breadcrumbs->setTemplates([
		  'wrapper' => '<div aria-label="breadcrumb" class="container"><ol class="breadcrumb" {{attrs}}>{{content}}</ol></div>',
		  'item' => '<li {{attrs}}>{{icon}}<a href="{{url}}"{{innerAttrs}} class="breadcrumb">{{title}}</a></li>{{separator}}',
		]);
		echo $this->Breadcrumbs->render();
	?>
</div>
</small>
			</div>
		</div>
		<div class="col-md-4">
			<div class="big-feed-container">
			<?php echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'article-header-cover', 'width' => '500px', 'height' => '500px']); ?>
			<div class="article-header-gradient">
			</div>
			</div>
		</div>
	  </div>
    </section>
	

<!--
<small>
	<div class="mt-1 pb-1 shadow">

	</div>
</small>
-->
	
<div class="container mt-5 text-secondary">
  <div class="row">
    <div class="col-md-9">
		<div class="has-dropcap mb-6">
			<?= $article->body ?>
		</div>
<hr>

<div class="badge bg-primary text-wrap">
  Cite this article (APA 6th Edition)
</div>

<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="" aria-label="Copy" aria-describedby="button-addon2" value="<?php echo $article->user->fullname; ?>. <?= h($article->title) ?>. Retrieved <?php echo date("d F, Y"); ?>, from <?php echo Router::url(null, true); ?>" id="myInput" size="100%">
  <button class="btn btn-outline-secondary" onclick="myFunction()" data-clipboard-target="#myInput"><i class="far fa-clipboard"></i></button>
</div>

<?php echo h($article->tag_list); ?>
<hr>

<div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://codethepixel.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

<!-- Trigger -->
<script>
var clipboard = new ClipboardJS('.btn');

clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});
</script>
			


<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);
  
  /* Alert the copied text */
  alert("Reference copied: " + copyText.value);
}
</script>
	  
	  
	  
	  
    </div>
    <div class="col-md-3">
<!--	
	<div class="input-group mb-3 mt-2">
	  <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
	  <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
	</div>
-->	
<div class="fw-bold fs-5">Popular</div>
<div class="line-divider mb-2"></div>

<?php foreach ($popular as $article): ?>
<?php 
	$domain = Router::url("/", true);
	$sub = 'articles/';
	$identifier = $article->slug;
	$combine = $domain . $sub . $identifier;
?>
<a href="<?= $combine; ?>" class="module-link">
<div class="mb-1">
  <div class="card-body py-0">
	<div class="row">
		<div class="col-md-4 col-3 px-0 my-0">
		  <?php echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'img-thumbnail', 'width' => '100px', 'style' => 'height: 80px;']); ?>
		</div>
		<div class="col-md-8 col-9 px-1">

	<div class="fw-bold fs-6 mx-1 text-secondary"><?= h($article->title) ?></div>
	<div class="text-small mx-1 text-secondary"><?= date('F, d Y', strtotime($article->publish_on)); ?></div>

		</div>
	</div>
  </div>
</div>
</a>

<?php endforeach; ?>


<div class="fw-bold fs-5 pt-3">Share</div>
<div class="line-divider mb-2"></div>


	


			<div class="mb-3">
			  <div class="row g-0">
				<div class="col-5">
			<div id="qr" align="center"></div>
			<script type="text/javascript">
				const qrCode = new QRCodeStyling({
					width: 130,
					height: 130,
					margin: 0,
					//type: "svg",
					data: "<?php echo $this->request->getUri(); ?>",
					dotsOptions: {
						//color: "#4267b2",
						type: "dots"
					},
					cornersSquareOptions: {
						type: "dots",
						color: "#007bff",
					},
					cornersDotOptions: {
						type: "dots"
					},
					backgroundOptions: {
						//color: "#ffffff",
					},
					imageOptions: {
						crossOrigin: "anonymous",
						margin: 20
					}
				});

				qrCode.append(document.getElementById("qr"));
				//qrCode.download({ name: "qr", extension: "png" });
			</script>
				</div>
				<div class="col-7">
				  <div class="card-body">
					<h5 class="card-title fw-bold">Sharing Link</h5>
					Click the icon to share
					<p class="card-text">
			<?php echo $this->SocialShare->fa('email', null, ['icon_class' => 'far fa-envelope text-danger', 'title' => 'Email']); ?>&nbsp;&nbsp;
			<?php echo $this->SocialShare->fa('whatsapp', null, ['icon_class' => 'fab fa-whatsapp text-success', 'title' => 'Whatsapp']); ?>&nbsp;&nbsp;
			<?php echo $this->SocialShare->fa('facebook', null, ['icon_class' => 'fab fa-facebook-f text-primary', 'title' => 'Facebook']); ?>&nbsp;&nbsp;
			<?php echo $this->SocialShare->fa('twitter', null, ['icon_class' => 'fab fa-twitter text-primary', 'title' => 'Twitter']); ?>&nbsp;&nbsp;
			<?php echo $this->SocialShare->fa('reddit', null, ['icon_class' => 'fab fa-reddit-alien text-danger', 'title' => 'Reddit']); ?>
					</p>
					
	<style>
		.tag-cloud li {
			float: left;
			padding: 2px;
			display: inline-block;
			list-style: none;
		}
		.tag-cloud {
			clear: both;
		}
	</style>

	<?php
	//$this->loadHelper('Tags.TagCloud');

	//echo $this->TagCloud->display($tags, [], ['class' => 'tag-cloud']);
	?>					
					
					
				  </div>
				</div>
			  </div>
			</div>
			



<!--
<div class="card border borderless mb-3">
  <div class="card-header module-blue">
		<div class="icon-robot icon-robot-tangan mt-0 text-light">Latest Posting</div>
  </div>
<ul class="list-group">
<?php //foreach ($latest as $article): ?>	
<?php 
	//$domain = Router::url("/", true);
	//$sub = 'articles/view/';
	//$identifier = $article->id;
	//$combine = $domain . $sub . $identifier;
?>
<a href="<?php //echo $combine; ?>" class="module-link">
	<li class="list-group-item text-secondary"><i class="fas fa-caret-right text-primary"></i> <?= h($article->title) ?></li>
</a>
<?php //endforeach; ?>
</ul>
</div>
-->


    </div>
  </div>
  
<!-- 
<div class="container">
  <div class="row">
<?php foreach ($random as $article): ?>	
<?php 
	$domain = Router::url("/", true);
	$sub = 'articles/view/';
	$identifier = $article->id;
	$combine = $domain . $sub . $identifier;
?>
    <div class="col-md-3 g-3">
	  <div class="card">
	  <a href="<?= $combine; ?>" class="module-link">
		<div class="">
			<?php echo $this->Html->image('../files/articles/poster/' . $article->poster_dir . '/' . $article->poster,['class' =>'footer-bg-cover', 'width' => '', 'height' => '150px']); ?>
		</div>
		<div class="card-body text-secondary">
		  <h5 class="card-title fw-bold">
		  <?php echo strip_tags($this->Text->truncate($article->title,30,
					[
						'ellipsis' => '...',
						'exact' => false
					]));
			?>
		  </h5>
		  <p class="card-text justify">
			<?php echo strip_tags($this->Text->truncate($article->body,60,
					[
						'ellipsis' => '...',
						'exact' => false
					]));
			?>
		  </p>
		</div>
		<div class="card-footer">
		  <small class="text-muted">
			<div class="badge bg-secondary text-wrap"><i class="far fa-eye"></i>&nbsp;&nbsp;<?= $article->hits ?></div>
			<div class="badge bg-secondary text-wrap"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;<?= date('F, d Y', strtotime($article->publish_on)); ?></div> 
			  <?php if ($article->featured == 1){
					echo '<div class="badge bg-warning text-wrap"><i class="fas fa-star"></i> Recommended</div>';
				}else
					'';
				?>
		  </small>
		</div>
		</a>
	  </div>
    </div>
<?php endforeach; ?>
  </div>
</div>
-->
</div>



<script>
// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};

function myFunction() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("myBar").style.width = scrolled + "%";
}
</script>