<?php

require 'app/connection.php';
require 'app/helpers.php';
require 'models/comment.php';

$db = getConnection();

createComment($db, $_POST);

// On redirige vers l'article sur lequel on a écrit un commentaire
redirect('show_post.php?id=' . $_POST['post_id']);