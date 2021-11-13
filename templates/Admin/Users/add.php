<?php
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
?>
<div class="container">
<!--Top Menu Start-->
<div class="dropdown text-end pt-2 pb-2">
  <button class="btn  border-0 shadow-none text-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	<i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('List'), ['prefix' => 'Admin', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]) ?>
  </ul>
</div>	
<!--Top Menu End-->
    <div class="card mb-3 shadow module-blue-big border borderless">
        <div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">User Registration
            <div class=" text-light panel_subs"><?php echo $system_name; ?></div>
        </div>
            <div class="card-body bg-light border borderless">
                <?php echo $this->Form->create($user, ['type' => 'file', 'novalidate' => true]); ?>
                <fieldset>
				
<div class="row">
	<div class="col">
	  <?php echo $this->Form->control('fullname',['required' => false]); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('email',['required' => false]); ?>
	</div>
</div>				
	
<div class="row">
	<div class="col">
	  <?php echo $this->Form->control('username',['required' => false]); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('password',['required' => false]); ?>
	</div>
</div>	

<div class="row">
	<div class="col">
	  <?php 
echo $this->Form->control('user_group_id', [
	//'type' => 'text', 
	'options' => $userGroups,
	'id' => 'group',
	'label' => 'User Group',
	'class' => 'form-control',
	'required' => false]); 
?>
<script type="text/javascript">
$('#group').select2({
	tags: true,
    //data: ["Clare","Cork","South Dublin"],
    //tokenSeparators: [','], 
    placeholder: "Select",
    /* the next 2 lines make sure the user can click away after typing and not lose the new tag */
    //selectOnClose: true, 
    //closeOnSelect: false
});
</script>
	</div>
	<div class="col">
<label>Status</label><br>
		<?php
			echo $this->Form->radio(
				'status',
				[
					['value' => '1', 'text' => 'Active', 'label' => ['class' => 'btn btn-outline-success ms-1 mb-3']],
					['value' => '0', 'text' => 'In-Active', 'label' => ['class' => 'btn btn-outline-warning ms-1 mb-3']],
				]
			);?>
	</div>
</div>		
<?php echo $this->Form->control('avatar',['type'=>'file','required' => false, 'class' =>'form-control', 'label' => 'Profile Image']); ?>
 
                </fieldset>
            </div>
            <div class="card-footer text-end bg-light">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->end() ?>
		  </div>
    </div>
</div>
