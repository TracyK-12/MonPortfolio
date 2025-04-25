<?php 

// Connexion à la Base de donnée
// Retourne PDO ou null
function dbConnect() {
    $ctxDb = null;

    $cnxStr = "mysql:host=localhost;dbname=mvc_store;charset=utf8";

    try {
        $ctxDb = new PDO($cnxStr, 'root', '', array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        ));
    }
    catch(PDOException $ex) {
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $ctxDb;
    }
}