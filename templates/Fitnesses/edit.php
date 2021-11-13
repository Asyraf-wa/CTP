<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fitness $fitness
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $fitness->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $fitness->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Fitnesses'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="fitnesses form content">
            <?= $this->Form->create($fitness) ?>
            <fieldset>
                <legend><?= __('Edit Fitness') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('type');
                    echo $this->Form->control('counter');
                    echo $this->Form->control('latitude');
                    echo $this->Form->control('longitude');
                    echo $this->Form->control('status');
                    echo $this->Form->control('registered_on');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
