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
		<div class="tasks-list">
			<h3 class="dft-subtitle">Дела пользователей:</h3>
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
							<div>
								<label>Пользователя: </label>
								<?php echo $task->getUser()->name; ?>
							</div>
						</footer>
					</article>
				<?php endforeach; ?>
			</section>
		</div>
	</main>
</body>
</html>