<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Publication $publication
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $publication->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $publication->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Publications'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="publications form content">
            <?= $this->Form->create($publication) ?>
            <fieldset>
                <legend><?= __('Edit Publication') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('year');
                    echo $this->Form->control('type');
                    echo $this->Form->control('title');
                    echo $this->Form->control('keywords');
                    echo $this->Form->control('authors');
                    echo $this->Form->control('abstract');
                    echo $this->Form->control('diciplines');
                    echo $this->Form->control('sponsor');
                    echo $this->Form->control('pointer');
                    echo $this->Form->control('link');
                    echo $this->Form->control('note');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
