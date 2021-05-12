<?php

require 'app/connection.php';
require 'models/post.php';
require 'models/comment.php';

$db = getConnection();
$post = getDetailPost($db, (int) $_GET['id']);

$comments = getCommentsFromPost($db, (int) $_GET['id']);

$template = 'show_post';
require 'html/layout.phtml';