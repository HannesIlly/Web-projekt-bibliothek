<?php

function logLogin() {
    $date = $_SESSION['loginDate'];
    $time = $_SESSION['loginTime'];
    $username = $_SESSION['username'];

    $logEntry = 'login, ' . $username . ', ' . $date . ', ' . $time;

    file_put_contents('../logfile_' . $username . '.txt', $logEntry, FILE_APPEND);

}

function logLogout() {

}