<?php

    session_start();
    if(!$_SESSION["userId"]) {
        header("Location: login.php");
        die();
    }

    include_once("./classes/Client.php");
    include_once("./classes/Wishlist.php");

    if($_GET["id"]) {
        $client_id = $_GET["id"];

        try {
            $client = new Client();
            $client->loadClientById($client_id);
            $client_name = $client->getName();

            $order_ticket_date = Wishlist::getOrderTicketDateByClientId($client_id);
            $items = Wishlist::getAllItemsAndWeightsByClientId($client_id);
            $total_weight = Wishlist::getTotalWeightByClientId($client_id);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

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
        <title>Foodflow | Leveringsbon <?php echo $client_name; ?></title>
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
            <h2>Leveringsbon <?php echo $client_name; ?></h2>

            <p><?php echo $order_ticket_date; ?></p>

            <div class="wishlist">

                <?php foreach($items as $item): ?>
                    <div class="wishlist__item">
                        <?php if(!$item["is_ready"]): ?>
                            <img class="wishlist__item__checkmark" src="./images/check-not-finished.svg" alt="Nog niet klaargezet">
                        <?php else: ?>
                            <img class="wishlist__item__checkmark" src="./images/check-finished.svg" alt="Al klaargezet">
                        <?php endif; ?>

                        <span class="wishlist__item__name"><?php echo $item["name"]; ?></span>
                        <span class="wishlist__item__amount"><?php echo $item["total_weight"] ?> kg</span>
                    </div>
                <?php endforeach; ?>

                <hr class="total-ruler">

                <div class="total-order-ticket">
                    Totaal
                    <span><?php echo $total_weight; ?> kg</span>
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
</html>