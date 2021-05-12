<?php

session_start();

require 'app/connection.php';

// Modèle qui gère les articles
require 'models/post.php';
require 'models/user.php';
require 'app/helpers.php';

// Si l'utilisateur n'est pas connecté, on le redirige vers l'accueil
if (! isAuth()) {
    redirect('index.php');
}

// Connexion à la base de données
$db = getConnection();

// Récupération des articles
$posts = getPosts($db);

// Affichage du template
$template = 'admin';
require "html/layout.phtml";