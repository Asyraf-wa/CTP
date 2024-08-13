<?php
//$cakeDescription = $system_name;
use Cake\Core\Configure;
use Cake\Routing\Router;

$c_name = $this->request->getParam('controller');
$a_name = $this->request->getParam('action');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->Html->charset() ?>

    <!-- Basic Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO Meta Tags -->
    <?php if ($a_name == 'view') {
        echo $this->Html->meta('title', $article->title) . "\n";
        echo $this->Html->meta('keyword', $article->meta_key) . "\n";
        echo $this->Html->meta('subject', $article->title) . "\n";
        echo $this->Html->meta('copyright', $meta_copyright) . "\n";
        echo $this->Html->meta('description', $article->meta_description) . "\n";
    } else {
        echo $this->Html->meta('title', $meta_title) . "\n";
        echo $this->Html->meta('keyword', $meta_keyword) . "\n";
        echo $this->Html->meta('subject', $meta_subject) . "\n";
        echo $this->Html->meta('copyright', $meta_copyright) . "\n";
        echo $this->Html->meta('description', $meta_desc) . "\n";
    }
    ?>

    <!-- Open Graph Meta Tags for Social Media -->
    <meta property="og:title" content="<?php echo $meta_title; ?>">
    <meta property="og:description" content="<?php echo $meta_desc; ?>">
    <meta property="og:image" content="URL to your image">
    <meta property="og:url" content="https://<?php echo $domain_name; ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $meta_title; ?>">
    <meta name="twitter:description" content="<?php echo $meta_desc; ?>">
    <meta name="twitter:image" content="URL to your image">
    <meta name="twitter:site" content="@yourtwitterhandle">



    <title><?= $system_abbr ?>: <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Monomaniac+One&family=Victor+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/color-modes.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php
    echo $this->Html->css('articleStyle');
    echo $this->Html->script('color-modes.js');
    //echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js');
    //Bottom JS
    echo $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', ['block' => 'scriptBottom']);
    //echo $this->Html->script('custom.js', ['block' => 'scriptBottom']);
    //echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>

