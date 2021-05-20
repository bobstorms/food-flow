<?php
    include_once("./classes/User.php");

    if(!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $error_found = false;

        if(empty($email) && !$error_found) {
            $error_found = true;
            $error = "Gelieve een e-mailadres in te vullen.";
        }

        if(empty($password) && !$error_found) {
            $error_found = true;
            $error = "Gelieve een wachtwoord in te vullen.";
        } else {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->login();
        }

    }

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Foodflow | Inloggen</title>
</head>
<body>

    <main>
        <div class="header-logo">

        </div>

        <form action="" method="POST" class="form login-form">
            <h1>Inloggen</h1>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email">

            <label for="password">Wachtwoord</label>
            <input type="password" name="password" id="password">

            <a href="signup.php">Nog geen account?</a>

            <input type="submit" value="Inloggen">
        </form>
    </main>

</body>
</html>