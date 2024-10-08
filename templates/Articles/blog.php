<?php

use Cake\Routing\Router; //load at the beginning of file
echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
echo $this->Html->css('jquery.datetimepicker.min.css');
echo $this->Html->script('jquery.datetimepicker.full.js');
$domain = Router::url("/", true);
$c_name = $this->request->getParam('controller');
$this->assign('title', 'Blog');
?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css'>



<!-- slider main container -->
<div class="swiper-container">
    <div class="swiper-wrapper">
        <!-- slides -->
        <?php foreach ($blogs as $article) : ?>

            <div class="swiper-slide">
                <div class="product">
                    <?php echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'photograph swiper_poster', 'alt' => $article->title]); ?>
                    <div class="bottom-left">
                        <span>
                            <div class="goo"><?php echo $article->title; ?></div>
                        </span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- pagination -->
    <div class="swiper-pagination"></div>

    <!-- navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
<svg style="visibility: hidden; position: absolute;" width="0" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1">
    <defs>
        <filter id="goo">
            <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
            <feComposite in="SourceGraphic" in2="goo" operator="atop" />
        </filter>
    </defs>
</svg>


<script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js'></script>

<script>
    (function() {

        'use strict';

        const mySwiper = new Swiper('.swiper-container', {

            loop: true,

            slidesPerView: 'auto',
            centeredSlides: true,

            a11y: true,
            keyboardControl: true,
            grabCursor: true,

            // pagination
            pagination: '.swiper-pagination',
            paginationClickable: true,

            // navigation arrows
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev'
        });
    })(); /* IIFE end */
</script>







<div class="container">
    <div class="row">
        <div class="col-md-6">


            <div class="card blue mb-4 border-0 tile ripple-effect pt-3 px-3 blog_box">
                <div class="row">
                    <div class="col">
                        <div class="blog_title mb-0 mt-2">Search Blog</div>
                    </div>
                    <div class="col-3 text-end">
                        <img src="/CTP/img/icon/4233837.png" alt="virus" class="" style="opacity: .9" width="48px" height="48px">
                    </div>
                </div>
                <?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'articles', 'action' => 'blog']]); ?>

                <div class="row mt-4">
                    <div class="col-md-8">
                        <?php echo $this->Form->control('search', ['class' => 'form-control', 'onkeypress' => 'handle', 'label' => 'Search', 'placeholder' => 'Looking for something?']); ?>
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->control('category_id', [
                            'options' => $categories,
                            'empty' => 'Select Category',
                            'class' => 'form-select',
                            'default' => 5,
                            'required' => false,
                            'disabled' => 'disabled'
                        ]); ?>
                    </div>
                    <div class="col-md-12">
                        <?php echo $this->Form->control('tag', ['options' => $tags, 'id' => 'tagging', 'multiple' => true,]); ?>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $('.select2').select2();
                                $("#tagging").select2({
                                    tags: true,
                                    placeholder: "Tagging",
                                    tokenSeparators: [','],
                                    allowClear: true
                                });
                            });
                        </script>
                    </div>
                    <div class="col-md-3">
                        <?php echo $this->Form->control('publish_from', [
                            'class' => 'form-control datepicker-here',
                            'label' => 'Published From',
                            'id' => 'publish_from',
                            'type' => 'Text',
                            'data-language' => 'en',
                            'data-date-format' => 'Y-m-d',
                            //'value' => date('Y-m-d'),
                            'empty' => 'empty',
                            'autocomplete' => 'off',
                        ]); ?>
                        <script>
                            $('#publish_from').datetimepicker({
                                lang: 'en',
                                timepicker: false,
                                format: 'Y-m-d',
                                formatDate: 'Y/m/d',
                                //minDate:'-1970/01/01', // yesterday is minimum date
                                //maxDate:'+1970/01/02' // and tommorow is maximum date calendar
                            });
                        </script>
                    </div>
                    <div class="col-md-3">
                        <?php echo $this->Form->control('publish_to', [
                            'class' => 'form-control datepicker-here',
                            'label' => 'Published To',
                            'id' => 'publish_to',
                            'type' => 'Text',
                            'data-language' => 'en',
                            'data-date-format' => 'Y-m-d',
                            //'value' => date('Y-m-d'),
                            'empty' => 'empty',
                            'autocomplete' => 'off',
                        ]); ?>
                        <script>
                            $('#publish_to').datetimepicker({
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



                <div class="text-end">
                    <?php
                    if (!empty($_isSearch)) {
                        echo ' ';
                        echo $this->Html->link(__('Reset'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-secondary btn-sm mx-1', 'title' => 'Reset']);
                    }
                    echo $this->Form->button(__('Search'), ['class' => 'btn btn-dark btn-sm', 'title' => 'Search']);
                    echo $this->Form->end();
                    ?>
                </div>
            </div>


            <script>
                (function($) {
                    $(".ripple-effect").click(function(e) {
                        var rippler = $(this);

                        // create .ink element if it doesn't exist
                        if (rippler.find(".ink").length == 0) {
                            rippler.append("<span class='ink'></span>");
                        }

                        var ink = rippler.find(".ink");

                        // prevent quick double clicks
                        ink.removeClass("animate");

                        // set .ink diametr
                        if (!ink.height() && !ink.width()) {
                            var d = Math.max(rippler.outerWidth(), rippler.outerHeight());
                            ink.css({
                                height: d,
                                width: d
                            });
                        }

                        // get click coordinates
                        var x = e.pageX - rippler.offset().left - ink.width() / 2;
                        var y = e.pageY - rippler.offset().top - ink.height() / 2;

                        // set .ink position and add class .animate
                        ink.css({
                            top: y + 'px',
                            left: x + 'px'
                        }).addClass("animate");
                    })
                })(jQuery);
            </script>




        </div>







        <?php foreach ($blogs as $article) : ?>
            <div class="col-md-3">
                <div class="card bg-body-tertiary border-0 shadow mb-4 blog_box">
                    <?php echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'card-img-top blog_poster', 'width' => '100%', 'height' => '100px', 'alt' => $article->title]); ?>
                    <div class="card-body text-body-secondary">

                        <p class="category"><?= $article->category->title ?> <span class="date"><i class="fa fa-clock-o"></i><?= date('d M Y', strtotime($article->publish_on)); ?></p>
                        <h2 class="blog_title"> <?php echo $article->title; ?></h2>
                        <p class="blog_desc">
                            <?php echo strip_tags($this->Text->truncate(
                                $article->body,
                                200,
                                [
                                    'ellipsis' => '...',
                                    'exact' => false
                                ]
                            )); ?>
                        </p>
                        <?= $this->Html->link(__('Read More'), ['action' => 'view', 'prefix' => false, $article->slug], ['class' => 'read_more', 'escapeTitle' => false]) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="col-md-3 yellow">x</div>
        <div class="col-md-3 red">x</div>
        <div class="col-md-3 purple">x</div>
        <div class="col-md-3 orange">x</div>
    </div>

    <div aria-label="Page navigation" class="mt-3 px-2">
        <ul class="pagination justify-content-end flex-wrap">
            <?= $this->Paginator->first('<< ' . __('First')) ?>
            <?= $this->Paginator->prev('< ' . __('Previous')) ?>
            <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
            <?= $this->Paginator->next(__('Next') . ' >') ?>
            <?= $this->Paginator->last(__('Last') . ' >>') ?>
        </ul>
        <div class="text-end"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></div>
    </div>
</div>