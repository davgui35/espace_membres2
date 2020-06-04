<?php
// Selection de la base de données à utiliser et connection à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=membres;charset=utf8', 'root', '');
//Gestion de l'affichage des erreurs
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);