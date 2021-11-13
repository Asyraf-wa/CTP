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
  </ul>
</div>	
<!--Top Menu End-->
	
<div class="card mb-3 shadow module-blue-big border borderless">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">New Blog Entry
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
<div class="card-body bg-light border borderless">
<?php echo $this->Form->create($blog, ['type' => 'file', 'novalidate' => true]); ?>
            <fieldset>
                <?php //echo $this->Form->control('user_id', ['options' => $users]); ?>
<?php echo $this->Form->control('title',['required' => false]); ?>				
<?php echo $this->Form->control('poster',['type'=>'file','required' => false, 'class' =>'form-control', 'label' => 'Poster']); ?>
<?php echo $this->Form->control('body',['required' => false, 'class' => 'ckeditor', 'label' => 'Content']); ?>				
				
<div class="mb-3">

</div>

<div class="row">
	<div class="col">
<label for="published">Select Publish Status</label><br>
<?php echo $this->Form->radio(
    'published',
    [
        ['value' => '0', 'text' => 'Unpublish', 'class' => 'btn-check', 'label' => ['class' => 'btn btn-sm btn-outline-danger me-1']],
        ['value' => '1', 'text' => 'Publish', 'class' => 'btn-check', 'label' => ['class' => 'btn btn-sm btn-outline-success me-1']],
        ['value' => '2', 'text' => 'Archived', 'class' => 'btn-check', 'label' => ['class' => 'btn btn-sm btn-outline-warning me-1']],
    ]
);

if ($this->Form->isFieldError('published')) {
    echo $this->Form->error('published', 'Please select publish status');
}
?>
	</div>
	<div class="col">
<?php echo $this->Form->control('word_count',['required' => false]); ?>
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
                          'empty'=>'empty',
						  'required' => false,
						  'autocomplete' => 'off'
			]); ?>
	</div>
</div>




				
				
<?php echo $this->Form->control('meta_key',['required' => false, 'label' => 'Meta Keyword']); ?>

<?php echo $this->Form->control('meta_description',['required' => false, 'class' => 'input-textarea', 'width' => '100%']); ?>

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

$('#publish_on').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>
