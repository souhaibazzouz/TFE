<?php

try {
    $dbName = 'c1641721c_2par';
    $host = 'localhost';
    $utilisateur = 'root';
    $motDePasse = '';
    $port='3306';
    $dns = 'mysql:host='.$host .';dbname='.$dbName.';port='.$port;
    $conn = new PDO( $dns, $utilisateur, $motDePasse );
} catch ( Exception $e ) {
    echo "Connection à la BDD impossible : ", $e->getMessage();
    die();
}

return $conn;

