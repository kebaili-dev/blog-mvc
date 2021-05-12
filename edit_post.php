<?php

require 'app/connection.php';
require 'app/helpers.php';
require 'models/post.php';

$db = getConnection();

if (empty($_POST)) {
    
    $post = getDetailPost($db, (int) $_GET['id']);
    
    $template = 'edit_post';
    require 'html/layout.phtml';
} else {
    updatePost($db, $_POST);
    
    redirect('admin.php');
}