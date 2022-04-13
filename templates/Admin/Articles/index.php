<?php
	use Cake\Routing\Router;
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
?>

<div class="container"><!--Container Start-->
<?php
//extract URL parameter for collapse search
/* $search = $this->request->getQuery('search');
echo $search;
$tag = $this->request->getQuery('tag');
echo $tag;
$category = $this->request->getQuery('category_id');
echo $category; */
?>
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
<!--Search Form Start-->
<div class="accordion accordion-flush" id="search">
	<div class="accordion-item">
		<div id="flush-search" class="accordion-collapse <?= (!empty($_isSearch)) == ''?'collapse':'' ?>" aria-labelledby="flush-headingOne" data-bs-parent="#search">
		<div class="accordion-body bg-light">
<?php echo $this->Form->create(null, ['valueSources' => 'query']); ?>

  <div class="row">
    <div class="col">
      <?php echo $this->Form->control('search', ['class' =>'form-control', 'onkeypress' =>'handle', 'label' =>'Search', 'placeholder' =>'Looking for something?']); ?>
    </div>
    <div class="col">
      <?php echo $this->Form->control('category_id', [
					'options' => $categories,
					'empty' => 'Select Category',
					'class' => 'form-select',
					'required' => false
				]); ?>
    </div>
  </div>

<?php //echo $this->Form->control('tag', ['options' => $tags, 'empty' => true, 'class' => 'form-select', 'required' => false]); ?>
<?php echo $this->Form->control('tag',['options' => $tags, 'id' => 'tagging', 'multiple' => true,]); ?>

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

<?php echo $this->element('report/current_year_published'); ?>

<div class="card mb-3 shadow module-blue-big border borderless mt-3">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Article Management
		<div class=" text-light contribution_counter_month"><?php echo $system_name; ?></div>
	</div>
  <div class="card-body bg-light border borderless px-0">

    <div class="table-responsive">


        <table class="table text-secondary mt-4 px-1 table-sm">
            <thead>
                <tr>
                    <th class="px-3"><?= $this->Paginator->sort('category_id') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('featured') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('published') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('hits') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('user_id','Author') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('publish_on') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('id') ?></th>
                    <th class="actions"><?= __('') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                <tr>
                    <td class="px-3"><?= $article->has('category') ? $this->Html->link($article->category->title, ['controller' => 'Categories', 'action' => 'view', $article->category->id]) : '' ?>
					</td>
                    <td><?= h($article->title) ?> 
<a class="btn p-0" data-bs-toggle="collapse" href="#collapse<?= h($article->id) ?>" role="button" aria-expanded="false" aria-controls="collapse<?= h($article->id) ?>">
<i class="far fa-caret-square-down"></i>
</a>

<div class="collapse" id="collapse<?= h($article->id) ?>">
    <b>Tags:</b> <?php echo h($article->tag_list); ?>
</div>
					</td>
                    <td style="text-align: center;">
					<?php if($article->featured == 1){
						echo '<i class="fas fa-star text-warning"></i>';
					}else
						echo '<i class="far fa-star text-secondary"></i>';
					?>
					</td>
                    <td style="text-align: center;">
					<?php if ($article->published == 1){
						echo '<i class="fas fa-circle text-success"></i>';
					}else
						echo '<i class="fas fa-circle text-danger"></i>';
					?>
					</td>
                    <td style="text-align: center;"><?= $this->Number->format($article->hits) ?></td>
                    <td style="text-align: center;"><?= $article->has('user') ? $this->Html->link($article->user->username, ['controller' => 'Users', 'action' => 'view', $article->user->id]) : '' ?></td>
                    <td style="text-align: center;"><?= date('d M Y', strtotime($article->publish_on)); ?></td>
                    <td style="text-align: center;"><?= h($article->id) ?></td>
                    <td style="text-align: center;" class="px-3">
					



<div class="dropdown">
  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('<i class="fas fa-plus"></i> View'), ['action' => 'view', $article->id, 'prefix' => false], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['action' => 'edit', $article->id], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $article->id], ['confirm' => __('Are you sure you want to delete # {0}?', $article->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
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