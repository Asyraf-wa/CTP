
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="container pt-5">

<?php echo $this->element('report/current_year_published'); ?>

<div class="card mb-3 shadow module-blue-big border borderless mt-3">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Article Report
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-light border borderless">
		
<div class="row">
	<div class="col-md-6">
		<table class="table table-bordered table-sm">
			<tr class="text-center bg-secondary text-light">
				<th colspan="3">
<?php $year = date("Y"); 
echo $year; 
?>				
				</th>
			</tr>
			<tr class="text-center">
				<th>Month</th>
				<th>Total Articles</th>
				<th>Total Views</th>
			</tr>
			<?php foreach ($monthly as $article): ?>
				<tr>
					<td><?= h($article->month) ?></td>
					<td class="text-center"><?= h($article->total) ?></td>
					<td class="text-center"><?= h($article->view) ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		

<div class="row">
	<div class="col-md-6">
<canvas id="monthYearChart" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById('monthYearChart').getContext('2d');
var monthYearChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: '# of Month',
            data: [<?= json_encode($january); ?>, <?= json_encode($february); ?>, <?= json_encode($march); ?>, <?= json_encode($april); ?>, <?= json_encode($may); ?>, <?= json_encode($jun); ?>, <?= json_encode($july); ?>, <?= json_encode($august); ?>, <?= json_encode($september); ?>, <?= json_encode($october); ?>, <?= json_encode($november); ?>, <?= json_encode($december); ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(89, 233, 28, 0.2)',
				'rgba(255, 5, 5, 0.2)',
                'rgba(255, 128, 0, 0.2)',
                'rgba(153, 153, 153, 0.2)',
                'rgba(15, 207, 210, 0.2)',
                'rgba(44, 13, 181, 0.2)',
                'rgba(86, 172, 12, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(89, 233, 28, 1)',
				'rgba(255, 5, 5, 1)',
                'rgba(255, 128, 0, 1)',
                'rgba(153, 153, 153, 1)',
                'rgba(15, 207, 210, 1)',
                'rgba(44, 13, 181, 1)',
                'rgba(86, 172, 12, 1)'
            ],
            borderWidth: 1
        }]
    },
	options: {
        plugins: {
            title: {
                display: true,
                text: 'Article Published (Monthly)'
            },
		legend: {
                display: false,
                labels: {
                    color: 'rgb(255, 99, 132)'
                }
            },
        }
    },
});
</script>	
	</div>
	<div class="col-md-6">
<canvas id="monthly" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById("monthly");
var chart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: <?= $months; ?>,
    datasets: [
      {
        type: "bar",
        backgroundColor: "rgba(54, 162, 235, 0.2)",
        borderColor: "rgba(54, 162, 235, 1)",
        borderWidth: 1,
        label: "View",
        data: <?= $count_monthly; ?>
      },
      {
        type: "line",
        label: "View",
        data: <?= $count_monthly; ?>,
        lineTension: 0, 
        fill: true 
      }
    ]
  },
  options: {
        plugins: {
            title: {
                display: true,
                text: 'Article Views/Hits (Monthly)'
            },
		legend: {
                display: false,
                labels: {
                    color: 'rgb(255, 99, 132)'
                }
            },
        }
    },
});
</script>
	</div>
</div>

	</div>
	<div class="col-md-6">
			<table class="table table-bordered table-sm">
				<tr class="text-center">
					<th>Year</th>
					<th>Total Articles</th>
					<th>Total Views</th>
				</tr>
				<?php foreach ($yearly as $article): ?>
					<tr class="text-center">
						<td><?= h($article->year) ?></td>
						<td><?= h($article->total) ?></td>
						<td><?= h($article->view) ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
	</div>
</div>		



<?php //echo $count_monthly; ?><br>
<?php //echo $months; ?><br>
<?php //echo $monthly_articles->extract('total'); ?><br><br>
<?php print_r($monthly_articles); ?>
<br>
<br>
<?= $count_monthly; ?>
<br>
<?= $months; ?>


		</div>
</div>

  <div class="row">
    <div class="col-md-4">
		column // 
		<?php
			echo $print_month; ?>
    </div>
    <div class="col-md-4">
		Column
    </div>
    <div class="col-md-4">
		Column
    </div>
  </div>
  
<div class="row">
	<div class="col-md-6">
