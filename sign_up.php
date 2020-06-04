<?php 
$title = "Sign_up";
require'include/header.php';?>
<!-- On inclut le header.php qui contient la partie du haut de notre site -->

<?php
// name="sign_up" vérifier que l'utilisateur a cliqué sur le bouton
if(isset($_POST['sign_up'])){
// Si le champ de username est vide ou que l'username n'a pas de alphabet minuscules a-z ou majuscules A-Z répétés plusieurs fois (+)
	if(empty($_POST['username']) || !preg_match('/[a-zA-Z0-9]+/', $_POST['username'])){

		$message_error = "Votre username doit être une chaîne de caractère (alphanumérique)";
// Si le champ de email est vide ou si le filtre de validation email est différent de vrai
	}elseif(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$message_error = "Entrez une adresse email valide !";
//Si le champ est vide  ou si le mot de passe n'est pas égale ou 2ème mot de passe
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

		//Idem pour le email
		$req1= $bdd->prepare('SELECT * FROM table_membres WHERE email = :email');
		$req1->bindValue(':email', $_POST['email']);
		$req1->execute();
		$result1 = $req1->fetch();

		if($result){
			$message_error = "The username already exists";
		}elseif($result1){
			$message_error = "Email already exists";
		}else{
			//Cryptage du mot de passe
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		//Insertion dans la base de données des informations de l'utilisateur

		$requete = $bdd->prepare('INSERT INTO table_membres(username, email, password) VALUES(:username, :email, :password)');

		//Mise en place de parallèle entre les valeurs vides et les valeurs postées par l'utilisateur
		$requete->bindValue(':username', $_POST['username']);
		$requete->bindValue(':email', $_POST['email']);
		$requete->bindValue(':password', $password);

		//Ensuite on execute la requete 
		$requete->execute();

		//Message de bon fonctionnement
		$message_success = "You are well registered!";

		}
	}
}
?>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
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
				<form action="sign_up.php" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						    <input type="text" class="form-control" placeholder="username" name="username">
                    </div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" class="form-control" placeholder="Adresse@email" name="email">
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
						<input type="submit" value="Sign Up" class="btn float-right login_btn" name="sign_up">
					</div>
					<div class="card-footer">
					<div class="d-flex justify-content-center mt-2">
							<a href="login.php" class="float-right mb-4">login</a>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require 'include/footer.php'?>