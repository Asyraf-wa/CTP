<?php
use Cake\Core\Configure;
use Cake\Routing\Router;
$cakeDescription = $system_abbr;
$c_name = $this->request->getParam('controller');
$a_name = $this->request->getParam('action');
?>
<!--Navigation-->
<div class="container-fluid sticky-top navbar-light bg-light shadow px-0">
<nav class="container navbar navbar-expand-sm sticky-top navbar-light pt-0 pb-0">
<div class="container">
	<a class="navbar-brand" href="#">
<div id="logoFade" class="logo-fade hide"><b class="gradient-animate-small">&lt;&#47;&gt; CTP</b></div>	
	</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="main_nav">
		<ul class="navbar-nav ms-auto">
			<li class="nav-item <?= $c_name == 'Articles'?'menu-active-style rounded':'' ?>"><?= $this->Html->link('Home',['controller' => 'articles', 'action' => '', '_full' => true, 'prefix' => false],['class' => 'nav-link']); ?> </li>
			<li class="nav-item <?= $c_name == 'Blogs'?'menu-active-style rounded':'' ?>"><?= $this->Html->link('Blog',['controller' => 'blogs', 'action' => 'index', '_full' => true, 'prefix' => false],['class' => 'nav-link']); ?> </li>
			<li class="nav-item <?= $c_name == 'Projects'?'menu-active-style rounded':'' ?>"><?= $this->Html->link('Project',['controller' => 'projects', 'action' => 'index', '_full' => true, 'prefix' => false],['class' => 'nav-link']); ?> </li>
			<li class="nav-item <?= $c_name == 'Contacts'?'menu-active-style rounded':'' ?>"><?= $this->Html->link('Contact',['controller' => 'contact', '_full' => true, 'prefix' => false],['class' => 'nav-link']); ?> </li>
