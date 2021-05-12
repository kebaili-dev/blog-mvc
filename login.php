<?php

// Démarrage de la session
// Fonction à appeler tout en haut des fichiers (avant le moindre affichage)
session_start();

require 'app/connection.php';
require 'app/helpers.php';
require 'models/user.php';

$db = getConnection();

if (empty($_POST)) {
    $template = 'login';
    require 'html/layout.phtml';
} else {
    // On récupère l'utilisateur à partir de son email
    $user = getUserByEmail($db, $_POST['email']);
    
    // Si l'utilisateur n'a pas été trouvé => aucun email ne correspond dans la base de données
    if ($user === null) {
        redirect('login.php');
    }
    
    // On vérifie que le mot de passe est correct
    if (password_verify($_POST['password'], $user['password'])) {
        // Mot de passe OK : on connecte l'utilisateur
        // Création d'une session avec les données de l'utilisateur
        $_SESSION['auth'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname']
        ];
        
        redirect('index.php');
    } else {
        // Gestion de l'erreur : identifiants erronnés
        redirect('login.php');
    }
}