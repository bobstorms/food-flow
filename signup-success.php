<?php

    session_start();
    if($_SESSION["userId"]) {
        header("Location: index.php");
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
    <title>Foodflow | Succesvol geregistreerd!</title>
</head>
<body>

    <header class="header">
        <a href="login.php" class="header__back-icon">
            <img src="./images/arrow-back.svg" alt="Terug">
        </a>
        <img src="./images/logo-word.svg" alt="Foodflow" class="header__logo"/>
    </header>

    <main class="signup-success">
        <h2>Succesvol geregistreerd!</h2>
        <p>
            U ontvangt een mail wanneer uw account goedgekeurd is.
        </p>
        <img src="./images/confetti.svg" alt="Confetti" class="success-image">
        <a href="login.php" class="button button--primary">Ga naar login</a>
    </main>

</body>
</html>