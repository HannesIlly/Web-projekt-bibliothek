<?php
include 'database.php';

session_start();

$_SESSION['login'] = 'verweigert';
$seite = '../html/login_form.html';

if (isset($_POST['username']) && isset($_POST['password'])) {
    // secure login-form data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Get user login data
    $statement = 'SELECT UID, user_pass, role, user_fehlversuche FROM logindaten WHERE user_name = "' . $username . '";';
    echo $statement;
    $query = $database->query($statement);
    $loginDaten = $query->fetchAll();

    $loginAttempts = $loginDaten[0]['user_fehlversuche'];
    if ($loginAttempts < 3) {
        if (count($loginDaten) > 0) {
            if (password_verify($password, $loginDaten[0]['user_pass'])) {
                // Get user name
                $statement = 'SELECT vorname, nachname FROM userdaten WHERE UID = ' . $loginDaten[0]['UID'] . ';';
                $query = $database->query($statement);
                $userDaten = $query->fetchAll();

                $_SESSION['login'] = 'ok';
                $_SESSION['username'] = $username;
                $_SESSION['first-name'] = $userDaten[0]['vorname'];
                $_SESSION['role'] = $loginDaten[0]['role'];

                $loginAttempts = 0;

                $seite = '../hauptseite.php';
            } else {
                $loginAttempts++;

                $seite = '../html/login_form.html';
            }

            // store login attempts
            $statement = 'UPDATE logindaten SET user_fehlversuche = :user_fehlversuche WHERE UID = ' . $loginDaten[0]['UID'] . ';';
            $query = $database->prepare($statement);
            $parameters = ['user_fehlversuche' => $loginAttempts];
            $query->execute($parameters);
        } else {
            // username not found
            $seite = 'user_register_form.php';
        }
    } else {

    }
}

header('Location: ' . $seite);

