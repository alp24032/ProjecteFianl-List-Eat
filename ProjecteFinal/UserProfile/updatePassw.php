
<?php
session_start();

include_once "../Conn_BDD/connexio.php";
if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])) {

    if(isset($_POST['newPassw'])){
        $newPassw = $_POST['newPassw'];
        $hash_newPassw = password_hash($newPassw, PASSWORD_DEFAULT, [15]);

        $sqlNewPassw = "UPDATE users SET `password`='$hash_newPassw' WHERE username = '".$_SESSION['username']."' ";

        console_log($sqlNewPassw);

        $conn->query($sqlNewPassw);

        $_SESSION['password'] = $hash_newPassw;

        header("Location: userProfile.php");

    }else {
        echo "Error";
    }
}else{
    header("Location: http://localhost/projecteFinal/LogIn_&_SignUp/signIn.php");
    exit();
}
?>