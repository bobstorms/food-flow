<?php
    include_once("./classes/User.php");

    if(!empty($_POST)) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        $error_found = false;

        if(empty($firstname) && !$error_found) {
            $error_found = true;
            $error = "Gelieve een voornaam in te vullen.";
        }

        if(empty($lastname) && !$error_found) {
            $error_found = true;
            $error = "Gelieve een achternaam in te vullen.";
        }

        if(empty($email) && !$error_found) {
            $error_found = true;
            $error = "Gelieve een e-mailadres in te vullen.";
        }

        if(empty($password) && !$error_found) {
            $error_found = true;
            $error = "Gelieve een wachtwoord in te vullen.";
        }

        if(empty($password_confirm) && !$error_found) {
            $error_found = true;
            $error = "Gelieve je wachtwoord te bevestigen.";
        }

        // Check if passwords match
        if($password !== $password_confirm && !$error_found) {
            $error_found = true;
            $error = "De wachtwoorden zijn niet gelijk.";
        } else {
            $user = new User();
            $user->setFirstName($firstname);
            $user->setLastName($lastname);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setIsAdmin(0);
            $user->save();
        }

    }

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Foodflow | Registreren</title>
</head>
<body>

    <main>
        <div class="header-logo">

        </div>

        <form action="" method="POST" class="form login-form">
            <h1>Registreren</h1>

            <?php if(isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <label for="firstname">Voornaam</label>
            <input type="text" name="firstname" id="firstname">

            <label for="lastname">Achternaam</label>
            <input type="text" name="lastname" id="firstname">

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email">

            <label for="password">Wachtwoord</label>
            <input type="password" name="password" id="password">

            <label for="password_confirm">Bevestig wachtwoord</label>
            <input type="password" name="password_confirm" id="password_confirm">

            <a href="login.php">Al een account?</a>

            <input type="submit" value="Registreren">
        </form>
    </main>

</body>
</html>