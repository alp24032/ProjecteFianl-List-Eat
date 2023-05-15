<?php

include_once "connexio.php";
//validem si s'han envait els camps necesaris per crear un compte
// $passwAlex = password_hash('Alp_24032', PASSWORD_DEFAULT, [15]);
// console_log($passwAlex);
if(isset($_POST["userN_up"]) && isset($_POST["email_up"]) && isset($_POST["passw_up"])){
    $userN_up = $_POST["userN_up"];
    $email_up = $_POST["email_up"];
    $passw_up = $_POST["passw_up"];
	$hash_passw_up = password_hash($passw_up, PASSWORD_DEFAULT, [15]);


    //sentencia SQL per comprobar si existeix el email introduit
    $sqlExistEmail = "SELECT email FROM users WHERE email = '$email_up'";
    //sentencia SQL per comprobar si existeix l'username introduit
    $sqlExistUsername = "SELECT username FROM users WHERE username = '$userN_up'";
    //query de l'SQL
    $existEmail = $conn->query($sqlExistEmail);
    //query de l'SQL
    $existusername = $conn->query($sqlExistUsername);

    if($existEmail !== NULL && $existusername !== NULL ){//comprobem que la query s'ha executat
		//guardem el resultat de la query en un objecte
        $infoEmail = $existEmail->fetch_object();
		//guardem el resultat de la query en un objecte
        $infoUsername = $existusername->fetch_object();

		if($infoEmail == NULL && $infoUsername == NULL){//en cas que la query sigui == NULL, significarà que l'Email i l'Username introduit no existeix.
			
            //sentencia SQL per crear un nou usuari a la BDD
			$sqlAddUser = "INSERT INTO users (username, email, password)
			VALUES ('$userN_up', '$email_up', '$hash_passw_up')";

            //query de l'SQL
			$addUserData = $conn->query($sqlAddUser);

			echo "<script>alert('User " . $userN_up . " created succesfuly.');window.location.assign('signIn.php')</script>";
					
		}else if($infoEmail != NULL){
			echo "<script>alert('Error: L\'Email [ $email_up ] ja existeix.')</script>";
        }else if($infoUsername != NULL){
			echo "<script>alert('Error: L\'Username [ $userN_up ] ja existeix.')</script>";
		}else{
			echo "<script>alert('Error: L\'Username [ $userN_up ] i l\'Email [ $email_up ] ja existeixen.')</script>";
		}
            
    }else {
		echo "<script>alert('Error a l\'hora d\'xecutar la consulta.')</script>";
	}
}

$conn->close();//tenquem connexió

?>
<!-----------------------------------------------------------------------  -->
<!-- HTML del SignIn -->
<!-- --------------------------------------------------------------------- -->
<!doctype html>
<html lang="en">
  <head>
  	<title>Login 07</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<style>
        form i {
            margin-left: -35px;
			margin-top: 13px;
            cursor: pointer;
        }
		#shuffle{
			margin-left: -50px;
		}

    </style>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>

	</head>
	<body class="bg-dark">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
								<h2 class="text-dark">Welcome to </h2>
								<img src="/ProjecteFinal/img/LogoProjecte.gif" class="rounded-circle" width="150" height="150">
								<p class="text-dark">Don't have an account?</p>
								<a href="/ProjecteFinal/LogIn_&_SignUp/signIn.php" class="btn btn-outline-dark" >Sign In</a>
							</div>
			            </div>
						<div class="login-wrap p-4 p-lg-5">
			      			<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Sign Up</h3>
								</div>
							</div>
							<form name="signUp_form" action="signUp.php" method="post" class="signin-form">
								<div class="form-group mb-3">
									<label class="label" for="userN_up">Username</label>
									<input id="userN_up" name="userN_up" type="text" class="form-control" minlength="3" placeholder="Username" required>
									<div id="user_upMesage" class="small text-danger" hidden></div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="email_up">E-Mail</label>
									<input id="email_up" name="email_up" type="email" class="form-control" placeholder="example@gmail.com"  required>
									<div id="email_upMesage" class="small text-danger" hidden></div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="passw_up">Password</label>
									<span class="d-flex">
										<input id="passw_up" name="passw_up" type="password" class="form-control" minlength="6" placeholder="Password" onkeyup="strengthPassw()" required>
										<i class="bi bi-eye-slash fa-lg" id="eye_upPassw" onclick="hideShowPassw()"></i>
										<i class="bi bi-shuffle fa-lg" id="shuffle" onclick="randomPassw()"></i>
									</span>
									<div id="passw_upMesage" class="small text-danger" hidden></div>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="okPassw_up">Confirm Password</label>
									<span class="d-flex">
										<input id="okPassw_up" type="password" class="form-control" minlength="6" placeholder="Confirm Password" required>
										<i class="bi bi-eye-slash fa-lg" id="eye_upOkPassw" onclick="hideShowOkPassw()"></i>
									</span>
									<div id="okPassw_upMesage" class="small text-danger" hidden></div>
								</div>
								<div class="form-group">
									<button id="send" type="submit" class="form-control btn btn-primary submit btn-outline-dark" onclick="return validate()">Sign Up</button>
								</div>
								<div class="form-group d-md-flex">
									<div class="w-0 text-md-right">
										<a href="forgotPassw.php">Forgot Password</a>
									</div>
								</div>
							</form>
		        		</div>
		      		</div>
				</div>
			</div>
		</div>
	</section>

	<script src="singUp.js"></script>

	</body>
</html>