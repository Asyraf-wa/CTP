<?php

use Cake\Routing\Router; //load at the beginning of file
echo $this->Html->css('select2/css/select2.css');
echo $this->Html->script('select2/js/select2.full.min.js');
echo $this->Html->css('jquery.datetimepicker.min.css');
echo $this->Html->script('jquery.datetimepicker.full.js');
$domain = Router::url("/", true);
$c_name = $this->request->getParam('controller');
$this->assign('title', 'Code The Pixel - Coding and Tutorial');
?>

<div class="container mt-4">
	<div class="text-end">
		<button id="gridButton" class="btn btn-secondary btn-xs" title="Grid View">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<rect x="3" y="3" width="7" height="7"></rect>
				<rect x="14" y="3" width="7" height="7"></rect>
				<rect x="14" y="14" width="7" height="7"></rect>
				<rect x="3" y="14" width="7" height="7"></rect>
			</svg>
		</button>
		<button id="listButton" class="btn btn-secondary btn-xs" title="List View">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<line x1="8" y1="6" x2="21" y2="6"></line>
				<line x1="8" y1="12" x2="21" y2="12"></line>
				<line x1="8" y1="18" x2="21" y2="18"></line>
				<line x1="3" y1="6" x2="3.01" y2="6"></line>
				<line x1="3" y1="12" x2="3.01" y2="12"></line>
				<line x1="3" y1="18" x2="3.01" y2="18"></line>
			</svg>
		</button>

		<?= $this->Html->link(__('
<svg width="20" height="20" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="white" stroke-width="10">
<path d="M47.4451 47.4983L50.7244 50.7776M50.7249 55.0168L63.4534 67.7487C64.6243 68.9199 66.523 68.9201 67.6941 67.749C68.8649 66.5782 68.865 64.6799 67.6944 63.5089L54.9659 50.777C53.795 49.6058 51.8963 49.6057 50.7252 50.7767C49.5544 51.9476 49.5542 53.8458 50.7249 55.0168Z" stroke="#C2CCDE" stroke-linecap="round" stroke-linejoin="round" />
<path d="M15.5967 29.0688C17.3584 22.494 22.494 17.3584 29.0688 15.5967C35.6437 13.8349 42.6591 15.7147 47.4722 20.5278C52.2854 25.341 54.1651 32.3563 52.4034 38.9312C50.6416 45.5061 45.5061 50.6416 38.9312 52.4034C32.3563 54.1651 25.341 52.2854 20.5278 47.4722C15.7147 42.6591 13.8349 35.6437 15.5967 29.0688Z" stroke="#C2CCDE" stroke-linecap="round" stroke-linejoin="round" />
</svg>
	'), ['action' => ''], ['class' => 'btn btn-secondary btn-xs', 'escape' => false, 'data-bs-toggle' => 'collapse', 'data-bs-target' => '#flush-search', 'aria-expanded' => 'false', 'aria-controls' => 'flush-search']) ?>
		<?php if (!empty($_isSearch)) {
			echo $this->Html->link(__('<i class="fas fa-sync-alt fa-sm"></i>'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-secondary btn-sm my-2 shadow', 'escape' => false, 'title' => 'Reset']);
		} ?>
	</div>

	<!--Search Form Start-->
	<div class="accordion accordion-flush mt-1" id="search">
		<div class="accordion-item">
			<div id="flush-search" class="accordion-collapse <?= (!empty($_isSearch)) == '' ? 'collapse' : '' ?>" aria-labelledby="flush-headingOne" data-bs-parent="#search">
				<div class="card bg-body-tertiary border-0 shadow">
					<div class="card-body">
						<?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'articles', 'action' => 'index']]); ?>
						<div class="row">
							<div class="col">
								<?php echo $this->Form->control('search', ['class' => 'form-control', 'onkeypress' => 'handle', 'label' => 'Search', 'placeholder' => 'Looking for something?']); ?>
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

						<div class="row">
							<div class="col-md-8 col-xs-4">
								<?php echo $this->Form->control('tag', ['options' => $tags, 'id' => 'tagging', 'multiple' => true,]); ?>
							</div>
							<div class="col-md-2 col-xs-4">
								<?php echo $this->Form->control('publish_from', [
									'class' => 'form-control datepicker-here',
									'label' => 'Published From',
									'id' => 'publish_from',
									'type' => 'Text',
									'data-language' => 'en',
									'data-date-format' => 'Y-m-d',
									//'value' => date('Y-m-d'),
									'empty' => 'empty',
									'autocomplete' => 'off',
								]); ?>
								<script>
									$('#publish_from').datetimepicker({
										lang: 'en',
										timepicker: false,
										format: 'Y-m-d',
										formatDate: 'Y/m/d',
										//minDate:'-1970/01/01', // yesterday is minimum date
										//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
									});
								</script>
							</div>
							<div class="col-md-2 col-xs-4">
								<?php echo $this->Form->control('publish_to', [
									'class' => 'form-control datepicker-here',
									'label' => 'Published To',
									'id' => 'publish_to',
									'type' => 'Text',
									'data-language' => 'en',
									'data-date-format' => 'Y-m-d',
									//'value' => date('Y-m-d'),
									'empty' => 'empty',
									'autocomplete' => 'off',
								]); ?>
								<script>
									$('#publish_to').datetimepicker({
										lang: 'en',
										timepicker: false,
										format: 'Y-m-d',
										formatDate: 'Y/m/d',
										//minDate:'-1970/01/01', // yesterday is minimum date
										//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
									});
								</script>
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
							});
						</script>

						<script>
							function handle(e) {
								if (e.key === "Enter") {
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
	</div>
	<!--Search Form End-->


	<div class="row grid mt-0 g-3">
		<?php
		//$page = $this->params['paging']['Model']['page'];
		//$limit = $this->params['paging']['Model']['options']['limit'];
		//debug($this->request->param('paging'));
		//debug($this->Paginator->counter('{{current}}'));
		//debug($this->paginate['maxLimit']);

		/* $page = $this->Paginator->counter('{{page}}');
$limit = 10;

$counter = ($page * $limit) - $limit + 1; */
		$i = 1;
		?>




		<?php foreach ($articles as $article) : ?>

			<?php
			$domain = Router::url("/", true);
			$sub = 'articles/';
			$identifier = $article->slug;
			$combine = $domain . $sub . $identifier;

			switch ($i++) {
					//Row 1 [3 items]
				case "1":
					echo '<div class="col-md-6">';
					echo '<div class="big-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'big-bg-cover', 'width' => '644px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="big-gradient-feed big-gradient-brown">';
					echo '<div class="big-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="big-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						200,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "2":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-gray">';
					echo '<div class="small-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "3":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-blue">';
					echo '<div class="small-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
					//Row 2 [3 items]
				case "4":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-purple">';
					echo '<div class="small-feed-title text-light">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "5":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-green">';
					echo '<div class="small-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					//echo strip_tags($abc['Abc']['description']);
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					/* 	echo $this->Text->truncate(h($article->body),80,
		[
			'ellipsis' => '...',
			'exact' => false
		]); */
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "6":
					echo '<div class="col-md-6">';
					echo '<div class="big-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'big-bg-cover', 'width' => '644px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="big-gradient-feed big-gradient-yellow">';
					echo '<div class="big-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="big-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						200,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
					//Row 3 [4 items]
				case "7":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-gray">';
					echo '<div class="small-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';

					break;
				case "8":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-orange">';
					echo '<div class="small-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "9":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-pink">';
					echo '<div class="small-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "10":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-navy">';
					echo '<div class="small-feed-title text-light">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
					//Row 4 [3 items]
				case "11":
					echo '<div class="col-md-6">';
					echo '<div class="big-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'big-bg-cover', 'width' => '644px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="big-gradient-feed big-gradient-red">';
					echo '<div class="big-feed-title text-light">';
					echo h($article->title);
					echo '<div class="big-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						200,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "12":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-yellow">';
					echo '<div class="small-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "13":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-yellow-green">';
					echo '<div class="small-feed-title text-light">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
					//Row 5 [3 items]
				case "14":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-purple">';
					echo '<div class="small-feed-title text-light">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "15":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-red">';
					echo '<div class="small-feed-title text-light">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "16":
					echo '<div class="col-md-6">';
					echo '<div class="big-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'big-bg-cover', 'width' => '644px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="big-gradient-feed big-gradient-blue">';
					echo '<div class="big-feed-title text-light">';
					echo h($article->title);
					echo '<div class="big-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						200,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
					//Row 6 [4 items]
				case "17":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-green">';
					echo '<div class="small-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';

					break;
				case "18":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-navy">';
					echo '<div class="small-feed-title text-light">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "19":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-orange">';
					echo '<div class="small-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
				case "20":
					echo '<div class="col-md-3">';
					echo '<div class="small-feed-container">';
					echo ($article->featured == 1) ? "<div class='ribbon-featured'>Featured</div>" : "";
					echo $this->Html->image('../files/Articles/poster/' . $article->slug . '/' . $article->poster, ['class' => 'small-bg-cover', 'width' => '318px', 'height' => '300px', 'alt' => $article->title]);
					echo '<a href="' . $combine . '" class="feed-title-light-link">';
					echo '<div class="small-gradient-feed small-gradient-light-brown">';
					echo '<div class="small-feed-title text-dark">';
					echo h($article->title);
					echo '<div class="small-feed-intro">';
					echo strip_tags($this->Text->truncate(
						$article->body,
						80,
						[
							'ellipsis' => '...',
							'exact' => false
						]
					));
					echo '<div>';
					echo '<button type="button" class="btn hits">' . $article->category->title . ' </button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-eye"></i> ' . h($article->hits) . '</button> ';
					echo '<button type="button" class="btn hits"><i class="far fa-calendar-alt"></i> ' . date('M d, Y', strtotime($article->publish_on)) . '</button> ';
					echo '</div></div></div></div>';
					echo '</a>';
					echo '</div></div>';
					break;
			}
			?>
		<?php endforeach; ?>

		<div aria-label="Page navigation" class="mt-3 px-2">
			<ul class="pagination justify-content-end flex-wrap">
				<?= $this->Paginator->first('<< ' . __('First')) ?>
				<?= $this->Paginator->prev('< ' . __('Previous')) ?>
				<?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
				<?= $this->Paginator->next(__('Next') . ' >') ?>
				<?= $this->Paginator->last(__('Last') . ' >>') ?>
			</ul>
			<div class="text-end"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></div>
		</div>
	</div>


	<div class="list" style="display: none;"> <!-- Initially hidden -->
		<!-- list content here -->
		<div class="row">
			<div class="col-md-9">
				<div class="card bg-body-tertiary border-0 shadow">
					<div class="card-body">
						<div class="table-responsive">
							<table class="text-secondary table table-sm table-bordered mt-4 mb-4 table_transparent table-hover">
								<thead>
									<tr>
										<th class="px-3">#</th>
										<th><?= $this->Paginator->sort('title') ?></th>
										<th><?= $this->Paginator->sort('category_id') ?></th>
										<th style="text-align: center;"><?= $this->Paginator->sort('featured') ?></th>
										<th style="text-align: center;"><?= $this->Paginator->sort('hits') ?></th>
										<th style="text-align: center;"><?= $this->Paginator->sort('publish_on') ?></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$page = $this->Paginator->counter('{{page}}');
									$limit = 20; //limit ni supaya klu page last ada 8 rekod, dia xsalah kira
									$counter = ($page * $limit) - $limit + 1;
									?>
									<?php foreach ($articles as $article) : ?>
										<?php
										$domain = Router::url("/", true);
										$sub = 'articles/';
										$identifier = $article->slug;
										$combine = $domain . $sub . $identifier;
										?>

										<tr data-href="<?php echo $combine; ?>">
											<script>
												jQuery(document).ready(function($) {
													$('*[data-href]').on('click', function() {
														window.location = $(this).data("href");
													});
												});
											</script>
											<td class="px-3"><?= $counter++ ?></td>

											<td><?= h($article->title) ?></td>
											<td><?= $article->has('category') ? $article->category->title : '' ?></td>
											<td style="text-align: center;">
												<?php if ($article->featured == 1) {
													echo '<i class="fas fa-star text-warning"></i>';
												} else
													echo '<i class="far fa-star text-secondary"></i>';
												?>
											</td>
											<td style="text-align: center;"><?= $this->Number->format($article->hits) ?></td>
											<td style="text-align: center;" class="px-3"><?= date('d M Y', strtotime($article->publish_on)); ?></td>
										</tr>

									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div aria-label="Page navigation" class="mt-3 px-2">
					<ul class="pagination justify-content-end flex-wrap">
						<?= $this->Paginator->first('<< ' . __('First')) ?>
						<?= $this->Paginator->prev('< ' . __('Previous')) ?>
						<?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
						<?= $this->Paginator->next(__('Next') . ' >') ?>
						<?= $this->Paginator->last(__('Last') . ' >>') ?>
					</ul>
					<div class="text-end"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="mt-4">
					<?php foreach ($tagging as $TagsTags) : ?>
						<?php
						echo $this->Html->link(
							$TagsTags->label,
							['controller' => 'Articles', '?' => ['tag' => $TagsTags->slug], '_full' => true],
							['class' => 'btn btn-outline-primary btn-sm mb-1']
						);
						?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>