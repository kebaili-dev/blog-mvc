<?php

function getConnection(): PDO
{
    return new PDO(
        'mysql:host=home.3wa.io:3307;dbname=live-46_cle_blog;charset=UTF8', 
        'cedricleclinche', 
        'M2MyNzJkNGZiODk4OTIzMGFkMmFmYmE43Wa!', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
}