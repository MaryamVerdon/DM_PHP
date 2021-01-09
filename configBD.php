<?php
    try{
        //Création de la connexion avec la BD
        $bdd = new PDO('mysql:host=localhost;port=3306; dbname=lpdasi; charset=utf8', 'root');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e)
    {
        die('Une erreur s\'est produite:'.$e->getMessage());
    }
?>