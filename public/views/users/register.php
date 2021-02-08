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
            <input class="dft-input" name="name" 
                placeholder="Имя" autocomplete="off">
            <input class="dft-input" name="password" 
                placeholder="Пароль" autocomplete="off">
            <input class="dft-input" name="password_again" 
                placeholder="Пароль еще раз" autocomplete="off">
            <button class="dft-btn dft-btn--green" type="submit">
                Войти
            </button>
        </form>
    </main>
</body>
</html>