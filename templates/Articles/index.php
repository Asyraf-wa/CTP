<?php
	use Cake\Routing\Router; //load at the beginning of file
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	$domain = Router::url("/", true);
	$c_name = $this->request->getParam('controller');
	$this->assign('title', 'Code The Pixel - Coding and Tutorial');
?>

<div class="container"><!--Container Start-->
<!--Top Menu Start-->
<div class="text-end pt-2 pb-2">
	<div class="btn-group" role="group" aria-label="Basic outlined example">
	<?= $this->Html->link(__('<i class="fas fa-sort-amount-down fa-sm"></i>'), ['?' => ['sort' => 'publish_on', 'direction' => 'desc']], ['title' => __('Latest First'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Latest First']) ?>
	<?= $this->Html->link(__('<i class="fas fa-sort-amount-up-alt fa-sm"></i>'), ['?' => ['sort' => 'publish_on', 'direction' => 'asc']], ['title' => __('Oldest First'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Oldest First']) ?>
	<?= $this->Html->link(__('<i class="fas fa-search fa-sm"></i>'), ['action' => ''], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'type' => 'button', 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#flush-search', 'aria-expanded' => 'false', 'aria-controls' => 'flush-search']) ?>
	<?php if (!empty($_isSearch)) {
		echo $this->Html->link(__('<i class="fas fa-sync-alt fa-sm"></i>'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Reset']);
	} ?>
	<?= $this->Html->link(__('<i class="fas fa-star fa-sm"></i>'), ['?' => ['featured' => '1']], ['title' => __('Featured Only'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false]) ?>
	</div>
</div>
<!--Top Menu End-->
<!--Search Form Start-->
<div class="accordion accordion-flush" id="search">
	<div class="accordion-item">
		<div id="flush-search" class="accordion-collapse <?= (!empty($_isSearch)) == ''?'collapse':'' ?>" aria-labelledby="flush-headingOne" data-bs-parent="#search">
		<div class="accordion-body bg-light">
<?php echo $this->Form->create(null, ['valueSources' => 'query']); ?>

  <div class="row">
    <div class="col">
      <?php echo $this->Form->control('search', ['class' =>'form-control', 'onkeypress' =>'handle', 'label' =>'Search', 'placeholder' =>'Looking for something?']); ?>
    </div>
    <div class="col">
      <?php echo $this->Form->control('category_id', [
					'options' => $categories,
					'empty' => 'Select Category',
					'class' => 'form-select',
					'required' => false
				]); ?>
    </div>
  </div>

	<?php //echo $this->Form->control('publish_on',['required' => false, 'type' => 'date']); ?>
  
<div class="row">
	<div class="col-md-8 col-xs-4">
	  <?php echo $this->Form->control('tag',['options' => $tags, 'id' => 'tagging', 'multiple' => true,]); ?>
	</div>
	<div class="col-md-2 col-xs-4">
	  <?php echo $this->Form->control('publish_from',[
                          'class' => 'form-control datepicker-here', 
                          'label' => 'Published From',
                          'id' => 'publish_from',
                          'type' => 'Text',
                          'data-language' => 'en',
                          'data-date-format' => 'Y-m-d',
                          //'value' => date('Y-m-d'),
                          'empty'=>'empty',
						  'autocomplete' => 'off',
                    ]); ?>
<script>
$('#publish_from').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>
	</div>
	<div class="col-md-2 col-xs-4">
	  <?php echo $this->Form->control('publish_to',[
                          'class' => 'form-control datepicker-here', 
                          'label' => 'Published To',
                          'id' => 'publish_to',
                          'type' => 'Text',
                          'data-language' => 'en',
                          'data-date-format' => 'Y-m-d',
                          //'value' => date('Y-m-d'),
                          'empty'=>'empty',
						  'autocomplete' => 'off',
                    ]); ?>
<script>
$('#publish_to').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>
	</div>
</div>
  
  
  <div class="row">
    <div class="col">
      <?php //echo $this->Form->control('publish_from',['required' => false, 'type' => 'date']); ?>

    </div>
    <div class="col">
      <?php //echo $this->Form->control('publish_to',['required' => false, 'type' => 'date']); ?>

    </div>
  </div>
  




<?php //echo $this->Form->control('tag', ['options' => $tags, 'empty' => true, 'class' => 'form-select', 'required' => false]); ?>

<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();
	$("#tagging").select2({
		  tags: true,
          placeholder: "Tagging",
		  tokenSeparators: [','], 
          allowClear: true
      });
}
);
</script>

<script>
    function handle(e){
        if(e.key === "Enter"){
            alert("Enter was just pressed.");
        }

        return false;
    }
</script>

		
		<div class="text-end">
			<?php
			if (!empty($_isSearch)) {
			echo ' ';
			echo $this->Html->link(__('Reset'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm mx-1', 'title' => 'Reset']);
			} 
			echo $this->Form->button(__('Search'), ['class' => 'btn btn-outline-secondary btn-sm', 'title' => 'Search']);
			echo $this->Form->end();
			?>
		</div>
		</div>
		</div>
	</div>
</div>
<!--Search Form End-->

<div class="row g-2">
<?php
//$page = $this->params['paging']['Model']['page'];
//$limit = $this->params['paging']['Model']['options']['limit'];
//debug($this->request->param('paging'));
//debug($this->Paginator->counter('{{current}}'));
//debug($this->paginate['maxLimit']);

/* $page = $this->Paginator->counter('{{page}}');
$limit = 10;

$counter = ($page * $limit) - $limit + 1; */
$i = 1;
?>




<?php foreach ($articles as $article) : ?>

<?php
	$domain = Router::url("/", true);
	$sub = 'articles/';
	$identifier = $article->slug;
	$combine = $domain . $sub . $identifier;
	
switch ($i++) {
//Row 1 [3 items]
  case "1":
    echo '<div class="col-md-6">';
	echo '<div class="big-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'big-bg-cover', 'width' => '644px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="big-gradient-feed big-gradient-brown">';
	echo '<div class="big-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="big-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,200,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "2":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-gray">';
	echo '<div class="small-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "3":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-blue">';
	echo '<div class="small-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
//Row 2 [3 items]
  case "4":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-purple">';
	echo '<div class="small-feed-title text-light">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "5":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-green">';
	echo '<div class="small-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	//echo strip_tags($abc['Abc']['description']);
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
/* 	echo $this->Text->truncate(h($article->body),80,
		[
			'ellipsis' => '...',
			'exact' => false
		]); */
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "6":
    echo '<div class="col-md-6">';
	echo '<div class="big-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'big-bg-cover', 'width' => '644px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="big-gradient-feed big-gradient-yellow">';
	echo '<div class="big-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="big-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,200,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
//Row 3 [4 items]
  case "7":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-gray">';
	echo '<div class="small-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';

    break;
  case "8":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-orange">';
	echo '<div class="small-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "9":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-pink">';
	echo '<div class="small-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "10":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-navy">';
	echo '<div class="small-feed-title text-light">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
//Row 4 [3 items]
  case "11":
    echo '<div class="col-md-6">';
	echo '<div class="big-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'big-bg-cover', 'width' => '644px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="big-gradient-feed big-gradient-red">';
	echo '<div class="big-feed-title text-light">';
	echo h($article->title);
	echo '<div class="big-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,200,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "12":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-yellow">';
	echo '<div class="small-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "13":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-yellow-green">';
	echo '<div class="small-feed-title text-light">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
//Row 5 [3 items]
  case "14":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-purple">';
	echo '<div class="small-feed-title text-light">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "15":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-red">';
	echo '<div class="small-feed-title text-light">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "16":
    echo '<div class="col-md-6">';
	echo '<div class="big-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'big-bg-cover', 'width' => '644px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="big-gradient-feed big-gradient-blue">';
	echo '<div class="big-feed-title text-light">';
	echo h($article->title);
	echo '<div class="big-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,200,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
//Row 6 [4 items]
  case "17":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-green">';
	echo '<div class="small-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';

    break;
  case "18":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-navy">';
	echo '<div class="small-feed-title text-light">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "19":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-orange">';
	echo '<div class="small-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
  case "20":
    echo '<div class="col-md-3">';
	echo '<div class="small-feed-container">';
	echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster,['class' =>'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
	echo '<a href="' . $combine . '" class="feed-title-light-link">';
	echo '<div class="small-gradient-feed small-gradient-light-brown">';
	echo '<div class="small-feed-title text-dark">';
	echo h($article->title);
	echo '<div class="small-feed-intro">';
	echo strip_tags($this->Text->truncate($article->body,80,
		[
			'ellipsis' => '...',
			'exact' => false
		]));
	echo '<div>';
	echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
	echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
	if ($article->featured == 1){
		echo '<button type="button" class="btn btn-circle text-warning" title="Recommended"><i class="fas fa-star"></i></button> ';
	}else
		'';
	echo '</div></div></div></div>';
	echo '</a>';
	echo '</div></div>';
    break;
}
?>
<?php endforeach; ?>
</div>

<br>

<div class="paginator text-end text-secondary">
    <ul class="pagination pagination-sm justify-content-end">
        <?= $this->Paginator->first('<< ' . __('First')) ?>
        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} article(s) out of {{count}} total')) ?></p>
</div>


</div><!--Container End-->
