<?php

use Cake\I18n\FrozenTime;

echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
//echo $this->Html->css('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css');
//echo $this->Html->script('https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js');
//echo $this->Html->script('https://unpkg.com/feather-icons'); 
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
?>
<!--Header-->
<div class="row text-body-secondary">
	<div class="col-12">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
</div>
<div class="line mb-4"></div>

<div class="row mt-3">
	<div class="col-md-12">
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
				<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'profile_pdf', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
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
</div>








<script type="text/javascript">
	$(document).ready(function() {
		$(".input select").select2();
	});
</script>