<?php
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	//echo $this->Html->script('tinymce/tinymce.min.js');
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('ckfinder/ckfinder.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
	echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
?>
<div class="container"><!--Container Start-->

<!--Top Menu Start-->
<div class="dropdown text-end pt-2 pb-2">
  <button class="btn  border-0 shadow-none text-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	<i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('List'), ['prefix' => 'Admin', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $project->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $project->id), 'class' => 'dropdown-item']
            ) ?>
  </ul>
</div>	
<!--Top Menu End-->
	
<div class="card mb-3 shadow module-blue-big border borderless">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">New Project
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
<div class="card-body bg-light border borderless">
	<?php echo $this->Form->create($project, ['type' => 'file', 'novalidate' => true]); ?>
<fieldset>
	<?php echo $this->Form->control('title',['required' => false]); ?>
		<div class="row my-2">
		<div class="col-md-3">
			<label>Category</label><br>
	<?php
	echo $this->Form->radio(
		'category',
		[
			['value' => 'Research', 'text' => 'Research', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
			['value' => 'Application', 'text' => 'Application', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
			['value' => 'Others', 'text' => 'Others', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
		]
	);
if ($this->Form->isFieldError('category')) {
    echo $this->Form->error('category', 'Please select category');
}
	?>
		</div>
		<div class="col-md-4">
			<label>Progress Status</label><br>
	<?php
	echo $this->Form->radio(
		'progress',
		[
			['value' => 'On-Progress', 'text' => 'On-Progress', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
			['value' => 'Completed', 'text' => 'Completed', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
			['value' => 'Abandon', 'text' => 'Abandon', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
		]
	);
if ($this->Form->isFieldError('progress')) {
    echo $this->Form->error('progress', 'Please select progress');
}
	?>
		</div>
		<div class="col">
			<?php echo $this->Form->control('publish_on',[
                          'class' => 'form-control datepicker-here', 
                          'label' => 'Publish On',
                          'id' => 'publish_on',
                          'type' => 'Text',
                          'data-language' => 'en',
                          'data-date-format' => 'Y-m-d',
                          'value' => date('Y-m-d'),
                          'empty'=>'empty'

			]); ?>
		</div>
		<div class="col-2">
		  <?php echo $this->Form->control('word_count',['required' => false]); ?>
		</div>
	</div>
<div class="row">
	<div class="col">
<?php echo $this->Form->control('poster',['type'=>'file','required' => false, 'class' =>'form-control', 'label' => 'Poster']); ?>
	</div>
	<div class="col-2">
	  <?php echo $this->Form->control('height',['required' => false, 'label' => 'Height (px)']); ?>
	</div>
</div>
<?php echo $this->Form->control('body',['required' => false, 'class' => 'ckeditor', 'label' => 'Content']); ?>
<?php echo $this->Form->control('meta_key',['required' => false, 'label' => 'Meta Keyword']); ?>
<?php echo $this->Form->control('meta_description',['required' => false, 'class' => 'input-textarea', 'width' => '100%']); ?>
<?php echo $this->Form->checkbox('published', [
	'class' => 'form-control',
	'type' => 'checkbox',
	'data-toggle'=>'toggle', 'data-on'=>'Yes', 'data-off'=>'No', 'data-onstyle'=>'success', 'data-offstyle'=>'danger', 'data-size'=>'small', 'data-width'=>'80']); ?>
<?php echo $this->Form->label('published', ' Publish this project',['class' => 'mx-2']); ?>
</fieldset>
</div>
<div class="card-footer text-end bg-light">
<?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-primary btn-flat btn-sm mx-1']) ?>
<?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
<?= $this->Form->end() ?>
</div>
</div>
</div><!--Container End-->
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();
}
);
</script>

