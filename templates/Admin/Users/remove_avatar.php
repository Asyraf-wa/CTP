<div class="container">
	<div class="card mb-3 shadow module-blue-big border borderless mt-3">
		<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Remove Avatar
			<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
		</div>
			<div class="card-body bg-light border borderless">
			<?= $this->Form->create($user, ['type' => 'file']); ?>

            <fieldset>
<div class="row">
	<div class="col-md-2" align="center">
<?php if ($user->avatar != NULL) {
		echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar,['class'=> 'rounded-circle shadow', 'width' => '100px', 'height' => '100px']);
	}else
		echo $this->Html->image('avatar_default.png', ['alt' => 'avatar', 'class' => 'img-circle', 'width' => '100px', 'height' => '100px']);
?>
	</div>
	<div class="col-md-10">
	Are confirm to remove your profile picture?
			<div class="form-group">
				<?php echo $this->Form->hidden('user.avatar', ['value' => '', 'class' => 'form-control','required' => false]); ?>
				<?php echo $this->Form->hidden('user.avatar_dir', ['value' => '', 'class' => 'form-control','required' => false]); ?>
			</div>	
			<?= $this->Form->button(__('Confirm'),['class' => 'btn btn-outline-primary btn-flat']) ?>
				  <?= $this->Form->end() ?>
	</div>
</div>
	
            </fieldset>
			</div>
	</div>
</div>