<?php
session_start();

if (isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['username']) && isset($_POST['password'])
    && $_POST['first-name'] != '' && $_POST['last-name'] != '' && $_POST['username'] != '' && $_POST['password'] != '') {

    // Create connection to the database
    $database = new PDO('mysql:host=localhost; dbname=bibliothek', 'root', '');

    // insert user data
    $loginData = ['name' => strip_tags($_POST['username']), 'pass' => $_POST['password']];
    $statement = 'INSERT INTO logindaten(user_name, user_pass) VALUES (:name, :pass);';
    $query = $database->prepare($statement);
    $query->execute($loginData);
    // id of the dataset that was inserted last
    $id = $database->lastInsertId();
    $userData = ['UserID' => $id, 'firstname' => strip_tags($_POST['first-name']), 'lastname' => strip_tags($_POST['last-name'])];
    $statement = 'INSERT INTO userdaten(UID, vorname, nachname) VALUES (:UserID, :firstname, :lastname);';
    $query = $database->prepare($statement);
    $query->execute($userData);

    header('Location: ../html/login_form.html');
} else {
    header('Location: ../html/user_register_form.html');
}
