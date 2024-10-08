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
				<?= $this->Html->link(__('<i class="fa-solid fa-user-astronaut"></i> Account'), ['action' => 'profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-regular fa-pen-to-square"></i> Update'), ['action' => 'update', $user->slug], ['class' => 'nav-link active', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-unlock"></i> Password'), ['action' => 'change_password', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?= $this->Html->link(__('<i class="fa-solid fa-timeline"></i> Activities'), ['action' => 'activity', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
			<li class="nav-item">
				<?php echo $this->Html->link(__('<i class="fa-regular fa-file-pdf"></i> PDF'), ['action' => 'pdf_profile', $user->slug], ['class' => 'nav-link', 'escapeTitle' => false]) ?>
			</li>
		</ul>
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="row p-3">
				<div class="col-md-2">
					<?php if ($user->avatar != NULL) {
						echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar, ['class' => 'd-block rounded', 'width' => '100px', 'height' => '100px']);
					} else
						echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'd-block rounded', 'width' => '100px', 'height' => '100px']);
					?>
				</div>
				<div class="col-md-8 ps-0">
					<?php echo $this->Form->create($user, ['type' => 'file', 'novalidate' => true]); ?>

					<?php echo $this->Form->control('avatar', ['type' => 'file', 'required' => false, 'class' => 'form-control', 'label' => 'Profile Image', 'onchange' => 'readURL(this)']); ?>

					<p class="text-muted mb-0">
						<?php echo $this->Html->link(__('Remove Existing Picture'), ['action' => 'remove_avatar', $user->slug], ['class' => 'btn btn-sm btn-outline-primary', 'escapeTitle' => false]) ?>&nbsp;&nbsp;&nbsp;
						Allowed JPG/JPEG Only. Recommended Size 100px X 100px
					</p>
				</div>

				<div class="col-md-2">
					<center>
						<?php echo $this->Html->image('avatar_default_preview.png', ['alt' => 'avatar preview', 'class' => 'd-block rounded', 'width' => '100px', 'height' => '100px', 'id' => 'gambar']); ?>
					</center>
					<script>
						function readURL(input) {
							if (input.files && input.files[0]) {
								var reader = new FileReader();

								reader.onload = function(e) {
									$('#gambar')
										.attr('src', e.target.result);
								};

								reader.readAsDataURL(input.files[0]);
							}
						}
					</script>
				</div>
			</div>



			<div class="p-3">

				<fieldset>
					<?php
					if ($this->Identity->isLoggedIn()) { ?>


						<div class="row">
							<div class="col-md-6">
								<?php echo $this->Form->control('fullname', ['required' => false]); ?>
							</div>
							<div class="col-md-6">
								<?php echo $this->Form->control('email', ['required' => false]); ?>
							</div>
						</div>



					<?php } ?>



				</fieldset>
				<div class="text-end">
					<?= $this->Form->button(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
					<?= $this->Form->end() ?>
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