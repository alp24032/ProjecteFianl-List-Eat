<?php
session_start();
include_once "../Conn_BDD/connexio.php";

console_log(password_hash('fadya)t5DYp', PASSWORD_DEFAULT, [15]));
//en cas que l'usuari encara estigui logejat, redireccionem a la pàgina principal
if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])) {
    header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
    exit();

}else{//en cas que l'usuari no estigui logejat, fem el SignIn
	//comprovem si les dades necessaries s'han enviat
    if(isset($_POST["passw_in"])){
		//condició on verifiquem si l'usuari a envait el username o el email
        if(isset($_POST["userN_in"])){ 
            $userN_in = $_POST["userN_in"];
            $passw_in = $_POST["passw_in"];
			// $hash_passw_in = password_hash($passw_in, PASSWORD_DEFAULT, [15]);
			// password_verify($passw_in, );

            if($userN_in !== NULL){
            	//sentencia SQL per buscar si l'usuari existeix a la BDD
                $sqlLogin ="SELECT id, email, username, password FROM users
                WHERE username = '$userN_in'";
				
            }
        }
        if(isset($_POST["email_in"])){
            $email_in = $_POST["email_in"];
            $passw_in = $_POST["passw_in"];

            if($email_in !== NULL){				
				$sqlLogin ="SELECT id, email, username, password FROM users
				WHERE username = '$email_in'";
            }
        }

         //query de l'SQL
		// console_log($hash_passw_in);
        $getUserData = $conn->query($sqlLogin);
		//guardem el resultat de la query en un objecte
        $getUserInfo = $getUserData->fetch_object();

        if($getUserInfo !== NULL && password_verify($passw_in, $getUserInfo->password)){
			//guardem les variables de sessió que utilitzarem per verificar si un usuari està logejat o no
            $_SESSION['idUser'] = $getUserInfo->id;
            $_SESSION['username'] = $getUserInfo->username;
            $_SESSION['email'] = $getUserInfo->email;
            $_SESSION['password'] = $getUserInfo->password;

            header("Location: http://localhost/ProjecteFinal/LogIn_&_SignUp/addGroup.php");
            exit();

        }else{
            echo    "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
                    <div style='width: 100%; height: 100%; display: flex; flex-wrap: wrap; justify-content: center; align-content: center;'>
                        <div style='display: flex; color: black; align-content: center; justify-content: center; flex-wrap: wrap; background-color: tomato; width: 300; height: 100px; font-family: monospace; text-align: center; font-size: large;'>
                            Your Username/Email or password are wrong. 
                        </div>
                    </div>";
            header("Refresh:5; url=signIn.php");
            exit();
        }

    } 
}   


$conn->close();//tenquem connexió

?>
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
    </style>

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
								<a href="signUp.php" class="btn btn-outline-dark">Sign Up</a>
							</div>
			      		</div>
						<div class="login-wrap p-4 p-lg-5">
			      			<div class="d-flex">
								<div class="w-100">
									<h3 class="mb-4">Sign In</h3>
								</div>
			      			</div>
							<form action="signIn.php" method="post" class="signin-form">
			      				<div class="form-group mb-3">
									<label class="label" for="name">Username/E-Mail</label>
									<input id="userN_in" name="userN_in" type="text" class="form-control" placeholder="Username/E-Mail" required>
									<div id="user_inMesage" class="small text-danger" hidden></div>
								</div>
								<div class="form-group mb-3 ">
									<label class="label" for="password">Password</label>
									<span class="d-flex">
									<input id="passw_in" name="passw_in" type="password" class="form-control" placeholder="Password" required>
									<i class="bi bi-eye-slash fa-lg" id="eye_inPassw" onclick="hideShowPassw()"></i>
									</span>
									<div id="passw_inMesage" class="small text-danger" hidden></div>
								</div>
								<div class="form-group">
									<button type="submit" class="form-control btn btn-primary submit px-3" onclick="validate()">Sign In</button>
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

	<script src="js/signIn.js"></script>


	</body>
</html>