<?php
if ($this->Identity->isLoggedIn()) { ?>
<!--Mega menu-->
<li class="nav-item dropdown has-megamenu">
				<!--<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Mega menu  </a>-->
	<a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="fas fa-cog fa-spin text-warning"></i></a>
				
				<div class="dropdown-menu megamenu" role="menu">
					<div class="container">
<?php
	$domain = Router::url("/", true);
	$prefix = 'admin/';
?>
<!--Outer wrap Start-->
<div class="row text-secondary">
	<div class="col-md-3 col-sm-6 col-xs-12 border-end">
	
	<div class="text-center">
<?php echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'), ['alt' => 'Profile Picture', 'class' => 'rounded-circle shadow my-2', 'width' => '100px', 'height' => '100px']); ?>
	<div class="fs-6 fw-bold"><?php echo $this->Identity->get('fullname'); ?></div>
	<div class="text-muted text-small"><?php echo $this->Identity->get('email'); ?></div>
	<div class="text-muted text-small"><?= date('d M Y h:s a', strtotime($this->Identity->get('last_login'))); ?></div>
	
	</div>
<hr>

<div class="row">
	<div class="col text-center pe-1">
		<a href="<?= $domain . $prefix; ?>users/profile/<?php echo $this->Identity->get('slug'); ?>" class="kosong">
			<div class="card my-1 px-1 py-1">
				<div><i class="far fa-user fs-4"></i></div>
					<div class="fw-bold">My Profile</div>
					<p class="text-muted text-small mb-0">View Profile</p>
			</div>
		</a>
	</div>
	<div class="col text-center ps-1">
		<a href="<?= $domain . $prefix; ?>users/update_profile/<?php echo $this->Identity->get('slug'); ?>" class="kosong">
			<div class="card my-1 px-1 py-1">
				<div><i class="far fa-edit fs-4"></i></div>
					<div class="fw-bold">Update</div>
					<p class="text-muted text-small mb-0">Update Profile</p>
			</div>
		</a>
	</div>
</div>

<div class="row">
	<div class="col text-center pe-1">
		<a href="<?= $domain . $prefix; ?>users/remove_avatar/<?php echo $this->Identity->get('slug'); ?>" class="kosong">
			<div class="card my-1 px-1 py-1">
				<div><i class="far fa-address-card fs-4"></i></div>
					<div class="fw-bold">Avatar</div>
					<p class="text-muted text-small mb-0">Update Avatar</p>
			</div>
		</a>
	</div>
	<div class="col text-center ps-1">
		<a href="<?= $domain . $prefix; ?>users/password/<?php echo $this->Identity->get('slug'); ?>" class="kosong">
			<div class="card my-1 px-1 py-1">
				<div><i class="fas fa-unlock-alt fs-4"></i></div>
					<div class="fw-bold">Password</div>
					<p class="text-muted text-small mb-0">Update Password</p>
			</div>
		</a>
	</div>
</div>
	  
	</div>
	<div class="col-md-9 col-sm-6 col-xs-12">
<!--Row 1 Start-->
	<div class="row">
<!--Administrator-->
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="fw-bold">ADMINISTRATOR</div>
			<a href="<?= $domain . $prefix; ?>dashboards" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-navy text-light fs-4">
				  <div class="mt-1"><i class="fas fa-crown"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">Dashboard</div>
					<p class="text-muted text-small mb-0"><?php echo $system_name; ?> Dashboard</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>

			<a href="<?= $domain . $prefix; ?>settings" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-yellow2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-cog"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">Settings</div>
					<p class="text-muted text-small mb-0"><?php echo $system_abbr; ?> configurations</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>
<!--User-->
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="fw-bold">USER</div>
			<a href="<?= $domain . $prefix; ?>users" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-lime2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-user"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">User</div>
					<p class="text-muted text-small mb-0">List of users</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
			
			<a href="<?= $domain . $prefix; ?>users/add" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-lime2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-user-plus"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">New User</div>
					<p class="text-muted text-small mb-0">Register new user</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>
<!--Article-->
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="fw-bold">ARTICLE</div>
			<a href="<?= $domain . $prefix; ?>articles" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-blue2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-list"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">Article</div>
					<p class="text-muted text-small mb-0">List of articles</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>

			<a href="<?= $domain . $prefix; ?>articles/add" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-blue2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-plus"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">New Article</div>
					<p class="text-muted text-small mb-0">Post new article</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>	
<!--Category-->
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="fw-bold">CATEGORY</div>
			<a href="<?= $domain . $prefix; ?>categories" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-cyan2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-list"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">Category</div>
					<p class="text-muted text-small mb-0">List of categories</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>

			<a href="<?= $domain . $prefix; ?>categories/add" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-cyan2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-plus"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">New Category</div>
					<p class="text-muted text-small mb-0">Register new category</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>
	</div><!--Row 1 End-->
<hr>
<!--Row 2 Start-->
	<div class="row">
<!--Blog-->
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="fw-bold">BLOG</div>
			<a href="<?= $domain . $prefix; ?>blogs" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-pink2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-ghost"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">Blog</div>
					<p class="text-muted text-small mb-0">List of blogs</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
			
			<a href="<?= $domain . $prefix; ?>blogs/add" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-pink2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-plus"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">New Blog</div>
					<p class="text-muted text-small mb-0">Post new blog</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>
<!--Project-->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="fw-bold">PROJECT</div>
			<a href="<?= $domain . $prefix; ?>projects" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-purple text-light fs-4">
				  <div class="mt-1"><i class="fas fa-dice-d20"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">Project</div>
					<p class="text-muted text-small mb-0">List of projects</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
			
			<a href="<?= $domain . $prefix; ?>projects/add" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-purple text-light fs-4">
				  <div class="mt-1"><i class="fas fa-plus"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">New Project</div>
					<p class="text-muted text-small mb-0">Post new project</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>
<!--Fitness-->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="fw-bold">FITNESS TRACKER</div>
			<a href="<?= $domain . $prefix; ?>fitnesses" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-orange2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-heartbeat"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">Fitness</div>
					<p class="text-muted text-small mb-0">List of exercise</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
			
			<a href="<?= $domain . $prefix; ?>fitnesses/add" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-orange2 text-light fs-4">
				  <div class="mt-1"><i class="fas fa-plus"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">New Exercise</div>
					<p class="text-muted text-small mb-0">Post new exercise</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>
<!--Pain-->
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="fw-bold">PAIN TRACKER</div>
			<a href="<?= $domain . $prefix; ?>pains" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-blue text-light fs-4">
				  <div class="mt-1"><i class="fas fa-biohazard"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">Pain</div>
					<p class="text-muted text-small mb-0">List of pains</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>

			<a href="<?= $domain . $prefix; ?>pains/add" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-blue text-light fs-4">
				  <div class="mt-1"><i class="fas fa-plus"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">New pain</div>
					<p class="text-muted text-small mb-0">Post new pain</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>
	</div><!--Row 2 End-->	
<hr>
<!--Row 3 Start-->
	<div class="row">
<!--Contact-->
	<div class="col-md-3 col-sm-6 col-xs-12">
		<div class="fw-bold">CONTACT</div>
			<a href="<?= $domain . $prefix; ?>contacts" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-green text-light fs-4">
				  <div class="mt-1"><i class="far fa-comment-alt"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">Contact</div>
					<p class="text-muted text-small mb-0">List of contact tickets</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
			
			<a href="<?= $domain . $prefix; ?>contacts/add" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-green text-light fs-4">
				  <div class="mt-1"><i class="fas fa-plus"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">New Contact</div>
					<p class="text-muted text-small mb-0">Post new contact</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>
<!--CPanel-->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="fw-bold">CPANEL</div>
			<a href="https://codethepixel.com/cpanel" class="kosong" target="blank">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-red text-light fs-4">
				  <div class="mt-1"><i class="fas fa-gamepad"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">CPanel</div>
					<p class="text-muted text-small mb-0">Manage Hosting</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>
<!--Fitness-->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="fw-bold">SITEMAP</div>
			<a href="<?= $domain; ?>sitemap.xml" class="kosong" target="blank">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-magenta text-light fs-4">
				  <div class="mt-1"><i class="fas fa-sitemap"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">SiteMap</div>
					<p class="text-muted text-small mb-0">View XML sitemap</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>
<!--Fitness-->
	<div class="col-md-3 col-sm-6 col-xs-12">
	  <div class="fw-bold">SESSION</div>
			<a href="<?= $domain . $prefix; ?>users/logout" class="kosong">
			<div class="card my-1">
			  <div class="row g-0">
				<div class="col-md-3 col-2 text-center bg-secondary text-light fs-4">
				  <div class="mt-1"><i class="fas fa-sign-out-alt"></i></div>
				</div>
				<div class="col-md-9 col-10">
				  <div class="card-body px-2 py-0">
					<div class="fw-bold">Logout</div>
					<p class="text-muted text-small mb-0">End auth session</p>
				  </div>
				</div>
			  </div>
			</div>
			</a>
	</div>

	</div><!--Row 3 End-->	
	
	</div>
</div><!--Outer wrap End-->





					</div>
				</div>  
			</li>
<?php } ?>



