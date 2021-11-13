<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
 */
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
					//'options' => $categories,
					'empty' => 'Select Category',
					'class' => 'form-select',
					'required' => false
				]); ?>
    </div>
  </div>

	<?php //echo $this->Form->control('publish_on',['required' => false, 'type' => 'date']); ?>

		
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

<div class="container">

<div class="row" data-masonry='{"percentPosition": true }'>
<?php foreach ($projects as $project): ?>
    <div class="col-sm-6 col-lg-4 py-2 px-2">
      <div class="card shadow">
	  <a href="">
		<div class="container-project">
		  <?php echo $this->Html->image('../files/projects/poster/' . $project->poster_dir . '/' . $project->poster,['class' =>'container-project', 'width' => '500px', 'height' => $project->height . 'px']); ?>
		  <div class="top-left-project">
		  </div>
		</div>
		</a>
			<div class="card-body text-secondary">
<h5 class="card-title blog-title"><?= h($project->title) ?></h5>
			  
<div class="badge bg-lime2 text-wrap"><i class="far fa-calendar-alt"></i> <?= h($project->year) ?></div>
<?php if ($project->progress == 'Completed'){
	echo '<div class="badge bg-success text-wrap">Completed</div>';
}elseif ($project->progress == 'In-Progress'){
	echo '<div class="badge bg-warning text-wrap">In-Progress</div>';
}elseif ($project->progress == 'On-Hold'){
	echo '<div class="badge bg-danger text-wrap">On-Hold</div>';
}elseif ($project->progress == 'Abandoned'){
	echo '<div class="badge bg-secondary text-wrap">Abandoned</div>';
}else
	echo '<div class="badge bg-secondary text-wrap">Error</div>';
?>

<?php if ($project->category == 'Research'){
	echo '<div class="badge bg-pink2 text-wrap">Research</div>';
}elseif ($project->category == 'Application'){
	echo '<div class="badge bg-purple text-wrap">Application</div>';
}elseif ($project->category == 'Others'){
	echo '<div class="badge bg-red2 text-wrap">Others</div>';
}else
	echo '<div class="badge bg-secondary text-wrap">Error</div>';
?>
			  <p class="card-text justify pt-2">
					<?php echo $this->Text->truncate($project->body,500,
							[
								'ellipsis' => '...',
								'exact' => false
							]
						); ?>
			  </p>
			  



			</div>
      </div>
    </div>
<?php endforeach; ?>
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

</div><!--Container End-->















<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>