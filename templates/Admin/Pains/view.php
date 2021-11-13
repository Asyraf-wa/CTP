<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pain $pain
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Pain'), ['action' => 'edit', $pain->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Pain'), ['action' => 'delete', $pain->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pain->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Pains'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Pain'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="pains view content">
            <h3><?= h($pain->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $pain->has('user') ? $this->Html->link($pain->user->username, ['controller' => 'Users', 'action' => 'view', $pain->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($pain->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pain Point') ?></th>
                    <td><?= h($pain->pain_point) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($pain->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Feel') ?></th>
                    <td><?= $this->Number->format($pain->feel) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($pain->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($pain->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($pain->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Medication') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($pain->medication)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Cause') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($pain->cause)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
