<table class="table table-bordered">
	<tr>
		<th>Month</th>
		<th>Total Articles</th>
		<th>Total Views</th>
	</tr>
	<?php foreach ($monthly as $article): ?>
		<tr>
			<td><?= h($article->month) ?></td>
			<td><?= h($article->total) ?></td>
			<td><?= h($article->view) ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<hr>

<table class="table table-bordered">
	<tr>
		<th>Month</th>
		<th>Total Articles</th>
		<th>Total Views</th>
	</tr>
	<?php foreach ($yearly as $article): ?>
		<tr>
			<td><?= h($article->year) ?></td>
			<td><?= h($article->total) ?></td>
			<td><?= h($article->view) ?></td>
		</tr>
	<?php endforeach; ?>
</table>
