<div class="container">
<div class="card mb-3 shadow module-blue-big border borderless mt-3">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Update Password
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-light border borderless">
Hi, <?php echo $this->Identity->get('fullname'); ?>,<br> you are about to change and update your password. For verification purpose, you need to enter your current password and new password. If the current password is not match, the update will not be process. Please proceed with caution.<hr><br>
    <?= $this->Form->create($user); ?>
    <fieldset>
	<?php echo $this->Form->control('current_password', ['class' => 'form-control','required' => false, 'value' => '','autocomplete' => 'off', 'type'=>'password']); ?>
<div class="row">
	<div class="col">
	  <?php echo $this->Form->control('password', ['class' => 'form-control','required' => false, 'label'=>'New Password', 'value' => '','autocomplete' => 'off', 'type'=>'password']); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('cpassword', ['class' => 'form-control', 'type'=>'password', 'label'=>'Confirm New Password','required' => false, 'value' => '','autocomplete' => 'off', 'type'=>'password']);?>
	</div>
</div>
        
        
    </fieldset>
		</div>
		  <div class="card-footer text-end bg-light">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->end() ?>
		  </div>
</div>
</div>