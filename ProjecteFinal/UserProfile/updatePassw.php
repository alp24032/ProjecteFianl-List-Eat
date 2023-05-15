
<?php
session_start();

include_once "connexio.php";

if(isset($_POST['newPassw'])){
    $newPassw = $_POST['newPassw'];

    $sqlNewPassw = "UPDATE users SET `password`='$newPassw' WHERE username = '".$_SESSION['username']."' ";
    // UPDATE users SET `password`='Alp_24032' WHERE username = 'Alex'
    // $sqlNewPassw = "UPDATE password FROM users WHERE username = ".$_SESSION['username']." ";
    console_log($sqlNewPassw);
    // $setDataPassw = 
    $conn->query($sqlNewPassw);

    $_SESSION['password'] = $newPassw;

    // console_log($getNewPasswInfo);
    
    // $setInfoPassw = $setDataPassw->fetch_object();
    header("Location: userProfile.php");

}else {
    echo "Error";
}

?>