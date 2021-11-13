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
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">List of Users
		<div class=" text-light contribution_counter_month"><?php echo $system_name; ?></div>
	</div>
  <div class="card-body bg-light border borderless px-0">
    <div class="table-responsive">
        <table class="table text-secondary mt-4 px-1 table-sm">
            <thead>
                <tr>
					<th class="px-3"><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('avatar',' ') ?></th>
                    <th><?= $this->Paginator->sort('user_group_id') ?></th>
                    <th><?= $this->Paginator->sort('fullname') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
					
                    <th class="actions"><?= __('') ?></th>
                </tr>
            </thead>
            <tbody>
				<?php foreach ($users as $user): ?>
                <tr>
					<td class="px-3"><?= $this->Number->format($user->id) ?></td>
					<td class="px-3"><?php echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $this->Identity->get('avatar'), ['alt' => 'Profile Picture', 'class' => 'rounded-circle shadow my-2', 'width' => '70px', 'height' => '70px']); ?></td>
                    <td><?= $user->has('user_group') ? $this->Html->link($user->user_group->name, ['controller' => 'UserGroups', 'action' => 'view', $user->user_group->id]) : '' ?></td>
                    <td>
					<?= h($user->fullname) ?><br>
  <a class="btn btn-outline-primary btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    <i class="far fa-plus-square"></i> Article
  </a>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
<?php foreach ($user->articles as $articles): ?>  
	<?= h($articles->title) ?><br>
<?php endforeach; ?>	
  </div>
</div>
				
					</td>
                    <td><?= h($user->username) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->status) ?></td>
                    <td><?= date('d M Y (h:s a)', strtotime($user->created)); ?></td>
                    <td style="text-align: center;" class="px-3">
	<div class="dropdown">
	  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		<i class="fas fa-bars text-primary"></i>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		<?= $this->Html->link(__('<i class="fas fa-plus"></i> View'), ['action' => 'view', $user->id, 'prefix' => false], ['class' => 'dropdown-item', 'escape' => false]) ?>
		<?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['action' => 'edit', $user->id], ['class' => 'dropdown-item', 'escape' => false]) ?>
		<?= $this->Form->postLink(__('<i class="far fa-trash-alt"></i> Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
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





