<?php
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	//echo $this->Html->script('tinymce/tinymce.min.js');
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
	echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
?>
<div class="container"><!--Container Start-->

<!--Top Menu Start-->
<div class="dropdown text-end pt-2 pb-2">
  <button class="btn border-0 shadow-none text-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	<i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('List'), ['prefix' => 'Admin', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $pain->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $pain->id), 'class' => 'dropdown-item']
            ) ?>
  </ul>
</div>	
<!--Top Menu End-->
	
<div class="card mb-3 shadow module-blue-big border borderless">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Register Pain Feel
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
<div class="card-body bg-light border borderless">
	<?php echo $this->Form->create($pain, ['novalidate' => true]); ?>
<fieldset>
<div class="row mb-2">
	<div class="col-md-3">
		<label>Type of Pain</label><br>
		<?php
			echo $this->Form->radio(
				'type',
				[
					['value' => 'Gout', 'text' => 'Gout', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
					['value' => 'Fever', 'text' => 'Fever', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
					['value' => 'Flu', 'text' => 'Flu', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
					['value' => 'Others', 'text' => 'Others', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
				]
			);
if ($this->Form->isFieldError('type')) {
    echo $this->Form->error('type', 'Select pain type');
}			
			?>
	</div>
	<div class="col-md-5">
		<label>Pain Point</label><br>
		<?php
			echo $this->Form->radio(
				'pain_point',
				[
					['value' => 'Right Feet', 'text' => 'Right Feet', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
					['value' => 'Left Feet', 'text' => 'Left Feet', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
					['value' => 'Right Toe', 'text' => 'Right Toe', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
					['value' => 'Left Toe', 'text' => 'Left Toe', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
					['value' => 'Others', 'text' => 'Others', 'label' => ['class' => 'btn btn-outline-secondary me-1']],
				]
			);
			
if ($this->Form->isFieldError('pain_point')) {
    echo $this->Form->error('pain_point', 'Select paint point/location');
}
?>
	</div>
	<div class="col-md-4">
<?php echo $this->Form->control('date',[
			  'class' => 'form-control datepicker-here', 
			  'label' => 'Date',
			  'id' => 'date',
			  'type' => 'Text',
			  'data-language' => 'en',
			  'data-date-format' => 'Y-m-d',
			  'value' => date('Y-m-d'),
			  'empty'=>'empty'
]); ?>
	</div>
</div>

<label for="customRange2" class="form-label">Pain Feel: <span id="demo"></span>/10</label>
<div class="slidecontainer">
  <input type="range" min="0" max="10" value="5" class="slider" id="myRange" name="feel">
</div>
<p style="text-align:left;" class="text-small mb-3">
    Severe
    <span style="float:right;">
        Extreme
    </span>
</p>

<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>


<?php 
$options = ['Goutnor' => 'Goutnor', 'Prednisolone' => 'Prednisolone', 'Panadol' => 'Panadol', 'Others' => 'Others'];
echo $this->Form->control('medication', [
	//'type' => 'text', 
	'options' => $options,
	'id' => 'tags',
	'multiple' => true,
	'label' => 'Medication',
	'class' => 'form-control',
	'required' => false]); 
?>






<?php //echo $this->Form->control('medication',['required' => false, 'class' => 'input-textarea', 'width' => '100%']); ?>


<?php echo $this->Form->control('cause',['required' => false, 'class' => 'input-textarea', 'width' => '100%']); ?>

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
$('#tags').select2({
	tags: true,
    //data: ["Clare","Cork","South Dublin"],
    tokenSeparators: [','], 
    placeholder: "Select/Add Medicine",
    /* the next 2 lines make sure the user can click away after typing and not lose the new tag */
    //selectOnClose: true, 
    //closeOnSelect: false
});

$('#date').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>
