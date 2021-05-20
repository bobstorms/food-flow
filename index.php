<?php

    include_once("./database/Db.php");
    $conn = Db::getInstance();
    
    $q = $conn->prepare("SELECT * FROM user");
    $q->execute();
    $res = $q->fetch();

?><!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Foodflow | Home</title>
</head>
<body>
    <h1>Home</h1>
    <p><strong>Welcome to my website!</strong></p>
    <p>First name: <?php echo $res["first_name"]; ?></p>
    <p>Last name: <?php echo $res["last_name"]; ?></p>
    <p>Email: <?php echo $res["email"]; ?></p>
</body>
</html>