<?php

$register = true;

if ($register) {
    header('Location: ../html/login_form.html');
} else {
    header('Location: ../html/user_register_form.html');
}