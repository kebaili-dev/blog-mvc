<?php

require 'app/connection.php';
require 'app/helpers.php';

$db = getConnection();

deletePost($db, (int) $_GET['id']);)

redirect('admin.php');