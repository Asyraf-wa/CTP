<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Todo[]|\Cake\Collection\CollectionInterface $todos
 */
?>
<div class="container"><!--Container Start-->
<!--Top Menu Start-->
<div class="text-end pt-2 pb-2">
	<div class="btn-group" role="group" aria-label="Basic outlined example">
		<?= $this->Html->link(__('<i class="fas fa-plus fa-sm"></i>'), ['action' => 'add'], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'New']) ?>
		<?= $this->Html->link(__('<i class="fas fa-search fa-sm"></i>'), ['action' => ''], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'type' => 'button', 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#flush-search', 'aria-expanded' => 'false', 'aria-controls' => 'flush-search', 'title' => 'Search']) ?>
		<?= $this->Html->link(__('<i class="fas fa-star fa-sm"></i>'), ['?' => ['featured' => '1']], ['title' => __('Featured Only'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="fas fa-code"></i>'), ['action' => 'report'], ['title' => __('Report'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false]) ?>
		<?php if (!empty($_isSearch)) {
			echo $this->Html->link(__('<i class="fas fa-sync-alt fa-sm"></i>'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Reset']);
		} ?>
	</div>
</div>
<!--Top Menu End-->

<div class="card mb-3 shadow module-blue-big border borderless mt-3">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">To Do Task
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-light border borderless px-0">
    <div class="table-responsive">
        <table class="table text-secondary mt-4 px-1 table-sm">
            <thead>
                <tr>
                    <th class="px-3"><?= $this->Paginator->sort('task') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions" style="text-align: center;"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($todos as $todo): ?>
                <tr>
                    <td><?= h($todo->task) ?></td>
                    <td>
<?php if ($todo->status == 1)
	echo '<div class="badge bg-success text-wrap">Completed</div>';
else
	echo '<div class="badge bg-warning text-wrap">Pending</div>';
?>

					</td>
                    <td><?= h($todo->created) ?></td>
                    <td><?= h($todo->modified) ?></td>
                    <td style="text-align: center;" class="px-3">
<div class="dropdown">
  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('<i class="fas fa-plus"></i> View'), ['action' => 'view', $todo->id, 'prefix' => 'Admin'], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['action' => 'edit', $todo->id], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $todo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $todo->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
<?php if ($todo->status == 0) : ?>
<?= $this->Form->postButton(__('Completed'), 
       [
          'controller' => 'Todos', 
          'action' => 'completed', 
           $todo->id
       ], 
       [
           'block' => true,
           'class' => 'dropdown-item',
           'confirm' => __('Are you sure you want to delete # {0}?', $todo['id'])
           ]) ?>
<?php else : ?>
<?= $this->Form->postButton(__('Pending'), 
       [
          'controller' => 'Todos', 
          'action' => 'pending', 
           $todo->id
       ], 
       [
           'block' => true,
           'class' => 'dropdown-item',
           'confirm' => __('Are you sure you want to delete # {0}?', $todo['id'])
           ]) ?>
<?php endif; ?>
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


</div><!--Container End-->
