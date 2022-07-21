<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publication $publication
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Publication'), ['action' => 'edit', $publication->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Publication'), ['action' => 'delete', $publication->id], ['confirm' => __('Are you sure you want to delete # {0}?', $publication->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Publications'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Publication'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="publications view content">
            <h3><?= h($publication->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= h($publication->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $publication->has('user') ? $this->Html->link($publication->user->username, ['controller' => 'Users', 'action' => 'view', $publication->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($publication->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($publication->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Keywords') ?></th>
                    <td><?= h($publication->keywords) ?></td>
                </tr>
                <tr>
                    <th><?= __('Authors') ?></th>
                    <td><?= h($publication->authors) ?></td>
                </tr>
                <tr>
                    <th><?= __('Diciplines') ?></th>
                    <td><?= h($publication->diciplines) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sponsor') ?></th>
                    <td><?= h($publication->sponsor) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pointer') ?></th>
                    <td><?= h($publication->pointer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Link') ?></th>
                    <td><?= h($publication->link) ?></td>
                </tr>
                <tr>
                    <th><?= __('Year') ?></th>
                    <td><?= $this->Number->format($publication->year) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($publication->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($publication->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($publication->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Abstract') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($publication->abstract)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Note') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($publication->note)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
