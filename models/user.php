<?php

/**
 * Renvoie la liste des utilisateurs
 * 
 * @param PDO $connection La connexion à la base de données
 * @return array La liste des utilisateurs
 */
function getUsers(PDO $connection): array
{
    $query = $connection->prepare('
        SELECT id, firstname, lastname
        FROM users
        ORDER BY lastname
    ');
    
    $query->execute();
    
    return $query->fetchAll();
}

/**
 * Enregistre l'utilisateur dans la base de données
 * 
 * @param PDO $connection
 * @param array $data
 */
function createUser(PDO $connection, array $data): void
{
    $query = $connection->prepare('
        INSERT INTO users(email, password, creation_date, firstname, lastname) VALUES (?, ?, NOW(), ?, ?)
    ');
    
    $query->execute([
        $data['email'],
        password_hash($data['password'], PASSWORD_BCRYPT),
        $data['firstname'],
        $data['lastname']
    ]);
}

/**
 * Renvoie les informations de l'utilisateur dont on a passé l'email en paramètre
 * 
 * @param PDO $connection
 * @param string $email
 * @return null|array Les informations de l'utilisateur
 */
function getUserByEmail(PDO $connection, string $email): ?array
{
    $query = $connection->prepare('
        SELECT id, email, password, firstname, lastname
        FROM users
        WHERE email = ?
    ');
    
    $query->execute([
        $email 
    ]);
    
    $user = $query->fetch();
    
    if (empty($user)) {
        return null;
    } else {
        return $user;
    }
}

/**
 * Vérifie si l'utilisateur est bien connecté
 * 
 * @return bool Vrai si l'utilisateur est connecté, faux sinon
 */
function isAuth(): bool
{
    return isset($_SESSION['auth']);
}