<?php 
        session_start();
//Pour vérifier qu'il y est bien la session et récupéré les données
        // print_r($_SESSION);
?>
<?php 
$title = "Home";
require 'include/header.php';?> 
    <?php 
        if(isset($_SESSION['id'])){
            echo '<div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Welcome!!!</strong> You are member '.$_SESSION['username'].' <a href="profil.php" class="alert-link" >Click to access profile</a>.
            </div>';
        }else{
            echo '<div class="d-flex justify-content-center mt-4">
                <div class="card border-primary mb-3" style="max-width: 25rem; max-height: 15rem;">
                <div class="card-header text-white text-center">Espace membres</div>
                <div class="card-body text-center">
                    <p class="card-text bg-primary"><i class="fas fa-users"></i></p>
                    <p><a href="sign_up.php" class="alert-link" >Sign_up</p>
                    <p><a href="login.php" class="alert-link" >Login</p>
                </div>
                </div>
                </div>
            </div>';
        }
    ?>
 
    
<?php include 'include/footer.php'; ?>