<div id="monthly-publication-treemap"></div>
<script>
var options = {
  chart: {
    height: 350,
	type: "treemap",
  },
  title: {
	text: 'Treemap for <?php echo date("Y"); ?>	 Monthly Total Publication'
  },
  series: [{
    data: [
		{
            x: "January",
            y: <?= json_encode($january); ?>,
		},
		{
            x: "February",
            y: <?= json_encode($february); ?>,
		},
		{
            x: "March",
            y: <?= json_encode($march); ?>,
		},
		{
            x: "April",
            y: <?= json_encode($april); ?>,
		},
		{
            x: "May",
            y: <?= json_encode($may); ?>,
		},
		{
            x: "June",
            y: <?= json_encode($jun); ?>,
		},
		{
            x: "July",
            y: <?= json_encode($july); ?>,
		},
		{
            x: "August",
            y: <?= json_encode($august); ?>,
		},
		{
            x: "September",
            y: <?= json_encode($september); ?>,
		},
		{
            x: "October",
            y: <?= json_encode($october); ?>,
		},
		{
            x: "November",
            y: <?= json_encode($november); ?>,
		},
		{
            x: "December",
            y: <?= json_encode($december); ?>,
		},
	]
  }],
}

var chart = new ApexCharts(document.querySelector("#monthly-publication-treemap"), options);

chart.render();
</script>
	</div>
	<div class="col-md-6">
<div id="monthly-hits-treemap"></div>
<script>
var options = {
  chart: {
    height: 350,
	type: "treemap",
  },
  title: {
	text: 'Treemap for <?php echo date("Y"); ?>	 Monthly Total Views/Hits'
  },
  series: [{
    data: [
		{
            x: "January",
            y: <?= json_encode($sum_hits_jan); ?>,
		},
		{
            x: "February",
            y: <?= json_encode($sum_hits_feb); ?>,
		},
		{
            x: "March",
            y: <?= json_encode($sum_hits_mar); ?>,
		},
		{
            x: "April",
            y: <?= json_encode($sum_hits_apr); ?>,
		},
		{
            x: "May",
            y: <?= json_encode($sum_hits_may); ?>,
		},
		{
            x: "June",
            y: <?= json_encode($sum_hits_jun); ?>,
		},
		{
            x: "July",
            y: <?= json_encode($sum_hits_jul); ?>,
		},
		{
            x: "August",
            y: <?= json_encode($sum_hits_aug); ?>,
		},
		{
            x: "September",
            y: <?= json_encode($sum_hits_sep); ?>,
		},
		{
            x: "October",
            y: <?= json_encode($sum_hits_oct); ?>,
		},
		{
            x: "November",
            y: <?= json_encode($sum_hits_nov); ?>,
		},
		{
            x: "December",
            y: <?= json_encode($sum_hits_dec); ?>,
		},
	]
  }],
}

var chart = new ApexCharts(document.querySelector("#monthly-hits-treemap"), options);

chart.render();
</script>
column /<?php echo $sum_hits_jan; ?>/<?php echo $sum_hits_feb; ?>/<?php echo $sum_hits_mar; ?>
	</div>
</div>
  
  
<div class="row">
	<div class="col-md-2">
Column / 
	</div>
	<div class="col-md-10">
