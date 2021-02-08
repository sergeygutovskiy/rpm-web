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
	
		<section class="tasks-container">
			<div class="tasks-list">
				<h3 class="dft-subtitle">Ваши дела:</h3>
				<section class="tasks">
					<?php foreach(Auth::user()->tasks() as $task): ?>
						<article class="task dft-panel">
							<p>
								<?php echo $task->text; ?>
							</p>
							<footer>
								<div class="task__date">
									<label>До: </label>
									<?php $date = new DateTime(); ?>
									<?php $date->setTimestamp(strtotime($task->end_date)); ?>
									<?php echo $date->format('Y-m-d'); ?>
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
			</div>
			<div class="tasks-create">
				<h3 class="dft-subtitle">Добавить дело:</h3>
				
				<form class="dft-panel dft-form">
					<textarea class="dft-textarea" name="task_text" 
						placeholder="Описание"></textarea>
					<input class="dft-input" name="task_end_date"
						placeholder="ГГГГ-ММ-ДД">
					<div class="dft-section">
						<span></span>
						<ul>
							<li data-option-value="не начато">
								не начато
							</li>
							<li data-option-value="начато">
								начато
							</li>
							<li data-option-value="выполнено">
								выполнено
							</li>
							<li data-option-value="отменено">
								отменено
							</li>
						</ul>
						<input type="hidden" name="task_status">
					</div>
					<div class="dft-section">
						<span></span>
						<ul>
							<li data-option-value="0">
								доступно мне
							</li>
							<li data-option-value="1">
								доступно всем
							</li>
						</ul>
						<input type="hidden" name="task_visible">
					</div>
					<button class="dft-btn dft-btn--green" type="submit">
						Добавить
					</button>
				</form>				
			</div>
		</section>
	</main>
	<script>
		let sections = document.getElementsByClassName("dft-section");
		for (let s of sections)
		{
			let s_span = s.childNodes[1]; 
			let s_input = s.childNodes[5];

			s_span.textContent = s.children[1].children[0].textContent;
			s_input.value = s.children[1].children[0].dataset.optionValue;

			s.addEventListener("click", () => {
				s.classList.toggle("dft-section--active");
			});

			for (let i = 1; i < s.childNodes[3].childNodes.length; i += 2)
			{
				let item = s.childNodes[3].childNodes[i];
				item.addEventListener("click", () => {
					s_span.textContent = item.textContent;
					s_input.value = item.dataset.optionValue;
				});
			}
		}

		let create_task_form = document.forms[0];
		create_task_form.addEventListener("submit", function(e) {
			e.preventDefault();
			create_task(this);
		});

		function create_task(form)
		{
			let data = new FormData(form);

			let request = new XMLHttpRequest();
			request.open("POST", "/tasks/create");
			request.responseType = "json";
			request.send(data);

			request.onload = () => {
				if (request.status == 200)
				{
					if (request.response != "error")
						append_task(request.response);
				}
			};
		}

		function append_task(task)
		{
			let task_el = document.createElement("article");
			task_el.innerHTML = `
				<article class="task dft-panel">
					<p>
						` + task.text + `
					</p>
					<footer>
						<div class="task__date">
							<label>До: </label>
							` + task.end_date.split(" ")[0] + `
						</div>
						<div class="task__status">
							<label>Статус: </label>
							` + task.status + `
						</div>
						<div class="task__visible">
							<label>Видимость: </label>
							` + task.visible + `
						</div>
					</footer>
				</article>				
			`;

			document.getElementsByClassName("tasks")[0].prepend(task_el);
		}
	</script>
</body>
</html>