<?php

use Cake\Routing\Router;

echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
echo $this->Html->css('jquery.datetimepicker.min.css');
echo $this->Html->script('jquery.datetimepicker.full.js');
echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
$c_name = $this->request->getParam('controller');
echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
?>
<!--Header-->
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">
		<div class="dropdown mx-3 mt-2">
			<button class="btn p-0 border-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa-solid fa-bars text-primary"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
				<li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> New Faq'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			</div>
		</div>
	</div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<!--Column-->
<div class="row">
	<div class="col-md-9">
		<div class="nav-align-top mb-4">
			<ul class="nav nav-tabs nav-fill border-bottom mb-4" role="tablist">
				<li class="nav-item">
					<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-list" aria-controls="navs-top-list" aria-selected="true"><i class="fa-solid fa-bars-staggered"></i> List</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-report" aria-controls="navs-top-report" aria-selected="false"><i class="fa-solid fa-chart-line"></i> Report</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-export" aria-controls="navs-top-export" aria-selected="false"><i class="fa-solid fa-download"></i> Export</button>
				</li>
			</ul>
		</div>


		<div class="tab-content px-0">
			<div class="tab-pane fade active show" id="navs-top-list" role="tabpanel">
				<div class="card bg-body-tertiary border-0 shadow mb-4">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-sm table-border mb-0 table_transparent table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th><?= $this->Paginator->sort('id') ?></th>
										<th><?= $this->Paginator->sort('category') ?></th>
										<th><?= $this->Paginator->sort('question') ?></th>
										<th><?= $this->Paginator->sort('answer') ?></th>
										<th class="text-center"><?= $this->Paginator->sort('status') ?></th>
										<th><?= $this->Paginator->sort('created') ?></th>
										<th class="text-center"><?= __('Actions') ?></th>
									</tr>
								</thead>
								<?php
								$page = $this->Paginator->counter('{{page}}');
								$limit = 10;
								$counter = ($page * $limit) - $limit + 1;
								?>
								<?php foreach ($faqs as $faq) : ?>
									<tr>
										<td><?php echo $counter++ ?></td>
										<td><?= h($faq->id) ?></td>
										<td><?= h($faq->category) ?></td>
										<td><?= h($faq->question) ?></td>
										<td><?= h($faq->answer) ?></td>
										<td class="text-center">
											<?php if ($faq->status == 1) {
												echo '<span class="badge bg-success">Active</span>';
											} elseif ($faq->status == 0) {
												echo '<span class="badge bg-danger">Disabled</span>';
											} else
												echo '<span class="badge bg-secondary">Archived</span>';
											?>
										</td>
										<td><?php echo date('M d, Y (h:i A)', strtotime($faq->created)); ?></td>
										<td class="actions text-center">
											<div class="btn-group shadow" role="group" aria-label="Basic example">
												<?= $this->Html->link(__('<i class="far fa-folder-open"></i>'), ['action' => 'view', $faq->id], ['class' => 'btn btn-outline-primary btn-xs', 'escapeTitle' => false]) ?>
												<?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i>'), ['action' => 'edit', $faq->id], ['class' => 'btn btn-outline-warning btn-xs', 'escapeTitle' => false]) ?>
												<?php $this->Form->setTemplates([
													'confirmJs' => 'addToModal("{{formName}}"); return false;'
												]); ?>
												<?= $this->Form->postLink(
													__('<i class="fa-regular fa-trash-can"></i>'),
													['action' => 'delete', $faq->id],
													[
														'confirm' => __('Are you sure you want to delete Faqs: "{0}"?', $faq->id),
														'title' => __('Delete'),
														'class' => 'btn btn-outline-danger btn-xs',
														'escapeTitle' => false,
														'data-bs-toggle' => "modal",
														'data-bs-target' => "#bootstrapModal"
													]
												) ?>
											</div>
										</td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>
						<div aria-label="Page navigation" class="mt-3 px-2">
							<ul class="pagination justify-content-end">
								<?= $this->Paginator->first('<< ' . __('First')) ?>
								<?= $this->Paginator->prev('< ' . __('Previous')) ?>
								<?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
								<?= $this->Paginator->next(__('Next') . ' >') ?>
								<?= $this->Paginator->last(__('Last') . ' >>') ?>
							</ul>
							<div class="text-end"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></div>
						</div>

					</div>


				</div>
			</div>

			<div class="tab-pane fade" id="navs-top-report" role="tabpanel">


				<div class="row pb-3">
					<div class="col-md-4">
						<div class="stat_card card-1 bg-body-tertiary border-0 shadow">
							<h3><?php echo $total_faqs; ?></h3>
							<p>Total Faqs</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat_card card-2 bg-body-tertiary border-0 shadow">
							<h3><?php echo $total_faqs_active; ?></h3>
							<p>Active Faqs</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat_card card-3 bg-body-tertiary border-0 shadow">
							<h3><?php echo $total_faqs_archived; ?></h3>
							<p>Archived Faqs</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="card bg-body-tertiary border-0 shadow mb-4">
							<div class="card-body">
								<div class="card-title mb-0">FAQs (Monthly)</div>
								<div class="tricolor_line mb-3"></div>
								<div class="chart-container" style="position: relative;">
									<canvas id="monthly"></canvas>
								</div>
								<script>
									const ctx = document.getElementById('monthly');
									const monthly = new Chart(ctx, {
										type: 'bar',
										data: {
											labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
											datasets: [{
												label: '# of Faqs(s)',
												data: [<?= json_encode($january); ?>, <?= json_encode($february); ?>, <?= json_encode($march); ?>, <?= json_encode($april); ?>, <?= json_encode($may); ?>, <?= json_encode($jun); ?>, <?= json_encode($july); ?>, <?= json_encode($august); ?>, <?= json_encode($september); ?>, <?= json_encode($october); ?>, <?= json_encode($november); ?>, <?= json_encode($december); ?>],
												backgroundColor: [
													'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(89, 233, 28, 0.2)', 'rgba(255, 5, 5, 0.2)', 'rgba(255, 128, 0, 0.2)', 'rgba(153, 153, 153, 0.2)', 'rgba(15, 207, 210, 0.2)', 'rgba(44, 13, 181, 0.2)', 'rgba(86, 172, 12, 0.2)'
												],
												borderColor: [
													'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(89, 233, 28, 1)', 'rgba(255, 5, 5, 1)', 'rgba(255, 128, 0, 1)', 'rgba(153, 153, 153, 1)', 'rgba(15, 207, 210, 1)', 'rgba(44, 13, 181, 1)', 'rgba(86, 172, 12, 1)'
												],
												borderWidth: 1
											}]
										},
										options: {
											scales: {
												y: {
													beginAtZero: true
												}
											},
											plugins: {
												title: {
													display: false,
													text: 'Faqs (Monthly)',
													font: {
														size: 15
													}
												},
												subtitle: {
													display: false,
													text: '<?php echo $system_name; ?>'
												},
												legend: {
													display: false,
													labels: {
														color: 'rgb(255, 99, 132)'
													}
												},
											}
										}
									});
								</script>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card bg-body-tertiary border-0 shadow mb-4">
							<div class="card-body">
								<div class="card-title mb-0">FAQs by Status</div>
								<div class="tricolor_line mb-3"></div>
								<div class="chart-container" style="position: relative;">
									<canvas id="status"></canvas>
								</div>
								<script>
									const ctx_2 = document.getElementById('status');
									const status = new Chart(ctx_2, {
										type: 'bar',
										data: {
											labels: ['Active', 'Disabled', 'Archived'],
											datasets: [{
												label: '# of Faqs(s)',
												data: [<?= json_encode($total_faqs_active); ?>, <?= json_encode($total_faqs_disabled); ?>, <?= json_encode($total_faqs_archived); ?>],
												backgroundColor: [
													'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)',
												],
												borderColor: [
													'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)',
												],
												borderWidth: 1
											}]
										},
										options: {
											scales: {
												y: {
													beginAtZero: true
												}
											},
											plugins: {
												title: {
													display: false,
													text: 'Faqs by Status',
													font: {
														size: 15
													}
												},
												subtitle: {
													display: false,
													text: '<?php echo $system_name; ?>'
												},
												legend: {
													display: false,
													labels: {
														color: 'rgb(255, 99, 132)'
													}
												},
											}
										}
									});
								</script>
							</div>
						</div>
					</div>
				</div>


			</div>


			<div class="tab-pane fade" id="navs-top-export" role="tabpanel">
				<?php
				$domain = Router::url("/", true);
				$sub = 'faqs';
				$combine = $domain . $sub;
				?>
				<div class="row pb-3">
					<div class="col-md-3 mb-2">
						<a href='<?php echo $combine; ?>/csv' class="kosong">
							<div class="card border-0 shadow bg-body-tertiary">
								<div class="card-body">
									<div class="row mx-0">
										<div class="col-5 text-center mt-3 mb-3"><i class="fa-solid fa-file-csv fa-2x text-primary" style=""></i></div>
										<div class="col-7 text-end m-auto">
											<div class="fs-4 fw-bold">CSV</div>
											<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 mb-2">
						<a href='<?php echo $combine; ?>/json' class="kosong" target="_blank">
							<div class="card border-0 shadow bg-body-tertiary">
								<div class="card-body">
									<div class="row mx-0">
										<div class="col-5 text-center mt-3 mb-3"><i class="fa-solid fa-braille fa-2x text-warning" style=""></i></div>
										<div class="col-7 text-end m-auto">
											<div class="fs-4 fw-bold">JSON</div>
											<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 mb-2">
						<a href='<?php echo $combine; ?>/pdfList' class="kosong">
							<div class="card border-0 shadow bg-body-tertiary">
								<div class="card-body">
									<div class="row mx-0">
										<div class="col-5 text-center mt-3 mb-3"><i class="fa-regular fa-file-pdf fa-2x text-danger" style=""></i></div>
										<div class="col-7 text-end m-auto">
											<div class="fs-4 fw-bold">PDF</div>
											<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div class="col-md-3">

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Search</div>
				<div class="tricolor_line mb-3"></div>
				<?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'Faqs', 'action' => 'index']]); ?>
				<fieldset>
					<div class="mb-1"><?php echo $this->Form->control('id', ['required' => false]); ?></div>
					<div class="mb-1"><?php echo $this->Form->control('question', ['required' => false]); ?></div>
					<div class="mb-1"><?php echo $this->Form->control('answer', ['required' => false]); ?></div>
					<div class="mb-1">
						<?php echo $this->Form->label('Category'); ?><br>
						<?php
						$options = [
							'General' => 'General',
							'Account' => 'Account',
							'Other' => 'Other',
						];
						echo $this->Form->select('category', $options, [
							'multiple' => 'checkbox',
							'class' => 'form-check-input'
						]);
						?>
					</div>
					<div class="mb-1">
						<?php echo $this->Form->label('Status'); ?><br>
						<?php
						$options = [
							'1' => 'Active',
							'0' => 'Disabled',
							'2' => 'Archived',
						];
						echo $this->Form->select('status', $options, [
							'multiple' => 'checkbox',
							'class' => 'form-check-input'
						]);
						?>
					</div>
				</fieldset>
				<div class="text-end">
					<?php
					if (!empty($_isSearch)) {
						echo ' ';
						echo $this->Html->link(__('Reset'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-warning btn-sm']);
					}
					echo '&nbsp;&nbsp;';
					echo $this->Form->button(__('Search'), ['class' => 'btn btn-outline-primary btn-sm']);
					?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>

	</div>
</div>


<div class="modal" id="bootstrapModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirm</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">
				<i class="fa-solid fa-triangle-exclamation fa-6x text-danger mb-3"></i>
				<p id="confirmMessage"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" id="ok">OK</button>
			</div>
		</div>
	</div>
</div>