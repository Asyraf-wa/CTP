<?php
$this->assign('title', $article->title);

use Cake\Routing\Router;

echo $this->Html->css('prism.css');
echo $this->Html->script('prism.js', ['block' => 'scriptBottom']);
echo $this->Html->script('clipboard.min.js');
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
?>


<section class="header-view shadow">
    <div class="row g-0">
        <div class="col-md-2 pt-4 d-none d-sm-block">
            <div id="qr" align="right" class="mt-5 me-2"></div>
            <script type="text/javascript">
                const qrCode = new QRCodeStyling({
                    width: 130,
                    height: 130,
                    margin: 0,
                    //type: "svg",
                    data: "<?php echo $this->request->getUri(); ?>",
                    dotsOptions: {
                        color: "#ffffff",
                        type: "dots"
                    },
                    cornersSquareOptions: {
                        type: "dots",
                        color: "#007bff",
                    },
                    cornersDotOptions: {
                        type: "dots"
                    },
                    backgroundOptions: {
                        color: "#2B3034",
                    },
                    imageOptions: {
                        crossOrigin: "anonymous",
                        margin: 20
                    }
                });

                qrCode.append(document.getElementById("qr"));
                //qrCode.download({ name: "qr", extension: "png" });
            </script>
        </div>
        <div class="col-md-6">
            <div class="article-header-text text-secondary">
                <div class="svg-container-37">
                    <?php if ($article->icon != NULL) {
                        echo $article->icon;
                    } else {
                        echo '<svg viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 16C12 13.7909 13.7909 12 16 12H32C34.2091 12 36 13.7909 36 16V32C36 34.2091 34.2091 36 32 36H16C13.7909 36 12 34.2091 12 32V16Z" stroke="#C2CCDE" stroke-linecap="round" />
                                    <path d="M44 16C44 13.7909 45.7909 12 48 12H64C66.2091 12 68 13.7909 68 16V32C68 34.2091 66.2091 36 64 36H48C45.7909 36 44 34.2091 44 32V16Z" stroke="#C2CCDE" stroke-linecap="round" />
                                    <path d="M12 48C12 45.7909 13.7909 44 16 44H32C34.2091 44 36 45.7909 36 48V64C36 66.2091 34.2091 68 32 68H16C13.7909 68 12 66.2091 12 64V48Z" stroke="#C2CCDE" stroke-linecap="round" />
                                    <path d="M44 48C44 45.7909 45.7909 44 48 44H64C66.2091 44 68 45.7909 68 48V64C68 66.2091 66.2091 68 64 68H48C45.7909 68 44 66.2091 44 64V48Z" stroke="#C2CCDE" stroke-linecap="round" />
                                </svg>';
                    }
                    ?>
                </div>
                <h1 class="fw-bold">
                    <?= h($article->title) ?>
                </h1>
                <?= h($article->user->fullname) ?> - <?= date('F d, Y', strtotime($article->publish_on)); ?>
                <hr />
                <span class="badge text-bg-secondary">Published in <?= h($article->category->title) ?></span>
                <span class="badge text-bg-secondary"><?= h($article->hits) ?> Views</span>
                <?php if ($article->featured == 1) {
                    echo '<span class="badge text-bg-warning"> Featured</span>';
                } else
                    '';
                ?>
                <span class="badge text-bg-secondary"><a data-bs-toggle="modal" data-bs-target="#email"><i class="far fa-envelope"></i> Email This Article</a></span>


                <br />
                Estimated reading time:
                <?php
                $content = $article->body;

                $words = str_word_count(strip_tags($content));
                $minutes = floor($words / 200);
                $seconds = floor($words % 200 / (200 / 60));

                if (1 <= $minutes) {
                    $estimated_time = $minutes . ' minute' . ($minutes == 1 ? '' : 's') . ', ' . $seconds . ' second' . ($seconds == 1 ? '' : 's');
                } else {
                    $estimated_time = $seconds . ' second' . ($seconds == 1 ? '' : 's');
                }
                echo $estimated_time;
                ?>





                <!-- Email Modal -->
                <div class="modal fade" id="email" tabindex="-1" aria-labelledby="emailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="emailLabel">Email This Article</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?= $this->Form->create($article, ['action' => '/articles/email/' . $article->slug]) ?><!--local need /ctp/articles...-->
                                <?php echo $this->Form->control('email_address', ['class' => 'form-control', 'type' => 'email', 'required' => true]); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary btn-flat btn-sm" data-bs-dismiss="modal">Close</button>
                                <?= $this->Form->button(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                </div>

                <br />
                <?php
                if ($this->Identity->isLoggedIn()) { ?>
                    <button class="btn btn-sm shadow-none bg-danger text-light btn-outline-secondary mt-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Manage</button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <?= $this->Html->link(__('List'), ['prefix' => 'Admin', 'controller' => 'Projects', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]) ?>
                        <?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['prefix' => 'Admin', 'action' => 'edit', $article->id], ['class' => 'dropdown-item', 'escape' => false]) ?>
                        <?= $this->Form->postLink(__('<i class="far fa-trash-alt"></i> Delete'), ['prefix' => 'Admin', 'action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
                        <?= $this->Form->create ?>
                        <?php if ($article->published == 1) {
                            echo $this->Form->postLink(__('Unpublish'), ['action' => 'articlePublished', $article->id, $article->published], ['block' => true, 'confirm' => __('Are you sure you want to unpublish # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title' => 'Unpublish Article']);
                        } else
                            echo $this->Form->postLink(__('Publish'), ['action' => 'articlePublished', $article->id, $article->published], ['block' => true, 'confirm' => __('Are you sure you want to publish # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title' => 'Publish Article']); ?>

                        <?php if ($article->featured == 1) {
                            echo $this->Form->postLink(__('Unfeatured'), ['action' => 'articleFeatured', $article->id, $article->featured], ['block' => true, 'confirm' => __('Are you sure you want to unfeatured # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title' => 'Unfeatured Article']);
                        } else
                            echo $this->Form->postLink(__('Featured'), ['action' => 'articleFeatured', $article->id, $article->featured], ['block' => true, 'confirm' => __('Are you sure you want to featured # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title' => 'Featured Article']); ?>

                        <?= $this->Form->end() ?>
                        <?= $this->fetch('postLink'); ?>

                        <?= $this->Form->create ?>
                        <?php if ($article->published == 1) {
                            echo $this->Form->postLink(__('<i class="fas fa-exclamation-triangle"></i> Unpublish'), ['action' => 'articlePublished', $article->id, $article->published], ['block' => true, 'confirm' => __('Are you sure you want to unpublish # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title' => 'Unpublish Article']);
                        } else
                            echo $this->Form->postLink(__('<i class="fas fa-check"></i> Publish'), ['action' => 'articlePublished', $article->id, $article->published], ['block' => true, 'confirm' => __('Are you sure you want to publish # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title' => 'Publish Article']); ?>

                        <?php if ($article->featured == 1) {
                            echo $this->Form->postLink(__('<i class="fas fa-exclamation-triangle"></i> Unfeatured'), ['action' => 'articleFeatured', $article->id, $article->featured], ['block' => true, 'confirm' => __('Are you sure you want to unfeatured # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title' => 'Unfeatured Article']);
                        } else
                            echo $this->Form->postLink(__('<i class="fas fa-check"></i> Featured'), ['action' => 'articleFeatured', $article->id, $article->featured], ['block' => true, 'confirm' => __('Are you sure you want to featured # {0}?', $article->title), 'class' => 'dropdown-item', 'escape' => false, 'title' => 'Featured Article']); ?>

                        <?= $this->Form->end() ?>
                        <?= $this->fetch('postLink'); ?>
                    </ul>
                <?php } ?>

            </div>
        </div>
        <div class="col-md-4 d-none d-sm-block">
            <div class="big-feed-container">
                <?php echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'article-header-cover', 'width' => '500px', 'height' => '500px']); ?>
                <div class="article-header-gradient">
                </div>
            </div>
        </div>
    </div>
</section>

<!--Breadcrumbs-->
<?php
$this->Breadcrumbs->add([
    [
        'title' => 'Home',
        'url' => ['controller' => 'Articles', 'action' => 'index'],
        'options' => ['class' => 'breadcrumb-item']
    ],
    [
        'title' => $article->title,
        'url' => ['controller' => 'articles', 'action' => 'view', $article->id],
        'options' => [
            'class' => 'breadcrumb-item',
            'innerAttrs' => [
                'class' => 'breadcrumb',
                'id' => 'the-products-crumb'
            ]
        ]
    ]
]);
?>
<small>
    <div class="bg-body-tertiary shadow d-none d-lg-block">
        <?php
        $this->Breadcrumbs->setTemplates([
            'wrapper' => '<div aria-label="breadcrumb" class="container"><ol class="breadcrumb" {{attrs}}>{{content}}</ol></div>',
            'item' => '<li {{attrs}}>{{icon}}<a href="{{url}}"{{innerAttrs}} class="breadcrumb">{{title}}</a></li>{{separator}}',
        ]);
        echo $this->Breadcrumbs->render();
        ?>
    </div>
</small>

<div class="container">
    <div class="row mt-5 mb-4">
        <div class="col-md-9 border-end">
            <div class="has-dropcap mb-6">
                <?= $article->body ?>
            </div>



            <hr class="mt-5" />





            <div class="badge bg-primary text-wrap">
                Cite this article (APA 6th Edition)
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="" aria-label="Copy" aria-describedby="button-addon2" value="<?php echo $article->user->fullname; ?>. <?= h($article->title) ?>. Retrieved <?php echo date("d F, Y"); ?>, from <?php echo Router::url(null, true); ?>" id="myInput" size="100%">
                <button class="btn btn-outline-secondary" onclick="myFunction()" data-clipboard-target="#myInput">Copy</button>
            </div>

            <script>
                function myFunction() {
                    /* Get the text field */
                    var copyText = document.getElementById("myInput");

                    /* Select the text field */
                    copyText.select();
                    copyText.setSelectionRange(0, 99999); /* For mobile devices */

                    /* Copy the text inside the text field */
                    navigator.clipboard.writeText(copyText.value);

                    /* Alert the copied text */
                    alert("Reference copied: " + copyText.value);
                }
            </script>

            <?php //echo h($article->tag_list); 
            ?>


            <!-- Share Widget Starts Here -->
            <div class="ssbats-social-share">
                <span class="ssbats-social-share-label">Share on:</span>
                <div class="ssbats-social-share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=URL_HERE" class="ssbats-share-facebook ssbats-share-popup"><span>facebook</span></a>
                    <a href="https://www.instagram.com/intent/tweet?url=URL_HERE&via=i_Genius" class="ssbats-share-instagram ssbats-share-popup"><span>instagram</span></a>
                    <a href="https://www.twitter.com/intent/tweet?url=URL_HERE&via=i_Genius" class="ssbats-share-twitter ssbats-share-popup"><span>x</span></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=URL_HERE" class="ssbats-share-linkedin ssbats-share-popup"><span>linkedin</span></a>
                    <a href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" data-pin-custom="true" class="ssbats-share-pinterest"><span>pinterest</span></a>
                    <a href="https://tumblr.com/widgets/share/tool?canonicalUrl=URL_HERE" class="ssbats-share-tumblr ssbats-share-popup"><span>tumblr</span></a>
                    <a href="https://www.reddit.com/submit?url=URL_HERE" class="ssbats-share-reddit ssbats-share-popup"><span>reddit</span></a>
                    <a href="https://api.whatsapp.com/send?text=URL_HERE" class="ssbats-share-whatsapp"><span>whatsapp</span></a>
                    <a href="https://telegram.me/share/url?url=URL_HERE" class="ssbats-share-telegram ssbats-share-popup"><span>telegram</span></a>
                    <a href="https://getpocket.com/save?url=URL_HERE" class="ssbats-share-pocket ssbats-share-popup"><span>pocket</span></a>
                </div>
            </div>
            <!-- Share Widget Ends Here -->
            <script>
                document.querySelectorAll('.ssbats-share-popup').forEach(item =>
                    item.addEventListener('click', (event) => {
                        var window_size = "width=530,height=400";
                        var social = item.href.split("/")[2];
                        switch (social) {
                            case "www.facebook.com":
                                window_size = "width=530,height=640";
                                break;
                            case "www.twitter.com":
                                window_size = "width=585,height=261";
                                break;
                            case "www.linkedin.com":
                                window_size = "width=585,height=600";
                                break;
                            case "tumblr.com":
                                window_size = "width=540,height=600";
                                break;
                            case "www.reddit.com":
                                window_size = "width=600,height=600";
                                break;
                        }
                        window.open(item.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,' + window_size);
                        event.preventDefault();
                        return false;
                    }));

                document.querySelectorAll('.ssbats-social-share a').forEach(item => {
                    item.href = item.href.replace("URL_HERE", document.URL);
                });
            </script>


            <hr />



            <div class="row g-1 my-4">
                <div class="card-title mb-0">Latest Posting</div>
                <div class="tricolor_line mb-3"></div>
                <?php foreach ($latest as $article) : ?>
                    <div class="col-md-2">
                        <?php
                        $domain = Router::url("/", true);
                        //$sub = 'articles/';
                        $identifier = $article->slug;
                        $combine = $domain . $identifier;
                        echo '<div class="card bg-body-tertiary border border-0 rounded-0 gap_0_box_small">
                            <div class="module_tiles"><div class="module_gradient">';
                        echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'module_bg_cover', 'alt' => $article->title]);
                        echo '<a href="' . $combine . '" class="feed-title-light-link">';
                        echo '<div class="module_gradient_mask module_gradient">';
                        echo '<div class="mt-5"><span class="module_text_bg">';
                        echo h($article->title);
                        echo '</span></div></div>';
                        echo '</a>';
                        echo '</div></div></div>';
                        ?>
                    </div>
                <?php endforeach; ?>

            </div>


        </div>
        <div class="col-md-3">

            <?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'articles', 'action' => 'index']]); ?>
            <?php echo $this->Form->control('search', ['class' => 'form-control border-0 bg-body-tertiary shadow-none', 'label' => false, 'placeholder' => 'Looking for something?']); ?>
            <?= $this->Form->end() ?>









            <div class="card bg-body-tertiary border-0 shadow mb-4">
                <div class="card-body text-body-secondary">
                    <div class="card-title mb-0">Popular Posting</div>
                    <div class="tricolor_line mb-3"></div>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless table_transparent table-hover">
                            <?php foreach ($popular as $article) : ?>
                                <tr>
                                    <td class="in ps-2">
                                        <?php
                                        $domain = Router::url("/", true);
                                        $sub = 'articles/';
                                        $identifier = $article->slug;
                                        $combine = $domain . $sub . $identifier;
                                        ?>
                                        <a href="<?= $combine; ?>" class="nostyle_link">
                                            <?php echo $this->Text->truncate(
                                                $article->title,
                                                70,
                                                [
                                                    'ellipsis' => '...',
                                                    'exact' => false
                                                ]
                                            ); ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>



            <div class="card bg-body-tertiary border-0 shadow mb-4 gradient-border">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto fs-1">
                            <svg width="40" height="40" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 36.4141V34C16 28.4772 20.4772 24 26 24C28.2091 24 30 22.2091 30 20C30 17.7909 28.2091 16 26 16C16.0589 16 8 24.0589 8 34V53C8 58.0351 11.383 62.2801 16 63.5859" stroke="#C2CCDE" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16 36.4141C16.9537 36.1443 17.96 36 19 36H25C31.0751 36 36 40.9249 36 47V53C36 59.0751 31.0751 64 25 64H19C17.96 64 16.9537 63.8557 16 63.5859" stroke="#C2CCDE" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M52 36.4141V34C52 28.4772 56.4772 24 62 24C64.2091 24 66 22.2091 66 20C66 17.7909 64.2091 16 62 16C52.0589 16 44 24.0589 44 34V53C44 58.0351 47.383 62.2801 52 63.5859" stroke="#C2CCDE" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M52 36.4141C52.9537 36.1443 53.96 36 55 36H61C67.0751 36 72 40.9249 72 47V53C72 59.0751 67.0751 64 61 64H55C53.96 64 52.9537 63.8557 52 63.5859" stroke="#C2CCDE" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="col">
                            <?php foreach ($random_quote as $quotes) : ?>
                                <?php echo $quotes->quote; ?>
                                <div class="fst-italic">- <?php echo $quotes->author; ?></div>
                            <?php endforeach; ?>

                        </div>
                    </div>


                </div>
            </div>

            <div class="card border-0 mb-4">
                <div class="card-body">
                    <div class="row text-center ms-2">
                        <div class="col-1 small_box emerald rounded">
                            <div class="icon-center">
                                <svg width="40" height="40" viewBox="0 -28 256 256" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <title>Combined Shape</title>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <path d="M0,119.882843 C0,141.938825 57.2937323,159.841092 127.979753,159.841092 L127.979753,159.841092 L127.979753,199.783147 C57.2937323,199.783147 0,181.897074 0,159.841092 L0,159.841092 Z M255.999995,119.882843 L255.999995,159.832995 C255.999995,169.249701 245.530687,177.889104 228.09804,184.722895 L228.09804,184.722895 L127.971656,159.832995 L127.971656,119.882843 L228.09804,144.764647 C245.530687,137.938952 256.008088,129.299549 255.999995,119.882843 L255.999995,119.882843 Z M127.979753,0 C198.673871,0 256,17.9184609 256,39.9582488 L256,39.9582488 L256,79.9407884 C256,89.3251066 245.530687,97.9968968 228.106137,104.798301 L228.106137,104.798301 L127.979753,79.9407884 L127.979753,119.882843 C57.2937323,119.882843 0,101.988673 0,79.9407884 L0,79.9407884 L0,39.9582488 C0,17.9184609 57.2937323,0 127.979753,0 Z" fill="#ffffff"> </path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <div class="col-1 small_box purple rounded">
                            <div class="icon-center">
                                <svg width="40" height="40" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 16H23.8172H22.8399C18.1069 16 14.4087 20.0865 14.8796 24.796L15.4514 30.5141C15.7817 33.8172 14.0379 36.9811 11.0688 38.4656L8 40L11.0688 41.5344C14.0379 43.0189 15.7817 46.1828 15.4514 49.4859L14.8796 55.204C14.4087 59.9135 18.1069 64 22.8399 64H23.8172H24" stroke="#C2CCDE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M56 16H56.1828H57.1601C61.8931 16 65.5913 20.0865 65.1204 24.796L64.5486 30.5141C64.2183 33.8172 65.9621 36.9811 68.9312 38.4656L72 40L68.9312 41.5344C65.9621 43.0189 64.2183 46.1828 64.5486 49.4859L65.1204 55.204C65.5913 59.9135 61.8931 64 57.1601 64H56.1828H56" stroke="#C2CCDE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M27.7852 40H28.2852" stroke="#C2CCDE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M39.7852 40H40.2852" stroke="#C2CCDE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M51.7852 40H52.2852" stroke="#C2CCDE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-1 small_box red rounded">
                            <div class="icon-center">
                                <svg width="40" height="40" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21 11L22.3436 11.0755L23.6703 11.3009L24.9634 11.6734L26.2066 12.1884L27.3844 12.8393L28.4819 13.618L29.4853 14.5147L30.382 15.5181L31.1607 16.6156L31.8116 17.7934L32.3266 19.0367L32.6991 20.3298L32.9245 21.6564L33 23L32.9245 24.3436L32.6991 25.6703L32.3266 26.9634L31.8116 28.2066L31.1607 29.3844L30.382 30.4819L29.4853 31.4853L28.4819 32.382L27.3844 33.1607L26.2066 33.8116L24.9634 34.3266L23.6703 34.6991L22.3436 34.9245L21 35L19.6564 34.9245L18.3298 34.6991L17.0367 34.3266L15.7934 33.8116L14.6156 33.1607L13.5181 32.382L12.5147 31.4853L11.618 30.4819L10.8393 29.3844L10.1884 28.2066L9.6734 26.9634L9.30087 25.6703L9.07545 24.3436L9 23L9.07545 21.6564L9.30087 20.3298L9.6734 19.0367L10.1884 17.7934L10.8393 16.6156L11.618 15.5181L12.5147 14.5147L13.5181 13.618L14.6156 12.8393L15.7934 12.1884L17.0367 11.6734L18.3298 11.3009L19.6564 11.0755L21 11Z" fill="#C2CCDE" />
                                    <path d="M21 11L21.1121 9.00315C21.0374 8.99895 20.9626 8.99895 20.8879 9.00315L21 11ZM22.3436 11.0755L22.6786 9.10371C22.6048 9.09118 22.5304 9.0828 22.4557 9.0786L22.3436 11.0755ZM23.6703 11.3009L24.2239 9.37903C24.152 9.35832 24.079 9.34166 24.0053 9.32912L23.6703 11.3009ZM24.9634 11.6734L25.7287 9.82564C25.6596 9.79701 25.5889 9.77228 25.517 9.75157L24.9634 11.6734ZM26.2066 12.1884L27.174 10.4379C27.1086 10.4017 27.0411 10.3692 26.972 10.3406L26.2066 12.1884ZM27.3844 12.8393L28.5417 11.2082C28.4807 11.1649 28.4173 11.1251 28.3518 11.0889L27.3844 12.8393ZM28.4819 13.618L29.8146 12.1267C29.7588 12.0769 29.7002 12.0302 29.6392 11.9869L28.4819 13.618ZM29.4853 14.5147L30.9766 13.182C30.9267 13.1262 30.8738 13.0733 30.818 13.0234L29.4853 14.5147ZM30.382 15.5181L32.0131 14.3608C31.9698 14.2998 31.9231 14.2412 31.8733 14.1854L30.382 15.5181ZM31.1607 16.6156L32.9111 15.6482C32.8749 15.5827 32.8351 15.5193 32.7918 15.4583L31.1607 16.6156ZM31.8116 17.7934L33.6594 17.028C33.6308 16.9589 33.5983 16.8914 33.5621 16.826L31.8116 17.7934ZM32.3266 19.0367L34.2484 18.483C34.2277 18.4111 34.203 18.3404 34.1744 18.2713L32.3266 19.0367ZM32.6991 20.3298L34.6709 19.9947C34.6583 19.921 34.6417 19.848 34.621 19.7761L32.6991 20.3298ZM32.9245 21.6564L34.9214 21.5443C34.9172 21.4696 34.9088 21.3952 34.8963 21.3214L32.9245 21.6564ZM33 23L34.9969 23.1121C35.0011 23.0374 35.0011 22.9626 34.9969 22.8879L33 23ZM32.9245 24.3436L34.8963 24.6786C34.9088 24.6048 34.9172 24.5304 34.9214 24.4557L32.9245 24.3436ZM32.6991 25.6703L34.621 26.2239C34.6417 26.152 34.6583 26.079 34.6709 26.0053L32.6991 25.6703ZM32.3266 26.9634L34.1744 27.7287C34.203 27.6596 34.2277 27.5889 34.2484 27.517L32.3266 26.9634ZM31.8116 28.2066L33.5621 29.174C33.5983 29.1086 33.6308 29.0411 33.6594 28.972L31.8116 28.2066ZM31.1607 29.3844L32.7918 30.5417C32.8351 30.4807 32.8749 30.4173 32.9111 30.3518L31.1607 29.3844ZM30.382 30.4819L31.8733 31.8146C31.9231 31.7588 31.9698 31.7002 32.0131 31.6392L30.382 30.4819ZM29.4853 31.4853L30.818 32.9766C30.8738 32.9267 30.9267 32.8738 30.9766 32.818L29.4853 31.4853ZM28.4819 32.382L29.6392 34.0131C29.7002 33.9698 29.7588 33.9231 29.8146 33.8733L28.4819 32.382ZM27.3844 33.1607L28.3518 34.9111C28.4173 34.8749 28.4807 34.8351 28.5417 34.7918L27.3844 33.1607ZM26.2066 33.8116L26.972 35.6594C27.0411 35.6308 27.1086 35.5983 27.174 35.5621L26.2066 33.8116ZM24.9634 34.3266L25.517 36.2484C25.5889 36.2277 25.6596 36.203 25.7287 36.1744L24.9634 34.3266ZM23.6703 34.6991L24.0053 36.6709C24.079 36.6583 24.152 36.6417 24.2239 36.621L23.6703 34.6991ZM22.3436 34.9245L22.4557 36.9214C22.5304 36.9172 22.6048 36.9088 22.6786 36.8963L22.3436 34.9245ZM21 35L20.8879 36.9969C20.9626 37.0011 21.0374 37.0011 21.1121 36.9969L21 35ZM19.6564 34.9245L19.3214 36.8963C19.3952 36.9088 19.4696 36.9172 19.5443 36.9214L19.6564 34.9245ZM18.3298 34.6991L17.7761 36.621C17.848 36.6417 17.921 36.6583 17.9947 36.6709L18.3298 34.6991ZM17.0367 34.3266L16.2713 36.1744C16.3404 36.203 16.4111 36.2277 16.483 36.2484L17.0367 34.3266ZM15.7934 33.8116L14.826 35.5621C14.8914 35.5983 14.9589 35.6308 15.028 35.6594L15.7934 33.8116ZM14.6156 33.1607L13.4583 34.7918C13.5193 34.8351 13.5827 34.8749 13.6482 34.9111L14.6156 33.1607ZM13.5181 32.382L12.1854 33.8733C12.2412 33.9231 12.2998 33.9698 12.3608 34.0131L13.5181 32.382ZM12.5147 31.4853L11.0234 32.818C11.0733 32.8738 11.1262 32.9267 11.182 32.9766L12.5147 31.4853ZM11.618 30.4819L9.9869 31.6392C10.0302 31.7002 10.0769 31.7588 10.1267 31.8146L11.618 30.4819ZM10.8393 29.3844L9.08886 30.3518C9.12505 30.4173 9.16489 30.4807 9.20819 30.5417L10.8393 29.3844ZM10.1884 28.2066L8.34061 28.972C8.36925 29.0411 8.40174 29.1086 8.43793 29.174L10.1884 28.2066ZM9.6734 26.9634L7.75157 27.517C7.77228 27.5889 7.79701 27.6596 7.82564 27.7287L9.6734 26.9634ZM9.30087 25.6703L7.32912 26.0053C7.34166 26.079 7.35832 26.152 7.37903 26.2239L9.30087 25.6703ZM9.07545 24.3436L7.0786 24.4557C7.0828 24.5304 7.09118 24.6048 7.10371 24.6786L9.07545 24.3436ZM9 23L7.00315 22.8879C6.99895 22.9626 6.99895 23.0374 7.00315 23.1121L9 23ZM9.07545 21.6564L7.10371 21.3214C7.09118 21.3952 7.0828 21.4696 7.0786 21.5443L9.07545 21.6564ZM9.30087 20.3298L7.37903 19.7761C7.35832 19.848 7.34166 19.921 7.32912 19.9947L9.30087 20.3298ZM9.6734 19.0367L7.82564 18.2713C7.79701 18.3404 7.77228 18.4111 7.75157 18.483L9.6734 19.0367ZM10.1884 17.7934L8.43793 16.826C8.40174 16.8914 8.36925 16.9589 8.34061 17.028L10.1884 17.7934ZM10.8393 16.6156L9.20819 15.4583C9.16489 15.5193 9.12505 15.5827 9.08886 15.6482L10.8393 16.6156ZM11.618 15.5181L10.1267 14.1854C10.0769 14.2412 10.0302 14.2998 9.9869 14.3608L11.618 15.5181ZM12.5147 14.5147L11.182 13.0234C11.1262 13.0733 11.0733 13.1262 11.0234 13.182L12.5147 14.5147ZM13.5181 13.618L12.3608 11.9869C12.2998 12.0302 12.2412 12.0769 12.1854 12.1267L13.5181 13.618ZM14.6156 12.8393L13.6482 11.0889C13.5827 11.1251 13.5193 11.1649 13.4583 11.2082L14.6156 12.8393ZM15.7934 12.1884L15.028 10.3406C14.9589 10.3692 14.8914 10.4017 14.826 10.4379L15.7934 12.1884ZM17.0367 11.6734L16.483 9.75157C16.4111 9.77228 16.3404 9.79701 16.2713 9.82564L17.0367 11.6734ZM18.3298 11.3009L17.9947 9.32912C17.921 9.34166 17.848 9.35832 17.7761 9.37903L18.3298 11.3009ZM19.6564 11.0755L19.5443 9.0786C19.4696 9.0828 19.3952 9.09118 19.3214 9.10371L19.6564 11.0755ZM20.8879 12.9969L22.2314 13.0723L22.4557 9.0786L21.1121 9.00315L20.8879 12.9969ZM22.0086 13.0472L23.3352 13.2726L24.0053 9.32912L22.6786 9.10371L22.0086 13.0472ZM23.1166 13.2227L24.4097 13.5952L25.517 9.75157L24.2239 9.37903L23.1166 13.2227ZM24.198 13.5212L25.4412 14.0361L26.972 10.3406L25.7287 9.82564L24.198 13.5212ZM25.2392 13.9388L26.4169 14.5898L28.3518 11.0889L27.174 10.4379L25.2392 13.9388ZM26.227 14.4704L27.3245 15.2491L29.6392 11.9869L28.5417 11.2082L26.227 14.4704ZM27.1492 15.1093L28.1526 16.006L30.818 13.0234L29.8146 12.1267L27.1492 15.1093ZM27.994 15.8474L28.8907 16.8508L31.8733 14.1854L30.9766 13.182L27.994 15.8474ZM28.7509 16.6755L29.5296 17.773L32.7918 15.4583L32.0131 14.3608L28.7509 16.6755ZM29.4102 17.5831L30.0612 18.7608L33.5621 16.826L32.9111 15.6482L29.4102 17.5831ZM29.9639 18.5588L30.4788 19.802L34.1744 18.2713L33.6594 17.028L29.9639 18.5588ZM30.4048 19.5903L30.7773 20.8834L34.621 19.7761L34.2484 18.483L30.4048 19.5903ZM30.7274 20.6648L30.9528 21.9914L34.8963 21.3214L34.6709 19.9947L30.7274 20.6648ZM30.9277 21.7686L31.0031 23.1121L34.9969 22.8879L34.9214 21.5443L30.9277 21.7686ZM31.0031 22.8879L30.9277 24.2314L34.9214 24.4557L34.9969 23.1121L31.0031 22.8879ZM30.9528 24.0086L30.7274 25.3352L34.6709 26.0053L34.8963 24.6786L30.9528 24.0086ZM30.7773 25.1166L30.4048 26.4097L34.2484 27.517L34.621 26.2239L30.7773 25.1166ZM30.4788 26.198L29.9639 27.4412L33.6594 28.972L34.1744 27.7287L30.4788 26.198ZM30.0612 27.2392L29.4102 28.4169L32.9111 30.3518L33.5621 29.174L30.0612 27.2392ZM29.5296 28.227L28.7509 29.3245L32.0131 31.6392L32.7918 30.5417L29.5296 28.227ZM28.8907 29.1492L27.994 30.1526L30.9766 32.818L31.8733 31.8146L28.8907 29.1492ZM28.1526 29.994L27.1492 30.8907L29.8146 33.8733L30.818 32.9766L28.1526 29.994ZM27.3245 30.7509L26.227 31.5296L28.5417 34.7918L29.6392 34.0131L27.3245 30.7509ZM26.4169 31.4102L25.2392 32.0612L27.174 35.5621L28.3518 34.9111L26.4169 31.4102ZM25.4412 31.9639L24.198 32.4788L25.7287 36.1744L26.972 35.6594L25.4412 31.9639ZM24.4097 32.4048L23.1166 32.7773L24.2239 36.621L25.517 36.2484L24.4097 32.4048ZM23.3352 32.7274L22.0086 32.9528L22.6786 36.8963L24.0053 36.6709L23.3352 32.7274ZM22.2314 32.9277L20.8879 33.0031L21.1121 36.9969L22.4557 36.9214L22.2314 32.9277ZM21.1121 33.0031L19.7686 32.9277L19.5443 36.9214L20.8879 36.9969L21.1121 33.0031ZM19.9914 32.9528L18.6648 32.7274L17.9947 36.6709L19.3214 36.8963L19.9914 32.9528ZM18.8834 32.7773L17.5903 32.4048L16.483 36.2484L17.7761 36.621L18.8834 32.7773ZM17.802 32.4788L16.5588 31.9639L15.028 35.6594L16.2713 36.1744L17.802 32.4788ZM16.7608 32.0612L15.5831 31.4102L13.6482 34.9111L14.826 35.5621L16.7608 32.0612ZM15.773 31.5296L14.6755 30.7509L12.3608 34.0131L13.4583 34.7918L15.773 31.5296ZM14.8508 30.8907L13.8474 29.994L11.182 32.9766L12.1854 33.8733L14.8508 30.8907ZM14.006 30.1526L13.1093 29.1492L10.1267 31.8146L11.0234 32.818L14.006 30.1526ZM13.2491 29.3245L12.4704 28.227L9.20819 30.5417L9.9869 31.6392L13.2491 29.3245ZM12.5898 28.4169L11.9388 27.2392L8.43793 29.174L9.08886 30.3518L12.5898 28.4169ZM12.0361 27.4412L11.5212 26.198L7.82564 27.7287L8.34061 28.972L12.0361 27.4412ZM11.5952 26.4097L11.2227 25.1166L7.37903 26.2239L7.75157 27.517L11.5952 26.4097ZM11.2726 25.3352L11.0472 24.0086L7.10371 24.6786L7.32912 26.0053L11.2726 25.3352ZM11.0723 24.2314L10.9969 22.8879L7.00315 23.1121L7.0786 24.4557L11.0723 24.2314ZM10.9969 23.1121L11.0723 21.7686L7.0786 21.5443L7.00315 22.8879L10.9969 23.1121ZM11.0472 21.9914L11.2726 20.6648L7.32912 19.9947L7.10371 21.3214L11.0472 21.9914ZM11.2227 20.8834L11.5952 19.5903L7.75157 18.483L7.37903 19.7761L11.2227 20.8834ZM11.5212 19.802L12.0361 18.5588L8.34061 17.028L7.82564 18.2713L11.5212 19.802ZM11.9388 18.7608L12.5898 17.5831L9.08886 15.6482L8.43793 16.826L11.9388 18.7608ZM12.4704 17.773L13.2491 16.6755L9.9869 14.3608L9.20819 15.4583L12.4704 17.773ZM13.1093 16.8508L14.006 15.8474L11.0234 13.182L10.1267 14.1854L13.1093 16.8508ZM13.8474 16.006L14.8508 15.1093L12.1854 12.1267L11.182 13.0234L13.8474 16.006ZM14.6755 15.2491L15.773 14.4704L13.4583 11.2082L12.3608 11.9869L14.6755 15.2491ZM15.5831 14.5898L16.7608 13.9388L14.826 10.4379L13.6482 11.0889L15.5831 14.5898ZM16.5588 14.0361L17.802 13.5212L16.2713 9.82564L15.028 10.3406L16.5588 14.0361ZM17.5903 13.5952L18.8834 13.2227L17.7761 9.37903L16.483 9.75157L17.5903 13.5952ZM18.6648 13.2726L19.9914 13.0472L19.3214 9.10371L17.9947 9.32912L18.6648 13.2726ZM19.7686 13.0723L21.1121 12.9969L20.8879 9.00315L19.5443 9.0786L19.7686 13.0723Z" fill="#C2CCDE" />
                                    <path d="M47.1005 13.1722L56.1 22.1717L57.8999 23.9716L66.8995 32.9712" stroke="#C2CCDE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M66.8995 13.1722L57.9 22.1717L56.1001 23.9716L47.1005 32.9712" stroke="#C2CCDE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M32.5212 56.1374C33.1819 56.5227 33.1818 57.4773 32.5212 57.8626L11.5018 70.1239C10.8361 70.5123 10 70.0321 10 69.2613L10 44.7387C10 43.9679 10.8361 43.4877 11.5018 43.8761L32.5212 56.1374Z" fill="#C2CCDE" stroke="#C2CCDE" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                    <rect x="45" y="45" width="24" height="24" rx="1" fill="#C2CCDE" stroke="#C2CCDE" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-1 small_box orange rounded">
                            <div class="icon-center">
                                <svg width="40" height="40" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M40.7878 16.3377C40.2847 16.1221 39.7152 16.1221 39.2121 16.3377L16.2893 26.1617C14.6731 26.8544 14.6731 29.1457 16.2893 29.8383L39.2121 39.6624C39.7152 39.878 40.2847 39.878 40.7878 39.6624L63.7106 29.8383C65.3269 29.1457 65.3269 26.8544 63.7106 26.1617L40.7878 16.3377ZM19.7561 35.6759L16.2893 37.1617C14.6731 37.8543 14.6731 40.1456 16.2893 40.8383L39.2121 50.6623C39.7152 50.8779 40.2847 50.8779 40.7878 50.6623L63.7106 40.8383C65.3268 40.1456 65.3268 37.8543 63.7106 37.1617L60.2438 35.6759L42.3635 43.3389C40.8542 43.9857 39.1458 43.9857 37.6365 43.3389L19.7561 35.6759ZM19.7562 46.6759L16.2893 48.1617C14.6731 48.8544 14.6731 51.1456 16.2893 51.8383L39.2121 61.6623C39.7152 61.8779 40.2847 61.8779 40.7878 61.6623L63.7106 51.8383C65.3269 51.1456 65.3269 48.8544 63.7106 48.1617L60.2438 46.6759L42.3635 54.3389C40.8542 54.9857 39.1458 54.9857 37.6365 54.3389L19.7562 46.6759Z" fill="#C2CCDE" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-1 small_box blue rounded">
                            <div class="icon-center">
                                <svg width="40" height="40" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M42.9975 33.0718C41.2846 33.072 39.5705 33.5154 38.0353 34.4017C34.9639 36.175 33.0718 39.4522 33.0718 42.9987C33.0718 44.0551 33.2399 45.0887 33.5574 46.0658C34.0694 47.6416 35.7619 48.5039 37.3376 47.9919C38.9134 47.4798 39.7757 45.7874 39.2637 44.2116C39.1383 43.8258 39.0718 43.4176 39.0718 42.9987C39.0718 41.5958 39.8203 40.2994 41.0353 39.5979C41.6427 39.2472 42.3199 39.0719 42.9983 39.0718C44.6551 39.0716 45.9981 37.7282 45.9979 36.0714C45.9977 34.4145 44.6544 33.0716 42.9975 33.0718Z" fill="#C2CCDE" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M38.2969 8.99994C36.7076 8.99994 35.2692 9.94078 34.6322 11.3968L33.931 12.9997H33.8564C32.1989 12.9997 30.7132 14.0219 30.1207 15.5698L28.4249 20H25.525L25.338 19.1452C24.9363 17.3089 23.3102 15.9999 21.4304 15.9999H18.6042C16.7244 15.9999 15.0983 17.3089 14.6966 19.1452L14.5097 20H14C11.2386 20 9 22.2386 9 25V61C9 63.7614 11.2386 66 14 66H31.9497C38.9308 69.3555 47.0692 69.3555 54.0504 66H64C66.7614 66 69 63.7614 69 61V25C69 22.2386 66.7614 20 64 20H57.6962L56.0004 15.5698C55.4079 14.0219 53.9222 12.9997 52.2647 12.9997H52.1382L51.437 11.3968C50.8 9.94077 49.3616 8.99994 47.7723 8.99994H38.2969ZM52.7583 26.0981C46.7199 22.6117 39.2801 22.6117 33.2417 26.0981C27.2032 29.5844 23.4833 36.0273 23.4833 43C23.4833 49.9726 27.2032 56.4156 33.2417 59.9019C39.2801 63.3882 46.7199 63.3882 52.7583 59.9019C58.7968 56.4156 62.5167 49.9726 62.5167 43C62.5167 36.0274 58.7968 29.5844 52.7583 26.0981Z" fill="#C2CCDE" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-1 small_box yellow rounded">
                            <div class="icon-center">
                                <svg width="40" height="40" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.6667 37C17.0098 37 15.6667 38.3431 15.6667 40C15.6667 41.6569 17.0098 43 18.6667 43V37ZM37.3333 40L40.3333 40C40.3333 38.3431 38.9902 37 37.3333 37V40ZM38 71C39.6569 71 41 69.6569 41 68C41 66.3431 39.6569 65 38 65V71ZM18 68H15C15 69.6569 16.3431 71 18 71V68ZM37.3333 40.5833L39.7674 42.337C40.1353 41.8263 40.3333 41.2128 40.3333 40.5833H37.3333ZM18 67.4167L15.566 65.663C15.198 66.1737 15 66.7872 15 67.4167H18ZM18.6667 43H37.3333V37H18.6667V43ZM38 65H18V71H38V65ZM34.3333 40V40.5833H40.3333V40L34.3333 40ZM34.8993 38.8296L15.566 65.663L20.434 69.1704L39.7674 42.337L34.8993 38.8296ZM15 67.4167V68H21V67.4167H15Z" fill="#C2CCDE" />
                                    <path d="M48.4667 27C46.8098 27 45.4667 28.3431 45.4667 30C45.4667 31.6569 46.8098 33 48.4667 33V27ZM61.5333 30H64.5333C64.5333 28.3431 63.1902 27 61.5333 27V30ZM62 53C63.6569 53 65 51.6569 65 50C65 48.3431 63.6569 47 62 47V53ZM48 50H45C45 51.6569 46.3431 53 48 53V50ZM61.5333 30.4167L63.984 32.1471C64.3414 31.6408 64.5333 31.0364 64.5333 30.4167H61.5333ZM48 49.5833L45.5493 47.8529C45.1919 48.3592 45 48.9636 45 49.5833H48ZM48.4667 33H61.5333V27L48.4667 27V33ZM62 47H48L48 53H62V47ZM58.5333 30V30.4167L64.5333 30.4167V30L58.5333 30ZM59.0827 28.6863L45.5493 47.8529L50.4507 51.3137L63.984 32.1471L59.0827 28.6863ZM45 49.5833V50H51V49.5833H45Z" fill="#C2CCDE" />
                                    <path d="M29.4 9C27.7431 9 26.4 10.3431 26.4 12C26.4 13.6569 27.7431 15 29.4 15V9ZM40.6 12H43.6C43.6 10.3431 42.2569 9 40.6 9V12ZM41 33C42.6569 33 44 31.6569 44 30C44 28.3431 42.6569 27 41 27V33ZM29 30H26C26 31.6569 27.3431 33 29 33V30ZM40.6 12.375L43.0895 14.0491C43.4223 13.5542 43.6 12.9714 43.6 12.375H40.6ZM29 29.625L26.5105 27.9509C26.1777 28.4458 26 29.0286 26 29.625H29ZM29.4 15L40.6 15V9L29.4 9V15ZM41 27H29V33H41V27ZM37.6 12V12.375H43.6V12H37.6ZM38.1105 10.7009L26.5105 27.9509L31.4895 31.2991L43.0895 14.0491L38.1105 10.7009ZM26 29.625V30H32V29.625H26Z" fill="#C2CCDE" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-1 small_box green rounded">
                            <div class="icon-center">
                                <svg width="40" height="40" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M24 12C19.5817 12 16 15.5817 16 20V52C16 56.4183 19.5817 60 24 60H34L40 68L46 60H56C60.4183 60 64 56.4183 64 52V20C64 15.5817 60.4183 12 56 12H24ZM40 21.5C41.379 21.5 42.4976 22.6166 42.5 23.9957L42.5133 31.6469L49.1385 27.8371L49.1461 27.8328C50.3415 27.1453 51.8679 27.5557 52.5574 28.75C53.2469 29.9443 52.8391 31.4713 51.6461 32.1629L51.6385 32.1672L45.0265 36L51.6385 39.8328L51.6461 39.8371C52.8391 40.5287 53.2469 42.0557 52.5574 43.25C51.8679 44.4443 50.3415 44.8547 49.1461 44.1672L49.1385 44.1629L42.5133 40.3531L42.5 48.0043C42.4976 49.3834 41.379 50.5 40 50.5C38.621 50.5 37.5024 49.3834 37.5 48.0043L37.4867 40.3531L30.8614 44.1629L30.8539 44.1672C29.6585 44.8547 28.1321 44.4443 27.4426 43.25C26.7531 42.0557 27.1609 40.5287 28.3539 39.8371L34.9735 36L28.3539 32.1629C27.1609 31.4713 26.7531 29.9443 27.4426 28.75C28.1321 27.5557 29.6585 27.1453 30.8539 27.8328L30.8614 27.8371L37.4867 31.6469L37.5 23.9957C37.5024 22.6166 38.621 21.5 40 21.5Z" fill="#C2CCDE" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-1 small_box darkblue rounded">
                            <div class="icon-center">
                                <svg width="40" height="40" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 21.3333C20 20.597 20.597 20 21.3333 20H26.6667C27.403 20 28 20.597 28 21.3333V26.6667C28 27.403 27.403 28 26.6667 28H21.3333C20.597 28 20 27.403 20 26.6667V21.3333Z" fill="#C2CCDE" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.5 16C9.5 12.4102 12.4101 9.5 16 9.5H32C35.5898 9.5 38.5 12.4101 38.5 16V32C38.5 35.5898 35.5899 38.5 32 38.5H16C12.4102 38.5 9.5 35.5899 9.5 32V16ZM16 14.5C15.1716 14.5 14.5 15.1716 14.5 16V32C14.5 32.8284 15.1716 33.5 16 33.5H32C32.8284 33.5 33.5 32.8284 33.5 32V16C33.5 15.1716 32.8284 14.5 32 14.5H16Z" fill="#C2CCDE" />
                                    <path d="M51.5859 21.3333C51.5859 20.597 52.1829 20 52.9193 20H58.2526C58.989 20 59.5859 20.597 59.5859 21.3333V26.6667C59.5859 27.403 58.989 28 58.2526 28H52.9193C52.1829 28 51.5859 27.403 51.5859 26.6667V21.3333Z" fill="#C2CCDE" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M41.5 16C41.5 12.4102 44.4101 9.5 48 9.5H64C67.5899 9.5 70.5 12.4101 70.5 16V32C70.5 35.5898 67.5899 38.5 64 38.5H48C44.4101 38.5 41.5 35.5899 41.5 32V16ZM48 14.5C47.1716 14.5 46.5 15.1716 46.5 16V32C46.5 32.8284 47.1716 33.5 48 33.5H64C64.8284 33.5 65.5 32.8284 65.5 32V16C65.5 15.1716 64.8284 14.5 64 14.5H48Z" fill="#C2CCDE" />
                                    <path d="M21.3333 52C20.597 52 20 52.597 20 53.3333V58.6667C20 59.403 20.597 60 21.3333 60H26.6667C27.403 60 28 59.403 28 58.6667V53.3333C28 52.597 27.403 52 26.6667 52H21.3333Z" fill="#C2CCDE" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 41.5C12.4101 41.5 9.5 44.4101 9.5 48V64C9.5 67.5899 12.4102 70.5 16 70.5H32C35.5899 70.5 38.5 67.5899 38.5 64V48C38.5 44.4101 35.5898 41.5 32 41.5H16ZM14.5 48C14.5 47.1716 15.1716 46.5 16 46.5H32C32.8284 46.5 33.5 47.1716 33.5 48V64C33.5 64.8284 32.8284 65.5 32 65.5H16C15.1716 65.5 14.5 64.8284 14.5 64V48Z" fill="#C2CCDE" />
                                    <path d="M59.5 44C59.5 42.6193 58.3807 41.5 57 41.5C55.6193 41.5 54.5 42.6193 54.5 44V48.5H44C42.6193 48.5 41.5 49.6193 41.5 51C41.5 52.3807 42.6193 53.5 44 53.5H54.5V68C54.5 69.3807 55.6193 70.5 57 70.5H68C69.3807 70.5 70.5 69.3807 70.5 68C70.5 66.6193 69.3807 65.5 68 65.5H59.5V44Z" fill="#C2CCDE" />
                                    <path d="M70.5 44C70.5 42.6193 69.3807 41.5 68 41.5C66.6193 41.5 65.5 42.6193 65.5 44V58C65.5 59.3807 66.6193 60.5 68 60.5C69.3807 60.5 70.5 59.3807 70.5 58V44Z" fill="#C2CCDE" />
                                    <path d="M46.5 60C46.5 58.6193 45.3807 57.5 44 57.5C42.6193 57.5 41.5 58.6193 41.5 60V68C41.5 69.3807 42.6193 70.5 44 70.5C45.3807 70.5 46.5 69.3807 46.5 68V60Z" fill="#C2CCDE" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-1 small_box pink rounded">
                            <div class="icon-center">
                                <svg width="40" height="40" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M30 64.1641L50 16.1641" stroke="#C2CCDE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M23 24.1641L5.84084 39.4167C5.39332 39.8144 5.39332 40.5137 5.84083 40.9115L23 56.1641" stroke="#C2CCDE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M57 24.1641L74.1592 39.4167C74.6067 39.8144 74.6067 40.5137 74.1592 40.9115L57 56.1641" stroke="#C2CCDE" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div class="col-1 small_box brown rounded">
                            <div class="icon-center">
                                <svg width="40" height="40" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M49.0242 14.4358C43.3597 12.5214 37.2232 12.5214 31.5588 14.4358L30.5226 14.786C25.2023 16.5841 20.6721 20.1749 17.7068 24.944L17.5034 25.2712C14.4253 30.2217 13.3205 36.1484 14.408 41.8755C15.4616 47.4241 18.4999 52.399 22.955 55.8702L23.72 56.4662C24.5986 57.1508 25.0473 58.2719 24.784 59.3541L24.5935 60.1374C24.3954 60.9518 24.4167 61.8042 24.6553 62.6078C25.2527 64.62 27.102 66 29.201 66H32.791V58C32.791 56.6193 33.9103 55.5 35.291 55.5C36.6717 55.5 37.791 56.6193 37.791 58V66H42.791V58C42.791 56.6193 43.9103 55.5 45.291 55.5C46.6717 55.5 47.791 56.6193 47.791 58V66H51.3893C53.4834 66 55.3284 64.6233 55.9244 62.6158C56.1644 61.8073 56.184 60.9493 55.981 60.1306L55.7953 59.3821C55.5247 58.2907 55.9759 57.1573 56.8629 56.4662L57.628 55.8702C62.083 52.399 65.1213 47.4241 66.1749 41.8755C67.2624 36.1484 66.1576 30.2217 63.0795 25.2712L62.8761 24.944C59.9108 20.1749 55.3806 16.5841 50.0604 14.786L49.0242 14.4358ZM25.8269 33C27.9705 31.7624 30.6115 31.7624 32.7551 33C34.8987 34.2376 36.2192 36.5248 36.2192 39C36.2192 41.4752 34.8987 43.7624 32.7551 45C30.6115 46.2376 27.9705 46.2376 25.8269 45C23.6833 43.7624 22.3628 41.4752 22.3628 39C22.3628 36.5248 23.6833 34.2376 25.8269 33ZM54.7551 33C52.6115 31.7624 49.9705 31.7624 47.8269 33C45.6833 34.2376 44.3628 36.5248 44.3628 39C44.3628 41.4752 45.6833 43.7624 47.8269 45C49.9705 46.2376 52.6115 46.2376 54.7551 45C56.8987 43.7624 58.2192 41.4752 58.2192 39C58.2192 36.5248 56.8987 34.2376 54.7551 33Z" fill="#C2CCDE" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="card bg-body-tertiary border-0 shadow mb-4">
                <a href="https://github.com/Asyraf-wa" class="follow-me" target="_blank">
                    <span class="follow-text">
                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M28.7444 60.1431C28.7444 60.416 28.429 60.6344 28.0315 60.6344C27.579 60.6754 27.2637 60.457 27.2637 60.1431C27.2637 59.8702 27.579 59.6518 27.9766 59.6518C28.3879 59.6109 28.7444 59.8292 28.7444 60.1431ZM24.4806 59.529C24.3847 59.8019 24.6589 60.1158 25.0702 60.1977C25.4266 60.3342 25.8379 60.1977 25.9202 59.9247C26.0024 59.6518 25.7419 59.3379 25.3306 59.2151C24.9742 59.1195 24.5766 59.256 24.4806 59.529ZM30.5403 59.297C30.1427 59.3925 29.8685 59.6518 29.9097 59.9657C29.9508 60.2386 30.3073 60.4161 30.7185 60.3205C31.1161 60.225 31.3903 59.9657 31.3492 59.6927C31.3081 59.4334 30.9379 59.256 30.5403 59.297ZM39.5613 7C20.546 7 6 21.3707 6 40.2997C6 55.4347 15.5694 68.3862 29.2379 72.9444C30.9927 73.2583 31.6097 72.1801 31.6097 71.2931C31.6097 70.4469 31.5685 65.7795 31.5685 62.9135C31.5685 62.9135 21.9718 64.9606 19.9565 58.8466C19.9565 58.8466 18.3935 54.8752 16.1452 53.8516C16.1452 53.8516 13.0056 51.709 16.3645 51.7499C16.3645 51.7499 19.7782 52.0229 21.6565 55.271C24.6589 60.5389 29.6903 59.024 31.6508 58.1233C31.9661 55.9397 32.8573 54.4248 33.8444 53.5241C26.1806 52.678 18.4484 51.5725 18.4484 38.4437C18.4484 34.6906 19.4903 32.8073 21.6839 30.4053C21.3274 29.5183 20.1621 25.8608 22.0403 21.1387C24.9056 20.2517 31.5 24.8235 31.5 24.8235C34.2419 24.0593 37.1895 23.6635 40.1097 23.6635C43.0298 23.6635 45.9774 24.0593 48.7194 24.8235C48.7194 24.8235 55.3137 20.238 58.179 21.1387C60.0573 25.8744 58.8919 29.5183 58.5355 30.4053C60.729 32.8209 62.0726 34.7043 62.0726 38.4437C62.0726 51.6135 53.9976 52.6643 46.3339 53.5241C47.5952 54.6022 48.6645 56.6494 48.6645 59.8565C48.6645 64.4557 48.6234 70.1467 48.6234 71.2658C48.6234 72.1528 49.254 73.231 50.9952 72.9171C64.7048 68.3862 74 55.4347 74 40.2997C74 21.3707 58.5766 7 39.5613 7ZM19.3258 54.07C19.1476 54.2065 19.1887 54.5204 19.4218 54.7797C19.6411 54.998 19.9565 55.0936 20.1347 54.9161C20.3129 54.7797 20.2718 54.4658 20.0387 54.2065C19.8194 53.9881 19.504 53.8926 19.3258 54.07ZM17.8452 52.9646C17.7492 53.142 17.8863 53.3603 18.1605 53.4968C18.3798 53.6333 18.654 53.5923 18.75 53.4013C18.846 53.2239 18.7089 53.0055 18.4347 52.869C18.1605 52.7871 17.9411 52.8281 17.8452 52.9646ZM22.2871 57.823C22.0677 58.0005 22.15 58.4099 22.4653 58.6692C22.7806 58.9831 23.1782 59.024 23.3565 58.8057C23.5347 58.6282 23.4524 58.2188 23.1782 57.9595C22.8766 57.6456 22.4653 57.6047 22.2871 57.823ZM20.7242 55.8169C20.5048 55.9533 20.5048 56.3082 20.7242 56.6221C20.9435 56.936 21.3137 57.0724 21.4919 56.936C21.7113 56.7585 21.7113 56.4037 21.4919 56.0898C21.3 55.7759 20.9435 55.6395 20.7242 55.8169Z" fill="#C2CCDE" />
                        </svg>
                        Follow me on Github
                    </span>
                    <span class="developer">
                        <?php if ($this->Identity->get('avatar') != NULL) {
                            echo $this->Html->image('https://avatars.githubusercontent.com/u/4156856?v=4', ['class' => 'w-px-40 rounded-circle', 'width' => '100px', 'height' => '100px']);
                        } else
                            echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'w-px-40 h-auto rounded-circle', 'width' => '100px', 'height' => '100px']); ?>
                        Asyraf-wa
                    </span>
                </a>
            </div>

        </div>
    </div>
</div>


<script>
    // When the user scrolls the page, execute myFunction 
    window.onscroll = function() {
        myFunction()
    };

    function myFunction() {
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (winScroll / height) * 100;
        document.getElementById("myBar").style.width = scrolled + "%";
    }
</script>