<div class="container">

<?php echo $this->Form->create(null, ['valueSources' => 'query']); ?>
<?php echo $this->Form->control('search', ['class' =>'form-control', 'onkeypress' =>'handle', 'label' =>'Search', 'placeholder' =>'Looking for something?']); ?>

<?php 
	echo $this->Form->button(__('Search'), ['class' => 'btn btn-outline-secondary btn-sm', 'title' => 'Search']);
	echo $this->Form->end();
?>

<?php foreach($articles as $article){?>
	<?php echo $article->title ?>-
	<?php echo $article->slug ?><br>
<?php } ?>
</div>