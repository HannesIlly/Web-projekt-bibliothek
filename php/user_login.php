<?php
session_start();

$_SESSION['login'] = 'verweigert';
$seite = '../html/login_form.html';

if (isset($_POST['username']) && isset($_POST['password'])) {
    // secure login-form data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Create connection to the database
    $database = new PDO('mysql:host=localhost; dbname=bibliothek', 'root', '');

    // Get user login data
    $statement = 'SELECT UID, user_pass, role FROM logindaten WHERE user_name = "' . $username . '";';
    echo $statement;
    $query = $database->query($statement);
    $loginDaten = $query->fetchAll();

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
            $seite = '../hauptseite.php';
        } else {
            $seite = '../html/login_form.html';
        }
    } else {
        // username not found
        $seite = '../html/user_register_form.html';
    }
}

header('Location: ' . $seite);

