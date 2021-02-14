<?php use App\Core\Path; ?>
<!DOCTYPE html>
<html>
<head>
	<?php require Path::template("header"); ?>
</head>
<body>
	<main>
		<?php require Path::template("navigation"); ?>

		<h1><?php echo $user->name; ?></h1>
		<h3>Создать публикацию</h3>
		<form class="create-post" method="post" action="/posts">
			<input placeholder="Заголовок" name="post_title">
			<textarea placeholder="Содержание" name="post_text"></textarea>
			<button type="submit">Опубликовать</button>
		</form>
		<h3>Ваши публикации:</h3>
		<div class="posts">
			<?php foreach ($user->posts() as $post): ?>
				<article class="post">
					<h4><?php echo $post->title; ?></h4>
					<p>
						<?php echo $post->text; ?>
					</p>
				</article>
			<?php endforeach; ?>
		</div>
	</main>
</body>
</html>