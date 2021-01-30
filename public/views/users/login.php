<html>
<head>
    <?php Path::template("header"); ?>
</head>
<body>
    <?php Path::template("navigation"); ?>

    <header class="dft-container dft-page-title">
        <h1>Вход</h1>
    </header>

    <main class="dft-container">    
        <form action="/login" method="POST" class="dft-panel dft-form">
            <input class="dft-input" name="name" placeholder="Имя">
            <input class="dft-input" name="password" placeholder="Пароль">
            <button class="dft-btn dft-btn--green" type="submit">Войти</button>
        </form>
    </main>
</body>
</html>