<div id="heatmap"></div>
<script>
var options = {
  chart: {
    type: 'heatmap',
	height: 350
  },
	title: {
		text: 'HeatMap Chart with Color Range'
        },
	dataLabels: {
		enabled: false
        },
    stroke: {
		width: 3
        },
	plotOptions: {
          heatmap: {
            shadeIntensity: 0.5,
            radius: 0,
            useFillColorAsStroke: false,
            colorScale: {
              ranges: [{
                  from: 0,
                  to: 10,
                  name: 'low',
                  color: '#00A100'
                },
                {
                  from: 11,
                  to: 20,
                  name: 'medium',
                  color: '#128FD9'
                },
                {
                  from: 21,
                  to: 30,
                  name: 'high',
                  color: '#FFB200'
                },
                {
                  from: 31,
                  to: 40,
                  name: 'extreme',
                  color: '#FF0000'
                }
              ]
            }
          }
        },
    series: [
    {
      name: "Jan",
      data: [
		{x: '1', y: 5}, {x: '2', y: 13}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 22}, {x: '7', y: 10}, {x: '8', y: 67}, {x: '9', y: 19}, {x: '10', y: 26}, 
		{x: '11', y: 31}, {x: '12', y: 36}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "Feb",
      data: [
		{x: '1', y: 11}, {x: '2', y: 13}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 22}, {x: '7', y: 10}, {x: '8', y: 67}, {x: '9', y: 19}, {x: '10', y: 26}, 
		{x: '11', y: 31}, {x: '12', y: 36}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "Mar",
      data: [
		{x: '1', y: 22}, {x: '2', y: 13}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 44}, {x: '7', y: 10}, {x: '8', y: 67}, {x: '9', y: 19}, {x: '10', y: 26}, 
		{x: '11', y: 31}, {x: '12', y: 36}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "Apr",
      data: [
		{x: '1', y: 33}, {x: '2', y: 13}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 33}, {x: '7', y: 22}, {x: '8', y: 67}, {x: '9', y: 22}, {x: '10', y: 11}, 
		{x: '11', y: 44}, {x: '12', y: 36}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "May",
      data: [
		{x: '1', y: 44}, {x: '2', y: 43}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 8}, {x: '7', y: 10}, {x: '8', y: 67}, {x: '9', y: 19}, {x: '10', y: 26}, 
		{x: '11', y: 31}, {x: '12', y: 36}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "Jun",
      data: [
		{x: '1', y: 33}, {x: '2', y: 22}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 8}, {x: '7', y: 10}, {x: '8', y: 67}, {x: '9', y: 33}, {x: '10', y: 11}, 
		{x: '11', y: 31}, {x: '12', y: 36}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "Jul",
      data: [
		{x: '1', y: 22}, {x: '2', y: 11}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 8}, {x: '7', y: 22}, {x: '8', y: 67}, {x: '9', y: 19}, {x: '10', y: 26}, 
		{x: '11', y: 31}, {x: '12', y: 36}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "Aug",
      data: [
		{x: '1', y: 11}, {x: '2', y: 33}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 11}, {x: '7', y: 21}, {x: '8', y: 67}, {x: '9', y: 11}, {x: '10', y: 44}, 
		{x: '11', y: 11}, {x: '12', y: 21}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "Sep",
      data: [
		{x: '1', y: 5}, {x: '2', y: 33}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 8}, {x: '7', y: 44}, {x: '8', y: 67}, {x: '9', y: 19}, {x: '10', y: 26}, 
		{x: '11', y: 21}, {x: '12', y: 11}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "Oct",
      data: [
		{x: '1', y: 11}, {x: '2', y: 22}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 33}, {x: '7', y: 33}, {x: '8', y: 67}, {x: '9', y: 19}, {x: '10', y: 26}, 
		{x: '11', y: 31}, {x: '12', y: 36}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "Nov",
      data: [
		{x: '1', y: 5}, {x: '2', y: 22}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 8}, {x: '7', y: 10}, {x: '8', y: 67}, {x: '9', y: 19}, {x: '10', y: 26}, 
		{x: '11', y: 31}, {x: '12', y: 11}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
    {
      name: "Dec",
      data: [
		{x: '1', y: 33}, {x: '2', y: 33}, {x: '3', y: 33}, {x: '4', y: 49}, {x: '5', y: 32}, 
		{x: '6', y: 8}, {x: '7', y: 10}, {x: '8', y: 67}, {x: '9', y: 19}, {x: '10', y: 26}, 
		{x: '11', y: 11}, {x: '12', y: 36}, {x: '13', y: 41}, {x: '14', y: 14}, {x: '15', y: 50}, 
		{x: '16', y: 41}, {x: '17', y: 33}, {x: '18', y: 56}, {x: '19', y: 23}, {x: '20', y: 43}, 
		{x: '21', y: 11}, {x: '22', y: 1}, {x: '23', y: 32}, {x: '24', y: 78}, {x: '25', y: 13}, 
		{x: '26', y: 14}, {x: '27', y: 33}, {x: '28', y: 1}, {x: '29', y: 0}, {x: '30', y: 50},{x: '31', y: 11}
	]
    },
  ],
/*   xaxis: {
    categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul', 'Aug','Sep','Oct','Nov','Dec']
  } */
}

var chart = new ApexCharts(document.querySelector("#heatmap"), options);
chart.render();
</script>
	</div>
</div>
  



<div class="row">
	<div class="col-md-12">

<div id="single_hits"></div>
<script>
var options = {
  chart: {
    height: 650,
	type: "treemap",
  },
  title: {
	text: 'Treemap for Published Articles Hits/Views'
  },
  series: [{
    data: <?php echo "[" . implode(", ", $hit_stats) . "]"; ?>
  }],
	dataLabels: {
	  enabled: true,
	},
}

var chart = new ApexCharts(document.querySelector("#single_hits"), options);
chart.render();
</script>



	</div>
	<div class="col-md-12">
<canvas id="cute" width="400" height="200px"></canvas>
<script>
var ctx = document.getElementById('cute').getContext('2d');
var cute = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo $title_hits; ?>,
        datasets: [{
            label: '# of Month',
            data: <?php echo $view_hits; ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(89, 233, 28, 0.2)',
				'rgba(255, 5, 5, 0.2)',
                'rgba(255, 128, 0, 0.2)',
                'rgba(153, 153, 153, 0.2)',
                'rgba(15, 207, 210, 0.2)',
                'rgba(44, 13, 181, 0.2)',
                'rgba(86, 172, 12, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(89, 233, 28, 1)',
				'rgba(255, 5, 5, 1)',
                'rgba(255, 128, 0, 1)',
                'rgba(153, 153, 153, 1)',
                'rgba(15, 207, 210, 1)',
                'rgba(44, 13, 181, 1)',
                'rgba(86, 172, 12, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Article Views/Hits'
            }
        }
    }
});
</script>
	</div>
</div>
      

<?php echo $title_hits; ?>
	
</div>