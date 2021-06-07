<?php

    session_start();
    if(!$_SESSION["userId"]) {
        header("Location: login.php");
        die();
    }

    include_once("./classes/Client.php");
    $clients = Client::getAllClients();

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

            <?php foreach($clients as $client): ?>
                <div class="client-list__item">

                    <?php if(!$client["is_ready"]): ?>
                        <a href="sorting-card.php?id=<?php echo $client["id"]; ?>">
                            <span><?php echo $client["name"]; ?></span>
                            <img src="./images/arrow-forward.svg" alt="Open">
                        </a>
                    <?php else: ?>
                        <div>
                            <span><?php echo $client["name"]; ?></span>
                            <img src="./images/icon-success.svg" alt="Voltooid">
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>

        </div>

    </main>
</body>
</html>