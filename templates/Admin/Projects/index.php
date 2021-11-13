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
			<div class="col-md-8">
			<?php echo $this->Form->control('search', ['class' =>'form-control', 'onkeypress' =>'handle', 'label' =>'Search', 'placeholder' =>'Looking for something?']); ?>
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
<div class="card mb-3 shadow module-blue-big border borderless mt-1">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Projects Management
		<div class=" text-light contribution_counter_month"><?php echo $system_name; ?></div>
	</div>
  <div class="card-body bg-light border borderless px-0">
    <div class="table-responsive">
        <table class="table text-secondary mt-4 px-1 table-sm">
            <thead>
                <tr>
					<th class="px-3"><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('category') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('hits') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('kudos') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('publish') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('progress') ?></th>
                    <th><?= $this->Paginator->sort('publish_on') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('') ?></th>
                </tr>
            </thead>
            <tbody>
				<?php foreach ($projects as $project): ?>
                <tr>
					<td class="px-3"><?= $this->Number->format($project->id) ?></td>
                    <td><?= h($project->category) ?></td>
                    <td><?= h($project->title) ?></td>
                    <td style="text-align: center;"><?= $this->Number->format($project->hits) ?></td>
                    <td style="text-align: center;"><?= $this->Number->format($project->kudos) ?></td>
                    <td style="text-align: center;">
					<?php if ($project->published == 1){
						echo '<i class="fas fa-circle text-success"></i>';
					}else
						echo '<i class="fas fa-circle text-danger"></i>';
					?></td>
                    <td><?= h($project->progress) ?></td>
                    <td><?= date('d M Y', strtotime($project->publish_on)); ?></td>
                    <td><?= date('d M Y (h:s a)', strtotime($project->created)); ?></td>
                    <td style="text-align: center;" class="px-3">
	<div class="dropdown">
	  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		<i class="fas fa-bars text-primary"></i>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		<?= $this->Html->link(__('<i class="fas fa-plus"></i> View'), ['action' => 'view', $project->id, 'prefix' => false], ['class' => 'dropdown-item', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['action' => 'edit', $project->id], ['class' => 'dropdown-item', 'escape' => false]) ?>
		<?= $this->Form->postLink(__('<i class="far fa-trash-alt"></i> Delete'), ['action' => 'delete', $project->id], ['confirm' => __('Are you sure you want to delete # {0}?', $project->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
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