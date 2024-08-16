<?php
echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
echo $this->Html->css('jquery.datetimepicker.min.css');
echo $this->Html->script('jquery.datetimepicker.full.js');
?>
<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Article> $articles
 */

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
				<li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> New Article'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			</div>
		</div>
	</div>
</div>
<div class="line mb-4"></div>
<!--/Header-->
<div class="row">
	<div class="col-md-9">
		<!-- Nav tabs -->
		<div class="nav-align-top mb-4">
			<ul class="nav nav-tabs nav-fill border-bottom mb-4" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-bs-toggle="tab" href="#list"><i class="fa-solid fa-bars-staggered"></i> List</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#report"><i class="fa-solid fa-chart-line"></i> Report</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-bs-toggle="tab" href="#export"><i class="fa-solid fa-download"></i> Export</a>
				</li>
			</ul>
		</div>


		<div class="tab-content px-0">
			<div class="tab-pane fade active show" id="list">
				<div class="card bg-body-tertiary border-0 shadow mb-4">
					<div class="card-body text-body-secondary">
						<!-- Tab panes -->
						<div class="table-responsive">
							<table class="table table-sm table-border mb-4 table_transparent table-hover">
								<thead>
									<?php
									$page = $this->Paginator->counter('{{page}}');
									$limit = 10;
									$counter = ($page * $limit) - $limit + 1;
									?>
									<tr>
										<th>#</th>
										<th class="px-3"><?= $this->Paginator->sort('category_id') ?></th>
										<th><?= $this->Paginator->sort('title') ?></th>
										<th style="text-align: center;"><?= $this->Paginator->sort('featured') ?></th>
										<th style="text-align: center;"><?= $this->Paginator->sort('published') ?></th>
										<th style="text-align: center;"><?= $this->Paginator->sort('hits') ?></th>
										<th style="text-align: center;"><?= $this->Paginator->sort('user_id', 'Author') ?></th>
										<th style="text-align: center;"><?= $this->Paginator->sort('publish_on') ?></th>
										<th style="text-align: center;"><?= $this->Paginator->sort('id') ?></th>
										<th class="actions"><?= __('Actions') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($articles as $article): ?>
										<tr>
											<td><?php echo $counter++ ?></td>



											<td class="px-3"><?= $article->has('category') ? $this->Html->link($article->category->title, ['controller' => 'Categories', 'action' => 'view', $article->category->id]) : '' ?>
											</td>
											<td><?= h($article->title) ?>
												<a class="btn p-0" data-bs-toggle="collapse" href="#collapse<?= h($article->id) ?>" role="button" aria-expanded="false" aria-controls="collapse<?= h($article->id) ?>">
													<i class="far fa-caret-square-down"></i>
												</a>

												<div class="collapse" id="collapse<?= h($article->id) ?>">
													<b>Tags:</b> <?php echo h($article->tag_list); ?>
												</div>
											</td>
											<td style="text-align: center;">
												<?php if ($article->featured == 1) {
													echo '<i class="fas fa-star text-warning"></i>';
												} else
													echo '<i class="far fa-star text-secondary"></i>';
												?>
											</td>
											<td style="text-align: center;">
												<?php if ($article->published == 1) {
													echo '<i class="fas fa-circle text-success"></i>';
												} else
													echo '<i class="fas fa-circle text-danger"></i>';
												?>
											</td>
											<td style="text-align: center;"><?= $this->Number->format($article->hits) ?></td>
											<td style="text-align: center;"><?= $article->hasValue('user') ? $this->Html->link($article->user->fullname, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></td>
											<td style="text-align: center;"><?= date('d M Y', strtotime($article->publish_on)); ?></td>
											<td style="text-align: center;"><?= h($article->id) ?></td>



											<td class="actions text-center">
												<div class="btn-group shadow" role="group" aria-label="Basic example">
													<?= $this->Html->link(__('<i class="far fa-folder-open"></i>'), ['action' => 'view', 'prefix' => false, $article->slug], ['class' => 'btn btn-outline-primary btn-xs', 'escapeTitle' => false]) ?>
													<?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i>'), ['action' => 'edit', $article->id], ['class' => 'btn btn-outline-warning btn-xs', 'escapeTitle' => false]) ?>
													<?php $this->Form->setTemplates([
														'confirmJs' => 'addToModal("{{formName}}"); return false;'
													]); ?>
													<?= $this->Form->postLink(
														__('<i class="fa-regular fa-trash-can"></i>'),
														['action' => 'delete', $article->id],
														[
															'confirm' => __('Are you sure you want to delete Articles: "{0}"?', $article->id),
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
								</tbody>
							</table>
						</div>
						<div aria-label="Page navigation" class="mt-3 px-2">
							<ul class="pagination justify-content-end flex-wrap">
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
			<div class="tab-pane container fade px-0" id="report">
				<div class="row pb-3">
					<div class="col-md-4">
						<div class="stat_card card-1 bg-body-tertiary">
							<h3><?php echo $total_articles; ?></h3>
							<p>Total Articles</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat_card card-2 bg-body-tertiary">
							<h3><?php echo $total_articles_active; ?></h3>
							<p>Active Articles</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat_card card-3 bg-body-tertiary">
							<h3><?php echo $total_articles_archived; ?></h3>
							<p>Archived Articles</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="card bg-body-tertiary border-0 shadow mb-4">
							<div class="card-body">
								<div class="card-title mb-0">Articles (Monthly)</div>
								<div class="tricolor_line mb-3"></div>
								<div class="chart-container" style="position: relative;">
									<canvas id="monthly"></canvas>
								</div>
								<script>
									const ctx = document.getElementById('monthly');
									const monthly = new Chart(ctx, {
										type: 'bar',
										data: {
											labels: <?php echo json_encode($monthArray); ?>,
											datasets: [{
												label: '# of Articles(s)',
												data: <?php echo json_encode($countArray); ?>,
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
													text: 'Articles (Monthly)',
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
								<div class="card-title mb-0">Articles by Status</div>
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
												label: '# of Articles(s)',
												data: [<?= json_encode($total_articles_active); ?>, <?= json_encode($total_articles_disabled); ?>, <?= json_encode($total_articles_archived); ?>],
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
													text: 'Articles by Status',
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


			<div class="tab-pane container fade px-0" id="export">
				<?php
				$domain = Router::url("/", true);
				$sub = 'articles';
				$combine = $domain . $sub;
				?>
				<div class="row pb-3">
					<div class="col-md-3 mb-2">
						<a href='<?php echo $combine; ?>/csv' class="kosong">
							<div class="card bg-body-tertiary border-0 shadow">
								<div class="card-body">
									<div class="row mx-0">
										<div class="col-5 text-center mt-3 mb-3"><i class="fa-solid fa-file-csv fa-2x text-primary"></i></div>
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
							<div class="card bg-body-tertiary border-0 shadow">
								<div class="card-body">
									<div class="row mx-0">
										<div class="col-5 text-center mt-3 mb-3"><i class="fa-solid fa-braille fa-2x text-warning"></i></div>
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
							<div class="card bg-body-tertiary border-0 shadow">
								<div class="card-body">
									<div class="row mx-0">
										<div class="col-5 text-center mt-3 mb-3"><i class="fa-regular fa-file-pdf fa-2x text-danger"></i></div>
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
				<?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'Articles', 'action' => 'index']]); ?>
				<fieldset>
					<div class="mb-1"><?php echo $this->Form->control('id', ['required' => false, 'class' => 'form-control border-0']); ?></div>
					<div class="mb-1"><?php echo $this->Form->control('title', ['required' => false, 'class' => 'form-control border-0']); ?></div>
					<div class="mb-1"><?php echo $this->Form->control('category_id', [
											'options' => $categories,
											'empty' => 'Select Category',
											'class' => 'form-select border-0',
											'required' => false
										]); ?>
					</div>
					<div class="mb-1"><?php echo $this->Form->control('tag', ['options' => $tags, 'id' => 'tagging', 'multiple' => true, 'class' => 'border-0']); ?></div>
					<script type="text/javascript">
						$(document).ready(function() {
							$('.select2').select2();
							$("#tagging").select2({
								tags: true,
								placeholder: "Tagging",
								tokenSeparators: [','],
								allowClear: true
							});
						});
					</script>

					<div class="row">
						<div class="col-md-6 col-xs-6">
							<?php echo $this->Form->control('publish_from', [
								'class' => 'form-control datepicker-here border-0',
								'label' => 'Published From',
								'id' => 'publish_from',
								'type' => 'Text',
								'data-language' => 'en',
								'data-date-format' => 'Y-m-d',
								//'value' => date('Y-m-d'),
								'empty' => 'empty',
								'autocomplete' => 'off',
							]); ?>
							<script>
								$('#publish_from').datetimepicker({
									lang: 'en',
									timepicker: false,
									format: 'Y-m-d',
									formatDate: 'Y/m/d',
									//minDate:'-1970/01/01', // yesterday is minimum date
									//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
								});
							</script>
						</div>
						<div class="col-md-6 col-xs-6">
							<?php echo $this->Form->control('publish_to', [
								'class' => 'form-control datepicker-here border-0',
								'label' => 'Published To',
								'id' => 'publish_to',
								'type' => 'Text',
								'data-language' => 'en',
								'data-date-format' => 'Y-m-d',
								//'value' => date('Y-m-d'),
								'empty' => 'empty',
								'autocomplete' => 'off',
							]); ?>
							<script>
								$('#publish_to').datetimepicker({
									lang: 'en',
									timepicker: false,
									format: 'Y-m-d',
									formatDate: 'Y/m/d',
									//minDate:'-1970/01/01', // yesterday is minimum date
									//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
								});
							</script>
						</div>
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
				<i class="fa-regular fa-circle-xmark fa-6x text-danger mb-3"></i>
				<p id="confirmMessage"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" id="ok">OK</button>
			</div>
		</div>
	</div>
</div>