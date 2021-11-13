<div class="container pt-3">
<div class="card mb-3 shadow module-blue-big border borderless mt-3">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Login
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-light border borderless">
    <?= $this->Form->create() ?>
    <fieldset>
<div class="row">
	<div class="col">
	  <?= $this->Form->control('username', ['required' => false]) ?>
	</div>
	<div class="col">
	  <?= $this->Form->control('password', ['required' => false]) ?>
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