<?php

session_start();
include_once "../Conn_BDD/connexio.php";

if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])) {

    // password_verify($passw_in, $getUserInfo->password);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<!-- <link rel="stylesheet" href="/ProjecteFinal/LogIn_&_SignUp/css/style.css"> -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script type="text/javascript" src="/ProjecteFinal/Global_Function_JS/function.js"></script>
	<style>
        i {
            margin-left: -35px;
			margin-top: 13px;
            cursor: pointer;
        }
		#shuffle{
			margin-left: -50px;
		}

    </style>
</head>
<body>
    <nav class=" navbar navbar-expand-lg navbar-light" style="background-color: rgba(247, 215, 5, 1);">
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
                </ul>
            </div>
        </div>
      </nav>

    <div class="bg-image" style="background-image: url('/ProjecteFinal/img/background0.jpg'); height: 85vh;">
        <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">   
            <div style="background-color: rgba(252, 252, 96, 0.9); padding: 1rem;">
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
                            <input id="showPassw" type="password" class="form-control" value="<?php  $_SESSION['password']?>" aria-label="Input group example" aria-describedby="basic-addon1" disabled>
                            <span class="input-group-text" type="button" id="eye_ShowPassw" onclick="hideShowPassw()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                    <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"></path>
                                    <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"></path>
                                    <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"></path>
                                </svg>
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
                                <input id="newPassw" name="newPassw" type="password" class="form-control" value="<?php echo $_SESSION['password']?>" aria-label="Input group example" aria-describedby="basic-addon1">
                                <span class="input-group-text" type="button" id="randomNewPassw" onclick="randomNewPassw()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M0 3.5A.5.5 0 0 1 .5 3H1c2.202 0 3.827 1.24 4.874 2.418.49.552.865 1.102 1.126 1.532.26-.43.636-.98 1.126-1.532C9.173 4.24 10.798 3 13 3v1c-1.798 0-3.173 1.01-4.126 2.082A9.624 9.624 0 0 0 7.556 8a9.624 9.624 0 0 0 1.317 1.918C9.828 10.99 11.204 12 13 12v1c-2.202 0-3.827-1.24-4.874-2.418A10.595 10.595 0 0 1 7 9.05c-.26.43-.636.98-1.126 1.532C4.827 11.76 3.202 13 1 13H.5a.5.5 0 0 1 0-1H1c1.798 0 3.173-1.01 4.126-2.082A9.624 9.624 0 0 0 6.444 8a9.624 9.624 0 0 0-1.317-1.918C4.172 5.01 2.796 4 1 4H.5a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M13 5.466V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192zm0 9v-3.932a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192z"/>
                                    </svg>
                                </span>
                                <span class="input-group-text" type="button" id="eye_ShowNewPassw" onclick="hideShowNewPassw()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"></path>
                                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"></path>
                                        <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"></path>
                                    </svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"></path>
                                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"></path>
                                        <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"></path>
                                    </svg>
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