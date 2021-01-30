<nav class="navigation">
	<div class="navigation__content dft-container">
		<ul>
			<h3><a href="/">ToDo List</a></h3>
		</ul>
		<ul class="navigation__right">
			<?php if (Auth::isAuth()): ?>
				<li class="navigation__item"><a href="/home">Аккаунт</a></li>
				<li class="navigation__item"><a href="/logout">Выйти</a></li>
			<?php else: ?>
				<li class="navigation__item"><a href="/login">Вход</a></li>
				<li class="navigation__item"><a href="/register">Регистрация</a></li>
			<?php endif; ?>
		</ul>
	</div>
</nav>