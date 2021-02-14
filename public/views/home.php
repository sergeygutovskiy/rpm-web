<?php use App\Core\Path; ?>
<!DOCTYPE html>
<html>
<head>
	<?php require Path::template("header"); ?>
</head>
<body>
	<main>
		<?php require Path::template("navigation"); ?>

		<h1>Главная</h1>
		<h3>Публикации пользователей:</h3>
		<div class="posts">
			<?php foreach ($posts as $post): ?>
				<article class="post">
					<h4><?php echo $post->title; ?></h4>
					<p>
						<?php echo $post->text; ?>
					</p>
					<div class="post__author">
						от: <?php echo $post->user()->name; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

	</main>
</body>
</html>