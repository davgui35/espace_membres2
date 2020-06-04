<?php 
session_start();
$title = "profil";
require 'include/header.php'; ?>
<?php

//Savoir si connecter
if(isset($_SESSION['id'])){?>

<div class="d-flex justify-content-center mt-4">
    <div class="card border-primary mb-3" style="max-width: 25rem; max-height: 20rem;">
    <div class="card-header text-white text-center">Mon profil</div>
    <div class="card-body text-center">
        <p class="card-text bg-primary"><i class="fas fa-users"></i></p>
        <p class="card-text text-white ">Nom de l'utilisateur: <?= $_SESSION['username']?>.</p>
        <p class="card-text text-white ">Adresse email: <?= $_SESSION['email']?>.</p>
        <p><a href="logout.php" class="alert-link" >Logout</a></p>
        <p><a href="edit_profil.php" class="alert-link" >Modifier mon profil</a></p>
</div>
<?php
}else{
    echo'<div class="alert alert-dismissible alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4 class="alert-heading">Warning!</h4>
            <p class="mb-0">You are not identified as a member <a href="login.php" class="alert-link">Please login!!</a>.</p>
        </div>';
}

?>
    </div>
    </div>
    </div>
</div>   
    
<?php include 'include/footer.php'; ?>