<?php

    session_start();
    if(!$_SESSION["user"]) {
        header("Location: login.php");
        die();
    }

    include_once("./database/Db.php");
    $conn = Db::getInstance();
    
    $q = $conn->prepare("SELECT * FROM user");
    $q->execute();
    $res = $q->fetch();

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">
    <title>Foodflow | Home</title>
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
            <a href="index.php" class="menu__item menu__item--active">
                <img src="./images/orders-white.svg">
                <span>Bestellingen</span>
            </a>
            <a href="rides.php" class="menu__item">
                <img src="./images/car-green.svg" alt="">
                <span>Ritten</span>
            </a>
        </div>

        <h2>Kies een organisatie</h2>

        <div class="client-list">

            <div class="client-list__item">
                <a href="sorting?id=1">
                    <span>Actief Chaldeeuwse Organisatie</span>
                    <img src="./images/arrow-forward.svg" alt="Open">
                </a>
            </div>
            <hr>
            <div class="client-list__item">
                <a href="sorting?id=1">
                    <span>Actief Chaldeeuwse Organisatie</span>
                    <img src="./images/arrow-forward.svg" alt="Open">
                </a>
            </div>
            <hr>

        </div>

    </main>
</body>
</html>