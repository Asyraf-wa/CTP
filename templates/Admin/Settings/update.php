<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

use Cake\Datasource\ConnectionManager;
use Cake\Database\Schema\TableSchema;
use Cake\Database\Schema\Collection;
use Cake\ORM\TableRegistry;
?>
<?php
echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
//echo $this->Html->script('https://unpkg.com/feather-icons'); 
echo $this->Html->script('ckeditor/ckeditor.js');
?>
<!--Header-->
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">
		<div class="dropdown mx-3">
			<button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa-solid fa-bars text-primary"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
				<li><?= $this->Html->link(__('<i class="far fa-hdd"></i> Log'), ['action' => 'cakelog'], ['class' => 'dropdown-item', 'escape' => false]) ?></li>
				<li>
					<hr class="dropdown-divider">
				</li>
				<li><?= $this->Html->link(__('<i class="far fa-hdd"></i> Clear Cache'), ['action' => 'clearCache'], ['class' => 'dropdown-item', 'escape' => false]) ?></li>
			</div>
		</div>
	</div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row g-4">
	<div class="col-md-3">
		<div class="card bg-body-tertiary border-0 shadow">
			<div class="card-body">
				<div class="card-title mb-0">Framework Information</div>
				<div class="tricolor_line mb-3"></div>
				<table class="table table-sm table-borderless mb-0 table_transparent">
					<tr>
						<td><i data-feather="command"></i> Framework Version</td>
						<td><?php echo Configure::version(); ?></td>
					</tr>
					<tr>
						<td><i data-feather="package"></i> Re-CRUD Version</td>
						<td><?= $recrud; ?></td>
					</tr>
					<tr>
						<td><i data-feather="code"></i> System Version</td>
						<td><?= h($setting->version) ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-9">



		<div class="nav-align-top mb-4">
			<ul class="nav nav-tabs nav-fill mb-4" role="tablist">
				<li class="nav-item">
					<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-general" aria-controls="navs-justified-general" aria-selected="false"><i class="fa-solid fa-gear"></i> General <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger"><i class="fa-solid fa-code"></i></span></button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-meta" aria-controls="navs-justified-meta" aria-selected="false"><i class="fa-solid fa-circle-info"></i> Meta</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-captcha" aria-controls="navs-justified-captcha" aria-selected="true"><i class="fa-solid fa-barcode"></i> Captcha</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-telegram" aria-controls="navs-justified-telegram" aria-selected="true"><i class="fa-brands fa-telegram"></i> Telegram</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-other" aria-controls="navs-justified-other" aria-selected="true"><i class="fa-solid fa-cubes-stacked"></i> Others</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-notification" aria-controls="navs-justified-notification" aria-selected="true"><i class="fa-solid fa-bell"></i> Notification</button>
				</li>
			</ul>
			<div class="card bg-body-tertiary border-0 shadow mb-4">
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane fade active show" id="navs-justified-general" role="tabpanel">
							<?= $this->Form->create($setting) ?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('system_name', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('system_abbr', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<?php echo $this->Form->control('system_slogan', ['class' => 'form-control', 'required' => false]); ?>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('organization_name', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('domain_name', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('email', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('notification_email', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('author', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<?php echo $this->Form->control('timezone', ['class' => 'form-control', 'required' => false]); ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<?php echo $this->Form->control('version', ['class' => 'form-control', 'required' => false]); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-justified-meta" role="tabpanel">
							<div class="form-group">
								<?php echo $this->Form->control('meta_title', ['class' => 'form-control', 'required' => false]); ?>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('meta_subject', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('meta_copyright', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<?php echo $this->Form->control('meta_desc', ['class' => 'form-control', 'required' => false]); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-justified-captcha" role="tabpanel">
							<div class="row">
								<div class="col">
									<?php echo $this->Form->control('private_key_from_recaptcha'); ?>
								</div>
								<div class="col">
									<?php echo $this->Form->control('public_key_from_recaptcha'); ?>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<?php echo $this->Form->control('hcaptcha_sitekey'); ?>
								</div>
								<div class="col">
									<?php echo $this->Form->control('hcaptcha_secretkey'); ?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-justified-telegram" role="tabpanel">
							<div class="row">
								<div class="col">
									<?php echo $this->Form->control('telegram_bot_token'); ?>
								</div>
								<div class="col">
									<?php echo $this->Form->control('telegram_chatid'); ?>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-justified-other" role="tabpanel">
							<div class="row g-2">
								<div class="col-4">
									<div class="form-group">
										<?php echo $this->Form->checkbox('site_status', [
											'class' => 'form-control',
											'type' => 'checkbox',
											'data-toggle' => 'toggle', 'data-on' => 'Online', 'data-off' => 'Offline', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'data-size' => 'small', 'data-width' => '80'
										]); ?>
										<?php echo $this->Form->label('site_status', 'Site Status'); ?>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<?php echo $this->Form->checkbox('user_reg', [
											'class' => 'form-control',
											'type' => 'checkbox',
											'data-toggle' => 'toggle', 'data-on' => 'Enable', 'data-off' => 'Disable', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'data-size' => 'small', 'data-width' => '80'
										]); ?>
										<?php echo $this->Form->label('user_reg', 'User Registration'); ?>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<?php echo $this->Form->checkbox('config_2', [
											'class' => 'form-control',
											'type' => 'checkbox',
											'data-toggle' => 'toggle', 'data-on' => 'Yes', 'data-off' => 'No', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'data-size' => 'small', 'data-width' => '80'
										]); ?>
										<?php echo $this->Form->label('config_2', 'Config 2'); ?>
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<?php echo $this->Form->checkbox('config_3', [
											'class' => 'form-control',
											'type' => 'checkbox',
											'data-toggle' => 'toggle', 'data-on' => 'Yes', 'data-off' => 'No', 'data-onstyle' => 'success', 'data-offstyle' => 'danger', 'data-size' => 'small', 'data-width' => '80'
										]); ?>
										<?php echo $this->Form->label('config_3', 'Config 3'); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="navs-justified-notification" role="tabpanel">
							<?php //echo $this->Form->control('notification');
							?>
							<style>
								.ck-editor__editable_inline {
									min-height: 150px;
								}
							</style>
							<?php echo $this->Form->control('notification', ['required' => false, 'id' => 'ckeditor', 'label' => 'Notification']); ?>
							<script>
								ClassicEditor
									.create(document.querySelector('#ckeditor'))
									.catch(error => {
										console.error(error);
									});
							</script>
							<?php //echo $this->Form->checkbox('notification_status');
							?>
							<?php //echo $this->Form->label('Status');
							?>
							<div class="form-check form-switch mb-2">
								<?php echo $this->Form->checkbox('notification_status', ['class' => 'form-check-input', 'id' => 'notification_status']); ?>
								<label class="form-check-label" for="flexSwitchCheckChecked">Enable Notification</label>
							</div>
							<?php //echo $this->Form->control('notification_date');
							?>
							<code>Note: The notification will be hidden for 1 hour after click close button</code>
							<hr />
							<div class="row">
								<div class="col-md-6">
									<?php echo $this->Form->control('ribbon_title', ['required' => false, 'label' => 'Ribbon Text']); ?>
								</div>
								<div class="col-md-6">
									<?php echo $this->Form->control('ribbon_link', ['required' => false, 'label' => 'Ribbon Link']); ?>
								</div>
							</div>
							<div class="form-check form-switch mb-2">
								<?php echo $this->Form->checkbox('ribbon_status', ['class' => 'form-check-input', 'id' => 'ribbon_status']); ?>
								<label class="form-check-label" for="flexSwitchCheckChecked">Enable Ribbon</label>
							</div>
						</div>
						<div class="text-end">
							<?= $this->Form->button(__('Update'), ['class' => 'btn btn-outline-primary']) ?>
							<?= $this->Form->end() ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Server Information</div>
				<div class="tricolor_line mb-3"></div>
				<div class="table-responsive text-nowrap">
					<table class="table table-sm table-borderless mb-0 table_transparent table-hover">
						<tr>
							<th>Agent</th>
							<td><?php echo $_SERVER['HTTP_USER_AGENT']; ?></td>
						</tr>

						<tr>
							<th>IP</th>
							<td><?php echo $this->request->clientIp(); ?></td>
						</tr>

						<tr>
							<th>Load</th>
							<td><?php echo round(microtime(true) - TIME_START, 3); ?></td>
						</tr>

						<tr>
							<th>Root</th>
							<td><?php echo $_SERVER['PHP_SELF']; ?></td>
						</tr>

						<tr>
							<th>URL</th>
							<td><?php echo $_SERVER['SERVER_NAME']; ?>
								<br>
								<?php $hostname = gethostname();
								echo $hostname; ?>
							</td>
						</tr>

						<tr>
							<th>Referrer</th>
							<td><?php echo $_SERVER['HTTP_REFERER']; ?></td>
						</tr>

						<tr>
							<th>Operating System</th>
							<td><?php echo php_uname('s'); ?></td>
						</tr>

						<tr>
							<th>Release Name</th>
							<td><?php echo php_uname('r'); ?></td>
						</tr>

						<tr>
							<th>Version</th>
							<td><?php echo php_uname('v'); ?></td>
						</tr>

						<tr>
							<th>Machine Type</th>
							<td><?php echo php_uname('m'); ?></td>
						</tr>

						<tr>
							<th>Host Name</th>
							<td><?php echo gethostname(); ?></td>
						</tr>

						<tr>
							<th>Server Admin</th>
							<td><?php echo $_SERVER['SERVER_ADMIN']; ?></td>
						</tr>

						<tr>
							<th>Server Port</th>
							<td><?php echo $_SERVER['SERVER_PORT']; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$(document).ready(function() {
		$(".input select").select2();
	});
</script>