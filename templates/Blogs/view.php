<?php 
use Cake\Routing\Router;
echo $this->Html->css('prism.css');
echo $this->Html->script('prism.js', ['block' => 'scriptBottom']); 
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
?>
    <section class="header-view text-light shadow">
	  <div class="row g-0">
		<div class="col-md-2">
		  
		</div>
		<div class="col-md-6">
			<div class="article-header-text text-secondary">
			  <h2 class="fw-bold text-light"><?= h($blog->title) ?></h2>
			  <?= h($blog->user->fullname) ?> - <?= date('F, d Y', strtotime($blog->publish_on)); ?>
			  <hr>
			  
			  <button type="button" class="btn article-header-circle"><i class="far fa-eye"></i> <?= h($blog->hits) ?></button>
			  <?= $this->Html->link(__('<i class="far fa-thumbs-up"></i> Like'), ['action' => 'kudos', $blog->id], ['class' => 'btn hits article-header-circle', 'escape' => false]) ?>
			  <?php if ($blog->featured == 1){
					echo '<button type="button" class="btn article-header-circle-star text-white" title="Recommended"><i class="fas fa-star"></i> </button> ';
				}else
					'';
				?>
				<br><br>
<small class="text-muted">
Estimated reading time: 
<?php
    $content = $blog->body;

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
</small>
			</div>
		</div>
		<div class="col-md-4">
			<div class="big-feed-container">
			<?php echo $this->Html->image('../files/blogs/poster/' . $blog->poster_dir . '/' . $blog->poster,['class' =>'article-header-cover', 'width' => '500px', 'height' => '500px']); ?>
			<div class="article-header-gradient">
			</div>
			</div>
		</div>
	  </div>
    </section>

