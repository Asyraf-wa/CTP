<?php
	echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
	echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
?>
<script src="https://cdn.tiny.cloud/1/xdl9adhrcd1lf3q3hm2cmah8gfety19dnjbtai6sxw9yzsv7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<div class="container">
<!--Top Menu Start-->
<div class="dropdown text-end pt-2 pb-2">
  <button class="btn  border-0 shadow-none text-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	<i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('List'), ['prefix' => 'Admin','action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]) ?>
  </ul>
</div>	
<!--Top Menu End-->
<div class="card mb-3 shadow module-blue-big border borderless mt-3">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">To Do Task
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-light border borderless">
			<?= $this->Form->create($todo) ?>
<div class="row">
	<div class="col">
	  <?php echo $this->Form->control('task',['required' => false, 'label' => 'Task']); ?>
	</div>
	<div class="col-2"><br>
	  <?php echo $this->Form->checkbox('status', [
			'class' => 'form-control',
			'type' => 'checkbox',
			'data-toggle'=>'toggle', 'data-on'=>'Completed', 'data-off'=>'Pending', 'data-onstyle'=>'success', 'data-offstyle'=>'danger', 'data-size'=>'small', 'data-width'=>'80']); ?>
		<?php echo $this->Form->label('Status', 'Status'); ?>
	</div>
</div>
                    
<?php echo $this->Form->control('description',['required' => false, 'class' => 'tinymce', 'label' => 'Description']); ?>
<script type="text/javascript">
tinymce.init({
	//selector: 'textarea',
	mode : 'specific_textareas',
	editor_selector : 'tinymce',
	plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons tinydrive',
	menubar: 'file edit view insert format tools table help',
	toolbar1: 'code bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist | insertfile image media template link anchor codesample | forecolor backcolor removeformat | fontselect fontsizeselect formatselect | outdent indent | pagebreak | charmap emoticons | fullscreen  preview save print | ltr rtl | undo redo',
	toolbar_sticky: true,
	//toolbar_mode: 'floating',
	height : '680',
	//image_dimensions: false,
	image_advtab: true,
	image_title: true,
	image_dimensions: true,
	convert_urls: false,
	image_class_list: [
        {title: 'Responsive', value: 'img-fluid'},
        {title: 'Responsive + Thumbnail', value: 'img-fluid img-thumbnail rounded mx-auto d-block'}
    ],
	importcss_append: true,
});
</script>
                    <?php //echo $this->Form->control('status',['required' => false, 'label' => 'Status']); ?>
		
		</div>
		  <div class="card-footer text-end bg-light">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->end() ?>
		  </div>
</div>
</div>