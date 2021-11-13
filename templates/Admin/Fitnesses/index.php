<script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
<?php
	use Cake\Routing\Router;
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
?>
<div class="container"><!--Container Start-->
<!--Top Menu Start-->
<div class="text-end pt-2 pb-2">
	<div class="btn-group" role="group" aria-label="Basic outlined example">
		<?= $this->Html->link(__('<i class="fas fa-plus fa-sm"></i>'), ['action' => 'add'], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'New']) ?>
		<?= $this->Html->link(__('<i class="fas fa-search fa-sm"></i>'), ['action' => ''], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'type' => 'button', 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#flush-search', 'aria-expanded' => 'false', 'aria-controls' => 'flush-search', 'title' => 'Search']) ?>
		<?php if (!empty($_isSearch)) {
			echo $this->Html->link(__('<i class="fas fa-sync-alt fa-sm"></i>'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Reset']);
		} ?>
	</div>
</div>
<!--Top Menu End-->
<!--Search Form Start-->
<div class="accordion accordion-flush" id="search">
	<div class="accordion-item">
		<div id="flush-search" class="accordion-collapse <?= (!empty($_isSearch)) == ''?'collapse':'' ?>" aria-labelledby="flush-headingOne" data-bs-parent="#search">
		<div class="accordion-body bg-light">
<?php echo $this->Form->create(null, ['valueSources' => 'query']); ?>

  <div class="row">
    <div class="col">
            <label>Type of Excercise</label><br>
		<?php
		 echo $this->Form->radio(
			'type',
			[
				['value' => 'Sit-Up', 'text' => 'Sit-Up', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
				['value' => 'Pushups', 'text' => 'Pushups', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
				['value' => 'Star-Jumps', 'text' => 'Star-Jumps', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
				['value' => 'Squats', 'text' => 'Squats', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
				['value' => 'Planks', 'text' => 'Planks', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
				['value' => 'Burpees', 'text' => 'Burpees', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
			]
		);
		 ?>
    </div>
  </div>
  



  
  <div class="row">
    <div class="col">
            <?php echo $this->Form->control('registered_from',[
                          'class' => 'form-control datepicker-here', 
                          'label' => 'Registered On',
                          'id' => 'registered_from',
                          'type' => 'Text',
                          'data-language' => 'en',
                          'data-date-format' => 'Y-m-d',
                          //'value' => date('Y-m-d'),
                          'empty'=>'empty',
						  'autocomplete' => 'off',
                    ]); ?>
    </div>
    <div class="col">
            <?php echo $this->Form->control('registered_to',[
                          'class' => 'form-control datepicker-here', 
                          'label' => 'Registered On',
                          'id' => 'registered_to',
                          'type' => 'Text',
                          'data-language' => 'en',
                          'data-date-format' => 'Y-m-d',
                          //'value' => date('Y-m-d'),
                          'empty'=>'empty',
						  'autocomplete' => 'off',
                    ]); ?>
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function() {
    //$('.select2').select2();
}
);
</script>
		<div class="text-end">
			<?php
			if (!empty($_isSearch)) {
			echo ' ';
			echo $this->Html->link(__('Reset'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm mx-1', 'title' => 'Reset']);
			} 
			echo $this->Form->button(__('Search'), ['class' => 'btn btn-outline-secondary btn-sm', 'title' => 'Search']);
			echo $this->Form->end();
			?>
		</div>
		</div>
		</div>
	</div>
</div>
<!--Search Form End-->

<div class="row">
	<div class="col-md-4">
		<div class="card-fitness medal px-4 py-4">
			<div class="dashboard-title fw-bold pb-3">Congratulations 🎉 <?php echo $this->Identity->get('username'); ?>!</div>
			<div class="text-small pt-2">You've been active!</div>
			<div class="text-left fs-1 pt-2"><?php echo $this->Number->format($sum_current_year_fitnesses); ?></div>
			<div class="text-small pt-2">Total movement in <?php echo date('Y'); ?>: <?php echo $sum_current_year_fitnesses_event; ?></div>
			content
		</div>
	</div>
	<div class="col-md-8">
		<div class="card-fitness px-4 py-4">
			<div class="dashboard-title fw-bold pb-4"><?php echo date('Y'); ?> Report</div>
			
  <div class="row text-center current-year-text">
    <div class="col border-end">
		<div class="fs-4 pt-2"><?php echo $this->Number->format($sum_current_year_sit_up); ?></div>
		<div class="badge bg-primary text-light text-wrap mb-3">Sit-Up</div>
    </div>
    <div class="col border-end">
		<div class="fs-4 pt-2"><?php echo $this->Number->format($sum_current_year_pushups); ?></div>
		<div class="badge bg-primary text-light text-wrap mb-3">Pushups</div>
    </div>
    <div class="col border-end">
		<div class="fs-4 pt-2"><?php echo $this->Number->format($sum_current_year_planks); ?></div>
		<div class="badge bg-primary text-light text-wrap mb-3">Planks</div>
    </div>
    <div class="col border-end">
		<div class="fs-4 pt-2"><?php echo $this->Number->format($sum_current_year_star); ?></div>
		<div class="badge bg-primary text-light text-wrap mb-3">Jumps</div>
    </div>
    <div class="col border-end">
		<div class="fs-4 pt-2"><?php echo $this->Number->format($sum_current_year_squats); ?></div>
		<div class="badge bg-primary text-light text-wrap mb-3">Squats</div>
    </div>
    <div class="col">
		<div class="fs-4 pt-2"><?php echo $this->Number->format($sum_current_year_burpees); ?></div>
		<div class="badge bg-primary text-light text-wrap mb-3">Burpees</div>
    </div>
  </div>			
  
  <div class="text-small pt-2 text-center">All data from year <?php echo date('Y'); ?> is counted.</div>
		</div>
	</div>
</div>
  
<div class="row">
	<div class="col-md-6">
		<div class="card-fitness px-4 py-4">
<canvas id="current_year_montly" width="600" height="230" class="bg-white2"></canvas>
<script>
var ctx = document.getElementById('current_year_montly').getContext('2d');
var current_year_montly = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
			{
            label: '# of Run/Walk',
            data: [<?= $jan_run_cy; ?>, <?= $feb_run_cy; ?>, <?= $mar_run_cy; ?>, <?= $apr_run_cy; ?>, <?= $may_run_cy; ?>, <?= $jun_run_cy; ?>, <?= $jul_run_cy; ?>, <?= $aug_run_cy; ?>, <?= $sep_run_cy; ?>, <?= $oct_run_cy; ?>, <?= $nov_run_cy; ?>, <?= $dec_run_cy; ?>],
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
            label: '# of Sit-Up',
            data: [<?= $jan_sit_cy; ?>, <?= $feb_sit_cy; ?>, <?= $mar_sit_cy; ?>, <?= $apr_sit_cy; ?>, <?= $may_sit_cy; ?>, <?= $jun_sit_cy; ?>, <?= $jul_sit_cy; ?>, <?= $aug_sit_cy; ?>, <?= $sep_sit_cy; ?>, <?= $oct_sit_cy; ?>, <?= $nov_sit_cy; ?>, <?= $dec_sit_cy; ?>],
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
            label: '# of Pushups',
            data: [<?= $jan_pushups_cy; ?>, <?= $feb_pushups_cy; ?>, <?= $mar_pushups_cy; ?>, <?= $apr_pushups_cy; ?>, <?= $may_pushups_cy; ?>, <?= $jun_pushups_cy; ?>, <?= $jul_pushups_cy; ?>, <?= $aug_pushups_cy; ?>, <?= $sep_pushups_cy; ?>, <?= $oct_pushups_cy; ?>, <?= $nov_pushups_cy; ?>, <?= $dec_pushups_cy; ?>],
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
            label: '# of Planks',
            data: [<?= $jan_planks_cy; ?>, <?= $feb_planks_cy; ?>, <?= $mar_planks_cy; ?>, <?= $apr_planks_cy; ?>, <?= $may_planks_cy; ?>, <?= $jun_planks_cy; ?>, <?= $jul_planks_cy; ?>, <?= $aug_planks_cy; ?>, <?= $sep_planks_cy; ?>, <?= $oct_planks_cy; ?>, <?= $nov_planks_cy; ?>, <?= $dec_planks_cy; ?>],
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
            label: '# of Star-Jumps',
            data: [<?= $jan_star_cy; ?>, <?= $feb_star_cy; ?>, <?= $mar_star_cy; ?>, <?= $apr_star_cy; ?>, <?= $may_star_cy; ?>, <?= $jun_star_cy; ?>, <?= $jul_star_cy; ?>, <?= $aug_star_cy; ?>, <?= $sep_star_cy; ?>, <?= $oct_star_cy; ?>, <?= $nov_star_cy; ?>, <?= $dec_star_cy; ?>],
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
            label: '# of Squats',
            data: [<?= $jan_squats_cy; ?>, <?= $feb_squats_cy; ?>, <?= $mar_squats_cy; ?>, <?= $apr_squats_cy; ?>, <?= $may_squats_cy; ?>, <?= $jun_squats_cy; ?>, <?= $jul_squats_cy; ?>, <?= $aug_squats_cy; ?>, <?= $sep_squats_cy; ?>, <?= $oct_squats_cy; ?>, <?= $nov_squats_cy; ?>, <?= $dec_squats_cy; ?>],
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
            label: '# of Burpees',
            data: [<?= $jan_burpees_cy; ?>, <?= $feb_burpees_cy; ?>, <?= $mar_burpees_cy; ?>, <?= $apr_burpees_cy; ?>, <?= $may_burpees_cy; ?>, <?= $jun_burpees_cy; ?>, <?= $jul_burpees_cy; ?>, <?= $aug_burpees_cy; ?>, <?= $sep_burpees_cy; ?>, <?= $oct_burpees_cy; ?>, <?= $nov_burpees_cy; ?>, <?= $dec_burpees_cy; ?>],
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
		]
    },
    options: {
	  plugins: {
		legend: {
		  display: false,
		  fontColor: "white",
		},
		title: {
                display: true,
                text: 'Montly Activities Comparison'
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
	<div class="col-md-6">
		<div class="card-fitness px-4 py-4">
<canvas id="current_year_exercise" width="600" height="230" class="bg-white2"></canvas>
<script>
var ctx = document.getElementById('current_year_exercise').getContext('2d');
var current_year_exercise = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Sit-Up', 'Pushups', 'Planks', 'Star-Jumps', 'Squats', 'Burpees'],
        datasets: [
			{
            label: '# of Sit-Up',
            data: [<?= $sum_current_year_sit_up; ?>, <?= $sum_current_year_pushups; ?>, <?= $sum_current_year_planks; ?>, <?= $sum_current_year_star; ?>, <?= $sum_current_year_squats; ?>, <?= $sum_current_year_burpees; ?>],
			tension: 0.2,
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
        }
		]
    },
    options: {
	  plugins: {
		legend: {
		  display: false,
		  fontColor: "white",
		},
		title: {
                display: true,
                text: 'Exercise Performed by Activties Type'
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

<div class="row">
	<div class="col-md-4">
		<div class="card-fitness walk px-4 py-4">
			<div class="dashboard-title fw-bold pb-4"><?php echo date('Y'); ?> Running/Walking Report</div>
			<div class="text-small pt-2">You've been active!</div>
			<div class="text-left fs-1 pt-2"><?php echo $this->Number->format($sum_current_year_running); ?> <span class="text-primary fs-3"><i class="fas fa-walking"></i> km</span></div>
			<div class="text-small pt-2">Total Running/Walking Events: <?php echo $running_event; ?></div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card-fitness bicycle px-4 py-4">
			<div class="dashboard-title fw-bold pb-4"><?php echo date('Y'); ?> Cycling Report</div>
			<div class="text-small pt-2">You've been active!</div>
			<div class="text-left fs-1 pt-2"><?php echo $this->Number->format($sum_current_year_cycling); ?> <span class="text-primary fs-3"><i class="fas fa-biking"></i> km</span></div>
			<div class="text-small pt-2">Total Cycling Events: <?php echo $cycling_event; ?></div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card-fitness px-4 py-4">
			<div class="dashboard-title fw-bold pb-4">Overall Report</div>
			<div class="text-small pt-2">You've been active!</div>
			<div class="text-left fs-1 pt-2"><?php echo $this->Number->format($sum_overall_fitnesses); ?> <span class="text-primary fs-3">Movements</span></div>
			<div class="text-small pt-2">Total Excercise Events: <?php echo $sum_overall_fitnesses_event; ?></div>
		</div>
	</div>
</div>
  

  
<hr>  
  
  <div class="row pt-3">
    <div class="col">
      <?php echo $this->element('report/fitness_activity'); ?>
    </div>
    <div class="col">
      Column
    </div>
  </div>
  





<div class="card mb-3 shadow module-blue-big border borderless mt-3">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Fitness Management
		<div class=" text-light contribution_counter_month">Code The Pixel</div>
	</div>
  <div class="card-body bg-light border borderless px-0">

    <div class="table-responsive">
	
        <table class="table text-secondary mt-4 px-1 table-sm">
            <thead>
                <tr>
                    <th class="px-3"><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('counter') ?></th>
                    <th><?= $this->Paginator->sort('latitude') ?></th>
                    <th><?= $this->Paginator->sort('longitude') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('registered_on') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fitnesses as $fitness): ?>
                <tr>
                    <td class="px-3"><?= $this->Number->format($fitness->id) ?></td>
                    <td><?= $fitness->has('user') ? $this->Html->link($fitness->user->username, ['controller' => 'Users', 'action' => 'view', $fitness->user->id]) : '' ?></td>
                    <td><?= h($fitness->type) ?></td>
                    <td><?= $this->Number->format($fitness->counter) ?></td>
                    <td><?= h($fitness->latitude) ?></td>
                    <td><?= h($fitness->longitude) ?></td>
                    <td><?= $this->Number->format($fitness->status) ?></td>
                    <td><?= h($fitness->registered_on) ?></td>
                    <td><?= h($fitness->created) ?></td>
                    <td style="text-align: center;" class="px-3">
					<div class="dropdown">
					  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fas fa-bars text-primary"></i>
					  </button>
					  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
						<?= $this->Html->link(__('<i class="fas fa-plus"></i> View'), ['action' => 'view', $fitness->id, 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
						<?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['action' => 'edit', $fitness->id, 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
						<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fitness->id, 'prefix' => 'Admin'], ['confirm' => __('Are you sure you want to delete # {0}?', $fitness->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
					  </ul>
					</div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <div class="paginator px-3">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>

  </div>
</div>


</div><!--Container End-->

<script>
$('#registered_from').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>

<script>
$('#registered_to').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>