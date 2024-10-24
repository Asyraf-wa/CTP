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
<!--Header-->
<div class="row text-body-secondary">
    <div class="col-10">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
    <div class="col-2 text-end">
        <div class="dropdown mx-3 mt-2">
            <button class="btn p-0 border-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa-solid fa-bars text-primary"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                <?= $this->Html->link(__('List Projects'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
            </div>
        </div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
    <div class="card-body text-body-secondary">
        <?php echo $this->Form->create($project, ['type' => 'file', 'novalidate' => true]); ?>
        <fieldset>
            <legend><?= __('Add Project') ?></legend>
            <?php
            //echo $this->Form->control('user_id', ['options' => $users]); 
            ?>
            <?php echo $this->Form->control('title'); ?>
            <?php echo $this->Form->control('repo', ['class' => 'form-control', 'label' => 'Repository Link']); ?>

            <div class="row">
                <div class="col-md-3">
                    <?php echo $this->Form->control('year', [
                        'class' => 'form-control form-select',
                        'min' => date('Y') - 15,
                        'max' => date('Y'),
                    ]); ?>
                </div>
                <div class="col-md-9">
                    <?php echo $this->Form->control('poster', ['type' => 'file', 'required' => false, 'class' => 'form-control', 'label' => 'Poster']); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <label for="published">Select Publish Status</label><br>
                    <?php echo $this->Form->radio(
                        'published',
                        [
                            ['value' => '0', 'text' => 'Unpublish', 'class' => 'btn-check', 'label' => ['class' => 'btn btn-outline-danger me-1']],
                            ['value' => '1', 'text' => 'Publish', 'class' => 'btn-check', 'label' => ['class' => 'btn btn-outline-success me-1']],
                            ['value' => '2', 'text' => 'Archived', 'class' => 'btn-check', 'label' => ['class' => 'btn btn-outline-warning me-1']],
                        ]
                    );

                    if ($this->Form->isFieldError('published')) {
                        echo $this->Form->error('published', 'Please select publish status');
                    }
                    ?>
                </div>
                <div class="col-md-3">
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
                <div class="col-md-3">
                    <?php echo $this->Form->control('publish_on', [
                        'class' => 'form-control datepicker-here',
                        'label' => 'Publish On',
                        'id' => 'publish_on',
                        'type' => 'Text',
                        'data-language' => 'en',
                        'data-date-format' => 'Y-m-d',
                        'value' => date('Y-m-d'),
                        'empty' => 'empty'

                    ]); ?>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $('.select2').select2();
                        });

                        $('#publish_on').datetimepicker({
                            lang: 'en',
                            timepicker: false,
                            format: 'Y-m-d',
                            formatDate: 'Y/m/d',
                            //minDate:'-1970/01/01', // yesterday is minimum date
                            //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
                        });
                    </script>
                </div>
            </div>

            <?php echo $this->Form->control('body', ['required' => false, 'class' => 'tinymce', 'label' => 'Content']); ?>
            <script type="text/javascript">
                tinymce.init({
                    //selector: 'textarea',
                    mode: 'specific_textareas',
                    editor_selector: 'tinymce',
                    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons tinydrive',
                    menubar: 'file edit view insert format tools table help',
                    toolbar1: 'code bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | numlist bullist | insertfile image media template link anchor codesample | forecolor backcolor removeformat | fontselect fontsizeselect formatselect | outdent indent | pagebreak | charmap emoticons | fullscreen  preview save print | ltr rtl | undo redo',
                    //toolbar2: 'outdent indent | pagebreak | charmap emoticons | fullscreen  preview save print | ltr rtl | undo redo',
                    tinydrive_token_provider: function(success, failure) {
                        success({
                            token: "jwt-token"
                        }); // failure('Could not create a jwt token')
                    },
                    tinydrive_token_provider: 'URL_TO_YOUR_TOKEN_PROVIDER',
                    tinydrive_dropbox_app_key: 'YOUR_DROPBOX_APP_KEY',
                    tinydrive_google_drive_key: 'YOUR_GOOGLE_DRIVE_KEY',
                    tinydrive_google_drive_client_id: 'YOUR_GOOGLE_DRIVE_CLIENT_ID',
                    toolbar_sticky: true,
                    //toolbar_mode: 'floating',
                    height: '680',
                    //image_dimensions: false,
                    image_advtab: true,
                    image_title: true,
                    image_dimensions: true,
                    convert_urls: false,
                    image_class_list: [{
                            title: 'Responsive',
                            value: 'img-fluid'
                        },
                        {
                            title: 'Responsive + Thumbnail',
                            value: 'img-fluid img-thumbnail rounded mx-auto d-block'
                        }
                    ],
                    image_list: [{
                            title: 'My page 1',
                            value: 'https://www.tiny.cloud'
                        },
                        {
                            title: 'My page 2',
                            value: 'http://www.moxiecode.com'
                        }
                    ],
                    importcss_append: true,
                    file_picker_callback: function(callback, value, meta) {
                        /* Provide file and text for the link dialog */
                        if (meta.filetype === 'file') {
                            callback('https://www.google.com/logos/google.jpg', {
                                text: 'My text'
                            });
                        }

                        /* Provide image and alt text for the image dialog */
                        if (meta.filetype === 'image') {
                            callback('../img/tutorial/xxx/xxx.jpg', {
                                alt: 'Tutorial'
                            });
                        }

                        /* Provide alternative source and posted for the media dialog */
                        if (meta.filetype === 'media') {
                            callback('movie.mp4', {
                                source2: 'alt.ogg',
                                poster: 'https://www.google.com/logos/google.jpg'
                            });
                        }
                    },
                });
            </script>
            <?php echo $this->Form->control('meta_key', ['required' => false, 'label' => 'Meta Keyword']); ?>
            <?php echo $this->Form->control('meta_description', ['required' => false, 'class' => 'input-textarea', 'width' => '100%']); ?>

        </fieldset>
        <div class="text-end">
            <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
            <?= $this->Form->button(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>