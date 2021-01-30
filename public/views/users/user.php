<html>
<head>
	<?php Path::template("header"); ?>
</head>
<body>
	<?php Path::template("navigation"); ?>

	<header class="dft-container dft-page-title">
		<h1>Аккаунт</h1>
	</header>

	<main class="dft-container">
		<h3>Привет, <?php echo Auth::user()->name; ?></h3>
	
		<section class="tasks">
			<?php foreach(Auth::user()->tasks() as $task): ?>
				<article class="task dft-panel">
					<p>
						<?php echo $task->text; ?>
					</p>
					<footer>
						<div class="task__date">
							<label>До: </label>
							<?php echo $task->end_date; ?>
						</div>
						<div class="task__status">
							<label>Статус: </label>
							<?php echo $task->status; ?>
						</div>
						<div class="task__visible">
							<label>Видимость: </label>
							<?php echo $task->visible; ?>
						</div>
					</footer>
				</article>
			<?php endforeach; ?>
		</section>
	</main>
</body>
</html>