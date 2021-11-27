<?php
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->css('prism.css');
	echo $this->Html->script('prism.js');
	//echo $this->Html->script('tinymce/tinymce.min.js');
	echo $this->Html->script('ckeditor/ckeditor.js');
	echo $this->Html->script('ckfinder/ckfinder.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
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
	<?= $this->Html->link(__('List'), ['prefix' => 'Admin', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $article->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'dropdown-item']
            ) ?>
  </ul>
</div>	
<!--Top Menu End-->
<div class="card mb-3 shadow module-blue-big border borderless">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">New Article
		<div class=" text-light panel_subs">Code The Pixel</div>
	</div>
		<div class="card-body bg-white text-secondary">
            <?php echo $this->Form->create($article, ['type' => 'file']); ?>
            <fieldset>
<?php /* echo $this->Form->control('user_id', [
					'options' => $users,
					'empty' => 'Select User',
					'class' => 'form-select select2',
					'required' => false
				]); */ ?>
				


  <div class="row">
    <div class="col-md-6">
<?php echo $this->Form->control('category_id', [
					'options' => $categories,
					'empty' => 'Select Category',
					'class' => 'form-select',
					'required' => false
				]); ?>
    </div>
    <div class="col-md-6">
<?php //echo h($article->tag_list); ?>
<?php echo $this->Form->control('tag_list',[
						//'options' => $tags, 
						//'id' => 'tagging', 
						//'multiple' => true,
						'value' => $article->tag_list,
						]); ?>
    </div>
  </div>

<?php echo $this->Form->control('title',['required' => false]); ?>

<?php echo $this->Form->control('poster',['type'=>'file','required' => false, 'class' =>'form-control', 'label' => 'Poster']); ?>

<?php //echo $this->Form->control('body',['required' => false, 'class' => 'ckeditor', 'label' => 'Content']); ?>
<?php echo $this->Form->control('body',['required' => false, 'class' => 'tinymce', 'label' => 'Content']); ?>
<script type="text/javascript">
tinymce.init({
	//selector: 'textarea',
	mode : 'specific_textareas',
	editor_selector : 'tinymce',
	plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
	menubar: 'file edit view insert format tools table help',
	toolbar: 'code bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist | insertfile image media template link anchor codesample | forecolor backcolor removeformat | fontselect fontsizeselect formatselect | outdent indent | pagebreak | charmap emoticons | fullscreen  preview save print | ltr rtl | undo redo',
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
	image_list: [
		{ title: 'My page 1', value: 'https://www.tiny.cloud' },
		{ title: 'My page 2', value: 'http://www.moxiecode.com' }
	],
	importcss_append: true,
  file_picker_callback: function (callback, value, meta) {
    /* Provide file and text for the link dialog */
    if (meta.filetype === 'file') {
      callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
    }

    /* Provide image and alt text for the image dialog */
    if (meta.filetype === 'image') {
      callback('../img/tutorial/xxx/xxx.jpg', { alt: 'Tutorial' });
    }

    /* Provide alternative source and posted for the media dialog */
    if (meta.filetype === 'media') {
      callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
    }
  },
});
</script>

  <div class="row">
    <div class="col my-3">
	<label for="published">Featured This Article</label><br>
<?php echo $this->Form->checkbox('featured', [
			'class' => 'form-control',
			'type' => 'checkbox',
			'data-toggle'=>'toggle', 'data-on'=>'Yes', 'data-off'=>'No', 'data-onstyle'=>'success', 'data-offstyle'=>'danger', 'data-size'=>'small', 'data-width'=>'80']); ?>
    </div>
    <div class="col my-3">
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
  </div>

  <div class="row">
    <div class="col">
<?php echo $this->Form->control('meta_key',['required' => false, 'label' => 'Meta Keyword']); ?>
    </div>
    <div class="col">
<?php echo $this->Form->control('publish_on',[
                          'class' => 'form-control datepicker-here', 
                          'label' => 'Publish On',
                          'id' => 'publish_on',
                          'type' => 'Text',
						  'value' => date('Y-m-d', strtotime($article->publish_on)), //for edit page: read the existing data first
                          'data-language' => 'en',
                          'data-date-format' => 'Y-m-d',
                          'empty'=>'empty',
						  'required' => false,
						  'autocomplete' => 'off'
			]); ?>
<script type="text/javascript">
$('#publish_on').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	//formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});

</script>
    </div>
  </div>

<?php echo $this->Form->control('meta_description',['required' => false, 'class' => 'input-textarea', 'width' => '100%']); ?>


            </fieldset>
		</div>
		  <div class="card-footer text-end bg-light">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->end() ?>
		  </div>
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

