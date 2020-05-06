<?php
session_start();

$_SESSION['login'] = 'verweigert';
$seite = '../html/login_form.html';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create connection to the database
    $database = new PDO('mysql:host=localhost; dbname=bibliothek', 'root', '');

    // Get user login data
    $statement = 'SELECT UID, user_pass FROM logindaten WHERE user_name = "' . $username . '";';
    $query = $database->query($statement);
    $loginDaten = $query->fetchAll();
    if (count($loginDaten) > 0) {
        if ($password == $loginDaten[0]['user_pass']) {
            $_SESSION['login'] = 'ok';
            $seite = '../php/hauptseite.php';
        } else {
            $seite = '../html/login_form.html';
        }
    } else {
        // username not found
        $seite = '../html/user_register_form.html';
    }
}

header('Location: ' . $seite);

