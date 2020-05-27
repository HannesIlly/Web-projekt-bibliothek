<?php session_start();

function errorMessageUsername() {
    if (isset($_SESSION['errorUsernameExists'])) {
        echo $_SESSION['errorUsernameExists'];

        // session-variable löschen
        unset($_SESSION['errorUsernameExists']);
    }
    return;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrierung</title>
    <link rel="stylesheet" href="../css/user_register_form.css">
</head>
<body>
</body>
<div id="frame">
    <form action="user_register.php" method="POST">
        <div id="title">User-Registrierung</div>
        <div id="content">
            <p class="error"><?php errorMessageUsername(); ?></p>
            <div><label for="first-name">Vorname</label><input class="input" id="first-name" name="first-name" type="text" required /></div>
            <div><label for="last-name">Nachname</label><input class="input" id="last-name" name="last-name" type="text" required /></div>
            <div><label for="username">Username</label><input class="input" id="username" name="username" type="text" required /></div>
            <div><label for="password">Password</label><input class="input" id="password" name="password" type="password" required
                pattern="{8, 18}" title="Bitte 8-18 Zeichen sowie Großbuchstaben, Kleinbuchstaben und Zahlen eingeben!" /></div>
            <input id="submit" class="icon" type="image" src="../bilder/login_icon_haken.png" alt="Registrieren" />
        </div>
    </form>
</div>
</html>
<!DOCTYPE html>
