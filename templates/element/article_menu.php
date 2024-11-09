<?php
//$cakeDescription = $system_name;
use Cake\Core\Configure;
use Cake\Routing\Router;

$c_name = $this->request->getParam('controller');
$a_name = $this->request->getParam('action');
?>
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
                <li class="nav-item <?= ($c_name == 'Articles' && $a_name == 'index') ? 'menu-active-style' : '' ?>"><?= $this->Html->link('Home', ['controller' => 'articles', 'action' => 'index', '_full' => true, 'prefix' => false], ['class' => 'nav-link']); ?> </li>

                <li class="nav-item <?= $c_name == 'Projects' ? 'menu-active-style' : '' ?>"><?= $this->Html->link('Projects', ['controller' => 'Projects', 'action' => '', '_full' => true, 'prefix' => false], ['class' => 'nav-link']); ?> </li>

                <li class="nav-item <?= ($c_name == 'Articles' && $a_name == 'blog') ? 'menu-active-style' : '' ?>"><?= $this->Html->link('Blogs', ['controller' => 'Articles', 'action' => 'blog', '_full' => true, 'prefix' => false], ['class' => 'nav-link']); ?> </li>

                <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Playground</a> buat simple2 project, mcm calculator, etc
                        </li> -->
                <li class="nav-item <?= $c_name == 'about' ? 'menu-active-style' : '' ?>"><?= $this->Html->link('About Me', ['controller' => 'about', 'action' => '', '_full' => true, 'prefix' => false], ['class' => 'nav-link']); ?> </li>


                <li class="nav-item">
                    <?= $this->Html->link('Nerd Stats', ['controller' => 'articles', 'action' => 'stats', '_full' => true, 'prefix' => false], ['class' => 'nav-link']); ?>
                </li>
                <style>
                    .vl {
                        width: 3px;
                        height: 100%;
                        background: linear-gradient(to bottom, #fcb150 33.33%, #11a8ab 33.33%, #11a8ab 66.66%, #e64c65 66.66%);
                    }
                </style>
                <li class="nav-item">
                    <div class="vl mx-3"></div>
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


            <div class="dropdown">
                <button class="btn border-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Mode
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#" data-theme="dark">Dark Mode</a></li>
                    <li><a class="dropdown-item" href="#" data-theme="light">Light Mode</a></li>
                </ul>
            </div>



            <div class="col-2">
                <?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'articles', 'action' => 'index']]); ?>
                <input type="text" name="search" class="form-control border-0 bg-body-tertiary shadow-none" placeholder="Search..." id="search" aria-label="Search...">
                <?= $this->Form->end() ?>
            </div>

        </div>
    </div>
</nav>