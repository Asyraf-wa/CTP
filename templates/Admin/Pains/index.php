<?php
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
?>
<div class="container"><!--Container Start-->
<!--Top Menu Start-->
<div class="text-end pt-2 pb-2">
	<div class="btn-group" role="group" aria-label="Basic outlined example">
		<?= $this->Html->link(__('<i class="fas fa-plus fa-sm"></i>'), ['action' => 'add'], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'New']) ?>
		<?= $this->Html->link(__('<i class="fas fa-search fa-sm"></i>'), ['action' => ''], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'type' => 'button', 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#flush-search', 'aria-expanded' => 'false', 'aria-controls' => 'flush-search', 'title' => 'Search']) ?>
		<?php if (!empty($_isSearch)) {
			echo $this->Html->link(__('<i class="fas fa-sync-alt fa-sm"></i>'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Reset']);
		} ?>
	</div>
</div>
<!--Top Menu End-->
<!--Search Form Start-->
<div class="accordion accordion-flush" id="search">
	<div class="accordion-item">
		<div id="flush-search" class="accordion-collapse <?= (!empty($_isSearch)) == ''?'collapse':'' ?>" aria-labelledby="flush-headingOne" data-bs-parent="#search">
		<div class="accordion-body bg-light">
		<?php echo $this->Form->create(null, ['valueSources' => 'query']); ?>
		<div class="row">
	<div class="col-md-3">
		<label>Type of Pain</label><br>
		<?php
			echo $this->Form->radio(
				'type',
				[
					['value' => 'Gout', 'text' => 'Gout', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => 'Fever', 'text' => 'Fever', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => 'Flu', 'text' => 'Flu', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => 'Others', 'text' => 'Others', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
				]
			);?>
	</div>
	<div class="col-md-5">
		<label>Pain Point</label><br>
		<?php
			echo $this->Form->radio(
				'pain_point',
				[
					['value' => 'Right Feet', 'text' => 'Right Feet', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => 'Left Feet', 'text' => 'Left Feet', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => 'Right Toe', 'text' => 'Right Toe', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => 'Left Toe', 'text' => 'Left Toe', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => 'Others', 'text' => 'Others', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
				]
			);?>
	</div>
			<div class="col-md-2">
			<?php echo $this->Form->control('publish_from',[
                          'class' => 'form-control datepicker-here', 
                          'label' => 'Publish From',
                          'id' => 'publish_from',
                          'type' => 'Text',
                          'data-language' => 'en',
                          'data-date-format' => 'Y-m-d',
                          'empty'=>'empty',
						  'required' => false,
						  'autocomplete' => 'off'
			]); ?>
			</div>
			<div class="col-md-2">
			<?php echo $this->Form->control('publish_to',[
                          'class' => 'form-control datepicker-here', 
                          'label' => 'Publish To',
                          'id' => 'publish_to',
                          'type' => 'Text',
                          'data-language' => 'en',
                          'data-date-format' => 'Y-m-d',
                          'empty'=>'empty',
						  'required' => false,
						  'autocomplete' => 'off'
			]); ?>
			</div>
		</div>
		
		<label>Pain Feel</label><br>
		<?php
			echo $this->Form->radio(
				'feel',
				[
					['value' => '1', 'text' => '1', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => '2', 'text' => '2', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => '3', 'text' => '3', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => '4', 'text' => '4', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => '5', 'text' => '5', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => '6', 'text' => '6', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => '7', 'text' => '7', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => '8', 'text' => '8', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => '9', 'text' => '9', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
					['value' => '10', 'text' => '10', 'label' => ['class' => 'btn btn-outline-secondary ms-1 mb-3']],
				]
			);?>		
		
		<div class="text-end">
			<?php
			if (!empty($_isSearch)) {
			echo ' ';
			echo $this->Html->link(__('Reset'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm mx-1', 'title' => 'Reset']);
			} 
			echo $this->Form->button(__('Search'), ['class' => 'btn btn-outline-secondary btn-sm', 'title' => 'Search']);
			echo $this->Form->end();
			?>
		</div>
		</div>
		</div>
	</div>
</div>
<!--Search Form End-->
<?php echo $this->element('report/pain_attack'); ?>
<div class="card mb-3 shadow module-blue-big border borderless mt-1">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Pains Monitoring
		<div class=" text-light contribution_counter_month"><?php echo $system_name; ?></div>
	</div>
  <div class="card-body bg-light border borderless px-0">
    <div class="table-responsive">
        <table class="table text-secondary mt-4 px-1 table-sm">
            <thead>
                <tr>
					<th class="px-3"><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('feel') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('pain_point') ?></th>
                    <th><?= $this->Paginator->sort('medication') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('') ?></th>
                </tr>
            </thead>
            <tbody>
				<?php foreach ($pains as $pain): ?>
                <tr>
					<td class="px-3"><?= $this->Number->format($pain->id) ?></td>
                    <td><?= $pain->has('user') ? $this->Html->link($pain->user->username, ['controller' => 'Users', 'action' => 'view', $pain->user->id]) : '' ?></td>
                    <td><?= h($pain->type) ?></td>
                    <td><?= $this->Number->format($pain->feel) ?></td>
                    <td><?= date('d M Y', strtotime($pain->date)); ?></td>
                    <td><?= h($pain->pain_point) ?></td>
                    <td><?= h($pain->medication) ?></td>
                    <td><?= date('d M Y (h:s a)', strtotime($pain->created)); ?></td>
                    <td style="text-align: center;" class="px-3">
	<div class="dropdown">
	  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		<i class="fas fa-bars text-primary"></i>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		<?= $this->Html->link(__('<i class="fas fa-plus"></i> View'), ['action' => 'view', $pain->id, 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['action' => 'edit', $pain->id, 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
		<?= $this->Form->postLink(__('<i class="far fa-trash-alt"></i> Delete'), ['action' => 'delete', $pain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pain->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
	  </ul>
	</div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator px-3 text-end">
        <ul class="pagination justify-content-end">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-muted text-small"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
  </div>
</div>
</div><!--Container End-->

<script type="text/javascript">
$('#publish_from').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});

$('#publish_to').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	formatDate:'Y/m/d',
	//minDate:'-1970/01/01', // yesterday is minimum date
	//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
});
</script>