<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" integrity="sha256-TQq84xX6vkwR0Qs1qH5ADkP+MvH0W+9E7TdHJsoIQiM=" crossorigin="anonymous"></script>

<div class="container pt-5">

<?php echo $this->element('report/current_year_published'); ?>

<div class="card mb-3 shadow module-blue-big border borderless mt-3">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Article Report
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-light border borderless">
			
		</div>
</div>

  <div class="row">
    <div class="col-md-4">
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
		title: {
			display: true,
			text: 'Article Published (Monthly)'
		},
	legend: {
		display: false,
		position: 'top',
			labels: {
			  boxWidth: 40,
			  fontColor: 'black'
			}
	},
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
    </div>
    <div class="col-md-4">
      Column
    </div>
    <div class="col-md-4">
      Column
    </div>
  </div>
	
	
</div>