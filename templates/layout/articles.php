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
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Code The Pixel" />
    <link rel="manifest" href="/site.webmanifest" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Monomaniac+One&family=Victor+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet" media="print" onload="this.onload=null;this.removeAttribute('media');" fetchpriority="high">
    <!-- Core CSS -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <script src="js/color-modes.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous" defer></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <?php
    echo $this->Html->css('articleStyle.min');
    echo $this->Html->script('color-modes.js');
    //Bottom JS
    echo $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', ['block' => 'scriptBottom']);
    //echo $this->Html->script('custom.js', ['block' => 'scriptBottom']);
    //echo $this->fetch('meta');
    //echo $this->fetch('css');
    //echo $this->fetch('script');
    ?>
</head>

<body>
    <div class="container mt-4 mb-4">
        <h1 class="gradient-animate"><b class="logo">&lt;/&gt;</b> Code The Pixel</h1>
    </div>
    <!-- Menu -->
    <div class="container-fluid sticky-top px-0 bg-body-tertiary">
        <?php echo $this->element('article_menu'); ?>
        <div class="progress-container sticky-top">
            <div class="progress-bar" id="myBar"></div>
        </div>
    </div>
    <!-- Content -->
    <div class="text-body-secondary">
        <?= $this->fetch('content') ?>
    </div>
    <!-- Footer -->
    <?php echo $this->element('article_footer'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<!-- full screen toggle -->
<script>
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
</script>
<!-- Dark Mode -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const htmlElement = document.documentElement;
        const dropdownButton = document.getElementById('dropdownMenuButton');
        const dropdownItems = document.querySelectorAll('.dropdown-item');

        // Set the default theme to dark if no setting is found in local storage
        const currentTheme = localStorage.getItem('bsTheme') || 'dark';
        htmlElement.setAttribute('data-bs-theme', currentTheme);
        dropdownButton.textContent = currentTheme === 'dark' ? 'Mode' : 'Mode';

        dropdownItems.forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();
                const selectedTheme = this.getAttribute('data-theme');
                htmlElement.setAttribute('data-bs-theme', selectedTheme);
                localStorage.setItem('bsTheme', selectedTheme);
                dropdownButton.textContent = selectedTheme === 'dark' ? 'Mode' : 'Mode';
            });
        });
    });
</script>
<!-- Grid/List switch -->
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
<!-- Logo Fade -->
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