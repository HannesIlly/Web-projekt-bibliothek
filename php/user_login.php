<?php
session_start();

$users = file('../users.txt');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
}

$_SESSION['login'] = 'verweigert';
$seite = '../html/login_form.html';

$length = count($users);
for ($i = 0; $i < $length; $i++) {
    $currentUser = explode(',', $users[$i]);
    if ($currentUser[2] == $username) {
        if ($currentUser[3] == $password) {
            $_SESSION['login'] = 'ok';
            $seite = '../php/hauptseite.php';
        }
        break;
    }
}

header('Location: ' . $seite);