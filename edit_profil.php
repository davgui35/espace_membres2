<?php
//Parce que cela concerne les connecter
session_start();
$title = "Modification du profil";
require 'include/header.php';

// name="edit" vérifier que l'utilisateur a cliqué sur le bouton edit et en plus il doit être connecté
if(isset($_POST['edit']) && isset($_SESSION['id'])){
	// Si le champ de username est vide ou que l'username n'a pas de alphabet minuscules a-z ou majuscules A-Z répétés plusieurs fois (+)
		//Pour $id = $_SESSION['id'] connaitre l'utilisateur sur lequel on se trouve dans la base de données avant de faire les modifications
		$id = $_SESSION['id'];
        if(empty($_POST['username']) || !preg_match('/[a-zA-Z0-9]+/', $_POST['username'])){
    
            $message_error = "Votre username doit être une chaîne de caractère (alphanumérique)";
    // Si le champ de email est vide ou si le filtre de validation email est différent de vrai
        }elseif(empty($_POST['password']) || $_POST['password'] != $_POST['password2']) {
            $message_error = "Veuillez entrer deux mots de passe identiques";	
        }else{
            // Si tout est rentré correctement(affichage pour voir si le fonctionnement est correct)
		// echo "Les informations sont correctes";

		//Inclure le fichier de connexion à la base une seule fois pour toute
		require_once 'include/start_bdd.php';

		//Verifie la base de données si le nom de l'utilisateur existe déjà et si l'adresse email existe déja
		//Alors on selectionne tous ce qu'il y a dans la table
		$req=$bdd->prepare('SELECT * FROM table_membres WHERE username = :username');
		$req->bindValue(':username', $_POST['username']);
		$req->execute();
		//Permet de récupérer le premier enregistrement qui correspond ou le username est le même que celui dans la base
        $result= $req->fetch();
            if($result){
                $message_error = "The name already exists";
            }else{
                //Cryptage du mot de passe
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            //mettre à jour dans la base de données des informations de l'utilisateur selon l'id de la session récupérée plus haut

            $requete = $bdd->prepare('UPDATE table_membres SET username = :username, password = :password WHERE id= :id');

            //Mise en place de parallèle entre les valeurs vides et les valeurs postées par l'utilisateur
			$requete->bindValue(':username', $_POST['username']);
			$requete->bindValue(':id', $id);
            $requete->bindValue(':password', $password);

            //Ensuite on execute la requete 
            $requete->execute();

            //Message de bon fonctionnement
            $message_success = "The modification are well done!";

            }

        }
}
?>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Edit</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<!-- Si ce message existe on l'affiche -->
	<?php if(isset($message_error)){
		echo '<div class="alert alert-danger" role="alert">
			<p class="text-center">'. $message_error.'</p>
		</div>';
		}
	?>
	<?php if(isset($message_success)){
		echo '<div class="alert alert-success" role="alert">
			<p class="text-center">
			'.$message_success.'</p></div>';
		}
	?>
			<div class="card-body mb-3">
				<form action="edit_profil.php" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						    <input type="text" class="form-control" placeholder="username" name="username">
                    </div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="password">
                    </div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password confirm " name="password2">
                    </div>                    
					<div class="form-group d-flex justify-content-center mt-3">
						<input type="submit" value="Edit" class="btn float-right login_btn" name="edit">
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require 'include/footer.php';