<?php
	use Cake\Routing\Router; //load at the beginning of file
	echo $this->Html->css('select2/css/select2.css');
	echo $this->Html->script('select2/js/select2.full.min.js');
	echo $this->Html->css('jquery.datetimepicker.min.css');
	echo $this->Html->script('jquery.datetimepicker.full.js');
	echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
	$random = (rand(10,100));
	$domain = Router::url("/", true);
	$c_name = $this->request->getParam('controller');
?>

<div class="container"><!--Container Start-->
<!--Top Menu Start-->
<div class="text-end pt-2 pb-2">
	<div class="btn-group" role="group" aria-label="Basic outlined example">
	<?= $this->Html->link(__('<i class="fas fa-sort-amount-down fa-sm"></i>'), ['?' => ['sort' => 'publish_on', 'direction' => 'desc']], ['title' => __('Latest First'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Latest First']) ?>
	<?= $this->Html->link(__('<i class="fas fa-sort-amount-up-alt fa-sm"></i>'), ['?' => ['sort' => 'publish_on', 'direction' => 'asc']], ['title' => __('Oldest First'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Oldest First']) ?>
	<?= $this->Html->link(__('<i class="fas fa-search fa-sm"></i>'), ['action' => ''], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'type' => 'button', 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#flush-search', 'aria-expanded' => 'false', 'aria-controls' => 'flush-search']) ?>
	<?php if (!empty($_isSearch)) {
		echo $this->Html->link(__('<i class="fas fa-sync-alt fa-sm"></i>'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Reset']);
	} ?>
	<?= $this->Html->link(__('<i class="fas fa-star fa-sm"></i>'), ['?' => ['featured' => '1']], ['title' => __('Featured Only'), 'class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false]) ?>
	</div>
</div>
<!--Top Menu End-->
<!--Search Form Start-->
<div class="accordion accordion-flush" id="search">
	<div class="accordion-item">
		<div id="flush-search" class="accordion-collapse <?= (!empty($_isSearch)) == ''?'collapse':'' ?>" aria-labelledby="flush-headingOne" data-bs-parent="#search">
		<div class="accordion-body bg-light">
<?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'publications','action' => 'index']]); ?>

  <div class="row">
    <div class="col">
      <?php echo $this->Form->control('q', ['class' =>'form-control', 'onkeypress' =>'handle', 'label' =>'Search', 'placeholder' =>'Looking for something?']); ?>
      
    </div>
  </div>
  
  <div class="row">
    <div class="col">
    <?php echo $this->Form->label('Manuscript Type'); ?><br>
    <?php
        $options = [
            'Journal' => 'Journal',
            'Proceeding' => 'Proceeding',
            'Newsletter' => 'Newsletter',
            'Position' => 'Position',
            'Book' => 'Book',
            'Others' => 'Others',
        ];
        echo $this->Form->select('paper_type', $options, [
            'multiple' => 'checkbox',
            'class' =>'form-check-input'
        ]); 
        ?>
    </div>
    <div class="col">
    <?php echo $this->Form->label('Indexing'); ?><br>
        <?php
        $options = [
            'Web of Science' => 'Web of Science',
            'Scopus' => 'Scopus',
            'MyCite' => 'MyCite',
            'Others' => 'Others',
        ];
        echo $this->Form->select('pointer', $options, [
            'multiple' => 'checkbox',
            'class' =>'form-check-input'
        ]); 
        ?>
    </div>
  </div>

<div class="py-2">
    <?php echo $this->Form->label('Published Year'); ?><br>
    <?php
    $options = [
        '2021' => '2021',
        '2022' => '2022',
        '2023' => '2023',
    ];
    echo $this->Form->select('y', $options, [
        'multiple' => 'checkbox',
        'class' =>'form-check-input'
    ]); 
    ?>
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

<div class="row">
	<div class="col-md-9">
    <div class="card mt-3 mb-3 shadow ">
        <div class="card-body">
        <?php
    $page = $this->Paginator->counter('{{page}}');
    $limit = 10; 
    $counter = ($page * $limit) - $limit + 1;
?>
        <table class="table table-borderless">
        <?php foreach ($publications as $publication): ?>
            <tr>
                <td><?= $counter++ ?>.</td>
                <td class="justify">
                    <?= $publication->reference ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
        </div>
    </div>

    <?php foreach ($publications as $publication): ?>
        
        <div class="card mt-3 mb-3 shadow ">
        <div class="card-body">
            <div class="row">
                <div class="col-md-1">
                    <div class="fs-5 fw-bold text-center"><i class="far fa-calendar-alt fa-2x"></i><?= h($publication->year) ?></div>
                </div>
                <div class="col-md-11">
                    <div class="fs-6 fw-bold"><?= h($publication->manuscript_title) ?></div>
                    <div class="fst-italic"><?= h($publication->authors) ?></div>
                    <div class="fw-normal">
                        <?= h($publication->journal_name) ?>, 
                        <?php if($publication->volume != NULL){
                                echo '<i class="fst-italic">' . $publication->volume . '</i>';
                            }else
                                echo '';
                        ?>
                        <?php if($publication->issue != NULL){
                            echo '(' . $publication->issue . '),';
                        }else
                            echo '';
                        ?> 
                        <?= h($publication->pages) ?>
                        | <a class="" data-bs-toggle="collapse" href="#<?= h($publication->slug) ?>" role="button" aria-expanded="false">Read more...</a></div>
                </div>
            </div>
                    <div class="collapse" id="<?= h($publication->slug) ?>">
                    <div class="">
                        <hr>
                        <div class="justify"><b class="fw-bold">Abstract: </b><?= h($publication->abstract) ?>
                        <br><br>
                            <?php if($publication->doi != NULL){
                                echo '<b>DOI:</b>' . $publication->doi . ' | ';
                            }else
                                echo '';
                            ?>
                            <b>ISBN/ISSN:</b> <?= h($publication->serial) ?> | 
                            <b>Index:</b> <?= h($publication->pointer) ?> |
                            <b>Link:</b> <a href="<?= h($publication->url) ?>", target = "_blank"><i class="fas fa-external-link-alt"></i></a>
                            <br>
                            <b>Keywords:</b> <?= h($publication->keywords) ?><br>
                            <b>Sponsor:</b> <?= h($publication->sponsor) ?>
                        </div>
                    </div>
                    </div>

        </div>
        </div>
    <?php endforeach; ?>
	</div>
	<div class="col-md-3">
        <div class="card mt-3 mb-3">
            <div class="card-body shadow ">

<div id="yearly-publication-bar"></div>
<script>
options = {
  chart: {
    type: 'bar'
  },
  dataLabels: {
    enabled: false
  },
  series: [{
    data: [{
      x: '2021',
      y: <?= json_encode($y2021); ?>
    }, {
      x: '2022',
      y: <?= json_encode($y2022); ?>
    }]
  }]
}
var chart = new ApexCharts(document.querySelector("#yearly-publication-bar"), options);
chart.render();
</script>     




<div id="publication-index-treemap"></div>
<script>
var options = {
  chart: {
    height: 350,
	type: "treemap",
  },
  series: [{
    data: [
		{
            x: "WOS",
            y: <?= json_encode($wos); ?>,
		},
		{
            x: "Scopus",
            y: <?= json_encode($scopus); ?>,
		},
		{
            x: "MyCite",
            y: <?= json_encode($mycite); ?>,
		},
		{
            x: "Others",
            y: <?= json_encode($others); ?>,
		},
	]
  }],
}

var chart = new ApexCharts(document.querySelector("#publication-index-treemap"), options);

chart.render();
</script>

            </div>
        </div>
	</div>
</div>


  
<div class="paginator text-end text-secondary">
    <ul class="pagination pagination-sm justify-content-end">
        <?= $this->Paginator->first('<< ' . __('First')) ?>
        <?= $this->Paginator->prev('< ' . __('Previous')) ?>
        <?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} article(s) out of {{count}} total')) ?></p>
</div>
</div><!--Container End-->