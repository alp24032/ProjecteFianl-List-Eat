<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/forgotPassw.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

</head>
<body class=" bg-dark min-vh-100">
    <header>
        <div id="head" class="row bg-warning row-cols-auto text-white min-vh-20">
            <div class="col">
                <a href="signIn.php">
                    <img src="/ProjecteFinal/img/LogoProjecte.gif" class="rounded-circle" alt="" width="100" height="100">
                </a>
            </div>
        </div>
    </header>
	<div id="m" class="col ">
        <div class="container d-flex align-items-center justify-content-center p-4 my-5 w-75 bg-white text-dark">
            <form id="forgotPassw" class="form" action="forgotPassw.php" method="post">
                <label class="label" for="noPassw">Enter your Email</label>
                <input type="email" name="noPassw" id="noPassw" class="form-control"  placeholder="youremail@gmail.com">
				<div id="forgotEmail" class="small">*If your Email doesn't exist on the database you will not receive an email rsponse</div>
                <input type="submit" id="forgot" class="form-control my-2 btn btn-primary submit btn-outline-dark">
            </form>
        </div>
    </div>
    <script>
    </script>
</body>
</html>

<?php
// include_once "forgotPassw.html";
include_once "../Conn_BDD/connexio.php";


if(isset($_POST["noPassw"])){
    $noPassw = $_POST["noPassw"];

    $sqlS = "SELECT email FROM users WHERE email = '$noPassw'";

    $dades = $conn->query($sqlS);
    // print_r($dades);
    if($dades !== NULL){
        $info = $dades->fetch_object();
        // console_log($info);
        if($info != NULL){
            while($info != NULL){
                if($info->email == $noPassw){
                    // console_log($info->email);
                    $headers = "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $headers .= "From: Help service of List-Eat"."\r\n"; // Sender Email
                    $headers .= "Reply-To: ".$noPassw."\r\n"; // Email address to reach back
                    $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type

                    $linkRecoverPassw = "<a href='http://localhost/ProjecteFinal/LogIn_&_SignUp/recoverPassw.php?userEmail=$noPassw'>recover your password</a>";
                    $para = $noPassw;
                    $asunto = 'Recover Password';
                    $descripcion = "Click this link to " . $linkRecoverPassw . ", if the new password matches the old one you will recive a response saing that the new password ant de new one are the same.";
                    $de = 'From: alopez.dam@institutcampalans.net';
                    if (mail($para, $asunto, $descripcion, $headers, $de))
                    {
                        echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
                        <div id='message'>
                            <div id='okContainer'>
                                You will receive a response on your email
                            </div>
                        </div>";
                        header("Refresh:3; url=http://localhost/ProjecteFinal/LogIn_&_SignUp/forgotPassw.php");
                        exit();

                    }
                }
                $info = $dades->fetch_object();

            }
        }else{
            echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
            <div id='message'>
                <div id='errorContainer'>
                    This Email doesn\'t\ exists
                </div>
            </div>";
            header("Refresh:3; url=http://localhost/ProjecteFinal/LogIn_&_SignUp/forgotPassw.php");
            exit();
        }
    }
}  

$conn->close();//tenquem connexió

?> 
