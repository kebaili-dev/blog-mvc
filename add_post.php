<?php

session_start();

/* Page qui s'occupe de la création d'un article
    2 fonctions :
    - Afficher le formulaire de création
    - Enregistrer l'article en base de données
*/

require 'app/connection.php';
require 'app/helpers.php';
require 'models/post.php';
require 'models/category.php';
require 'models/user.php';

if (! isAuth()) {
    redirect('index.php');
}

$db = getConnection();

// Si $_POST est vide => si on arrive sur la page pour créer un nouvel article
if (empty($_POST)) {
    // Récupération des catégories et des auteurs pour les select
    $categories = getCategories($db);
    $authors = getUsers($db);
    
    // Affichage du template
    $template = 'add_post';
    require 'html/layout.phtml';
} else {
    // Enregistrement de l'article
    // si $_POST n'est pas vide => si des données ont été envoyées depuis le formulaire
    $userId = $_SESSION['auth']['id'];
    
    $data = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'category_id' => $_POST['category_id'],
        'author_id' => $userId
    ];
    
    createPost($db, $data);
    
    // Une fois l'article enregistré, on renvoie sur une autre page
    redirect('index.php');
}