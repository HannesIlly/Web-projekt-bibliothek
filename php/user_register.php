<?php
include 'database.php';

function checkPassword($password) {
    $length =(8 <= strlen($password) && strlen($password) <= 18);
    $uppercase = preg_match("/[A-Z]/", $password);
    $lowercase = preg_match("/[a-z]/", $password);
    $digits = preg_match("/[0-9]/", $password);
    $specialChars = !ctype_alnum($password);

    if ($length && $uppercase && $lowercase && $digits && $specialChars) {
        return true;
    } else {
        return false;
    }
}


session_start();
$location = '../html/login_form.html';

if (isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['username']) && isset($_POST['password'])
    && $_POST['first-name'] != '' && $_POST['last-name'] != '' && $_POST['username'] != '' && $_POST['password'] != '') {
    // secure register-form data
    $firstname = htmlspecialchars($_POST['first-name']);
    $lastname = htmlspecialchars($_POST['last-name']);
    $username = htmlspecialchars($_POST['username']);

    $password = $_POST['password'];
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);

    // check if user already exists
    $statement = 'SELECT user_name FROM logindaten WHERE user_name="' . $username . '";';
    $query = $database->query($statement);
    $result = $query->fetchAll();

    if (count($result) == 0) {
        // insert user data
        $loginData = ['name' => $username, 'pass' => $password, 'role' => 'user'];
        $statement = 'INSERT INTO logindaten(user_name, user_pass, role, user_fehlversuche) VALUES (:name, :pass, :role, 0);';
        $query = $database->prepare($statement);
        $query->execute($loginData);
        // id of the dataset that was inserted last
        $id = $database->lastInsertId();
        $userData = ['UserID' => $id, 'firstname' => $firstname, 'lastname' => $lastname];
        $statement = 'INSERT INTO userdaten(UID, vorname, nachname) VALUES (:UserID, :firstname, :lastname);';
        $query = $database->prepare($statement);
        $query->execute($userData);

    } else {
        $_SESSION['errorUsernameExists'] = 'Username existiert bereits!';
        $location = 'user_register_form.php';
    }

} else {
    $location = 'user_register_form.php';
}

header('Location: ' . $location);
