<?php

include_once "connexio.php";

//validem que l'informació del link ha arribat
if(isset($_GET['userEmail'])){
    //guardem l'informació del link en una variable
    $userEmail = $_GET['userEmail'];

    //sentencia SQL per buscar el email de l'usuari
    $sqlExistEmail = "SELECT email FROM users WHERE email = '$userEmail'";

    //query de l'SQL
    $existEmail = $conn->query($sqlExistEmail);

    if($existEmail !== NULL){//comprobem que la query s'ha executat
		//guardem el resultat de la query en un objecte
        $infoEmail = $existEmail->fetch_object();
        //verifiquem que el mail trobat i el del link coincideixen
        if($userEmail == $infoEmail->email){
            //verifiquem que s'han enviat les dades necesaries
            if(isset($_POST["recoverPassword"])){
                $recoverPassword = $_POST["recoverPassword"];

                //sentencia SQL per actualitzar la contrasenya de l'usuari
                $sqlNewPassw = "UPDATE users SET `password`='$recoverPassword' WHERE email = '$userEmail'";

                $conn->query($sqlNewPassw);

                echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
                <div style='width: 100%; height: 100%; display: flex; flex-wrap: wrap; justify-content: center; align-content: center;'>
                    <div style='display: flex; color: black; align-content: center; justify-content: center; flex-wrap: wrap; background-color: green; width: 50vw; height: 30vh; font-family: monospace; text-align: center;'>
                        Password Updated. 
                    </div>
                </div>";
                header("Refresh:3; url=http://localhost/ProjecteFinal/LogIn_&_SignUp/signIn.php");
                exit();   
            }
        }
    }

}

$conn->close();//tenquem connexió
?>
<!-----------------------------------------------------------------------  -->
<!-- HTML del recoverPassword -->
<!-- --------------------------------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
    
    
    <style>
        #m{
            display: flex;
            justify-content: center;
            /* align-content: center; */
            align-items: center;
            margin-top: 100px;
        }
        form i {
            margin-left: -35px;
			margin-top: 13px;
            cursor: pointer;
        }
		#shuffle{
			margin-left: -50px;
		}
        form{
            width: 400px;
        }
    </style>
</head>
<body class=" bg-dark min-vh-100">
    <header>
        <div id="head" class="row bg-warning row-cols-auto text-white min-vh-20">
            <div class="col">
                <a href="signIn.html">
                    <img src="/ProjecteFinal/img/LogoProjecte.gif" class="rounded-circle" alt="" width="100" height="100">
                </a>
            </div>
        </div>
    </header>
	<div id="m" class="col ">
        <div class=" d-flex align-items-center justify-content-center p-4 my-5 w-75 bg-white text-dark">
            <form class="form " action="recoverPassw.php?userEmail=<?=$userEmail?>" method="post">
                <div class="form-group mb-3">
                    <label class="label" for="recoverPassw">New Password</label>
                    <span class="d-flex">
                        <input id="recoverPassword" name="recoverPassword" type="password" class="form-control col-xs-4" minlength="6" placeholder="Set New Password"  required>
                        <!-- onkeyup="strengthPassw()" -->
                        <i class="bi bi-eye-slash fa-lg" id="eye_upPassw" onclick="hideShowPassw()"></i>
                        <i class="bi bi-shuffle fa-lg" id="shuffle" onclick="randomPassw()"></i>
                    </span>
                    <div id="recoverPassw_upMesage" class="small text-danger" hidden></div>
                </div>
                <div class="form-group mb-3">
                    <label class="label" for="recoverPasswConf">Confirm New Password</label>
                    <span class="d-flex">
                        <input id="recoverPasswConf" type="password" class="form-control col-xs-4" minlength="6" placeholder="Confirm Password" required>
                        <i class="bi bi-eye-slash fa-lg" id="eye_upOkPassw" onclick="hideShowOkPassw()"></i>
                    </span>
                    <div id="recoverPasswOk_upMesage" class="small text-danger" hidden></div>
                </div>
                <input type="submit" class="form-control my-2 btn btn-primary submit btn-outline-dark">
            </form>
        </div>
    </div>
    <script src="recoverPassw.js"></script>
</body>
</html>