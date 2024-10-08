<?php

use Cake\I18n\FrozenTime;

echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
//echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
//echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
//echo $this->Html->script('https://unpkg.com/feather-icons'); 
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
?>
<!--Header-->
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">
		<div class="btn-group bg-transparent">
			<?php echo $this->Form->button('<i class="fa-solid fa-arrow-left text-primary"></i>', ['type' => 'button', 'onclick' => 'history.back()', 'escapeTitle' => false, 'class' => 'btn border-0']); ?>
			<button type="button" class="btn border-0" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="fa-solid fa-bars text-primary"></i>
			</button>
			<ul class="dropdown-menu">
				<li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> Register New User'), ['action' => 'registration'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			</ul>
		</div>
	</div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row mt-3">
	<div class="col-md-8">
		<ul class="nav nav-pills flex-column flex-md-row mb-3">
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-user-astronaut"></i> Account'), ['action' => 'profile', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i> Update'), ['action' => 'update', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-unlock"></i> Password'), ['action' => 'change_password', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-cubes-stacked"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Audit Trail'), ['action' => 'audit_trail', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
		</ul>
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card bg-gold">
				<div class="p-3">
					<?php if ($user->avatar != NULL) {
						echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar, ['class' => 'd-block rounded shadow', 'width' => '130px', 'height' => '130px']);
					} else
						echo $this->Html->image('blank_profile.png', ['class' => 'd-block rounded shadow', 'width' => '130px', 'height' => '130px']);
					?>
				</div>
			</div>
			<div class="row px-3 py-3">
				<div class="col-md-9">
					<div class="table-responsive">
						<table class="table table-sm table-borderless mb-0 table_transparent table-hover">
							<tr>
								<th width="20%">Name</th>
								<td><?= h($user->fullname) ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?= h($user->email) ?></td>
							</tr>
							<tr>
								<th>Group</th>
								<td><?= $user->user_group->name; ?></td>
							</tr>
							<tr>
								<th>Status</th>
								<td>
									<?php if ($user->status == 1) {
										echo '<span class="badge bg-success">Active</span>';
									} elseif ($user->status == 0) {
										echo '<span class="badge bg-danger">Disabled</span>';
									} else
										echo '<span class="badge bg-secondary">Archived</span>';
									?>
								</td>
							</tr>
							<tr>
								<th>Verified</th>
								<td>
									<?php if ($user->is_email_verified == 1) {
										echo '<span class="badge bg-success">Verified</span>';
									} else
										echo '<span class="badge bg-danger">Not verified</span>';
									?>
								</td>
							</tr>
							<tr>
								<th>Created on</th>
								<td><?php echo date('M d, Y (h:i A)', strtotime($user->created)); ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-md-3 ms-0 text-center">
					<div id="qr" align="center"></div>
					<script type="text/javascript">
						const qrCode = new QRCodeStyling({
							width: 130,
							height: 130,
							margin: 0,
							//type: "svg",
							data: "<?php echo $this->request->getUri(); ?>",
							dotsOptions: {
								//color: "#4267b2",
								type: "dots"
							},
							cornersSquareOptions: {
								type: "dots",
								color: "#007bff",
							},
							cornersDotOptions: {
								type: "dots"
							},
							backgroundOptions: {
								//color: "#ffffff",
							},
							imageOptions: {
								crossOrigin: "anonymous",
								margin: 20
							}
						});

						qrCode.append(document.getElementById("qr"));
						//qrCode.download({ name: "qr", extension: "png" });
					</script>


				</div>
			</div>
		</div>











	</div>
	<div class="col-md-4">
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Account Management</div>
				<div class="tricolor_line mb-3"></div>
				<?php if ($user->status == 0 || $user->status == 1) : ?>
					<div class="mb-3 col-12 mb-0">
						<div class="alert alert-warning">
							<div class="fw-semibold">Delete Account</div>
							<p class="mb-0">Once you deactivate <?= h($user->fullname) ?> account, there is no going back. Please be certain.</p>

							<div class="text-end">
								<?php $this->Form->setTemplates([
									'confirmJs' => 'addToModal("{{formName}}"); return false;'
									//'confirmJs' => 'console.log("{{confirmMessage}} - {{formName}}"); return false;'
								]); ?>
								<?= $this->Form->postLink(
									__('<i class="fa-regular fa-trash-can"></i> Delete'),
									['action' => 'delete', $user->id],
									[
										'confirm' => __('Are you sure you want to delete user: "{0}"?', $user->fullname),
										'title' => __('Delete'),
										'disabled' => 'disabled',
										'class' => 'btn btn-danger btn-xs',
										'escapeTitle' => false,
										'data-bs-toggle' => "modal",
										'data-bs-target' => "#bootstrapModal"
									]
								) ?>
							</div>
						</div>
					</div>



				<?php endif; ?>
				<?php if ($user->status == 0) : ?>
					<div class="mb-3 col-12 mb-0">
						<div class="alert alert-warning">
							<div class="fw-semibold">Activate Account</div>
							<p class="mb-0">Are you sure you want to activate <?= h($user->fullname) ?> account?</p>
							<div class="text-end mb-2">
								<?= $this->Form->postLink(
									__('Activate'),
									['action' => 'activate', $user->slug],
									[
										'confirm' => __('Are you sure you want to activate user: "{0}"?', $user->fullname),
										'title' => __('Activate'),
										'class' => 'btn btn-success btn-xs',
										'escapeTitle' => false,
										'data-bs-toggle' => "modal",
										'data-bs-target' => "#bootstrapModal"
									]
								) ?>

							</div>
						</div>
					</div>


				<?php endif; ?>

				<?php if ($user->status == 1) : ?>
					<div class="mb-3 col-12 mb-0">
						<div class="alert alert-warning">
							<div class="fw-semibold">Disable Account</div>
							<p class="mb-0">Are you sure you want to disable <?= h($user->fullname) ?> account?</p>
							<div class="text-end">
								<?= $this->Form->postLink(
									__('Disable'),
									['action' => 'disable', $user->slug],
									[
										'confirm' => __('Are you sure you want to Disable user: "{0}"?', $user->fullname),
										'title' => __('Disable'),
										'class' => 'btn btn-danger btn-xs',
										'escapeTitle' => false,
										'data-bs-toggle' => "modal",
										'data-bs-target' => "#bootstrapModal"
									]
								) ?>
							</div>
						</div>
					</div>


				<?php endif; ?>
				<?php if ($user->is_email_verified == 0) : ?>

					<div class="mb-3 col-12 mb-0">
						<div class="alert alert-warning">
							<div class="fw-semibold">Verify Account</div>
							<p class="mb-0">This step will manually verify the registered account without validating the email address. Please be certain.</p>
							<div class="text-end">
								<?= $this->Form->postLink(
									__('Verify'),
									['action' => 'admin_verify', $user->slug],
									[
										'confirm' => __('Are you sure you want to verify user: "{0}"?', $user->fullname),
										'title' => __('Verify'),
										'class' => 'btn btn-success btn-xs',
										'escapeTitle' => false,
										'data-bs-toggle' => "modal",
										'data-bs-target' => "#bootstrapModal"
									]
								) ?>
							</div>
						</div>
					</div>


				<?php endif; ?>

				<?php if ($user->status == 0 || $user->status == 1) : ?>

					<div class="mb-3 col-12 mb-0">
						<div class="alert alert-warning">
							<div class="fw-semibold">Archived Account</div>
							<p class="mb-0">This step will transfer the account to archived. Once transfer to archived, it will remained and cannot be revert back. Please be certain.</p>
							<div class="text-end">
								<?= $this->Form->postLink(
									__('Archived'),
									['action' => 'archived', $user->slug],
									[
										'confirm' => __('Are you sure you want to archived user: "{0}"?', $user->fullname),
										'title' => __('Archived'),
										'class' => 'btn btn-success btn-xs',
										'escapeTitle' => false,
										'data-bs-toggle' => "modal",
										'data-bs-target' => "#bootstrapModal"
									]
								) ?>

							</div>
						</div>
					</div>


				<?php endif; ?>

				<?php if ($user->status == 2) : ?>
					This account has been archived on <?php echo date('M d, Y (h:i A)', strtotime($user->modified)); ?>
				<?php endif; ?>

			</div>
		</div>



	</div>
</div>





<script type="text/javascript">
	$(document).ready(function() {
		$(".input select").select2();
	});
</script>




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