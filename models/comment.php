<?php

function getCommentsFromPost(PDO $connection, int $id): array
{
    $query = $connection->prepare('
        SELECT id, username, creation_date, content
        FROM comments
        WHERE post_id = ?
        ORDER BY creation_date DESC
    ');
    
    $query->execute([
        $id 
    ]);
    
    return $query->fetchAll();
}

function createComment(PDO $connection, array $data): void
{
    $query = $connection->prepare('INSERT INTO comments (username, content, creation_date, post_id) VALUES (?, ?, NOW(), ?)');
    $query->execute([
        $data['username'],
        $data['content'],
        $data['post_id']
    ]);
}