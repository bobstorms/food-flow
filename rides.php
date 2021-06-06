<?php

    session_start();
    if(!$_SESSION["userId"]) {
        header("Location: login.php");
        die();
    }

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">
    <title>Foodflow | Ritten</title>
</head>
<body>
    <header class="header">
        <img src="./images/logo-word.svg" alt="Foodflow" class="header__logo"/>
        <a href="logout.php" class="header__logout-icon">
            <img src="./images/logout.svg" alt="Log uit">
        </a>
    </header>
    <main>
        <div class="menu">
            <a href="index.php" class="menu__item">
                <img src="./images/orders-green.svg">
                <span>Bestellingen</span>
            </a>
            <a href="rides.php" class="menu__item menu__item--active">
                <img src="./images/car-white.svg" alt="">
                <span>Ritten</span>
            </a>
        </div>
        <h2>Rittenplanning</h2>
        <p><strong>Welcome to my website!</strong></p>
        <p>Email: <?php echo $_SESSION["user"]; ?></p>
    </main>
</body>
</html>