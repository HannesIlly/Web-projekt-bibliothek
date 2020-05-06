<?php

$register = true;

if ($register) {
    header('Location: login_form.html');
} else {
    header('Location: user_register_form.html');
}