<?php require_once(ROOT . DS . 'vendor' . DS  . 'simple_html_dom' . DS . 'simple_html_dom.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<style>
a.todo:link {
    color:#fff;
    text-decoration:none;
}
a.todo:visited {
    color: #fff;
    text-decoration:none;
}
a.todo:hover {
    color: #fff;
    text-decoration:underline;
}
a.todo:active {
    color: #fff;
    text-decoration:none;
}


</style>
<div class="container pt-3 text-secondary">
<h3 class="fw-bold">Dashboard</h3>
		<div class="row">
		  <div class="col">
		  <?php echo $this->Html->link(
		   '<div class="col kotak kotak-blue">
			<div class="icon"><i class="fa fa-cog fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Setting</div>
			</div>',
			array('controller'=>'settings','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-green">
			<div class="icon"><i class="fab fa-staylinked fa-3x"></i></div>
			<div class="nota">Articles</div>
			</div>',
			array('controller'=>'articles','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-amber">
			<div class="icon"><i class="fas fa-users fa-3x" aria-hidden="true"></i></div>
			<div class="nota">User</div>
			</div>',
			array('controller'=>'users','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-orange">
			<div class="icon"><i class="fab fa-uikit fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Category</div>
			</div>',
			array('controller'=>'categories','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-red">
			<div class="icon"><i class="fas fa-ghost fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Blog</div>
			</div>',
			array('controller'=>'blogs','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>

		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-purple">
			<div class="icon"><i class="fas fa-dice-d20 fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Project</div>
			</div>',
			array('controller'=>'projects','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-darkblue">
			<div class="icon"><i class="fas fa-heartbeat fa-3x"></i></div>
			<div class="nota">Fitness</div>
			</div>',
			array('controller'=>'fitnesses','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-brown">
			<div class="icon"><i class="fas fa-biohazard fa-3x"></i></div>
			<div class="nota">Pain</div>
			</div>',
			array('controller'=>'pains','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-emerald">
			<div class="icon"><i class="far fa-comment-alt fa-3x"></i></div>
			<div class="nota">Contact</div>
			</div>',
			array('controller'=>'contacts','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-grey">
			<div class="icon"><i class="fas fa-sitemap fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Sitemap</div>
			</div>',
			array('controller'=>'users','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-pink">
			<div class="icon"><i class="fas fa-gamepad fa-3x" aria-hidden="true"></i></div>
			<div class="nota">CPanel</div>
			</div>',
			array('controller'=>'users','action'=>'index','prefix'=>'Admin'),
			array('escape' => false)); ?>
			
		<?php echo $this->Html->link(
		   '<div class="col kotak kotak-lightpurple">
			<div class="icon"><i class="fa fa-sign-out-alt fa-3x" aria-hidden="true"></i></div>
			<div class="nota">Logout</div>
			</div>',
			['controller'=>'users','action'=>'logout','prefix'=>'Admin'],
			['escape' => false]); ?>
			
		  </div>
		</div>
<hr>
<div class="row">
	<div class="col">
<i class="far fa-bookmark text-blue"></i> <?php echo $this->Html->link('Re-CRUD Repository','https://github.com/Asyraf-wa', ['target'=>'_blank', 'class' => 'reference']); ?><br>
<i class="far fa-bookmark text-indigo"></i> <?php echo $this->Html->link('Code The Pixel - tutorial','https://codethepixel.com', ['target'=>'_blank', 'class' => 'reference']); ?><br>
<i class="far fa-bookmark text-purple"></i> <?php echo $this->Html->link('GetBootstrap - Theme components','https://getbootstrap.com', ['target'=>'_blank', 'class' => 'reference']); ?><br>
	</div>
	<div class="col">
<i class="far fa-bookmark text-pink"></i> <?php echo $this->Html->link('Font Awesome Icon - Icon collection','https://fontawesome.com', ['target'=>'_blank', 'class' => 'reference']); ?><br>
<i class="far fa-bookmark text-red"></i> <?php echo $this->Html->link('Feather Icon - Icon collection','https://feathericons.com', ['target'=>'_blank', 'class' => 'reference']); ?><br>
<i class="far fa-bookmark text-orange"></i> <?php echo $this->Html->link('Github - Codes repository','https://github.com', ['target'=>'_blank', 'class' => 'reference']); ?><br>
	</div>
	<div class="col">
<i class="far fa-bookmark text-yellow"></i> <?php echo $this->Html->link('Composer - Dependecy manager','https://getcomposer.org/', ['target'=>'_blank', 'class' => 'reference']); ?><br>
<i class="far fa-bookmark text-green"></i> <?php echo $this->Html->link('ChartJS - Charting library','https://www.chartjs.org/', ['target'=>'_blank', 'class' => 'reference']); ?><br>
<i class="far fa-bookmark text-teal"></i> <?php echo $this->Html->link('DataTables - Table enhancement','https://datatables.net/', ['target'=>'_blank', 'class' => 'reference']); ?><br>
	</div>
	<div class="col">
<i class="far fa-bookmark text-cyan"></i> <?php echo $this->Html->link('Google Fonts - Font library','https://fonts.google.com/', ['target'=>'_blank', 'class' => 'reference']); ?><br>
<i class="far fa-bookmark text-gray"></i> <?php echo $this->Html->link('Optimizilla - Image optimizer','https://imagecompressor.com/', ['target'=>'_blank', 'class' => 'reference']); ?><br>
<i class="far fa-bookmark text-primary"></i> <?php echo $this->Html->link('PHP - PHP references','https://www.php.net/manual/en/', ['target'=>'_blank', 'class' => 'reference']); ?><br>
<i class="far fa-bookmark text-secondary"></i> <?php echo $this->Html->link('CakePHP  Framework','https://cakephp.org/', ['target'=>'_blank', 'class' => 'reference']); ?>
	</div>
</div>	
<hr>	

<div class="row">
	<div class="col-md-9">
		Column
	</div>
	<div class="col-md-3">
	
      <div class="bg-blue2 tile ripple-effect pt-3 px-3">
		  <div class="row">
			<div class="col">
			  <div class="dashboard-title fw-bold">To-Do-List</div>
			  <div class="pb-3 text-small"><?php echo $system_name; ?></div>
			</div>
			<div class="col-3 text-end">
			  <?= $this->Html->image('icon/2728212.png', ['alt' => 'virus', 'class' => '', 'style' => 'opacity: .9', 'width' => '48px', 'height' => '48px']); ?>
			</div>
		  </div>
		<table class="table table-sm table-borderless">
		<?php foreach ($todos as $todo): ?>	
			<tr>
				<td>
<i class="fas fa-caret-right text-light"></i> 
<?php if($todo->status == 1){
	echo '<del>';
	echo $this->Html->link(__($todo->task), ['controller' => 'Todos','action' => 'view', $todo->id, 'prefix' => 'Admin'], ['class' => 'todo', 'escape' => false]);
	echo '</del>';
}else
	echo $this->Html->link(__($todo->task), ['controller' => 'Todos','action' => 'view', $todo->id, 'prefix' => 'Admin'], ['class' => 'todo', 'escape' => false]);
?>			
				</td>
			</tr>
		<?php endforeach; ?>
		</table>

<div class="text-small pt-4">Data source from <a href="https://covid-19.dataflowkit.com/v1" target="blank">Dataflow Kit</a> #stayHome #staySafe <?php echo $this->Html->link(__('Task'), ['controller' => 'Todos','action' => 'index', 'prefix' => 'Admin'], ['class' => 'todo', 'escape' => false]) ?></div>
  
	  </div>
		

		
	</div>
</div>




<div class="row">
	<div class="col-4">
	  <div id="chart"></div>
	  <script>
        var options = {
          chart: {
          type: 'donut',
		  height: '400px',
        },
		labels: ['CakePHP', 'Joomla', 'Software', 'Misc'],
		series: [<?= $cakephp; ?>, <?= $joomla; ?>, <?= $software; ?>, <?= $misc; ?>],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
		

</script>
	</div>
	<div class="col">
	  Column
	</div>
	<div class="col">
	  Column
	</div>
</div>



		<br><br>
<div class="row">
	<div class="col-md-9">
	  Column
	</div>
	<div class="col-md-3">
<table class="table table-sm table-borderless">
	<tr>
		<td><i class="far fa-bookmark text-blue"></i> <?php echo $this->Html->link('Re-CRUD Repository','https://github.com/Asyraf-wa', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-indigo"></i> <?php echo $this->Html->link('Code The Pixel - Re-CRUD tutorial','https://codethepixel.com', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-purple"></i> <?php echo $this->Html->link('GetBootstrap - Theme components','https://getbootstrap.com', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-pink"></i> <?php echo $this->Html->link('Font Awesome Icon - Icon collection','https://fontawesome.com', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-red"></i> <?php echo $this->Html->link('Feather Icon - Icon collection','https://feathericons.com', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-orange"></i> <?php echo $this->Html->link('Github - Codes repository','https://github.com', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-yellow"></i> <?php echo $this->Html->link('Composer - Dependecy manager','https://getcomposer.org/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-green"></i> <?php echo $this->Html->link('ChartJS - Flexible charting library','https://www.chartjs.org/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-teal"></i> <?php echo $this->Html->link('DataTables - Table enhancement','https://datatables.net/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-cyan"></i> <?php echo $this->Html->link('Google Fonts - Font library','https://fonts.google.com/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-gray"></i> <?php echo $this->Html->link('Optimizilla - Image optimizer','https://imagecompressor.com/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-primary"></i> <?php echo $this->Html->link('PHP - PHP references','https://www.php.net/manual/en/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
	<tr>
		<td><i class="far fa-bookmark text-secondary"></i> <?php echo $this->Html->link('CakePHP Framework','https://cakephp.org/', ['target'=>'_blank', 'class' => 'reference']); ?></td>
	</tr>
</table>
	</div>
</div>


<?php
/* $row = 1;
if (($handle = fopen("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
} */
?>



<?php
/* 
echo '<table border="1">';
$start_row = 1;
if (($csv_file = fopen("https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv", "r")) !== FALSE) {
  while (($read_data = fgetcsv($csv_file, 1000, ",")) !== FALSE) {
    $column_count = count($read_data);
	echo '<tr>';
    $start_row++;
    for ($c=0; $c < $column_count; $c++) {
        echo "<td>".$read_data[$c] . "</td>";
    }
	echo '</tr>';
  }
  fclose($csv_file);
}
echo '</table>';
 */
?>






  <div class="row">
    <div class="col-md-6 px-1 py-1">
      <div class="bg-pink2 tile ripple-effect pt-3">
		  <div class="row px-3"><!--title row start-->
			<div class="col-9"><div class="dashboard-title fw-bold"><?php echo date("Y");?> Progress Report</div></div>
			<div class="col-3">
				<div class="dropdown text-end">
				  <button class="btn btn-sm rounded-circle text-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
					<i class="fas fa-ellipsis-h fa-xs text-light"></i>
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					<?= $this->Html->link(__('Edit Profile'), ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'edit', $this->Identity->get('id')], ['class' => 'dropdown-item', 'escape' => false]) ?>
					<?= $this->Html->link(__('Edit Password'), ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'password', $this->Identity->get('id')], ['class' => 'dropdown-item', 'escape' => false]) ?>
				  </ul>
				</div>	 
			</div>
		  </div><!--title row end-->
<div class="px-3">
<canvas id="myChart" width="600" height="200" class="bg-white2"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
			{
            label: '# of Articles',
            data: [<?= $article_jan; ?>, <?= $article_feb; ?>, <?= $article_mar; ?>, <?= $article_apr; ?>, <?= $article_may; ?>, <?= $article_jun; ?>, <?= $article_jul; ?>, <?= $article_aug; ?>, <?= $article_sep; ?>, <?= $article_oct; ?>, <?= $article_nov; ?>, <?= $article_dec; ?>],
			tension: 0.2,
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },
		{
            label: '# of Blogs',
            data: [<?= $blog_jan; ?>, <?= $blog_feb; ?>, <?= $blog_mar; ?>, <?= $blog_apr; ?>, <?= $blog_may; ?>, <?= $blog_jun; ?>, <?= $blog_jul; ?>, <?= $blog_aug; ?>, <?= $blog_sep; ?>, <?= $blog_oct; ?>, <?= $blog_nov; ?>, <?= $blog_dec; ?>],
			tension: 0.2,
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        },
		{
            label: '# of Projects',
            data: [5, 17, 9, 10, 2, 9, 18, 6, 7, 1, 6, 10],
			tension: 0.2,
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }
		]
    },
    options: {
	  plugins: {
		legend: {
		  display: false,
		  fontColor: "white",
		}
	  },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
</div>
	  </div>
    </div>
<!--Articles-->
    <div class="col-md-3 px-1 py-1">
      <div class="bg-purple tile ripple-effect pt-3">
  <div class="row px-3"><!--title row start-->
    <div class="col"><div class="dashboard-title fw-bold">Articles</div></div>
    <div class="col">
		<div class="dropdown text-end">
		  <button class="btn btn-light btn-sm rounded-circle text-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
			<i class="fas fa-ellipsis-h fa-xs"></i>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
			<?= $this->Html->link(__('Manage Articles'), ['controller' => 'Articles', 'action' => 'index', 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
			<?= $this->Html->link(__('View Front-Page Articles'), ['controller' => 'Articles', 'action' => 'index', 'prefix' => false], ['class' => 'dropdown-item', 'escape' => false]) ?>
			<?= $this->Html->link(__('Post New Articles'), ['controller' => 'Articles', 'action' => 'add', 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
		  </ul>
		</div>	 
    </div>
  </div><!--title row end-->
	<div class="loader counter-big fw-bold text-center pb-3 pt-3 px-3"><span class="count"><?php echo $article_count_all; ?></span></div>
	<div class="text-center px-3">
		<span class="badge rounded-pill bg-light text-secondary">Total : <span class="count"><?php echo $article_count_all; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Active : <span class="count"><?php echo $article_active; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Archived : <span class="count"><?php echo $article_archived; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Featured : <span class="count"><?php echo $article_featured; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Unpublish : <span class="count"><?php echo $article_unpublish; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Views : <span class="count"><?php echo $sum_quantity; ?></span></span>
	</div>
		<div class="marquee-container"><!--Scrolling start-->
		<div class="Marquee">
		  <div class="Marquee-content">
		<?php foreach ($article_last as $article): ?>	
			<div class="Marquee-tag"><?= h($article->title) ?> (<?= date('d M Y', strtotime($article->created)); ?>)</div>
		<?php endforeach; ?>
		  </div>
		</div>
		</div><!--Scrolling end-->
	  </div>
    </div>
<!--Blogs-->
    <div class="col-md-3 px-1 py-1">
      <div class="bg-cyan2 tile ripple-effect pt-3">
  <div class="row px-3"><!--title row start-->
    <div class="col"><div class="dashboard-title fw-bold">Blogs</div></div>
    <div class="col">
		<div class="dropdown text-end">
		  <button class="btn btn-light btn-sm rounded-circle text-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
			<i class="fas fa-ellipsis-h fa-xs"></i>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
			<?= $this->Html->link(__('Manage Blogs'), ['controller' => 'Blogs', 'action' => 'index', 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
			<?= $this->Html->link(__('View Front-Page Blogs'), ['controller' => 'Blogs', 'action' => 'index', 'prefix' => false], ['class' => 'dropdown-item', 'escape' => false]) ?>
			<?= $this->Html->link(__('Post New Blogs'), ['controller' => 'Blogs', 'action' => 'add', 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
		  </ul>
		</div>	 
    </div>
  </div><!--title row end-->
	<div class="loader counter-big fw-bold text-center pb-3 pt-3 px-3"><span class="count"><?php echo $blog_count_all; ?></span></div>
	<div class="text-center px-3">
		<span class="badge rounded-pill bg-light text-secondary">Total : <span class="count"><?php echo $blog_count_all; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Active : <span class="count"><?php echo $blog_active; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Disabled : <span class="count"><?php echo $blog_disabled; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Archived : <span class="count"><?php echo $blog_archived; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Unpublish : <span class="count"><?php echo $blog_unpublish; ?></span></span>
	</div>
		<div class="marquee-container"><!--Scrolling start-->
		<div class="Marquee">
		  <div class="Marquee-content">
		<?php foreach ($blog_last as $blog): ?>	
			<div class="Marquee-tag"><?= h($blog->title) ?> (<?= date('d M Y', strtotime($blog->created)); ?>)</div>
		<?php endforeach; ?>
		  </div>
		</div>
		</div><!--Scrolling end-->
	  </div>
    </div>
  </div>
  
  <div class="row">
<!--Blogs-->
    <div class="col-md-3 px-1 py-1">
      <div class="bg-yellow2 tile ripple-effect pt-3">
  <div class="row px-3"><!--title row start-->
    <div class="col"><div class="dashboard-title fw-bold">Projects</div></div>
    <div class="col">
		<div class="dropdown text-end">
		  <button class="btn btn-light btn-sm rounded-circle text-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
			<i class="fas fa-ellipsis-h fa-xs"></i>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
			<?= $this->Html->link(__('Manage Blogs'), ['controller' => 'Blogs', 'action' => 'index', 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
			<?= $this->Html->link(__('View Front-Page Blogs'), ['controller' => 'Blogs', 'action' => 'index', 'prefix' => false], ['class' => 'dropdown-item', 'escape' => false]) ?>
			<?= $this->Html->link(__('Post New Blogs'), ['controller' => 'Blogs', 'action' => 'add', 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
		  </ul>
		</div>	 
    </div>
  </div><!--title row end-->
	<div class="loader counter-big fw-bold text-center pb-3 pt-3 px-3"><span class="count"><?php echo $blog_count_all; ?></span></div>
	<div class="text-center px-3">
		<span class="badge rounded-pill bg-light text-secondary">Total : <span class="count"><?php echo $blog_count_all; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Active : <span class="count"><?php echo $blog_active; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Disabled : <span class="count"><?php echo $blog_disabled; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Archived : <span class="count"><?php echo $blog_archived; ?></span></span>
		<span class="badge rounded-pill bg-light text-secondary">Unpublish : <span class="count"><?php echo $blog_unpublish; ?></span></span>
	</div>
		<div class="marquee-container"><!--Scrolling start-->
		<div class="Marquee">
		  <div class="Marquee-content">
		<?php foreach ($blog_last as $blog): ?>	
			<div class="Marquee-tag"><?= h($blog->title) ?> (<?= date('d M Y', strtotime($blog->created)); ?>)</div>
		<?php endforeach; ?>
		  </div>
		</div>
		</div><!--Scrolling end-->
	  </div>
    </div>
    <div class="col-md-6 px-1 py-1">
      <div class="bg-blue2 tile ripple-effect pt-3 px-3">
		<div class="dashboard-title fw-bold">Column</div>
	  </div>
    </div>
<!--Auth Info-->
    <div class="col-md-3 px-1 py-1">
      <div class="bg-red2 tile ripple-effect pt-3">
  <div class="row px-3"><!--title row start-->
    <div class="col-9"><div class="dashboard-title fw-bold">
Hi, <?php
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$Hour = date('G');
	if ( $Hour >= 5 && $Hour <= 11 ) {
		echo "Good Morning";
	} else if ( $Hour >= 12 && $Hour <= 18 ) {
		echo "Good Afternoon";
	} else if ( $Hour >= 19 || $Hour <= 4 ) {
		echo "Good Evening";
	}
?>	
	</div></div>
    <div class="col-3">
		<div class="dropdown text-end">
		  <button class="btn btn-light btn-sm rounded-circle text-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
			<i class="fas fa-ellipsis-h fa-xs"></i>
		  </button>
		  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
			<?= $this->Html->link(__('Edit Profile'), ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'edit', $this->Identity->get('id')], ['class' => 'dropdown-item', 'escape' => false]) ?>
			<?= $this->Html->link(__('Edit Password'), ['prefix' => 'Admin', 'controller' => 'Users', 'action' => 'password', $this->Identity->get('id')], ['class' => 'dropdown-item', 'escape' => false]) ?>
		  </ul>
		</div>	 
    </div>
  </div><!--title row end-->
	<div class="text-center px-3 py-2">
	<?php echo $this->Html->image('../files/Users/avatar/' . $this->Identity->get('slug') . '/' . $this->Identity->get('avatar'), ['alt' => 'Profile Picture', 'class' => 'rounded-circle', 'width' => '100px', 'height' => '100px', 'style' => 'opacity: .8']); ?>
	</div>
	<div class="text-center fw-bold">
<?php echo $this->Identity->get('fullname'); ?>
	</div>
<div class="text-small text-center px-3">
<?php echo $this->Identity->get('email'); ?><br>
Last Logged in:<br><?= date('F, d Y (h:i:s a)', strtotime($this->Identity->get('last_login'))); ?>
<br>

</div>
	  </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-3 px-1 py-1">
      <div class="bg-indigo tile ripple-effect pt-3 px-3">
		<div class="dashboard-title fw-bold">Column</div>
	  </div>
    </div>
    <div class="col-md-3 px-1 py-1">
      <div class="bg-orange2 tile ripple-effect pt-3 px-3">
		<div class="dashboard-title fw-bold">Column</div>
	  </div>
    </div>

    <div class="col-md-6 px-1 py-1">
<?php
$case = file('https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/cases_malaysia.csv', FILE_IGNORE_NEW_LINES);
$case_fields = str_getcsv($case[count($case)-1]); 

$death = file('https://raw.githubusercontent.com/MoH-Malaysia/covid19-public/main/epidemic/deaths_malaysia.csv', FILE_IGNORE_NEW_LINES);
$death_fields = str_getcsv($death[count($death)-1]); 

//$owid = file('https://raw.githubusercontent.com/owid/covid-19-data/master/public/data/latest/owid-covid-latest.csv', FILE_IGNORE_NEW_LINES);
//$owid_fields = str_getcsv($owid[count($owid)-99]); 
?>
<?php //echo $owid_fields[count($owid_fields)-63]; // ?>
      <div class="bg-lime2 tile ripple-effect pt-3 px-3">
		  <div class="row">
			<div class="col">
			  <div class="dashboard-title fw-bold">Malaysia Covid-19 Tracker</div>
			  <div class="pb-3 text-small">
				Last Updated on: <?php echo $case_fields[count($case_fields)-11]; ?> (1159)
				<?php
					//$dateTime = new DateTime($decodedMalaysia->{'Last Update'});
					//echo $dateTime->format('d M Y (D) - g:i a');
					//echo ' GMT';
				?>
				</div>
			</div>
			<div class="col-2 text-end">
			  <?= $this->Html->image('c19.png', ['alt' => 'virus', 'class' => '', 'style' => 'opacity: .9', 'width' => '48px', 'height' => '48px']); ?>
			</div>
		  </div>
		


  <div class="row">
    <div class="col text-center fw-bolder">
			<?php //echo $owid_fields[count($owid_fields)-60]; //new case ?>
		<div class="fw-normal">New Case</div>
    </div>
    <div class="col text-center fw-bolder">
			<?php echo $death_fields[count($death_fields)-6]; //new death ?>
		<div class="fw-normal">New Death</div>
    </div>
    <div class="col text-center fw-bolder">
	  
		<div class="fw-normal">Active Case</div>
    </div>
  </div>
  
  <hr>

  <div class="row">
    <div class="col text-center fw-bolder">
			<?php echo $case_fields[count($case_fields)-8]; //total recovered ?>
		<div class="fw-normal">Total Recovered</div>
    </div>
    <div class="col">
    <div class="col text-center fw-bolder">
     
		<div class="fw-normal">Total Case</div>
    </div>
    </div>
    <div class="col">
    <div class="col text-center fw-bolder">
      
		<div class="fw-normal">Total Death</div>
    </div>
    </div>
  </div>
  
<div class="text-small pt-4">Data source from <a href="https://covid-19.dataflowkit.com/v1" target="blank">Dataflow Kit</a> #stayHome #staySafe</div>
  
	  </div>
    </div>
  </div>

  
<?php echo $this->element('report/current_year_published'); ?>

  
<br><br><br><br>
  
<script>

(function($) {
    $(".ripple-effect").click(function(e){
        var rippler = $(this);

        // create .ink element if it doesn't exist
        if(rippler.find(".ink").length == 0) {
            rippler.append("<span class='ink'></span>");
        }

        var ink = rippler.find(".ink");

        // prevent quick double clicks
        ink.removeClass("animate");

        // set .ink diametr
        if(!ink.height() && !ink.width())
        {
            var d = Math.max(rippler.outerWidth(), rippler.outerHeight());
            ink.css({height: d, width: d});
        }

        // get click coordinates
        var x = e.pageX - rippler.offset().left - ink.width()/2;
        var y = e.pageY - rippler.offset().top - ink.height()/2;

        // set .ink position and add class .animate
        ink.css({
            top: y+'px',
            left:x+'px'
        }).addClass("animate");
    })
})(jQuery);
</script>

  <div class="row">
    <div class="col-md-6">
	  <div class="row">
		<div class="col-md-6">
			<div class="card mb-3 shadow">
					<div class="card-body bg-light border borderless">
						<h6 class="fw-bold">Total Articles</h6>
						  <div class="row">
							<div class="col">
							  <h2 class="fw-bold text-center pt-2"><div class="loader"><span class="count"><?php echo $article_count_all; ?></span></div></h2>
							</div>
							<div class="col">

							</div>
						  </div>
					</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card mb-3 shadow">
					<div class="card-body bg-light border borderless text-center">
						xx
					</div>
			</div>
		</div>
	  </div>
	  
	  <div class="row">
		<div class="col-md-6">
			<div class="card mb-3 shadow">
					<div class="card-body bg-light border borderless text-center">
						xx
					</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card mb-3 shadow">
					<div class="card-body bg-light border borderless text-center">
						xx
					</div>
			</div>
		</div>
	  </div>	 
    </div>
    <div class="col-md-6">
			<div class="card mb-3 shadow">
					<div class="card-body bg-light border borderless text-center">
						xx<br>xx<br>xx<br>xx<br>
					</div>
			</div>
    </div> 
  </div>











  <div class="row">
    <div class="col-4">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
		<h5 class="text-center"><?php echo $this->Identity->get('fullname'); ?></h5>
		<?php echo $this->Identity->get('username'); ?><br>
		<?php echo $this->Identity->get('email'); ?>
				</div>
		</div>
    </div>
    <div class="col">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					Total Articles<br><?php echo $article_count_all; ?>
				</div>
		</div>
    </div>
    <div class="col">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					Total Blogs<br><?php echo $blog_count_all; ?>
				</div>
		</div>
    </div>
    <div class="col">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					Total Projects
				</div>
		</div>
    </div>
  </div>
  
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					Trending chart (3 line)
				</div>
		</div>
		
<?php echo $this->element('report/current_year_published'); ?>
		
  <div class="row">
    <div class="col-8">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					Current Year Activity Dot
				</div>
		</div>
    </div>
    <div class="col-4">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					Current Year Monthly Stats
				</div>
		</div>
    </div>
  </div>		
  
  <div class="row">
    <div class="col-8">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					2020 Year Activity Dot
				</div>
		</div>
    </div>
    <div class="col-4">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					2020 Year Monthly Stats
				</div>
		</div>
    </div>
  </div>	
  
  <div class="row">
    <div class="col-8">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					2019 Year Activity Dot
				</div>
		</div>
    </div>
    <div class="col-4">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					2019 Year Monthly Stats
				</div>
		</div>
    </div>
  </div>	
  
  <div class="row">
    <div class="col">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					<?php foreach ($articles as $article): ?>	
						<li class="list-group-item text-secondary"><i class="fas fa-caret-right text-primary"></i> <?= h($article->title) ?></li>
					<?php endforeach; ?>
				</div>
		</div>
    </div>
    <div class="col">
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					<?php foreach ($blogs as $blog): ?>	
						<li class="list-group-item text-secondary"><i class="fas fa-caret-right text-primary"></i> <?= h($blog->title) ?></li>
					<?php endforeach; ?>
				</div>
		</div>
    </div>
    <div class="col">
      Column
    </div>
  </div>
		

		
		<div class="card mb-3 shadow module-blue-big border borderless mt-3">
				<div class="card-body bg-light border borderless text-center">
					
				</div>
		</div>
</div>

<script>
$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 3000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
</script>