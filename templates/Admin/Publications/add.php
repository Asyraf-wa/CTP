<?php
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->css('prism.css');
	echo $this->Html->script('prism.js');
	//echo $this->Html->script('tinymce/tinymce.min.js');
	//echo $this->Html->script('ckeditor/ckeditor');
	//echo $this->Html->script('ckfinder/ckfinder.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
	echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
?>
<script src="https://cdn.tiny.cloud/1/xdl9adhrcd1lf3q3hm2cmah8gfety19dnjbtai6sxw9yzsv7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">New Publication
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
<div class="card-body bg-light border borderless">
	<?php echo $this->Form->create($publication, ['type' => 'file', 'novalidate' => true]); ?>
<fieldset>
    <?php //echo $this->Form->control('user_id', ['options' => $users]) ?>
    <?php echo $this->Form->control('manuscript_title',['label' => 'Manuscript Title', 'required' => false, 'class' =>'form-control']) ?>
    <?php echo $this->Form->control('authors',['required' => false, 'class' =>'form-control']) ?>
    <?php echo $this->Form->control('journal_name',['label' => 'Journal/Proceeding Name', 'required' => false, 'class' =>'form-control']) ?>

<div class="row">
	<div class="col">
        <?php echo $this->Form->control('year',['required' => false, 'class' =>'form-control']) ?>
	</div>
	<div class="col">
        <?php echo $this->Form->control('volume',['required' => false, 'class' =>'form-control']) ?>
	</div>
	<div class="col">
        <?php echo $this->Form->control('issue',['required' => false, 'class' =>'form-control']) ?>
	</div>
	<div class="col">
        <?php echo $this->Form->control('pages',['required' => false, 'class' =>'form-control']) ?>
	</div>
</div>

<div class="row">
	<div class="col">
        <?php echo $this->Form->control('doi',['required' => false, 'class' =>'form-control']) ?>
	</div>
	<div class="col">
        <?php echo $this->Form->control('serial',['required' => false, 'class' =>'form-control','label' => 'ISSN/ISBN']) ?>
	</div>
	<div class="col">
    <?php echo $this->Form->control('paper_type',[
        'options' => ['Journal' => 'Journal', 'Proceeding' => 'Proceeding', 'Newsletter' => 'Newsletter', 'Position' => 'Position', 'Book' => 'Book', 'Others' => 'Others'],
        'empty' => 'Select types',
        'required' => false, 
        'class' =>'form-select']
        ) ?>
	</div>
	<div class="col">
    <?php echo $this->Form->control('pointer',[
        'options' => ['Web of Science' => 'Web of Science', 'Scopus' => 'Scopus', 'MyCite' => 'MyCite', 'Others' => 'Others'],
        'empty' => 'Select indexing',
        'required' => false, 
        'class' =>'form-select', 
        'label' => 'Index']
        ) ?>
	</div>
</div>

    <?php echo $this->Form->control('keywords',['required' => false, 'class' =>'form-control']) ?>
    
    <?php echo $this->Form->control('abstract',['required' => false, 'class' =>'form-control']) ?>
    
    <?php echo $this->Form->control('sponsor',['required' => false, 'class' =>'form-control']) ?>
<div class="row">
	<div class="col">
        <?php echo $this->Form->control('diciplines',['required' => false, 'class' =>'form-control']) ?>
	</div>
	<div class="col">
        <?php echo $this->Form->control('url',['required' => false, 'class' =>'form-control']) ?>
	</div>
</div>
    <?php echo $this->Form->control('attachment',['type' => 'file', 'required' => false, 'class' =>'form-control', 'label' => 'Attachment']) ?>
	<?php echo $this->Form->control('reference',['label' => 'Reference (APA)', 'required' => false, 'class' =>'form-control']) ?>
    <?php echo $this->Form->control('note',['required' => false, 'class' =>'form-control']) ?>
    <?php //echo $this->Form->control('status',['required' => false, 'class' =>'form-control']) ?>
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