<!--Breadcrumbs-->
<?php
    $this->Breadcrumbs->add([
        [
            'title' => 'Home', 
            'url' => ['controller' => 'Articles', 'action' => 'index'],
            'options' => ['class'=> 'breadcrumb-item']
        ],
        [
            'title' => 'Blog', 
            'url' => ['controller' => 'Blogs', 'action' => 'index'],
            'options' => ['class'=> 'breadcrumb-item']
        ],
        [
            'title' => $blog->title, 
            'url' => ['controller' => 'blogs', 'action' => 'view', $blog->id],
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
<small>
	<div class="mt-1 pb-1 shadow">
	  <?php
		$this->Breadcrumbs->setTemplates([
		  'wrapper' => '<div aria-label="breadcrumb" class="container"><ol class="breadcrumb" {{attrs}}>{{content}}</ol></div>',
		  'item' => '<li {{attrs}}>{{icon}}<a href="{{url}}"{{innerAttrs}} class="breadcrumb">{{title}}</a></li>{{separator}}',
		]);
		echo $this->Breadcrumbs->render();
	  ?>
	</div>
</small>

<div class="container mt-5 text-secondary">
  <div class="row">
    <div class="col-md-9">
		<div class="has-dropcap justify">
			<?= $blog->body ?>
		</div>
		<br><br>

<div class="badge bg-primary text-wrap">
  Cite this article (APA 6th Edition)
</div>

<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="" aria-label="Copy" aria-describedby="button-addon2" value="<?php echo $blog->user->fullname; ?>. <?= h($blog->title) ?>. Retrieved <?php echo date("d F, Y"); ?>, from <?php echo Router::url(null, true); ?>" id="myInput" size="100%">
  <button class="btn btn-outline-secondary" onclick="myFunction()"><i class="far fa-clipboard"></i></button>
</div>

<hr>


			


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
	
<div class="card border-warning mb-3">
  <div class="card-header module-orange">
		<div class="icon-robot icon-excavator mt-0 text-light">Maintenance</div>
  </div>
  <div class="card-body text-primary">
<?php if($blog->published == 1) {
	echo '<div class="badge bg-success text-wrap"><i class="fas fa-check"></i> Published</div>';
}else
	echo '<div class="badge bg-danger text-wrap"><i class="fas fa-times"></i> Unpublished</div>';
?>

<?php if($blog->featured == 1) {
	echo '<div class="badge bg-success text-wrap"><i class="fas fa-star"></i> Featured</div>';
}else
	echo '<div class="badge bg-danger text-wrap"><i class="far fa-star"></i> Not Featured</div>';
?>
<hr>
<?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['action' => 'edit', $blog->id], ['class' => 'btn btn-secondary btn-sm mt-1', 'escape' => false]) ?> 
<?= $this->Form->postLink(__('<i class="far fa-trash-alt"></i> Delete'), ['action' => 'delete', $blog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id), 'class' => 'btn btn-danger btn-sm mt-1', 'escape' => false]) ?> 
<?= $this->Form->create ?>
<?php if ($blog->published == 1) {
	echo $this->Form->postLink(__('<i class="fas fa-exclamation-triangle"></i> Unpublish'), ['action' => 'articlePublished', $blog->id, $blog->published], ['block' => true, 'confirm' => __('Are you sure you want to unpublish # {0}?', $blog->title), 'class' => 'btn btn-danger btn-sm mt-1', 'escape' => false, 'title'=>'Unpublish blog']);
}else
	echo $this->Form->postLink(__('<i class="fas fa-check"></i> Publish'), ['action' => 'articlePublished', $blog->id, $blog->published], ['block' => true, 'confirm' => __('Are you sure you want to publish # {0}?', $blog->title), 'class' => 'btn btn-success btn-sm mt-1', 'escape' => false, 'title'=>'Publish blog']); ?>

<?php if ($blog->featured == 1) {
	echo $this->Form->postLink(__('<i class="fas fa-exclamation-triangle"></i> Unfeatured'), ['action' => 'articleFeatured', $blog->id, $blog->featured], ['block' => true, 'confirm' => __('Are you sure you want to unfeatured # {0}?', $blog->title), 'class' => 'btn btn-danger btn-sm mt-1', 'escape' => false, 'title'=>'Unfeatured blog']);
}else
	echo $this->Form->postLink(__('<i class="fas fa-check"></i> Featured'), ['action' => 'articleFeatured', $blog->id, $blog->featured], ['block' => true, 'confirm' => __('Are you sure you want to featured # {0}?', $blog->title), 'class' => 'btn btn-success btn-sm mt-1', 'escape' => false, 'title'=>'Featured blog']); ?>
		
<?= $this->Form->end() ?>
	<?= $this->fetch('postLink'); ?>
  </div>
</div>




	
			<div class="input-group mb-3">
			  <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
			  <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
			</div>

			<div class="card mb-3">
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
				  </div>
				</div>
			  </div>
			</div>
			





<div class="card border borderless mb-3">
  <div class="card-header module-blue">
		<div class="icon-robot icon-robot-chat mt-0 text-light">Popular Blog Entry</div>
  </div>

<ul class="list-group">
<?php foreach ($popular as $blog): ?>	
<?php 
	$domain = Router::url("/", true);
	$sub = 'articles/view/';
	$identifier = $blog->id;
	$combine = $domain . $sub . $identifier;
?>
<a href="<?= $combine; ?>" class="module-link">
	<li class="list-group-item text-secondary"><i class="fas fa-caret-right text-primary"></i> <?= h($blog->title) ?></li>
</a>
<?php endforeach; ?>
</ul>
</div>


<div class="card border borderless mb-3">
  <div class="card-header module-blue">
		<div class="icon-robot icon-robot-tangan mt-0 text-light">Latest Blog Entry</div>
  </div>
<ul class="list-group">
<?php foreach ($latest as $blog): ?>	
<?php 
	$domain = Router::url("/", true);
	$sub = 'articles/view/';
	$identifier = $blog->id;
	$combine = $domain . $sub . $identifier;
?>
<a href="<?= $combine; ?>" class="module-link">
	<li class="list-group-item text-secondary"><i class="fas fa-caret-right text-primary"></i> <?= h($blog->title) ?></li>
</a>
<?php endforeach; ?>
</ul>
</div>

<div class="card border borderless mb-3">
  <div class="card-header module-blue">
		<div class="icon-robot icon-robot-blur  mt-0 text-light">Advertisement</div>
  </div>
  <div class="card-body text-primary">
    
  </div>
</div>




    </div>
  </div>
  
  
<div class="container">
  <div class="row">
<?php foreach ($random as $blog): ?>	
<?php 
	$domain = Router::url("/", true);
	$sub = 'blogs/view/';
	$identifier = $blog->id;
	$combine = $domain . $sub . $identifier;
?>
    <div class="col-md-3 g-3">
	  <div class="card">
	  <a href="<?= $combine; ?>" class="module-link">
		<div class="">
			<?php echo $this->Html->image('../files/blogs/poster/' . $blog->poster_dir . '/' . $blog->poster,['class' =>'footer-bg-cover', 'width' => '', 'height' => '150px']); ?>
		</div>
		<div class="card-body text-secondary">
		  <h5 class="card-title fw-bold">
		  <?php echo strip_tags($this->Text->truncate($blog->title,30,
					[
						'ellipsis' => '...',
						'exact' => false
					]));
			?>
		  </h5>
		  <p class="card-text justify">
			<?php echo strip_tags($this->Text->truncate($blog->body,60,
					[
						'ellipsis' => '...',
						'exact' => false
					]));
			?>
		  </p>
		</div>
		<div class="card-footer">
		  <small class="text-muted">
			<div class="badge bg-secondary text-wrap"><i class="far fa-eye"></i>&nbsp;&nbsp;<?= $blog->hits ?></div>
			<div class="badge bg-secondary text-wrap"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;<?= date('F, d Y', strtotime($blog->publish_on)); ?></div> 
			  <?php if ($blog->featured == 1){
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

<br>

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





