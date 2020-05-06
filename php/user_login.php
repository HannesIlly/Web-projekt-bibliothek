<?php
session_start();

$users = [['Hannes', 'Illy', 'HAI', 'huhu'],
          ['ASDF', 'QWER', 'ICH', 'Passwort']];

if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['username'])) {
    $password = $_POST['password'];
}

$_SESSION['login'] = 'verweigert';
$seite = '../html/login_form.html';

$length = count($users);
for ($i = 0; $i < $length; $i++) {
    if ($users[$i][2] == $username) {
        if ($users[$i][3] == $password) {
            $_SESSION['login'] = 'ok';
            $seite = '../php/hauptseite.php';
        }
        break;
    }
}

header('Location: ' . $seite);
