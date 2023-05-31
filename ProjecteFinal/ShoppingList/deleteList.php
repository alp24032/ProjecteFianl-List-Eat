<?php
session_start();
include_once "../Conn_BDD/connexio.php";

//validem si l'usuari està logejat
if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])) {
    //validem que l'informació necessaria s'ha enviat corectamnet
    if( $_POST ){
        if(isset($_POST['deleteProdList'])){
        $deleteProdList = $_POST['deleteProdList'];

        //sentencia SQL per eliminar un producte per la seva id
        $sqlDeleteProdList = "DELETE FROM list where id = $deleteProdList";
        //query de l'SQL
        $conn->query($sqlDeleteProdList);

        header("Location: http://localhost/ProjecteFinal/ShoppingList/shoppingList.php");
        exit();
    }else{

        header("Location: http://localhost/ProjecteFinal/ShoppingList/shoppingList.php");
        exit();
    }

}else {

    header("Location: http://localhost/ProjecteFinal/ShoppingList/shoppingList.php");
    exit();
}
    }


$conn->close();

?>