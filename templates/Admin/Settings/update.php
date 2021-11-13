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
	echo $this->Html->script('https://unpkg.com/feather-icons');
?>
<div class="container mt-3 mb-5">

<div class="dropdown text-end dropstart">
  <button class="btn btn-outline btn-sm" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><?= $this->Html->link(__('<i class="far fa-hdd"></i> Log'), ['action' => 'cakelog'], ['class' => 'dropdown-item', 'escape' => false]) ?></li>
    <div class="dropdown-divider"></div>
	<?= $this->Html->link(__('<i class="far fa-hdd"></i> Clear Cache'), ['action' => 'clearCache'], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Html->link(__('<i class="fas fa-list"></i> Server Info'), ['action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]) ?>
  </ul>
</div>



  <div class="row">
    <div class="col-md-9">
<div class="card shadow module-blue-big border borderless">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Site Setting
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-white text-secondary">
<div class="row">
    <div class="column-responsive column-80">
        <div class="settings form content">
            <?= $this->Form->create($setting) ?>
            <fieldset>
<div class="row">
	<div class="col">
	  <?php  echo $this->Form->control('system_name'); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('system_abbr'); ?>
	</div>
</div>

<div class="row">
	<div class="col">
	  <?php echo $this->Form->control('system_slogan'); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('organization_name'); ?>
	</div>
</div>

<div class="row">
	<div class="col">
	  <?php echo $this->Form->control('domain_name'); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('email'); ?>
	</div>
</div>

<div class="row">
	<div class="col">
	  <?php echo $this->Form->control('notification_email'); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('timezone'); ?>
	</div>
</div>

<div class="row">
	<div class="col">
	  <?php echo $this->Form->control('meta_title'); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('meta_keyword'); ?>
	</div>
</div>
                    
<div class="row">
	<div class="col">
	  <?php echo $this->Form->control('meta_subject'); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('meta_copyright'); ?>
	</div>
</div>
                    
	<?php echo $this->Form->control('meta_desc'); ?>
                    
<div class="row">
	<div class="col">
	  <?php echo $this->Form->control('author'); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('version'); ?>
	</div>
</div>

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
	  <?php echo $this->Form->control('telegram_bot_token'); ?>
	</div>
	<div class="col">
	  <?php echo $this->Form->control('telegram_chatid'); ?>
	</div>
</div>

  <div class="row">
    <div class="col">
		<?php echo $this->Form->checkbox('site_status', [
			'class' => 'form-control',
			'type' => 'checkbox',
			'data-toggle'=>'toggle', 'data-on'=>'Online', 'data-off'=>'Offline', 'data-onstyle'=>'success', 'data-offstyle'=>'danger', 'data-size'=>'small', 'data-width'=>'80']); ?>
		<?php echo $this->Form->label('site_status', 'Site Status'); ?>
    </div>
    <div class="col">
		<?php echo $this->Form->checkbox('user_reg', [
			'class' => 'form-control',
			'type' => 'checkbox',
			'data-toggle'=>'toggle', 'data-on'=>'Enable', 'data-off'=>'Disable', 'data-onstyle'=>'success', 'data-offstyle'=>'danger', 'data-size'=>'small', 'data-width'=>'80']); ?>
		<?php echo $this->Form->label('user_reg', 'User Registration'); ?>
    </div>
    <div class="col">
		<?php echo $this->Form->checkbox('config_2', [
			'class' => 'form-control',
			'type' => 'checkbox',
			'data-toggle'=>'toggle', 'data-on'=>'Yes', 'data-off'=>'No', 'data-onstyle'=>'success', 'data-offstyle'=>'danger', 'data-size'=>'small', 'data-width'=>'80']); ?>
		<?php echo $this->Form->label('config_2', 'Config 2'); ?>
    </div>
    <div class="col">
		<?php echo $this->Form->checkbox('config_3', [
			'class' => 'form-control',
			'type' => 'checkbox',
			'data-toggle'=>'toggle', 'data-on'=>'Yes', 'data-off'=>'No', 'data-onstyle'=>'success', 'data-offstyle'=>'danger', 'data-size'=>'small', 'data-width'=>'80']); ?>
		<?php echo $this->Form->label('config_3', 'Config 3'); ?>
    </div>
  </div>
            </fieldset>
        </div>
    </div>
</div>
		</div>
		  <div class="card-footer text-end bg-light">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->end() ?>
		  </div>
</div>
    </div>
    <div class="col-md-3">
		<div class="card shadow mb-3">
		  <div class="card-header module-blue">
				<div class="icon-robot icon-robot-tangan mt-0 text-light">General Information</div>
		  </div>
				<div class="card-body bg-white text-secondary">
					<table class="table table-sm table-borderless table-hover">
						<tr>
							<td><i data-feather="command"></i> CakePHP Version</td>
							<td><?php echo Configure::version(); ?></td>
						</tr>
						<tr>
							<td><i data-feather="package"></i> re-CRUD Version</td>
							<td>1.0 Beta</td>
						</tr>
						<tr>
							<td><i data-feather="code"></i> System Version</td>
							<td><?= h($setting->version) ?></td>
						</tr>
					</table>
				</div>
		</div>
		
		<div class="card shadow mb-3">
		  <div class="card-header module-blue">
				<div class="icon-robot icon-robot-tangan mt-0 text-light">Available Database Table</div>
		  </div>
				<div class="card-body bg-white text-secondary">
					<?php 
						/* $db = ConnectionManager::get('default');
						$collection = $db->getSchemaCollection();
						$listTables = $collection->listTables(); 

						echo '<ul class="bullet_box">';
							foreach($listTables as $key => $listTables) {
								$tableData = TableRegistry::get($listTables);
								echo "<li>{$listTables}</li>";
							}
						echo '</ul>'; */
					?>
				</div>
		</div>		
    </div>
  </div>




</div>

<script>
	feather.replace()
</script>

<script type="text/javascript">
$(document).ready(function() {
  $(".input select").select2();
});
</script>