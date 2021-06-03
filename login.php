<?php
    include_once("./classes/User.php");

    if($_GET["signup"] === "success") {
        $success = "Je account is succesvol geregistreerd! Je kan nu inloggen.";
    }

    if(!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->login();
        } catch(Exception $e) {
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
    <title>Foodflow | Inloggen</title>
</head>
<body>

    <main>
        <div class="header-logo">

        </div>

        <form action="" method="POST" class="form login-form">
            <h1>Inloggen</h1>

            <?php if(isset($success)): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if(isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email">

            <label for="password">Wachtwoord</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="Inloggen">
            <a href="signup.php">Ik heb nog geen account</a>
        </form>
    </main>

</body>
</html>