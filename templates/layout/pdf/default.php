<!DOCTYPE html>
<html>
<head>
<title>PDF</title>
<?php
use Cake\Routing\Router; //load at the beginning of file
?>
<style>
@page {
	margin-top: 50px !important;
	margin-bottom: 50px !important;
	margin-right: 50px !important;
	margin-left: 50px !important;
    padding: 0px 0px 0px 0px !important;
}
.logo{
	font-size: 12px;
	text-align: center;
}
body{
	font-family: 'Roboto', sans-serif;
}
.title{
	font-size: 22px;
}
.url{
	font-size: 12px;
}
.content{
	
}
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&family=Roboto+Slab:wght@300&family=Tourney:wght@200&display=swap" rel="stylesheet">
</head>
<body>
<h1 class="logo">
<?= $this->Html->image('logo-150x150.png', ['fullBase' => true, 'width'=>'50px', 'height'=>'50px']); ?><br>
CODE THE PIXEL</h1>
<table border="0" style="width:100%">
	<tr>
		<td style="width:90%">
			<h1 class="title"><?php echo $title; ?></h1>
			<div class="url">
			<?= h($fullname) ?> - <?= date('F d, Y', strtotime($publish_on)); ?>
			<br>
			<?php echo Router::url("/", true); ?><?= h($slug) ?>
			</div>
		</td style="width:10%">
		<td><img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= Router::url(null, true); ?>&amp;size=80x80" alt="" title="" /></td>
	</tr>
</table>


			
<hr>
<div class="content">
<?php echo $body; ?>
</div>
</body>
</html>