<body>
    <div class="container mt-4 mb-4">
        <h1 class="gradient-animate"><b class="logo">&lt;/&gt;</b> Code The Pixel</h1>
    </div>
    <div class="container-fluid sticky-top px-0 bg-body-tertiary">
        <nav class="container navbar navbar-expand-sm sticky-top pt-0 pb-0">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <div id="logoFade" class="logo-fade hide"><b class="gradient-animate-small">&lt;&#47;&gt; CTP</b></div>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <?= $this->Html->link('Home', ['controller' => 'articles', 'action' => '', '_full' => true, 'prefix' => false], ['class' => 'nav-link']); ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Playground</a> <!--buat simple2 project, mcm calculator, etc-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Nerd Stats</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-sm border-0 transparent nav-link" data-bs-toggle="offcanvas" onclick="toggleFull()" role="button">
                                <svg width="25" height="25" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M34 64H24C19.5817 64 16 60.4183 16 56V46" stroke="#C2CCDE" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M46 64H56C60.4183 64 64 60.4183 64 56V46" stroke="#C2CCDE" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M46 16H56C60.4183 16 64 19.5817 64 24V34" stroke="#C2CCDE" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M34 16H24C19.5817 16 16 19.5817 16 24V34" stroke="#C2CCDE" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="darkModeSwitch" checked>
                    </div>
                    <div class="col-2"><input class="form-control border-0 bg-body-tertiary shadow-none" type="text" placeholder="Search..."></div>
                </div>
            </div>
        </nav>
        <div class="progress-container sticky-top">
            <div class="progress-bar" id="myBar"></div>
        </div>
    </div>

    <div class="text-body-secondary">
        <?= $this->fetch('content') ?>
    </div>

    <!-- Footer -->
    <div class="container-fluid bd-footer px-5 bg-body-tertiary">
        <div class="container">
            <footer class="pt-5">
                <div class="row">
                    <div class="col-md-6 mb-3 justify">
                        <h1 class="gradient-animate"><b class="logo">&lt;/&gt;</b> Code The Pixel</h1>
                        CodeThePixel.com (CTP) is a project aimed at assisting aspiring programmers with coding. CTP prioritises delivering highly optimised code or snippets, with a focus on simplicity. The objective is to assist code explorers in developing their understanding of subjects related to web frameworks, encompassing PHP, Java, HTML, CSS, Bootstrap, JavaScript, SQL, and Algorithm.
                        <div class="mt-3">admin@codethepixel.com</div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <style>
                            .box_footer_small {
                                width: 55px;
                                height: 55px;
                                margin-bottom: 8px;
                                margin-right: 8px;
                                position: relative;
                                display: inline-block;
                                text-align: center;
                            }

                            .box_footer_small:hover {
                                background: #000000;
                            }

                            .box_footer_small_text {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 55px;
                            }
                        </style>
                        <div class="row">
                            <div class="col-1 box_footer_small darkblue">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M28.7444 60.1431C28.7444 60.416 28.429 60.6344 28.0315 60.6344C27.579 60.6754 27.2637 60.457 27.2637 60.1431C27.2637 59.8702 27.579 59.6518 27.9766 59.6518C28.3879 59.6109 28.7444 59.8292 28.7444 60.1431ZM24.4806 59.529C24.3847 59.8019 24.6589 60.1158 25.0702 60.1977C25.4266 60.3342 25.8379 60.1977 25.9202 59.9247C26.0024 59.6518 25.7419 59.3379 25.3306 59.2151C24.9742 59.1195 24.5766 59.256 24.4806 59.529ZM30.5403 59.297C30.1427 59.3925 29.8685 59.6518 29.9097 59.9657C29.9508 60.2386 30.3073 60.4161 30.7185 60.3205C31.1161 60.225 31.3903 59.9657 31.3492 59.6927C31.3081 59.4334 30.9379 59.256 30.5403 59.297ZM39.5613 7C20.546 7 6 21.3707 6 40.2997C6 55.4347 15.5694 68.3862 29.2379 72.9444C30.9927 73.2583 31.6097 72.1801 31.6097 71.2931C31.6097 70.4469 31.5685 65.7795 31.5685 62.9135C31.5685 62.9135 21.9718 64.9606 19.9565 58.8466C19.9565 58.8466 18.3935 54.8752 16.1452 53.8516C16.1452 53.8516 13.0056 51.709 16.3645 51.7499C16.3645 51.7499 19.7782 52.0229 21.6565 55.271C24.6589 60.5389 29.6903 59.024 31.6508 58.1233C31.9661 55.9397 32.8573 54.4248 33.8444 53.5241C26.1806 52.678 18.4484 51.5725 18.4484 38.4437C18.4484 34.6906 19.4903 32.8073 21.6839 30.4053C21.3274 29.5183 20.1621 25.8608 22.0403 21.1387C24.9056 20.2517 31.5 24.8235 31.5 24.8235C34.2419 24.0593 37.1895 23.6635 40.1097 23.6635C43.0298 23.6635 45.9774 24.0593 48.7194 24.8235C48.7194 24.8235 55.3137 20.238 58.179 21.1387C60.0573 25.8744 58.8919 29.5183 58.5355 30.4053C60.729 32.8209 62.0726 34.7043 62.0726 38.4437C62.0726 51.6135 53.9976 52.6643 46.3339 53.5241C47.5952 54.6022 48.6645 56.6494 48.6645 59.8565C48.6645 64.4557 48.6234 70.1467 48.6234 71.2658C48.6234 72.1528 49.254 73.231 50.9952 72.9171C64.7048 68.3862 74 55.4347 74 40.2997C74 21.3707 58.5766 7 39.5613 7ZM19.3258 54.07C19.1476 54.2065 19.1887 54.5204 19.4218 54.7797C19.6411 54.998 19.9565 55.0936 20.1347 54.9161C20.3129 54.7797 20.2718 54.4658 20.0387 54.2065C19.8194 53.9881 19.504 53.8926 19.3258 54.07ZM17.8452 52.9646C17.7492 53.142 17.8863 53.3603 18.1605 53.4968C18.3798 53.6333 18.654 53.5923 18.75 53.4013C18.846 53.2239 18.7089 53.0055 18.4347 52.869C18.1605 52.7871 17.9411 52.8281 17.8452 52.9646ZM22.2871 57.823C22.0677 58.0005 22.15 58.4099 22.4653 58.6692C22.7806 58.9831 23.1782 59.024 23.3565 58.8057C23.5347 58.6282 23.4524 58.2188 23.1782 57.9595C22.8766 57.6456 22.4653 57.6047 22.2871 57.823ZM20.7242 55.8169C20.5048 55.9533 20.5048 56.3082 20.7242 56.6221C20.9435 56.936 21.3137 57.0724 21.4919 56.936C21.7113 56.7585 21.7113 56.4037 21.4919 56.0898C21.3 55.7759 20.9435 55.6395 20.7242 55.8169Z" fill="#C2CCDE" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-1 box_footer_small emerald">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.5871 44.989L20.4072 35.1102H21.022C21.2454 35.1102 21.4785 35.099 21.722 35.0772C23.3454 35.0554 24.6944 35.2205 25.7699 35.5728C26.8656 35.925 27.2308 37.2578 26.8656 39.5705C26.4194 42.324 25.5465 43.9318 24.2482 44.3943C22.9498 44.835 21.3263 45.0439 19.3785 45.0221H18.9524C18.8306 45.0221 18.7089 45.0108 18.5871 44.989Z" fill="#C2CCDE" />
                                        <path d="M54.6694 44.989L56.4895 35.1102H57.1043C57.3277 35.1102 57.5608 35.099 57.8043 35.0772C59.4277 35.0554 60.7767 35.2205 61.8522 35.5728C62.9479 35.925 63.3131 37.2578 62.9479 39.5705C62.5017 42.324 61.6289 43.9318 60.3305 44.3943C59.0321 44.835 57.4086 45.0439 55.4608 45.0221H55.0347C54.9129 45.0221 54.7912 45.0108 54.6694 44.989Z" fill="#C2CCDE" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M40 75C59.33 75 75 59.33 75 40C75 20.67 59.33 5 40 5C20.67 5 5 20.67 5 40C5 59.33 20.67 75 40 75ZM36.0979 25H40.2981L39.1111 31.3105H42.8851C44.9547 31.3548 46.4966 31.8174 47.5113 32.6982C48.5461 33.5791 48.8505 35.2535 48.4244 37.7202L46.3852 48.7224H42.1242L44.0721 38.2158C44.2748 37.1143 44.2139 36.3326 43.8895 35.87C43.565 35.4074 42.865 35.1762 41.7894 35.1762L38.4111 35.1431L35.9153 48.7224H31.7152L36.0979 25ZM16.8523 31.3107H25.009C27.4031 31.3325 29.138 32.0818 30.2135 33.5574C31.2891 35.0329 31.644 37.0483 31.2788 39.6036C31.1369 40.7712 30.8223 41.9164 30.3353 43.0397C29.8684 44.163 29.2195 45.176 28.3874 46.0793C27.3727 47.2245 26.2873 47.9514 25.1308 48.2599C23.9742 48.5685 22.7769 48.7225 21.5394 48.7225H17.8871L16.7306 55H12.5L16.8523 31.3107ZM52.9346 31.3107H61.0913C63.4854 31.3325 65.2203 32.0818 66.2958 33.5574C67.3714 35.0329 67.7263 37.0483 67.3611 39.6036C67.2192 40.7712 66.9045 41.9164 66.4176 43.0397C65.9507 44.163 65.3018 45.176 64.4697 46.0793C63.455 47.2245 62.3696 47.9514 61.2131 48.2599C60.0565 48.5685 58.8592 48.7225 57.6217 48.7225H53.9694L52.8129 55H48.5823L52.9346 31.3107Z" fill="#C2CCDE" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-1 box_footer_small purple">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M57.5045 7.79198C57.5045 5.59458 55.0442 5.59455 53.9507 5.86923C55.4815 4.66065 57.2767 4.95367 57.9145 5.3199L72.6979 12.5687C74.1065 13.2594 75.0001 14.6965 75.0001 16.2714V63.9578C75.0001 65.5538 74.0827 67.0062 72.6455 67.6858L58.7346 74.2634C57.7778 74.6754 55.7002 75.6917 53.9507 74.2634C56.1376 74.6754 57.3222 73.1189 57.5045 72.066V7.79198Z" fill="#C2CCDE" />
                                        <path d="M54.128 5.82976C55.2886 5.60042 57.5045 5.70662 57.5045 7.79198L57.5044 24.2063L12.684 58.1133C11.9005 58.7059 10.798 58.6076 10.1307 57.8856L5.51133 52.8871C4.78766 52.104 4.83829 50.8783 5.62406 50.1582L53.9507 5.86923L54.128 5.82976Z" fill="#C2CCDE" />
                                        <path d="M57.5044 55.927L12.684 22.02C11.9005 21.4274 10.798 21.5257 10.1307 22.2477L5.51133 27.2463C4.78766 28.0293 4.83829 29.255 5.62406 29.9752L53.9507 74.2634C56.1376 74.6754 57.3222 73.1189 57.5045 72.066L57.5044 55.927Z" fill="#C2CCDE" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-1 box_footer_small red">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M40 75C59.33 75 75 59.33 75 40C75 20.67 59.33 5 40 5C20.67 5 5 20.67 5 40C5 59.33 20.67 75 40 75ZM40 17.5H45V22.5H40V17.5ZM30 25H25V30H30V25ZM15.0039 42.3535C15.4311 49.6068 19.7507 60.0001 35 60.0001C52 60.0001 59.5833 47.5001 61.25 41.2501C63.3333 41.2501 68 40.0001 70 35.0001C68.75 33.75 63.75 33.75 61.25 35.0001C61.25 33.0001 60 28.75 57.5 27.5C55.8333 29.1667 53.25 33.5 56.25 37.5C55 39.9999 51.6668 40 50.0001 40H17.3572C16.0336 40 14.926 41.0321 15.0039 42.3535ZM17.5 32.5H22.5V37.5H17.5V32.5ZM25 32.5H30V37.5H25V32.5ZM32.5 32.5H37.5V37.5H32.5V32.5ZM40 32.5H45V37.5H40V32.5ZM47.5 32.5H52.5V37.5H47.5V32.5ZM37.5 25H32.5V30H37.5V25ZM45 25H40V30H45V25Z" fill="#C2CCDE" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-1 box_footer_small orange">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M66.6932 57.5111C68.5552 51.6257 67.0891 45.4952 63.2685 41.5598C58.7453 36.9006 49.549 27.5 49.549 27.5L42.5 34.7609C42.5 34.7609 52.3103 44.6406 56.294 48.744C58.1672 50.6735 58.1672 53.802 56.294 55.7315C54.4454 57.6357 51.4633 57.6607 49.5849 55.8067L42.6098 62.9914C46.6562 67.1018 52.4456 68.2973 57.506 66.5782C57.6787 71.2586 61.5274 75 66.25 75C71.0825 75 75 71.0825 75 66.25C75 61.5662 71.3197 57.7419 66.6932 57.5111Z" fill="#C2CCDE" />
                                        <path d="M57.5111 13.3068C51.6257 11.4448 45.4952 12.9109 41.5598 16.7315C36.9006 21.2547 27.5 30.451 27.5 30.451L34.7609 37.5C34.7609 37.5 44.6406 27.6897 48.744 23.706C50.6735 21.8327 53.802 21.8327 55.7315 23.706C57.6357 25.5546 57.6608 28.5367 55.8067 30.4151L62.9914 37.3902C67.1018 33.3438 68.2973 27.5544 66.5782 22.4939C71.2586 22.3213 75 18.4726 75 13.75C75 8.91752 71.0825 5.00002 66.25 5.00002C61.5662 5.00002 57.7419 8.68024 57.5111 13.3068Z" fill="#C2CCDE" />
                                        <path d="M13.3068 22.4889C11.4448 28.3743 12.9109 34.5048 16.7315 38.4402C21.2547 43.0994 30.451 52.5 30.451 52.5L37.5 45.2391C37.5 45.2391 27.6897 35.3594 23.706 31.256C21.8328 29.3265 21.8328 26.198 23.706 24.2685C25.5546 22.3643 28.5367 22.3392 30.4151 24.1933L37.3902 17.0086C33.3438 12.8982 27.5544 11.7027 22.494 13.4218C22.3213 8.74138 18.4726 5 13.75 5C8.91752 5 5.00002 8.91754 5.00002 13.75C5.00002 18.4338 8.68025 22.2581 13.3068 22.4889Z" fill="#C2CCDE" />
                                        <path d="M22.4889 66.6932C28.3743 68.5552 34.5048 67.0891 38.4402 63.2685C43.0994 58.7453 52.5 49.549 52.5 49.549L45.2391 42.5C45.2391 42.5 35.3594 52.3103 31.256 56.294C29.3265 58.1672 26.198 58.1672 24.2685 56.294C22.3643 54.4454 22.3392 51.4633 24.1933 49.5849L17.0086 42.6098C12.8982 46.6562 11.7027 52.4456 13.4218 57.506C8.74138 57.6787 5 61.5274 5 66.25C5 71.0825 8.91754 75 13.75 75C18.4338 75 22.2581 71.3197 22.4889 66.6932Z" fill="#C2CCDE" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-1 box_footer_small blue">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 7.5L15 70L40 77.5L65 70L70 7.5H10ZM21.25 20L23.75 43.75H48.75L47.5 53.75L40 56.25L32.5 53.75L31.25 47.5H23.75L25 60L40 65L55 60L57.5 36.25H30L28.75 27.5H58.75L60 20H21.25Z" fill="#C2CCDE" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-1 box_footer_small yellow">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 7.5L15 70L40 77.5L65 70L70 7.5H10ZM23.75 43.75H48.75L47.5 53.75L40 56.25L32.5 53.75L31.25 47.5H23.75L25 60L40 65L55 60L57.5 36.25H42.5L58.75 30L60 21.25H21.25L22.5 28.75H42.5L22.5 35L23.75 43.75Z" fill="#C2CCDE" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-1 box_footer_small green">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M40 8C22.3269 8 8 22.3269 8 40C8 57.6731 22.3269 72 40 72C57.6731 72 72 57.6731 72 40C72 22.3269 57.6731 8 40 8ZM54.1541 42.9864L52.6681 46.7441H59.6234L60.8699 50.2128H66.2489L58.9549 30.8462L56.408 37.286L58.4447 42.9864H54.1541ZM48.0763 49.1538L55.8845 29.7872L50.708 29.7876L45.3666 42.3028L41.568 29.7876H37.5891L33.5109 42.3028L30.6346 36.5996L28.0317 44.6186L30.6747 49.1538H35.7691L39.4546 37.9305L42.9682 49.1538H48.0763ZM22.9109 42.5053H19.7223V49.1538H14.8085V29.7872H22.8251C25.1042 29.7872 26.8356 30.4418 28.0189 31.7516C28.2446 31.9996 28.445 32.2631 28.6203 32.5411L25.4911 42.1819C24.7368 42.3976 23.8768 42.5053 22.9109 42.5053ZM24.6362 36.1099C24.6362 35.3305 24.4051 34.7076 23.9428 34.2425C23.4809 33.7772 22.6928 33.545 21.5787 33.545H19.7223V38.7479H21.5651C22.7603 38.7479 23.5807 38.4918 24.0266 37.9799C24.4328 37.5193 24.6362 36.896 24.6362 36.1099Z" fill="#C2CCDE" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-1 box_footer_small pink">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 16.2559C13.7909 16.2559 12 18.0467 12 20.2559V52.2559H32.126C33.9496 52.2559 35.5421 53.4892 35.9986 55.2543L36 55.2559H44L44.0014 55.2543C44.4579 53.4892 46.0504 52.2559 47.874 52.2559H68V20.2559C68 18.0467 66.2091 16.2559 64 16.2559L16 16.2559ZM46.711 25.0883C47.1255 24.0644 46.6314 22.8984 45.6075 22.484C44.5837 22.0696 43.4177 22.5636 43.0033 23.5875L33.289 47.5875C32.8745 48.6114 33.3686 49.7774 34.3925 50.1918C35.4163 50.6062 36.5823 50.1122 36.9967 49.0883L46.711 25.0883ZM33.2184 26.9878C33.964 27.8027 33.9079 29.0677 33.093 29.8134L25.9627 36.3379L33.093 42.8624C33.9079 43.608 33.964 44.8731 33.2184 45.688C32.4727 46.5029 31.2076 46.5591 30.3927 45.8134L22.4561 38.5512C21.1564 37.3619 21.1564 35.3139 22.4561 34.1246L30.3927 26.8624C31.2076 26.1167 32.4727 26.1729 33.2184 26.9878ZM46.907 29.8134C46.0921 29.0677 46.036 27.8027 46.7816 26.9878C47.5273 26.1729 48.7924 26.1167 49.6073 26.8624L57.5439 34.1246C58.8436 35.3139 58.8436 37.3619 57.5439 38.5512L49.6073 45.8134C48.7924 46.5591 47.5273 46.5029 46.7816 45.688C46.036 44.8731 46.0921 43.608 46.907 42.8624L54.0373 36.3379L46.907 29.8134Z" fill="#C2CCDE" />
                                        <path d="M32.126 56.2559H4.15215C4.06812 56.2559 4 56.324 4 56.408C4 60.7423 7.51361 64.2559 11.8479 64.2559H68.1521C72.4864 64.2559 76 60.7423 76 56.408C76 56.324 75.9319 56.2559 75.8479 56.2559H47.874C47.4299 57.9811 45.8638 59.2559 44 59.2559H36C34.1362 59.2559 32.5701 57.9811 32.126 56.2559Z" fill="#C2CCDE" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-1 box_footer_small brown">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18 26L25.2727 26L26.7273 26L34 26" stroke="#C2CCDE" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M45.9141 26L53.1868 26L54.6413 26L61.9141 26" stroke="#C2CCDE" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M53.9141 18L53.9141 25.2727L53.9141 26.7273L53.9141 34" stroke="#C2CCDE" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M20.343 48.384L25.4856 53.5266L26.5141 54.5551L31.6567 59.6977" stroke="#C2CCDE" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M31.657 48.384L26.5144 53.5266L25.4859 54.5551L20.3433 59.6977" stroke="#C2CCDE" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M45.8914 56.9092L53.1641 56.9092L54.6186 56.9092L61.8914 56.9092" stroke="#C2CCDE" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M45.8914 51.0908L53.1641 51.0908L54.6186 51.0908L61.8914 51.0908" stroke="#C2CCDE" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Project</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Playground</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Blog</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Nerd Stats</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 mb-3">
                        <form>
                            <h5>Subscribe to our newsletter</h5>
                            <p>Monthly digest of what's new and exciting from us.</p>
                            <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                                <label for="newsletter1" class="visually-hidden">Email address</label>
                                <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                                <button class="btn btn-primary" type="button">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex flex-column flex-sm-row justify-content-between pt-4  border-top">
                    <p>© <?php echo date('Y'); ?> <?php echo $system_name; ?>. <i class="fa-solid fa-code"></i> with ❤️ by
                        <a href="https://codethepixel.com" target="_blank" class="footer-link fw-bolder">Code The Pixel</a>
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <!-- / Footer -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<script>
    // full screen toggle
    function toggleFull() {
        if ((document.fullScreenElement && document.fullScreenElement !== null) ||
            (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
        }
    }
    // end full screen toggle
</script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const htmlElement = document.documentElement;
        const switchElement = document.getElementById('darkModeSwitch');

        // Set the default theme to dark if no setting is found in local storage
        const currentTheme = localStorage.getItem('bsTheme') || 'dark';
        htmlElement.setAttribute('data-bs-theme', currentTheme);
        switchElement.checked = currentTheme === 'dark';

        switchElement.addEventListener('change', function() {
            if (this.checked) {
                htmlElement.setAttribute('data-bs-theme', 'dark');
                localStorage.setItem('bsTheme', 'dark');
            } else {
                htmlElement.setAttribute('data-bs-theme', 'light');
                localStorage.setItem('bsTheme', 'light');
            }
        });
    });
</script>

<script>
    const gridButton = document.getElementById('gridButton');
    const listButton = document.getElementById('listButton');
    const gridDiv = document.querySelector('.grid');
    const listDiv = document.querySelector('.list');

    gridButton.addEventListener('click', () => {
        gridDiv.style.display = 'flex';
        listDiv.style.display = 'none';
    });

    listButton.addEventListener('click', () => {
        gridDiv.style.display = 'none';
        listDiv.style.display = 'block';
    });
</script>

<script>
    logoFade = document.getElementById("logoFade");

    var myScrollFunc = function() {
        var y = window.scrollY;
        if (y >= 60) {
            logoFade.className = "logo-fade show"
        } else {
            logoFade.className = "logo-fade hide"
        }
    };

    window.addEventListener("scroll", myScrollFunc);
</script>

</html>