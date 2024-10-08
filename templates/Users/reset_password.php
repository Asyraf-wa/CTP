<div class="row">
	<div class="col-md-3">

	</div>
	<div class="col-md-6">
		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="my-4 text-center">
					<h1 class="my-0 page_title">Reset Password</h1>
				</div>
				<div class="tricolor_line mb-3"></div>

				<?= $this->Form->create() ?>
				<?php echo $this->Form->control('password', ['class' => 'form-control  border-0', 'required' => false, 'label' => 'New Password', 'value' => '', 'autocomplete' => 'off', 'type' => 'password']); ?>
				<div class="text-end">
					<?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning btn-sm']); ?>
					<?= $this->Form->button(__('Submit'), ['type' => 'submit', 'class' => 'btn btn-outline-primary btn-sm']) ?>
					<?= $this->Form->end() ?>
				</div>

				<div class="postlink_space">
					<?php echo $this->Html->link('Register', ['controller' => 'Users', 'action' => 'registration']); ?> |
					<?php //echo $this->Html->link('Forgot Username', array('controller'=>'Users','action'=>'forgot_username')); 
					?>
					<?php echo $this->Html->link('Forgot Password', array('controller' => 'Users', 'action' => 'forgot_password')); ?>
				</div>

				<hr>

				<div class="btn-grid">
					<?php echo $this->Html->link(__('User Manual'), array('controller' => 'pages', 'action' => 'manual'), array('class' => 'btn btn-primary btn-sm', 'escape' => false)); ?>

					<?php echo $this->Html->link(__('Frequently Asked Question'), array('controller' => 'Faqs', 'action' => 'index'), array('class' => 'btn btn-primary btn-sm', 'escape' => false)); ?>

					<?php echo $this->Html->link(__('Contact Us'), array('controller' => 'Contacts', 'action' => 'add'), array('class' => 'btn btn-primary btn-sm', 'escape' => false)); ?>
				</div>
				<hr>
				<div id="supported" align="center">
					<b class="gradient-animate-tiny">&lt;&#47;&gt; <?php echo $system_abbr; ?></b>
					&nbsp;&nbsp;&nbsp;
					<?php echo $this->Html->link($this->Html->image(
						'ctp.png',
						array('alt' => 'Code The Pixel', 'class' => 'gambar',  'width' => '78px', 'height' => '22px')
					) . '' . (''), 'https://codethepixel.com', array('target' => 'blank', 'escape' => false)); ?>
					&nbsp;&nbsp;&nbsp;
					<?php echo $this->Html->link($this->Html->image(
						'github.png',
						array('alt' => 'Github', 'class' => 'gambar',  'width' => '78px', 'height' => '22px')
					) . '' . (''), 'https://github.com/', array('target' => 'blank', 'escape' => false)); ?>
					&nbsp;&nbsp;&nbsp;
					<?php echo $this->Html->link($this->Html->image(
						'gitlab.png',
						array('alt' => 'GitLab', 'class' => 'gambar',  'width' => '78px', 'height' => '22px')
					) . '' . (''), 'https://gitlab.com/', array('target' => 'blank', 'escape' => false)); ?>
				</div>
				<br />
				<div class="">
					<p class="text-center">
						Leading The CRUD Evolution<br>
						<?= $system_name; ?> (<?= $system_abbr; ?>)<br>
						<SCRIPT LANGUAGE="JavaScript">
							today = new Date();
							y0 = today.getFullYear();
						</SCRIPT>
						Copyright &copy; 2022-<SCRIPT LANGUAGE="JavaScript">
							document.write(y0);
						</SCRIPT> <?= $system_abbr; ?>. All rights reserved. [V <?= $version; ?>] <br>
						<br>
					</p>
				</div>

			</div>
		</div>
	</div>
	<div class="col-md-3">

	</div>
</div>