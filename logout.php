<?php

require 'app/helpers.php';

// On efface la session
session_start();
$_SESSION = [];
session_destroy();

redirect('index.php');