<?php

require 'app/connection.php';
require 'app/helpers.php';
require 'models/user.php';

$db = getConnection();

if (empty($_POST)) {
    $template = 'register';
    require 'html/layout.phtml';
} else {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        redirect('register.php');
    }
    
    createUser($db, $_POST);
    redirect('index.php');
}
