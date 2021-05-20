<!DOCTYPE html>
<html lang="en">
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