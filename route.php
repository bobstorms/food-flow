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
    <title>Foodflow | Route</title>
</head>
<body>
    <header class="header">
        <a href="rides.php" class="header__back-icon">
            <img src="./images/arrow-back.svg" alt="Terug">
        </a>
        <img src="./images/logo-word.svg" alt="Foodflow" class="header__logo"/>
    </header>
    <main>

        <h2>Route</h2>

        <div class="route__loading">
            <span>Route laden...</span>
            <img src="./images/loading.gif" alt="Laden...">
        </div>

        <div class="route"></div>

    </main>

    <script src="js/route.js"></script>
</body>