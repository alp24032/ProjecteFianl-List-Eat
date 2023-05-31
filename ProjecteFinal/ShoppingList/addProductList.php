<?php
session_start();
include_once "../Conn_BDD/connexio.php";

//validem si l'usuari està logejat
if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])) {
    //validem si s'han envait els camps necesaris per editar un producte
    if(isset($_POST['nameProdList']) && isset($_POST['typeProdList']) && isset($_POST['placeList']) && isset($_POST['calList'])){

        $nameProdList = $_POST['nameProdList'];
        $typeProdList = $_POST['typeProdList'];
        $placeList = $_POST['placeList'];
        $calList = $_POST['calList'];
        $groupNum = $_SESSION['idGroup'];

        //sentencia SQL per obtenir l'id pels Place
        $sqlGetPlaceID = "SELECT id FROM place WHERE placeName = '$placeList'";
        //query de l'SQL
        $dataGetPlaceID = $conn->query($sqlGetPlaceID);

        //condició per verificar si la query s'ha executat
        if($dataGetPlaceID !== NULL){
            //guardem el resultat de la query
            $infoGetPlaceID = $dataGetPlaceID->fetch_object();

            $sqlProductList = "INSERT INTO list (productName, type, calories, groupNumber, placeNumber)
            VALUES ('$nameProdList', '$typeProdList', '$calList', '$groupNum', '$infoGetPlaceID->id') ";

            //query de l'SQL
            $conn->query($sqlProductList);

            $sql = $conn->insert_id;

            echo $sql;
            exit();
        
        } else{
            echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
            <div style='width: 100%; height: 100%; display: flex; flex-wrap: wrap; justify-content: center; align-content: center;'>
                <div style='display: flex; color: black; align-content: center; justify-content: center; flex-wrap: wrap; background-color: tomato; width: 300; height: 100px; font-family: monospace; text-align: center; font-size: large;'>
                    Error. 
                </div>
            </div>";
            header("Refresh:3; url=http://localhost/ProjecteFinal/ShoppingList/shoppingList.php");
            exit();        
        }
    }else{
        echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
        <div style='width: 100%; height: 100%; display: flex; flex-wrap: wrap; justify-content: center; align-content: center;'>
            <div style='display: flex; color: black; align-content: center; justify-content: center; flex-wrap: wrap; background-color: tomato; width: 300; height: 100px; font-family: monospace; text-align: center; font-size: large;'>
                Error. 
            </div>
        </div>";
        header("Refresh:5; url=http://localhost/ProjecteFinal/ShoppingList/shoppingList.php");
        exit();   
    }
}else{
    //en cas de no tindre els camps necessaris redireccionem a la pàgina principal
    header("Location: http://localhost/ProjecteFinal/ShoppingList/shoppingList.php");
    exit();
}

$conn->close();

?>