<?php use App\Core\Auth; ?>
<nav>
	<ul>
		<?php if (Auth::is_auth()): ?>
			<li><a href="/account">Аккаунт</a></li>
			<li><a href="/logout">Выйти</a></li>
		<?php else: ?>
			<li><a href="/register">Регистрация</a></li>
			<li><a href="/login">Войти</a></li>
		<?php endif; ?>
	</ul>
</nav>