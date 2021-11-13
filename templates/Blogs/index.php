<?php
	use Cake\Routing\Router; //load at the beginning of file
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	$random = (rand(10,100));
	$domain = Router::url("/", true);
	$c_name = $this->request->getParam('controller');
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
  </div>
  
  <div class="row">
    <div class="col">
      <?php //echo $this->Form->control('publish_from',['required' => false, 'type' => 'date']); ?>
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
    <div class="col">
      <?php //echo $this->Form->control('publish_to',['required' => false, 'type' => 'date']); ?>
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

<div class="row" data-masonry='{"percentPosition": true }'>
<?php foreach ($blogs as $blog): ?>
<?php
	$domain = Router::url("/", true);
	$sub = 'blogs/';
	$identifier = $blog->slug;
	$combine = $domain . $sub . $identifier;
?>

    <div class="col-sm-6 col-lg-4 py-2 px-2">
      <div class="card">
	  <a href="<?= $combine ?>">
		<?php echo $this->Html->image('../files/blogs/poster/' . $blog->poster_dir . '/' . $blog->poster,['class' =>'card-img-top']); ?>
		<?php echo $this->Html->image('../' . $blog->poster_dir . '/' . $blog->poster,['class' =>'card-img-top']); ?>
		</a>
			<div class="card-body text-secondary">
			  <h5 class="card-title blog-title"><?= $this->Html->link(__($blog->title), ['action' => 'view', $blog->slug],['class' => 'blog-list-title']) ?></h5>
			  <p class="card-text justify">
<?php echo $blog->poster_dir; ?>/<?php echo $blog->poster; ?>
<?php $word_count = $blog->word_count; ?>
				<?php echo strip_tags($this->Text->truncate($blog->body,$word_count,
						[
							'ellipsis' => '...',
							'exact' => false
						])); ?>
			  </p>



  <div class="row">
    <div class="col text-muted">
		<i class="far fa-calendar-alt"></i> <?= date('F, d Y', strtotime($blog->publish_on)); ?>
    </div>
    <div class="col text-end">
		<?= $this->Html->link(__('Read More...'), ['action' => 'view', $blog->slug],['class' => 'btn btn-secondary btn-sm']) ?>
    </div>
  </div>

			</div>
      </div>
    </div>
<?php endforeach; ?>
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
</div><!--Container End-->
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
