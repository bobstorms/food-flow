<?php

    session_start();
    if(!$_SESSION["user"]) {
        header("Location: login.php");
        die();
    }

    include_once("./classes/Client.php");

    if($_GET["id"]) {
        $client_id = $_GET["id"];

        try {
            $client = new Client();
            $client->loadClientById($client_id);
            $client_name = $client->getName();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

    } else {
        $error = "Er werd geen \"id\" van de klant meegegeven.";
    }

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">

    <?php if($client_name): ?>
        <title>Foodflow | Sorteerfiche <?php echo $client_name; ?></title>
    <?php else: ?>
        <title>Foodflow | Klant niet gevonden</title>
    <?php endif; ?>
</head>
<body>
    <header class="header">
        <a href="index.php" class="header__back-icon">
            <img src="./images/arrow-back.svg" alt="Terug">
        </a>
        <img src="./images/logo-word.svg" alt="Foodflow" class="header__logo"/>
    </header>

    <main>
        <?php if($client_name): ?>
            <h2>Sorteerfiche <?php echo $client_name; ?></h2>

            <div class="wishlist">
                <div class="wishlist__item">
                    <img class="wishlist__item__checkmark" src="./images/check-not-finished.svg" alt="Nog niet klaargezet">
                    <span class="wishlist__item__name">Groenten</span>
                    <span class="wishlist__item__amount">2x</span>
                </div>
                <div class="wishlist__item">
                    <img class="wishlist__item__checkmark" src="./images/check-not-finished.svg" alt="Nog niet klaargezet">
                    <span class="wishlist__item__name">Fruit</span>
                    <span class="wishlist__item__amount">1x</span>
                </div>
            </div>

        <?php else: ?>
            <h2>Klant niet gevonden</h2>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <div class="alert alert--error"><?php echo $error; ?></div>
        <?php endif; ?>
    </main>
</body>