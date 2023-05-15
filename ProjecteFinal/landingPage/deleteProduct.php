<?php
session_start();
include_once "../Conn_BDD/connexio.php";

//validem si l'usuari està logejat
if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])) {
    //validem que l'informació necessaria s'ha enviat corectamnet
    if(isset($_POST['deleteProduct'])){
        $deleteProduct = $_POST['deleteProduct'];

        //sentencia SQL per eliminar un producte per la seva id
        $sqlDeleteProduct = "DELETE FROM product where id = $deleteProduct";
        //query de l'SQL
        $conn->query($sqlDeleteProduct);

        header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
        exit();
    }else{

        header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
        exit();
    }

}else {

    header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
    exit();
}

$conn->close();

?>