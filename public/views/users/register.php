<html>
<head>
    <?php Path::template("header"); ?>
</head>
<body>
    <?php Path::template("navigation"); ?>

    <header class="dft-container dft-page-title">
        <h1>Регистрация</h1>
    </header>

    <main class="dft-container">    
        <form action="/register" method="POST" class="dft-panel dft-form">
            <input class="dft-input" name="name" placeholder="Имя">
            <input class="dft-input" name="password" placeholder="Пароль">
            <input class="dft-input" name="password_again" placeholder="Еще раз пароль">
            <button class="dft-btn dft-btn--green" type="submit">Зарегистрироваться</button>
        </form>
    </main>
</body>
</html>