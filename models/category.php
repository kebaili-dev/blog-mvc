<?php

/**
 * Renvoie la liste des catégories
 * 
 * @param PDO $connection La connexion à la base de données
 * @return array La liste des catégories
 */
function getCategories(PDO $connection): array
{
    $query = $connection->prepare('
        SELECT id, name
        FROM categories
        ORDER BY name
    ');
    
    $query->execute();
    
    return $query->fetchAll();
}