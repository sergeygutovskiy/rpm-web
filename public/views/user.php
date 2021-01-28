<html>
<head>

</head>
<body>
    <h1>Аккаунт</h1>
    <h2><?php echo Auth::user()->id; ?></h2>
    <h2><?php echo Auth::user()->name; ?></h2>
    <h2><?php echo Auth::user()->password; ?></h2>
    <p>
        <?php var_dump(Auth::user()->tasks()[0]->text); ?>
    </p>
</body>
</html>