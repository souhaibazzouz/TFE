<?php

try {
    $dbName = '*******';
    $host = '*******';
    $utilisateur = '*******';
    $motDePasse = '*******';
    $port='****';
    $dns = 'mysql:host='.$host .';dbname='.$dbName.';port='.$port;
    $conn = new PDO( $dns, $utilisateur, $motDePasse );
} catch ( Exception $e ) {
    echo "Connection à la BDD impossible : ", $e->getMessage();
    die();
}

return $conn;

