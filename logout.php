<?php
require 'include/header.php';
session_start();

if(isset($_SESSION['id'])){
    //Détruire les variables
    session_unset();
    //Détruire la session
    session_destroy();
    //Redirection vers le fichier index.php
    header('location: login.php');
}else{
    echo '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Oh snap!</strong> <a href="login.php" class="alert-link">You are not connect!!</a> and try submitting again.
  </div>';
}
