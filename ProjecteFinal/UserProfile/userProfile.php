<?php

session_start();
include_once "../Conn_BDD/connexio.php";

if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])) {


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/userProfile.css">
    <script type="text/javascript" src="/ProjecteFinal/Global_Function_JS/function.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <nav class=" navbar navbar-expand-lg navbar-light" >
        <div class="container-fluid">
            <a class="navbar-brand" href="/ProjecteFinal/landingPage/landingPage.php">
                <img src="/ProjecteFinal/img/LogoProjecte.gif" class="rounded-circle" alt="" width="100" height="100">
            </a>
            <button id="toggler" class="navbar-toggler collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation" onclick="toogleMenu()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse me-auto mb-2 mb-lg-0" id="navbarToggler">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/ProjecteFinal/landingPage/landingPage.php">Food</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/ProjecteFinal/LogIn_&_SignUp/addGroup.php">Group</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/ProjecteFinal/UserProfile/userProfile.php" >Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/ProjecteFinal/ShoppingList/shoppingList.php" >ShoppingList</a>
                    </li>
                </ul>
            </div>
        </div>
      </nav>

    <div class="bg-image" >
        <div class="container d-flex justify-content-center align-items-center" >   
            <div id="profDiv">
                <h1 class="d-flex justify-content-center">Hello <?php echo $_SESSION['username']?></h1>
                Wellcome to your User Profile, where you can see the information of your acount.
                <hr>
                <b>Your Groups: </b><?php echo $_SESSION['groupName']?>
                <br>
                <br>
                <span class="d-flex align-items-center d-inline-block ">
                    <b>Password: </b>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input id="showPassw" type="password" class="form-control" value="<?php echo $_SESSION['password']?>" aria-label="Input group example" aria-describedby="basic-addon1" disabled>
                            <span class="input-group-text" type="button" id="eye_ShowPassw" onclick="hideShowPassw()">
                                <i class="bi bi-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </span>
                <br>
                <button type="button" class="btn btn-outline-dark" onclick="hideShowForm()">Change Password</button>
                <form id="formNewPassw" action="updatePassw.php" method="post" hidden>
                    <br>
                    <div class="form-group mb-3">
                        <div class="col-md-6">
                        <label class="label" for="passw">New Password</label>
                            <div class="input-group">
                                <input id="newPassw" name="newPassw" type="password" class="form-control" aria-label="Input group example" aria-describedby="basic-addon1">
                                <span class="input-group-text" type="button" id="randomNewPassw" onclick="randomNewPassw()">
                                    <i class="bi bi-shuffle"></i>
                                </span>
                                <span class="input-group-text" type="button" id="eye_ShowNewPassw" onclick="hideShowNewPassw()">
                                   <i class="bi bi-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="col-md-6">
                        <label class="label" for="okNewPassw">Confirm New Password</label>
                            <div class="input-group">
                                <input id="okNewPassw" type="password" class="form-control" aria-label="Input group example" aria-describedby="basic-addon1">
                                <span class="input-group-text" type="button" id="eye_ShowNewOkPassw" onclick="hideShowNewOkPassw()">
                                    <i class="bi bi-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="send" type="submit" class="form-control btn submit btn-outline-dark" onclick="return validate()">Set New Password</button>
                    </div>                 
                </form>
                <hr>
                <div class="d-flex justify-content-end">
                    <a type="button" class="btn btn-outline-dark" href="logOut.php">LogOut</a>
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>

<?php
}else{
    header("Location: http://localhost/ProjecteFinal/LogIn_&_SignUp/signIn.php");
    exit();
}

?>