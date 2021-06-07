<?php

    session_start();
    if(!$_SESSION["userId"]) {
        header("Location: login.php");
        die();
    }

    include_once("./classes/Client.php");
    include_once("./classes/Wishlist.php");
    include_once("./classes/OrderTicket.php");
    include_once("./classes/Weight.php");

    if(!empty($_POST)) {
        try {
            $order_ticket = new OrderTicket();
            $order_ticket->setUserId($_SESSION["userId"]);
            $order_ticket->setWishlistId($_SESSION["wishlistId"]);
    
            date_default_timezone_set('Europe/Brussels');
            $date = date("d/m/Y H:i:s");
            $order_ticket->setDate($date);
    
            $order_ticket->save();
    
            $order_ticket_id = OrderTicket::getIdByDate($date);

            $number_of_values = count($_POST);
    
            for($i; $i < $number_of_values; $i++) {
                $index = $i + 1;
                $input_name = "weight" . $index;
                $currentWeight = floatval($_POST[$input_name]);

                $weight = new Weight();
                $weight->setOrderTicketId($order_ticket_id);
                $weight->setWeight($currentWeight);

                $result = $weight->save();
            }

            Wishlist::setWishlistReady($_GET["id"], $_SESSION["productId"]);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }

    if($_GET["id"]) {
        $client_id = $_GET["id"];

        try {
            $client = new Client();
            $client->loadClientById($client_id);
            $client_name = $client->getName();

            $current_item = Wishlist::getItemToBeSortedByClientId($client_id);
            
            $_SESSION["wishlistId"] = $current_item["id"];
            $_SESSION["productId"] = $current_item["product_id"];
        } catch (Exception $e) {
            $error = $e->getMessage();

            if($error = "Alle items werden gesorteerd.") {
                unset($_SESSION["wishlistId"]);
                unset($_SESSION["productId"]);
                header("Location: order-ticket.php?id=" . $client_id);
            }
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
        <title>Foodflow | Sorteren <?php echo $client_name; ?></title>
    <?php else: ?>
        <title>Foodflow | Klant niet gevonden</title>
    <?php endif; ?>
</head>
<body>
    <header class="header">

        <?php if(isset($client_id)): ?>
            <a href="sorting-card.php?id=<?php echo $client_id; ?>" class="header__back-icon">
                <img src="./images/arrow-back.svg" alt="Terug">
            </a>
        <?php else: ?>
            <a href="index.php" class="header__back-icon">
                <img src="./images/arrow-back.svg" alt="Terug">
            </a>
        <?php endif; ?>

        <img src="./images/logo-word.svg" alt="Foodflow" class="header__logo"/>
    </header>

    <main>
    
        <?php if($client_name): ?>

            <h2><?php echo $current_item["name"]; ?></h2>
            <p class="intro-text">
                Vul de gewichten in voor alle bakken.
            </p>
            <img src="<?php echo $current_item["image"]; ?>" alt="<?php echo $current_item["name"]; ?>" class="food-image">

            <form action="" method="post" class="weights">
                <h3>Gewicht</h3>
                <?php echo $current_item["quality"]; ?>

                <?php for($i = 0; $i < $current_item["quantity"]; $i++): ?>
                    <div class="weights__form">
                        <span>Bak <?php echo $i + 1; ?></span>
                        <input type="number" name="weight<?php echo $i + 1; ?>" id="weight<?php echo $i + 1; ?>" min="0" step="0.001" class="weights__form__input">
                    </div>
                <?php endfor; ?>

                <button type="button" class="button button--disabled" id="next-button" data-disabled="true">Volgende</button>
            </form>

        <?php else: ?>
            <h2>Klant niet gevonden</h2>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <div class="alert alert--error"><?php echo $error; ?></div>
        <?php endif; ?>

    </main>

    <script src="js/sorting.js"></script>

</body>