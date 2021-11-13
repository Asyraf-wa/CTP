<?php
	use Cake\Routing\Router; //load at the beginning of file
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	$random = (rand(10,100));
	$domain = Router::url("/", true);
	$c_name = $this->request->getParam('controller');
?>

<div class="container mt-1">

  <div class="row top-controller">
    <div class="text-end">
<div class="btn-group my-2" role="group" aria-label="Basic outlined example">
	<?= $this->Html->link(__('<i class="fas fa-plus fa-sm"></i>'), ['action' => 'add'], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false]) ?>
	<?= $this->Html->link(__('<i class="fas fa-search fa-sm"></i>'), ['action' => ''], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'type' => 'button', 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#flush-search', 'aria-expanded' => 'false', 'aria-controls' => 'flush-search']) ?>
	<?php if (!empty($_isSearch)) {
		echo $this->Html->link(__('<i class="fas fa-sync-alt fa-sm"></i>'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Reset']);
	} ?>
	<?= $this->Html->link(__('<i class="fas fa-star fa-sm"></i>'), ['?' => ['featured' => '1']], ['title' => __('Featured Only'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false]) ?>
</div>
	</div>
	
<div class="accordion accordion-flush" id="search">
  <div class="accordion-item">
    <div id="flush-search" class="accordion-collapse <?php if (!empty($_isSearch)) {
	echo '';
}else
	echo 'collapse';
?>" aria-labelledby="flush-headingOne" data-bs-parent="#search">
      <div class="accordion-body px-0 py-0">

<div class="card border-light mb-3">
  <div class="card-body px-0 py-0">
<?php echo $this->Form->create(null, ['valueSources' => 'query']); ?>

  <div class="row">
    <div class="col">
      <?php echo $this->Form->control('search', ['class' =>'form-control', 'onkeypress' =>'handle', 'label' =>'Search', 'placeholder' =>'Looking for something?']); ?>
    </div>
  </div>
  
  <div class="row">
    <div class="col">
      <?php echo $this->Form->control('publish_from',['required' => false, 'type' => 'date']); ?>
    </div>
    <div class="col">
      <?php echo $this->Form->control('publish_to',['required' => false, 'type' => 'date']); ?>
    </div>
  </div>

<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2();
	$("#tagging").select2({
		  tags: true,
          placeholder: "Tagging",
		  tokenSeparators: [','], 
          allowClear: true
      });
}
);
</script>

<script>
    function handle(e){
        if(e.key === "Enter"){
            alert("Enter was just pressed.");
        }

        return false;
    }
</script>

<div class="text-end">
<?php
	echo $this->Form->button(__('Search'), ['class' => 'btn btn-outline-secondary btn-sm']);
 	if (!empty($_isSearch)) {
		echo ' ';
		echo $this->Html->link(__('Reset'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm']);
	} 

	echo $this->Form->end();
?>
</div>

  </div>
</div>
	  </div>
    </div>
  </div>
</div>
  </div>
  
  
<?php //echo $this->element('report/current_year_published'); ?>




<div class="card mb-3 shadow module-blue-big border borderless mt-3">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Contact Us Management
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-light border borderless px-0">
		
    <div class="table-responsive">
        <table class="table text-secondary mt-4 px-1 table-sm">
            <thead>
                <tr>
                    <th class="px-3"><?= $this->Paginator->sort('ticket') ?></th>
                    <th><?= $this->Paginator->sort('subject') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('ip') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('respond_date_time','Responded') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td class="px-3"><?= h($contact->ticket) ?></td>
                    <td><?= h($contact->subject) ?></td>
                    <td><?= h($contact->name) ?></td>
                    <td><?= h($contact->email) ?></td>
                    <td><?= h($contact->ip) ?></td>
<td style="text-align: center;">
					<?php if ($contact->status == 1){
						echo '<i class="fas fa-circle text-success"></i>';
					}else
						echo '<i class="fas fa-circle text-danger"></i>';
					?>
					
					</td>
                    <td><?= $this->Number->format($contact->id) ?></td>
                    <td>
					<?php if ($contact->respond_date_time == NULL) {
						echo '-';
					}else
						echo date('d M Y', strtotime($contact->respond_date_time));
					?>
					</td>
                    <td><?= date('d M Y', strtotime($contact->created)); ?></td>
                    <td style="text-align: center;" class="px-3">
<div class="dropdown">
  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('<i class="far fa-edit"></i> View'), ['action' => 'edit', $contact->id], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contact->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contact->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
  </ul>
</div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
		
    <div class="paginator px-3">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
		</div>
</div>

</div>