<!--			<li class="nav-item dropdown">
				<a class="nav-link" href="#" data-bs-toggle="dropdown"><i class="fas fa-cog fa-spin text-warning"></i></a>
			    <ul class="dropdown-menu dropdown-menu-end">
				  <li><?php //echo $this->Html->link('Dashboard', ['prefix' => 'Admin', 'controller' => 'Dashboards', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]); ?></li>
				  <li><?php //echo $this->Html->link('Settings', ['prefix' => 'Admin', 'controller' => 'Settings', 'action' => 'update','1'], ['class' => 'dropdown-item', 'escape' => false]); ?></li>
				  <li><?php //echo $this->Html->link('Article', ['prefix' => 'Admin', 'controller' => 'Articles', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]); ?></li>
				  <li><?php //echo $this->Html->link('Blog', ['prefix' => 'Admin', 'controller' => 'Blogs', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]); ?></li>
				  <li><?php //echo $this->Html->link('Project', ['prefix' => 'Admin', 'controller' => 'Projects', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]); ?></li>
				  <li><?php //echo $this->Html->link('Category', ['prefix' => 'Admin', 'controller' => 'Categories', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]); ?></li>
				  <li><?php //echo $this->Html->link('User', ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]); ?></li>
				  <li><?php //echo $this->Html->link('Fitness Tracker', ['prefix' => 'Admin', 'controller' => 'Fitnesses', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]); ?></li>
				  <li><?php //echo $this->Html->link('Pain Tracker', ['prefix' => 'Admin', 'controller' => 'Pains', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]); ?></li>
				  <li><?php //echo $this->Html->link('Logout', ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item', 'escape' => false]); ?></li>
			    </ul>
			</li>
-->
		</ul>

<!--		
		<ul class="navbar-nav ms-auto">
			<li class="nav-item"><a class="nav-link" href="#"> Menu item </a></li>
			<li class="nav-item dropdown">
				<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> Dropdown right </a>
			    <ul class="dropdown-menu dropdown-menu-end">
				  <li><a class="dropdown-item" href="#"> Submenu item 1</a></li>
				  <li><a class="dropdown-item" href="#"> Submenu item 2 </a></li>
			    </ul>
			</li>
		</ul>
-->	
	</div>
</div>
</nav>
<div class="progress-container sticky-top">
	<div class="progress-bar" id="myBar"></div>
</div>  
</div>
