<?php

    session_start();
    if(!$_SESSION["userId"]) {
        header("Location: login.php");
        die();
    }

    include_once("./classes/Ride.php");

    try {
        $rides = Ride::getRidesByDate("2021-06-09");
    } catch (Exception $e) {
        $error = $e->getMessage();
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

        <div class="route__loading">
            <span>Meest optimale route aan het berekenen...</span>
            <img src="./images/loading.gif" alt="Laden...">
        </div>

        <div class="route"></div>

        <?php if(isset($error)): ?>
            <div class="alert alert--error"><?php echo $error; ?></div>
        <?php endif; ?>

    </main>

    <script src="js/route.js"></script>
</body>
</html>