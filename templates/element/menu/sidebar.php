<?php
$c_name = $this->request->getParam('controller');
$a_name = $this->request->getParam('action');
?>
<!-- Menu -->
<nav id="sidebar" class="bg-body-tertiary shadow">
    <div class="sidebar-header pt-2 ps-3">
        <b class="gradient-animate-small"><b class="logo-small">&lt;&#47;&gt;</b> Re-CRUD</b>
    </div>
    <div class="px-0">
        <ul class="list-unstyled components">
            <?php if ($this->Identity->isLoggedIn() == NULL) {
            ?>
                <li class="menu-item">
                    <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-code"></i> Sign-in'), ['controller' => 'Users', 'action' => 'login', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                </li>
            <?php } ?>
            <?php if ($this->Identity->isLoggedIn()) {
            ?>
                <li class="menu-item">
                    <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-code"></i> Dashboard'), ['controller' => 'Dashboards', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
                </li>
            <?php }
            ?>
            <li class="menu-item">
                <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-circle-question"></i> FAQ'), ['controller' => 'Faqs', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
            <li class="menu-item">
                <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-message"></i> Contact Us'), ['controller' => 'Contact', 'action' => 'index', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
            <li class="menu-item">
                <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-circle-info"></i> Documents'), ['controller' => 'Pages', 'action' => 'manual', 'prefix' => false], ['class' => 'menu-link', 'escape' => false]) ?>
            </li>
            <?php if ($this->Identity->isLoggedIn()) { ?>
                <li class="menu-item <?= $c_name == 'Users' && $a_name == 'profile' ? 'active' : '' ?>">
                    <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-user-tie"></i> Profile'), ['controller' => 'Users', 'action' => 'profile', 'prefix' => false, $this->Identity->get('slug')], ['class' => 'menu-link', 'escape' => false]) ?>
                </li>
                <?php if ($this->Identity->isLoggedIn() && $this->Identity->get('user_group_id') == '1') { ?>
                    <!-- Administrator -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Administrator</span>
                    </li>
                    <li class="menu-item <?= $c_name == 'Settings' && $a_name == 'update' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-gear"></i> Site Configuration'), ['prefix' => 'Admin', 'controller' => 'Settings', 'action' => 'update', 'recrud'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Articles' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-folder"></i> Article'), ['prefix' => 'Admin', 'controller' => 'Articles', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Categories' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-layer-group"></i> Categories'), ['prefix' => 'Admin', 'controller' => 'Categories', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Projects' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-laptop-code"></i> Projects'), ['prefix' => 'Admin', 'controller' => 'Projects', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Users' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-users-viewfinder"></i> User Management'), ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Todos' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-list-check"></i> Todo'), ['prefix' => 'Admin', 'controller' => 'Todos', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Contacts' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-message"></i> Contacts'), ['prefix' => 'Admin', 'controller' => 'Contacts', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'AuditLogs' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-solid fa-timeline"></i> Audit Trail'), [
                            'prefix' => 'Admin',
                            'controller' => 'auditLogs',
                            'action' => 'index',
                            //'?' => ['limit' => '25', 'status' => '1']
                        ], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                    <li class="menu-item <?= $c_name == 'Faqs' && $a_name == 'index' ? 'active' : '' ?>">
                        <?= $this->Html->link(__('<i class="menu-icon fa-regular fa-circle-question"></i> FAQ'), ['prefix' => 'Admin', 'controller' => 'Faqs', 'action' => 'index'], ['class' => 'menu-link', 'escape' => false]) ?>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</nav>
<!-- / Menu -->