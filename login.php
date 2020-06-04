<?php 
$title = "Login";
require 'include/header.php'; ?>
<?php
//Si on submit sur le bouton login
if(isset($_POST['login'])){

	$email = $_POST['email'];
	$password = $_POST['password'];

	//Se connecter pour faire la vérification des infos identiques ente bdd et ce que rentre l'utilisateur
	require_once 'include/start_bdd.php';

	$requete = $bdd->prepare('SELECT * FROM table_membres WHERE email = :email');

	//lier le paramètre dans la requete avec l'info du post de l'utilisateur

	// Idem que le bindValue()
	$requete->execute(array('email'=>$email));
	$result = $requete->fetch();

	//Si le resultat est différent
	if(!$result){
		$message_error = "Your email adress is not valid";
	}else{
		$password_valid = password_verify($password, $result['password']);

		//Si tout est bon on créé une session
		if($password_valid){
			session_start();

			$_SESSION['id'] = $result['id'];
			$_SESSION['username'] = $result['username'];
			$_SESSION['email'] = $email;

			//Si l'utilisateur a coché cette case se souvenir
			if(isset($_POST['remember'])){
				//On met en cookie l'email avec une expiration une heure
				setcookie("email", $_POST['email'], time()+3600);
				//On met en cookie le password avec une expiration d'une heure
				setcookie("password", $_POST['password'], time()+3600);
			}else{
				//Si un cookie existe déjà email
				if(isset($_cookie['email'])){
					setcookie($_COOKIE['email'], "");
				}
				//Si un cookie existe déjà password
				if(isset($_cookie['password'])){
					setcookie($_COOKIE['password'], "");
				}
			}
			//Redirection
			header('location: index.php');
		} else{
			$message_error = "Password is incorrect";
		}
	}


}


?>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Login</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<?php if(isset($message_error)){
				echo '<div class="alert alert-danger">
				<p class="text-center">'.$message_error.'</p>
			</div>';
			}?>
			<div class="card-body mb-3">
				<form action="" method="post">
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" class="form-control" placeholder="Adresse@email" name="email" value=<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];} ?>>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" name="password" value=<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>>
                    </div>  
					<div class="form-check disabled">
						<label class="form-check-label">
							<input type="checkbox" class="form-check-input" name="remember" id="remember" value="option3">
							<p class="remember" >Remember me</p>
						</label>
					</div>                 
					<div class="form-group d-flex justify-content-center mt-4">
						<input type="submit" value="Login" class="btn float-right login_btn" name="login">
					</div>
                    <div class="card-footer">
                    <div class="d-flex justify-content-center mt-4">
                        <a href="sign_up.php" class="float-right mb-4">Sign_up</a>
                    </div>
				</form>
			</div>
			</div>
		</div>
	</div>
</div>
<?php require 'include/footer.php'; ?>