<?php

/**
 * Renvoie la liste des articles
 * 
 * @param PDO $connection La connexion à la base de données
 * @return array La liste des articles
 */
function getPosts(PDO $connection): array
{
    $query = $connection->prepare('
        SELECT posts.id, title, content, posts.creation_date, firstname, lastname, name
        FROM posts
        INNER JOIN users ON users.id = posts.author_id
        INNER JOIN categories ON categories.id = posts.category_id
        ORDER BY creation_date DESC
    ');
    
    $query->execute();
    
    return $query->fetchAll();
}

/**
 * Crée un article dans la base de données
 * 
 * @param PDO $connection La connexion à la base de données
 * @param array $data Les données à enregistrer
 */
function createPost(PDO $connection, array $data): void
{
    $query = $connection->prepare('
        INSERT INTO posts(title, content, creation_date, category_id, author_id) VALUES (?, ?, NOW(), ?, ?)
    ');
    
    $query->execute([
        $data['title'],
        $data['content'],
        $data['category_id'],
        $data['author_id']
    ]);
}

/**
 * Renvoie le détail de l'article dont l'id a été spécifié
 * 
 * @param PDO $connection
 * @param int $id
 * @return null|array
 */
function getDetailPost(PDO $connection, int $id): ?array
{
    // Version sécurisée
    $query = $connection->prepare('
        SELECT posts.id, title, content, posts.creation_date, firstname, lastname
        FROM posts
        INNER JOIN users ON users.id = posts.author_id
        WHERE posts.id = ?
    ');
    
    $query->execute([
        $id
    ]);
    
    $post = $query->fetch();
    
    if (empty($post)) {
        return null;
    } else {
        return $post;
    }
}

/**
 * Met à jour un article dans la base de données
 * 
 * @param PDO $connection
 * @param array $data
 */
function updatePost(PDO $connection, array $data): void
{
    $query = $connection->prepare('
        UPDATE posts SET title = ?, content = ?, update_date = NOW() WHERE id = ?
    ');
    
    $query->execute([
        $data['title'],
        $data['content'],
        $data['post_id']
    ]);
}

/**
 * Supprime un article dans la base de données
 * 
 * @param PDO $connection
 * @param int $id
 */
function deletePost(PDO $connection, int $id): void
{
    $query = $connection->prepare('DELETE FROM posts WHERE id = ?');
    $query->execute([
        $id 
    ]);
}