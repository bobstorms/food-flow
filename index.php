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
    <main>
        <h1>Home</h1>
        <p><strong>Welcome to my website!</strong></p>
        <p>Email: <?php echo $_SESSION["user"]; ?></p>
    </main>
</body>
</html>