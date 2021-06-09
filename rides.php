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

        <div class="route">
        
            <div class="route__stop">
                <div class="route__stop__icon">
                    <img src="./images/route-stop-complete.svg" alt="Klaar">
                </div>
                <div class="route__stop__info">
                    <span class="route__stop__info__name">Foodsavers</span>
                    <span class="route__stop__info__address">Oude Baan 1H, 2800 Mechelen</span>
                </div>
            </div>

            <?php foreach($rides as $ride): ?>

                <div class="route__stop">
                    <div class="route__stop__icon">
                        <?php if($ride["is_ready"] === "0"): ?>
                            <img src="./images/route-stop-not-complete.svg" alt="Nog niet klaar">
                            <span class="route__stop__icon__line"></span>
                        <?php else: ?>
                            <img src="./images/route-stop-complete.svg" alt="Klaar">
                            <span class="route__stop__icon__line route__stop__icon__line--complete"></span>
                        <?php endif; ?>
                    </div>
                    <div class="route__stop__info">
                        <span class="route__stop__info__name"><?php echo $ride["name"]; ?></span>
                        <span class="route__stop__info__address"><?php echo $ride["address_street"] . " " . $ride["address_number"] . ", " . $ride["postal_code"] . " " . $ride["city"]; ?></span>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

        <?php if(isset($error)): ?>
            <div class="alert alert--error"><?php echo $error; ?></div>
        <?php endif; ?>

    </main>

    <script src="js/route.js"></script>
</body>
</html>