<?php
    include_once("./functions/checkLogin.php");
    include_once("./classes/User.php");

    if(!empty($_POST)) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $user = new User();
            $user->setFirstName($firstname);
            $user->setLastName($lastname);
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setIsAdmin(0);
            $user->save();
            header("Location: signup-success.php");
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
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">
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

            <input type="submit" value="Registreren">
            <a href="login.php">Ik heb al een account</a>
        </form>
    </main>

</body>
</html>