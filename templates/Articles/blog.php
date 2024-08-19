<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css'>

<style>
    .swiper-container {
        margin-top: 0px;
    }

    .swiper-wrapper {
        margin-bottom: 3em;
        width: 73.8%;
    }

    @media (min-width: 37.5em) {
        .swiper-wrapper {
            width: 92%;
        }
    }

    @media (min-width: 43.75em) {
        .swiper-wrapper {
            width: 95%;
        }
    }

    .swiper-slide.swiper-slide {
        width: 100%;
    }


    @media (min-width: 37.5em) {
        .swiper-slide.swiper-slide {
            width: 50%;
            transform: translateX(-50%);
        }
    }

    @media (min-width: 43.75em) {
        .swiper-slide.swiper-slide {
            width: 33.33333333333%;
            transform: translateX(-100%);
        }
    }

    @media (min-width: 53em) {
        .swiper-slide.swiper-slide {
            width: 20%;
            transform: translateX(-150%);
        }
    }

    .swiper-pagination {
        display: block;
    }

    @media (min-width: 37.5em) {
        .swiper-pagination {
            display: none;
        }
    }

    .swiper-button-prev {
        display: none;
        left: 0;
        top: 0;
        margin-top: 0;
        height: calc(100% - 3em);
    }

    @media (min-width: 37.5em) {
        .swiper-button-prev {
            display: block;
        }
    }

    .swiper-button-next {
        display: none;
        right: 0;
        top: 0;
        margin-top: 0;
        height: calc(100% - 3em);
    }

    @media (min-width: 37.5em) {
        .swiper-button-next {
            display: block;
        }
    }

    .product {
        margin-left: 0px;
        margin-right: 0px;
    }

    .photograph {
        display: block;
        height: auto;
        width: 100%;
        height: 400px;
    }

    .product__name.product__name {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        font-size: calc(.5em + 5vw);
        font-weight: 600;
        text-align: center;
        text-transform: uppercase;
    }

    @media (min-width: 37.5em) {
        .product__name.product__name {
            font-size: .92em;
        }
    }

    .product__description {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        font-size: calc(.3em + 5vw);
        font-weight: 300;
        line-height: 1.1;
        text-align: center;
    }

    @media (min-width: 37.5em) {
        .product__description {
            font-size: .92em;
        }
    }

    .bottom-left {
        position: absolute;
        bottom: 8px;
        left: 16px;
    }
</style>

<!-- slider main container -->
<div class="swiper-container">

    <!-- additional required wrapper -->
    <div class="swiper-wrapper">

        <!-- slides -->
        <?php foreach ($blogs as $article) : ?>

            <div class="swiper-slide">
                <div class="product">
                    <?php echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'photograph', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]); ?>
                    <div class="bottom-left"><?php echo $article->title; ?></div>
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




<style>
    .category {
        font-weight: 900;
        font-size: 13px;
        color: #F26743;
        text-transform: uppercase;
    }

    .date {
        font-weight: 900;
        font-size: 13px;
        color: #9b9eab;
        margin-left: 5px;
    }

    .blog_title {
        font-weight: 500;
        font-size: 24px;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .blog_desc {
        font-weight: 400;
        font-size: 14px;
        line-height: 22px;
        color: #9b9eab;
    }

    .read_more {
        color: #F26743;
        display: block;
        font-weight: 900;
        font-size: 13px;
        position: relative;
        text-transform: uppercase;
    }

    .blog_box {
        height: 280px;
    }
</style>

<div class="container">
    <div class="row">
        <?php foreach ($blogs as $article) : ?>
            <div class="col-md-3">
                <div class="card bg-body-tertiary border-0 shadow mb-4 blog_box">
                    <div class="card-body text-body-secondary">
                        <p class="category">News <span class="date"><i class="fa fa-clock-o"></i>2014.11.19</p>
                        <h2 class="blog_title"> <?php echo $article->title; ?></h2>
                        <p class="blog_desc">
                            <?php echo strip_tags($this->Text->truncate(
                                $article->body,
                                250,
                                [
                                    'ellipsis' => '...',
                                    'exact' => false
                                ]
                            )); ?>
                        </p>
                        <a class="read_more" href="#">Read More</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="col-md-3 yellow">x</div>
        <div class="col-md-3 red">x</div>
        <div class="col-md-3 purple">x</div>
        <div class="col-md-3 orange">x</div>
    </div>
</div>