<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fitness[]|\Cake\Collection\CollectionInterface $fitnesses
 */
?>
<div class="fitnesses index content">
    <?= $this->Html->link(__('New Fitness'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Fitnesses') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('counter') ?></th>
                    <th><?= $this->Paginator->sort('latitude') ?></th>
                    <th><?= $this->Paginator->sort('longitude') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('registered_on') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fitnesses as $fitness): ?>
                <tr>
                    <td><?= $this->Number->format($fitness->id) ?></td>
                    <td><?= $fitness->has('user') ? $this->Html->link($fitness->user->username, ['controller' => 'Users', 'action' => 'view', $fitness->user->id]) : '' ?></td>
                    <td><?= h($fitness->type) ?></td>
                    <td><?= $this->Number->format($fitness->counter) ?></td>
                    <td><?= h($fitness->latitude) ?></td>
                    <td><?= h($fitness->longitude) ?></td>
                    <td><?= $this->Number->format($fitness->status) ?></td>
                    <td><?= h($fitness->registered_on) ?></td>
                    <td><?= h($fitness->created) ?></td>
                    <td><?= h($fitness->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $fitness->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fitness->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fitness->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fitness->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
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
