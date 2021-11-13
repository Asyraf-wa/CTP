<?php
	use Cake\Routing\Router; //load at the beginning of file
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	$random = (rand(10,100));
	$domain = Router::url("/", true);
	$c_name = $this->request->getParam('controller');
?>
<div class="container"><!--Container Start-->
<!--Top Menu Start-->
<div class="text-end pt-2 pb-2">
	<div class="btn-group" role="group" aria-label="Basic outlined example">
		<?= $this->Html->link(__('<i class="fas fa-plus fa-sm"></i>'), ['action' => 'add'], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'New']) ?>
		<?= $this->Html->link(__('<i class="fas fa-search fa-sm"></i>'), ['action' => ''], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'type' => 'button', 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#flush-search', 'aria-expanded' => 'false', 'aria-controls' => 'flush-search', 'title' => 'Search']) ?>
		<?= $this->Html->link(__('<i class="fas fa-star fa-sm"></i>'), ['?' => ['featured' => '1']], ['title' => __('Featured Only'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false]) ?>
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
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Blog Management
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-light border borderless px-0">
    <table class="table text-secondary mt-4 px-1 table-sm">
            <thead>
                <tr>
                    <th class="px-3"><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('hits') ?></th>
                    <th style="text-align: center;"><?= $this->Paginator->sort('published') ?></th>
                    <th><?= $this->Paginator->sort('user_id','Author') ?></th>
                    <th><?= $this->Paginator->sort('publish_on') ?></th>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td class="px-3"><?= h($blog->title) ?></td>
                    <td><?= $this->Number->format($blog->hits) ?></td>
                    <td style="text-align: center;">
					<?php if ($blog->published == 1){
						echo '<i class="fas fa-circle text-success"></i>';
					}else
						echo '<i class="fas fa-circle text-danger"></i>';
					?>
					</td>
                    <td><?= $blog->has('user') ? $this->Html->link($blog->user->username, ['controller' => 'Users', 'action' => 'view', $blog->user->id]) : '' ?></td>
                    <td><?= date('d M Y', strtotime($blog->publish_on)); ?></td>
                    <td><?= $this->Number->format($blog->id) ?></td>
                    <td style="text-align: center;" class="px-3">
<div class="dropdown">
  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('<i class="fas fa-plus"></i> View'), ['action' => 'view', $blog->id, 'prefix' => false], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['action' => 'edit', $blog->id], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $blog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $blog->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
  </ul>
</div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
		
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