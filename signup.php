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
            $user->setIsApproved(0);
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

    <header class="header">
        <img src="./images/logo-word.svg" alt="Foodflow" class="header__logo"/>
    </header>

    <main>
        <form action="" method="POST" class="form login-form">
            <h1>Registreren</h1>
            <p>
                Je account moet eerst goedgekeurd worden door een medewerker voor je 
                toegang krijgt tot de applicatie.
            </p>

            <?php if(isset($error)): ?>
                <div class="alert alert--error"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="form__input-fields">
                <label for="firstname" class="form__label">Voornaam</label>
                <input type="text" name="firstname" id="firstname" class="form__input">

                <label for="lastname" class="form__label">Achternaam</label>
                <input type="text" name="lastname" id="lastname" class="form__input">

                <label for="email" class="form__label">E-mail</label>
                <input type="email" name="email" id="email" class="form__input">

                <label for="password" class="form__label">Wachtwoord</label>
                <input type="password" name="password" id="password" class="form__input">
            </div>

            <div class="form__button-set">
                <input type="submit" value="Registreren" class="button button--primary">
                <a href="login.php" class="button button--secondary">Ik heb al een account</a>
            </div>
        </form>
    </main>

</body>
</html>