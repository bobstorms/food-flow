<?php

    session_start();
    if(!$_SESSION["user"]) {
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

            $items = Wishlist::getItemsToBeSortedByClientId($client_id);
            $current_item = $items[0];
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
            <img src="<?php echo $current_item["image"]; ?>" alt="<?php echo $current_item["name"]; ?>" class="food-image">

            <div class="weights">
                <h3>Gewicht</h3>
                <?php echo $current_item["quality"]; ?>

                <?php for($i = 0; $i < $current_item["quantity"]; $i++): ?>
                    <div class="weights__form">
                        <span>Bak <?php echo $i + 1; ?></span>
                        <input type="number" name="weight<?php echo $i + 1; ?>" id="weight<?php echo $i + 1; ?>" min="0">
                    </div>
                <?php endfor; ?>

            </div>

            <button class="button button--disabled">Volgende</button>

        <?php else: ?>
            <h2>Klant niet gevonden</h2>
        <?php endif; ?>

        <?php if(isset($error)): ?>
            <div class="alert alert--error"><?php echo $error; ?></div>
        <?php endif; ?>

    </main>

</body>