<?php
if (isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['username']) && isset($_POST['password'])
    && $_POST['first-name'] != '' && $_POST['last-name'] != '' && $_POST['username'] != '' && $_POST['password'] != '') {

    $user = [$_POST['first-name'], $_POST['last-name'], $_POST['username'], $_POST['password']];
    $userText = implode(',', $user) . "\r\n";
    file_put_contents('../users.txt', $userText, FILE_APPEND);

    header('Location: ../html/login_form.html');
} else {
    header('Location: ../html/user_register_form.html');
}
