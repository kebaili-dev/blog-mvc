<?php

require 'app/connection.php';
require 'models/post.php';

// Connexion à la base de données
$db = getConnection();

// Récupération des articles
$posts = getPosts($db);

// Ficher phtml spéficique à la page 
$template = 'index';    // Le fichier index.phtml sera chargé directement dans le layout

// Chargement du layout qui va lui-même charger le template au bon endroit
require 'html/layout.phtml';