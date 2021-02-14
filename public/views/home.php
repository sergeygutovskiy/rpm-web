<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php foreach ($posts as $post): ?>
		<article>
			<p><?php echo $post->title; ?></p>
			<p>от: <?php echo $post->user()->name; ?></p>
		</article>
	<?php endforeach; ?>
</body>
</html>