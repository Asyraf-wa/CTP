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
<style>
[data-href] {
    cursor: pointer;
}
</style>
<div class="container"><!--Container Start-->
<!--Top Menu Start-->
<div class="text-end pt-2 pb-2">
	<div class="btn-group" role="group" aria-label="Basic outlined example">
	<?= $this->Html->link(__('<i class="fas fa-th-large"></i>'), ['action' => 'index'], ['title' => __('Tiles View'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false]) ?>
	<?= $this->Html->link(__('<i class="fas fa-sort-amount-down fa-sm"></i>'), ['?' => ['sort' => 'publish_on', 'direction' => 'desc']], ['title' => __('Latest First'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Latest First']) ?>
	<?= $this->Html->link(__('<i class="fas fa-sort-amount-up-alt fa-sm"></i>'), ['?' => ['sort' => 'publish_on', 'direction' => 'asc']], ['title' => __('Oldest First'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Oldest First']) ?>
	<?= $this->Html->link(__('<i class="fas fa-search fa-sm"></i>'), ['action' => ''], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#flush-search', 'aria-expanded' => 'false', 'aria-controls' => 'flush-search']) ?>
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
			echo $this->Html->link(__('Reset'), ['action' => 'listing', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm mx-1', 'title' => 'Reset']);
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

<div class="row">
	<div class="col-md-9">
<div class="card mb-3 shadow module-blue-big border borderless mt-3">

  <div class="card-body bg-light border borderless px-0">

    <div class="table-responsive">


        <table class="table text-secondary mt-4 px-1 table-sm table-hover">
            <thead>
                <tr>
                    <th class="px-3">#</th>
                    <th><?= $this->Paginator->sort('title') ?></th>
					<th><?= $this->Paginator->sort('category_id') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('featured') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('hits') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('publish_on') ?></th>
                </tr>
            </thead>
            <tbody>
<?php
$page = $this->Paginator->counter('{{page}}');
$limit = 20; //limit ni supaya klu page last ada 8 rekod, dia xsalah kira
$counter = ($page * $limit) - $limit + 1;
?>
                <?php foreach ($articles as $article): ?>
<?php
	$domain = Router::url("/", true);
	$sub = 'articles/';
	$identifier = $article->slug;
	$combine = $domain . $sub . $identifier;
?>

                <tr data-href="<?php echo $combine; ?>">
<script>
jQuery(document).ready(function($) {
    $('*[data-href]').on('click', function() {
        window.location = $(this).data("href");
    });
});
</script>
                    <td class="px-3"><?= $counter++ ?></td>
                    
                    <td><?= h($article->title) ?></td>
					<td><?= $article->has('category') ? $article->category->title : '' ?></td>
                    <td style="text-align: center;">
					<?php if($article->featured == 1){
						echo '<i class="fas fa-star text-warning"></i>';
					}else
						echo '<i class="far fa-star text-secondary"></i>';
					?>
					</td>
                    <td style="text-align: center;"><?= $this->Number->format($article->hits) ?></td>
                    <td style="text-align: center;" class="px-3"><?= date('d M Y', strtotime($article->publish_on)); ?></td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

  </div>
</div>
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
	</div>
	<div class="col-md-3 mt-3">
<?php foreach ($tagging as $TagsTags): ?>	
<?php
echo $this->Html->link($TagsTags->label, ['controller' => 'Articles', 'action' => 'listing', '?' => ['tag' => $TagsTags->slug], '_full' => true],['class'=> 'btn btn-outline-primary btn-sm mb-1']
);
?>
<?php endforeach; ?>	
	</div>
</div>




	
	

	
</div><!--Container End-->