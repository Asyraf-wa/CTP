<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Project> $projects
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" type='text/css' href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" />

<div class="container pt-4 pb-0">
	<div class="row mb-2">
		<div class="col-md-6">
			Asyraf-wa / <span class="fw-bold">Projects</span>
		</div>
		<div class="col-md-6 text-end">
			<button type="button" class="btn btn-secondary border me-2" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .75rem;"><i class="fa-regular fa-bell me-2"></i> Notifications</button>
			<button type="button" class="btn btn-secondary border me-2" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .75rem;"><i class="fa-solid fa-code-fork me-2"></i> Fork</button>
			<button type="button" class="btn btn-secondary border" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .75rem;"><i class="fa-regular fa-star me-2"></i> Star</button>
		</div>
	</div>

	<div class="horizontal-tabs border-bottom">
		<?= $this->Html->link(__('<i class="fa-solid fa-code me-2"></i> Code'), ['controller' => 'Projects'], ['class' => 'topMenu', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="fa-solid fa-triangle-exclamation me-2"></i> Issues'), ['controller' => 'Projects'], ['class' => 'topMenu', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="fa-solid fa-code-pull-request me-2"></i> Pull requests'), ['controller' => 'Projects'], ['class' => 'topMenu', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="fa-regular fa-circle-play me-2"></i> Actions'), ['controller' => 'Projects'], ['class' => 'topMenu', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="fa-regular fa-folder-closed me-2"></i> Projects'), ['controller' => 'Projects'], ['class' => 'topMenu active', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="fa-solid fa-book-open me-2"></i> Wiki'), ['controller' => 'Projects'], ['class' => 'topMenu', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="fa-solid fa-shield-halved me-2"></i> Security'), ['controller' => 'Projects'], ['class' => 'topMenu', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="fa-solid fa-chart-line me-2"></i> Insights'), ['controller' => 'Projects'], ['class' => 'topMenu', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="fa-solid fa-gear me-2"></i> Settings'), ['controller' => 'Projects'], ['class' => 'topMenu', 'escape' => false]) ?>
	</div>

	<div class="row mt-4">
		<div class="col-md-9">
			<div class="row mt-3">
				<div class="col-md-6">
					<button type="button" class="btn btn-secondary me-3 pe-3"><i class="fa-solid fa-code-branch me-2 ms-2"></i> 2.x <i class="fa-solid fa-caret-down ms-2"></i></button>
					<button type="button" class="btn bg-body"><i class="fa-solid fa-code-branch me-2 ms-2"></i> 4 Branches</button>
					<button type="button" class="btn bg-body"><i class="fa-solid fa-tag me-2 ms-2"></i></i> 11 Tags</button>
				</div>
				<div class="col-md-6 text-end">
					<button id="toggleAll" type="button" class="btn btn-secondary border">
						<i id="toggleIcon" class="fa-folder-open fa-regular"></i> Expand All
					</button>
					<button class="btn btn-success dropdown-toggle border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fa-solid fa-code"></i> Code
					</button>
					<div class="dropdown-menu">
						<div class="card border-0" style="width: 400px;">
							<div class="card-body border-0">
								<div class="mb-3 fw-bold"><i class="fa-regular fa-file-code me-3"></i>Clone</div>
								<div class="row">
									<div class="col-11 pe-0"><input type="text" class="form-control" id="copyInput" value="https://github.com/Asyraf-wa/recrud.git"></div>
									<div class="col-1 ps-0"><button class="btn btn-outline-secondary border-0" type="button" id="copyButton"><i class="fa-regular fa-copy"></i></button></div>
								</div>


								<script>
									document.getElementById('copyButton').addEventListener('click', function() {
										var copyText = document.getElementById('copyInput');
										copyText.select();
										copyText.setSelectionRange(0, 99999); // For mobile devices
										document.execCommand('copy');
										alert('Copied the text: ' + copyText.value);
									});
								</script>
								<hr />
								Clone using the web URL.
								<hr />
								Open with GitHub Desktop
								<hr />
								Download ZIP
							</div>
						</div>
					</div>
				</div>
			</div>




			<div class="table-responsive mt-4">
				<table class="table table-hover">
					<tr class="table-secondary">
						<td colspan="4" class="py-3 px-3">
							<div class="row">
								<div class="col-md-6"><i class="fa-solid fa-ghost mx-3"></i> <span class="fw-bold">Asyraf-wa</span> Update index.php</div>
								<div class="col-md-6 text-end">Latest commit 8008l355 2 hours ago</div>
							</div>

						</td>
					</tr>
					<?php foreach ($projects as $project): ?>
						<tr data-bs-toggle="collapse" data-bs-target="#row<?= h($project->id) ?>" class="table-row">
							<td width="40%"><i class="fa-solid fa-folder mx-3"></i> <?= h($project->title) ?></td>
							<td width="40%">
								<?php echo strip_tags($this->Text->truncate(
									$project->body,
									65,
									[
										'ellipsis' => '...',
										'exact' => false
									]
								)); ?>
							</td>
							<td width="10%" class="text-end"><?= h($project->year) ?></td>
							<td width="10%" class="text-end"><?= h($project->progress) ?></td>
						</tr>
						<tr id="row<?= h($project->id) ?>" class="collapse table-collapse">
							<td colspan="4">
								<div class="row mb-5">
									<div class="col-md-6">
										<?php echo $this->Html->image('../files/Projects/poster/' . $project->slug . '/' . $project->poster, ['class' => 'card-img-top', 'width' => '100%',  'alt' => $project->title]); ?>
									</div>
									<div class="col-md-6">
										<div class="card-title mt-3"><?= h($project->title) ?></div>
										<div class="tricolor_line mb-3"></div>

										<div class="table-responsive">
											<table class="table table-borderless table_transparent table-hover">
												<tr>
													<td>Year</td>
													<td>:</td>
													<td><?= ($project->year) ?></td>
												</tr>
												<tr>
													<td>Category</td>
													<td>:</td>
													<td><?= ($project->category) ?></td>
												</tr>
												<tr>
													<td>Status</td>
													<td>:</td>
													<td><?= ($project->progress) ?></td>
												</tr>
												<tr>
													<td>About</td>
													<td>:</td>
													<td class="text-justify"><?= ($project->body) ?></td>
												</tr>
												<tr>
													<td>Repository</td>
													<td>:</td>
													<td class="text-justify">
														<?php if ($project->repo == NULL) {
															echo '-';
														} else
															echo $this->Html->link(
																$project->title,
																$project->repo,
																['target' => '_blank', '_full' => true]
															)
														?>
													</td>
												</tr>
											</table>
										</div>
									</div>
								</div>



							</td>
						</tr>

					<?php endforeach; ?>

				</table>
			</div>

			<script>
				$(document).ready(function() {
					var isExpanded = false;

					$('#toggleAll').click(function() {
						if (isExpanded) {
							// Collapse all
							$('.table-collapse').collapse('hide');
							$('#toggleIcon').removeClass('fa-folder').addClass('fa-folder-open');
							$(this).html('<i id="toggleIcon" class="fa-regular fa-folder-open"></i> Expand All');
						} else {
							// Expand all
							$('.table-collapse').collapse('show');
							$('#toggleIcon').removeClass('fa-folder-open').addClass('fa-folder');
							$(this).html('<i id="toggleIcon" class="fa-solid fa-folder"></i> Collapse All');
						}
						isExpanded = !isExpanded;
					});

					$('.table-row').click(function() {
						var icon = $(this).find('i');
						if ($(this).next('.table-collapse').hasClass('show')) {
							icon.removeClass('fa-folder-open').addClass('fa-folder');
						} else {
							icon.removeClass('fa-folder').addClass('fa-folder-open');
						}
					});

					$('.table-collapse').on('hidden.bs.collapse', function() {
						$(this).prev('.table-row').find('i').removeClass('fa-folder-open').addClass('fa-folder');
					});

					$('.table-collapse').on('shown.bs.collapse', function() {
						$(this).prev('.table-row').find('i').removeClass('fa-folder').addClass('fa-folder-open');
					});
				});
			</script>

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

			<div class="row mt-5">
				<div class="col-md-4">
					<div class="card project_box project_box1 border-0">
						<div class='ribbon-featured'>Featured</div>
						<div class="card-body mx-3 my-3">
							<h4 class="fw-bold">Re-CRUD</h4>
							<div class="justify">Re-CRUD allows developers to construct complete Create Read Update Delete Search and Report CRUD components using the Re-CRUD generator.</div>
							<div class="my-4">Developed by Asyraf Wahi Anuar</div>
							<div class="dev_icon">
								<i class="devicon-cakephp-plain mx-1 my-1"></i>
								<i class="devicon-php-plain mx-1 my-1"></i>
								<i class="devicon-mysql-original mx-1 my-1"></i>
								<i class="devicon-apache-plain mx-1 my-1"></i>
								<i class="devicon-bootstrap-plain mx-1 my-1"></i>
								<i class="devicon-javascript-plain mx-1 my-1"></i>
								<i class="devicon-html5-plain mx-1 my-1"></i>
								<i class="devicon-css3-plain mx-1 my-1"></i>
								<i class="devicon-github-original mx-1 my-1"></i>
								<i class="devicon-composer-line mx-1 my-1"></i>
								<i class="devicon-androidstudio-plain mx-1 my-1"></i>
								<i class="devicon-powershell-plain mx-1 my-1"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card project_box project_box2 border-0">
						<div class='ribbon-featured'>Featured</div>
						<div class="card-body mx-3 my-3">
							<h4 class="fw-bold">e-XATT</h4>
							<div class="justify">The e-XATT system is an examination scheduling system that arranges the exam venue according to the number of students, taking into account factors such as consecutive examinations, student seating capacity, and room availability.</div>
							<div class="my-4">Developed by Asyraf Wahi Anuar</div>
							<div class="dev_icon">
								<i class="devicon-cplusplus-plain mx-1 my-1"></i>
								<i class="devicon-mongodb-plain mx-1 my-1"></i>
								<i class="devicon-github-original mx-1 my-1"></i>
								<i class="devicon-powershell-plain mx-1 my-1"></i>
								<i class="devicon-vscode-plain mx-1 my-1"></i>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card project_box project_box3 border-0">
						<div class='ribbon-featured'>Featured</div>
						<div class="card-body mx-3 my-3">
							<h4 class="fw-bold">Internship Info System</h4>
							<div class="justify">Internship Information System allows intern candidates to build their resumes, generate application correspondence, and manage their internship activities and logbooks.</div>
							<div class="my-4">Developed by Asyraf Wahi Anuar</div>
							<div class="dev_icon">
								<i class="devicon-cakephp-plain mx-1 my-1"></i>
								<i class="devicon-php-plain mx-1 my-1"></i>
								<i class="devicon-mysql-original mx-1 my-1"></i>
								<i class="devicon-apache-plain mx-1 my-1"></i>
								<i class="devicon-bootstrap-plain mx-1 my-1"></i>
								<i class="devicon-javascript-plain mx-1 my-1"></i>
								<i class="devicon-html5-plain mx-1 my-1"></i>
								<i class="devicon-css3-plain mx-1 my-1"></i>
								<i class="devicon-github-original mx-1 my-1"></i>
								<i class="devicon-composer-line mx-1 my-1"></i>
								<i class="devicon-powershell-plain mx-1 my-1"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-3">
			<div class="mb-3 fw-bold fs-5">About</div>
			<div class="text-justify">Welcome to my project portfolio! This page showcases a collection of my completed and ongoing projects. Here, you’ll find detailed descriptions, progress updates, and outcomes of each project, highlighting my skills and expertise in various domains. Whether you’re interested in my past achievements or current endeavors, this portfolio provides a comprehensive view of my work and dedication. Explore the projects to learn more about my journey and the impact of my contributions.
			</div>
			<div class="mt-2 mb-4">
				<span class="badge text-bg-primary px-2 me-1">application</span>
				<span class="badge text-bg-primary px-2 me-1">web</span>
				<span class="badge text-bg-primary px-2 me-1">framework</span>
				<span class="badge text-bg-primary px-2 me-1">codethepixel</span>
				<span class="badge text-bg-primary px-2 me-1">recrud</span>
				<span class="badge text-bg-primary px-2 me-1">rapid-development</span>
				<span class="badge text-bg-primary px-2 me-1">mvc</span>
			</div>

			<div class="mt-2"><a href="#" class="project"><i class="fa-solid fa-book-open me-2"></i> Readme</a></div>
			<div class="mt-2"><a href="#" class="project"><i class="fa-solid fa-wave-square me-2"></i> Activity</a></div>
			<div class="mt-2"><a href="#" class="project"><i class="fa-regular fa-star me-2"></i> 20 stars</a></div>
			<div class="mt-2"><a href="#" class="project"><i class="fa-regular fa-eye me-2"></i> 10 watching</a></div>
			<div class="mt-2"><a href="#" class="project"><i class="fa-solid fa-code-fork me-2"></i> 5 forks</a></div>
			<div class="mt-3"><a href="#" class="project">Report Repository</a></div>

			<hr />


			<div class="mb-3 fw-bold fs-5">Releases <span class="badge text-bg-secondary">11</span></div>

			<div class="mt-4"><i class="fa-solid fa-tag text-success me-2"></i> Re-CRUD 2.0.0 released <span class="badge rounded-pill text-bg-success">Latest</span></div>

			<div class="mt-3">+ 10 releases</div>

			<hr />

			<div class="mb-3 fw-bold fs-5">Packages</div>
			<div class="mt-4">No packages published </div>
			<hr />

			<div class="mb-3 fw-bold fs-5">Languages</div>
			<div class="multicolor-line mt-4 mb-3"></div>
			<div class="row">
				<div class="col-auto"><span style="font-size: 1em; color: #4f5d95;"><i class="fas fa-circle"></i></span><a href="#" class="project me-3"> PHP 51%</a></div>
				<div class="col-auto"><span style="font-size: 1em; color: #f1e05a;"><i class="fas fa-circle"></i></span><a href="#" class="project me-3"> JavaScript 38%</a></div>
				<div class="col-auto"><span style="font-size: 1em; color: #cd1f1c;"><i class="fas fa-circle"></i></span><a href="#" class="project me-3"> Twig 9%</a></div>
				<div class="col-auto"><span style="font-size: 1em; color: #198754;"><i class="fas fa-circle"></i></span><a href="#" class="project me-3"> Others 2%</a></div>
			</div>





		</div>
	</div>


</div>