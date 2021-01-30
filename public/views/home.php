<html>
<head>
	<?php Path::template("header"); ?>
</head>
<body>
	<?php Path::template("navigation"); ?>

	<header class="dft-container dft-page-title">
		<h1>Главная</h1>
	</header>

	<main class="dft-container">
		<?php if (Auth::isAuth()): ?>
			<h3>Привет, <?php echo Auth::user()->name; ?></h3>
		<?php endif; ?>

		<section class="tasks">
			<?php foreach($vars["tasks"] as $task): ?>
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
					</footer>
				</article>
			<?php endforeach; ?>
		</section>
	</main>
</body>
</html>