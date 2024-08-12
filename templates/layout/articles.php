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
                        <h5>Section</h5>
                        <style>
                            .box_footer_small {
                                width: 40px;
                                height: 40px;
                                margin-bottom: 8px;
                                margin-right: 8px;
                                position: relative;
                                float: left;
                                display: inline-block;
                                text-align: center;
                            }

                            .box_footer_small_text {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                height: 40px;
                            }
                        </style>
                        <div class="row">
                            <div class="col-1 box_footer_small emerald">
                                <div class="box_footer_small_text">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M28.7444 60.1431C28.7444 60.416 28.429 60.6344 28.0315 60.6344C27.579 60.6754 27.2637 60.457 27.2637 60.1431C27.2637 59.8702 27.579 59.6518 27.9766 59.6518C28.3879 59.6109 28.7444 59.8292 28.7444 60.1431ZM24.4806 59.529C24.3847 59.8019 24.6589 60.1158 25.0702 60.1977C25.4266 60.3342 25.8379 60.1977 25.9202 59.9247C26.0024 59.6518 25.7419 59.3379 25.3306 59.2151C24.9742 59.1195 24.5766 59.256 24.4806 59.529ZM30.5403 59.297C30.1427 59.3925 29.8685 59.6518 29.9097 59.9657C29.9508 60.2386 30.3073 60.4161 30.7185 60.3205C31.1161 60.225 31.3903 59.9657 31.3492 59.6927C31.3081 59.4334 30.9379 59.256 30.5403 59.297ZM39.5613 7C20.546 7 6 21.3707 6 40.2997C6 55.4347 15.5694 68.3862 29.2379 72.9444C30.9927 73.2583 31.6097 72.1801 31.6097 71.2931C31.6097 70.4469 31.5685 65.7795 31.5685 62.9135C31.5685 62.9135 21.9718 64.9606 19.9565 58.8466C19.9565 58.8466 18.3935 54.8752 16.1452 53.8516C16.1452 53.8516 13.0056 51.709 16.3645 51.7499C16.3645 51.7499 19.7782 52.0229 21.6565 55.271C24.6589 60.5389 29.6903 59.024 31.6508 58.1233C31.9661 55.9397 32.8573 54.4248 33.8444 53.5241C26.1806 52.678 18.4484 51.5725 18.4484 38.4437C18.4484 34.6906 19.4903 32.8073 21.6839 30.4053C21.3274 29.5183 20.1621 25.8608 22.0403 21.1387C24.9056 20.2517 31.5 24.8235 31.5 24.8235C34.2419 24.0593 37.1895 23.6635 40.1097 23.6635C43.0298 23.6635 45.9774 24.0593 48.7194 24.8235C48.7194 24.8235 55.3137 20.238 58.179 21.1387C60.0573 25.8744 58.8919 29.5183 58.5355 30.4053C60.729 32.8209 62.0726 34.7043 62.0726 38.4437C62.0726 51.6135 53.9976 52.6643 46.3339 53.5241C47.5952 54.6022 48.6645 56.6494 48.6645 59.8565C48.6645 64.4557 48.6234 70.1467 48.6234 71.2658C48.6234 72.1528 49.254 73.231 50.9952 72.9171C64.7048 68.3862 74 55.4347 74 40.2997C74 21.3707 58.5766 7 39.5613 7ZM19.3258 54.07C19.1476 54.2065 19.1887 54.5204 19.4218 54.7797C19.6411 54.998 19.9565 55.0936 20.1347 54.9161C20.3129 54.7797 20.2718 54.4658 20.0387 54.2065C19.8194 53.9881 19.504 53.8926 19.3258 54.07ZM17.8452 52.9646C17.7492 53.142 17.8863 53.3603 18.1605 53.4968C18.3798 53.6333 18.654 53.5923 18.75 53.4013C18.846 53.2239 18.7089 53.0055 18.4347 52.869C18.1605 52.7871 17.9411 52.8281 17.8452 52.9646ZM22.2871 57.823C22.0677 58.0005 22.15 58.4099 22.4653 58.6692C22.7806 58.9831 23.1782 59.024 23.3565 58.8057C23.5347 58.6282 23.4524 58.2188 23.1782 57.9595C22.8766 57.6456 22.4653 57.6047 22.2871 57.823ZM20.7242 55.8169C20.5048 55.9533 20.5048 56.3082 20.7242 56.6221C20.9435 56.936 21.3137 57.0724 21.4919 56.936C21.7113 56.7585 21.7113 56.4037 21.4919 56.0898C21.3 55.7759 20.9435 55.6395 20.7242 55.8169Z" fill="#C2CCDE" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-1 box_footer_small pink">
                                <div class="box_footer_small_text">2</div>
                            </div>
                            <div class="col-1 box_footer_small blue">
                                <div class="box_footer_small_text">3</div>
                            </div>
                            <div class="col-1 box_footer_small orange">
                                <div class="box_footer_small_text">4</div>
                            </div>
                            <div class="col-1 box_footer_small red">
                                <div class="box_footer_small_text">5</div>
                            </div>
                            <div class="col-1 box_footer_small yellow">
                                <div class="box_footer_small_text">6</div>
                            </div>
                            <div class="col-1 box_footer_small yellow">
                                <div class="box_footer_small_text">7</div>
                            </div>
                            <div class="col-1 box_footer_small yellow">
                                <div class="box_footer_small_text">8</div>
                            </div>
                            <div class="col-1 box_footer_small yellow">
                                <div class="box_footer_small_text">9</div>
                            </div>
                            <div class="col-1 box_footer_small yellow">
                                <div class="box_footer_small_text">10</div>
                            </div>
                            <div class="col-1 box_footer_small yellow">
                                <div class="box_footer_small_text">11</div>
                            </div>
                            <div class="col-1 box_footer_small yellow">
                                <div class="box_footer_small_text">12</div>
                            </div>
                            <div class="col-1 box_footer_small yellow">
                                <div class="box_footer_small_text">13</div>
                            </div>
                            <div class="col-1 box_footer_small yellow">
                                <div class="box_footer_small_text">14</div>
                            </div>
                            <div class="col-1 box_footer_small purple">
                                <div class="box_footer_small_text">15</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <h5>Section</h5>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
                            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
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