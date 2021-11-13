<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fitness $fitness
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Fitness'), ['action' => 'edit', $fitness->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Fitness'), ['action' => 'delete', $fitness->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fitness->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Fitnesses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Fitness'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="fitnesses view content">
            <h3><?= h($fitness->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $fitness->has('user') ? $this->Html->link($fitness->user->username, ['controller' => 'Users', 'action' => 'view', $fitness->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($fitness->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Latitude') ?></th>
                    <td><?= h($fitness->latitude) ?></td>
                </tr>
                <tr>
                    <th><?= __('Longitude') ?></th>
                    <td><?= h($fitness->longitude) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($fitness->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Counter') ?></th>
                    <td><?= $this->Number->format($fitness->counter) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($fitness->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Registered On') ?></th>
                    <td><?= h($fitness->registered_on) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($fitness->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($fitness->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
