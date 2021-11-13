<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fitness $fitness
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<?php
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
?>
<div class="container">
<!--Top Menu Start-->
<div class="dropdown text-end pt-2 pb-2">
  <button class="btn  border-0 shadow-none text-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
	<i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('List'), ['prefix' => 'Admin', 'action' => 'index'], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $fitness->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $fitness->id), 'class' => 'dropdown-item']
            ) ?>
  </ul>
</div>	
<!--Top Menu End-->

    <div class="card mb-3 shadow module-blue-big border borderless">
        <div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Fitness Tracking
            <div class=" text-light panel_subs"><?php echo $system_name; ?></div>
        </div>
            <div class="card-body bg-light border borderless">
				<?php echo $this->Form->create($fitness, ['novalidate' => true]); ?>
                <fieldset>
                    <body onLoad="getLocation()">
                    <?php //echo $this->Form->control('user_id', ['options' => $users]); ?>





  <div class="row">
    <div class="col-md-8">
      <label>Type of Excercise</label><br>
		<?php
		echo $this->Form->radio(
			'type',
			[
				['value' => 'Running', 'text' => 'Running', 'label' => ['class' => 'btn btn-outline-secondary ms-1']],
				['value' => 'Cycling', 'text' => 'Cycling', 'label' => ['class' => 'btn btn-outline-secondary ms-1']],
				['value' => 'Sit-Up', 'text' => 'Sit-Up', 'label' => ['class' => 'btn btn-outline-secondary ms-1']],
				['value' => 'Pushups', 'text' => 'Pushups', 'label' => ['class' => 'btn btn-outline-secondary ms-1']],
				['value' => 'Star-Jumps', 'text' => 'Star-Jumps', 'label' => ['class' => 'btn btn-outline-secondary ms-1']],
				['value' => 'Squats', 'text' => 'Squats', 'label' => ['class' => 'btn btn-outline-secondary ms-1']],
				['value' => 'Planks', 'text' => 'Planks', 'label' => ['class' => 'btn btn-outline-secondary ms-1']],
				['value' => 'Burpees', 'text' => 'Burpees', 'label' => ['class' => 'btn btn-outline-secondary ms-1']],
			]
		);
if ($this->Form->isFieldError('type')) {
    echo $this->Form->error('type', 'Select fitness type');
}
		?>
    </div>
    <div class="col-md-4">
      <?php echo $this->Form->control('counter'); ?>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <?php echo $this->Form->control('latitude',['id' => 'lat', 'type' => 'text']); ?>
    </div>
    <div class="col">
      <?php echo $this->Form->control('longitude',['id' => 'long', 'type' => 'text']); ?>
    </div>
    <div class="col">
      <?php echo $this->Form->control('registered_on',[
                          'class' => 'form-control datepicker-here', 
                          'label' => 'Registered On',
                          'id' => 'registered_on',
                          'type' => 'Text',
                          'data-language' => 'en',
                          'data-date-format' => 'Y-m-d H:i:s',
						  'value' => date('Y-m-d H:i:s', strtotime($fitness->registered_on)), //for edit page: read the existing data first
                          'empty'=>'empty'

                    ]); ?>
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


<script>
    function getLocation()
      {
       navigator.geolocation.getCurrentPosition(function(position)
        {
         var coordinates = position.coords;
         document.getElementById('lat').value = coordinates.latitude;
         document.getElementById('long').value = coordinates.longitude;
       });
     }
 </script>

<script>
$('#registered_on').datetimepicker({
	lang:'en',
	timepicker:true,
	format:'Y-m-d H:i:s',
	formatDate:'Y/m/d H:i:s',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>