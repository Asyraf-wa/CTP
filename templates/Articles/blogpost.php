<?php
$this->assign('title', $article->title);

use Cake\Routing\Router;

echo $this->Html->css('prism.css');
echo $this->Html->script('prism.js', ['block' => 'scriptBottom']);
echo $this->Html->script('clipboard.min.js');
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
?>

<style>
    .image-container {
        position: relative;
        width: 100%;
        /* Adjust width as needed */
        padding-bottom: 56.25%;
        /* 16:9 aspect ratio (adjust as needed) */
        height: 300px;
        /* Set a fixed height to match the max-height of the image */
        padding-bottom: 0;
        /* Remove padding-bottom as height is now fixed */
    }

    .image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        max-height: 100%;
        /* Set the maximum height to 200 pixels */
        object-fit: cover;
        /* Ensure image fills the container */
    }

    .text-overlay {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: white;
        /* Set background color to white */
        color: black;
        /* Set text color to black */
        padding: 5px 10px;
        margin-bottom: 0px;
        /* Add padding if needed */
        border-radius: 5px;
        /* Add rounded corners */
    }
</style>

<div class="image-container">
    <img class="image" src="your-image.jpg" alt="Image">
    <?php echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'image', 'alt' => $article->title]); ?>
</div>

<div class="container">
    <div class="row mt-5 mb-4">
        <div class="col-md-9 border-end">
            <h1 class="fw-bold"><?php echo $article->title; ?></h1>
            <div class="fw-normal">✍🏼<?= h($article->user->fullname) ?> &nbsp;&nbsp;&nbsp;📅 <?= date('F d, Y', strtotime($article->publish_on)); ?> &nbsp;&nbsp;&nbsp;👁️ <?= h($article->hits) ?> Views</div>
            <hr class="mt-2 mb-4" />
            <div class="justify mb-6">
                <?= $article->body ?>
            </div>
            <hr class="mt-5" />

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


        </div>
        <div class="col-md-3">

            <div class="card bg-body-tertiary border-0 shadow mb-4">
                <div class="card-body text-body-secondary">
                    <div class="card-title mb-0">Most Read Blog</div>
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