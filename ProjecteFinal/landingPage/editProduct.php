<?php
session_start();
include_once "../Conn_BDD/connexio.php";

//validem si l'usuari està logejat
if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])) {
    
    if( $_POST ){
        //validem si s'han envait els camps necesaris per editar un producte
        if(isset($_POST['idEdit']) && isset($_POST['nameProdEdit']) && isset($_POST['typeProdEdit']) && isset($_POST['buyDateEdit']) && isset($_POST['expDateEdit']) && isset($_POST['placeEdit']) && isset($_POST['calEdit']) && isset($_POST['unitsEdit']) && (!isset($_POST['opneOrNotEdit']) || isset($_POST['opneOrNotEdit']))){
            //condició per evitar problemes amb el value de l'input checkbox
            if(!isset($_POST['opneOrNotEdit'])){
                $opneOrNotEdit = 0;
            }  
            if(isset($_POST['opneOrNotEdit'])){
                $opneOrNotEdit = 1;
            }  

            $idEdit = $_POST['idEdit'];
            $nameProdEdit = $_POST['nameProdEdit'];
            $typeProdEdit = $_POST['typeProdEdit'];
            $buyDateEdit = $_POST['buyDateEdit'];
            $expDateEdit = $_POST['expDateEdit'];
            $placeEdit = $_POST['placeEdit'];
            $calEdit = $_POST['calEdit'];
            $unitsEdit = $_POST['unitsEdit'];

            //sentencia SQL per obtenir l'id pels Place
            $sqlGetPlaceID = "SELECT id FROM place WHERE placeName = '$placeEdit'";
            //query de l'SQL
            $dataGetPlaceID = $conn->query($sqlGetPlaceID);

            //condició per verificar si la query s'ha executat
            if($dataGetPlaceID !== NULL){
                //guardem el resultat de la query
                $infoGetPlaceID = $dataGetPlaceID->fetch_object();

                //sentencia SQL per actualitzar el producte a la BDD
                $sqlUpdate = "UPDATE product SET 
                productName = '$nameProdEdit',
                shoppingDate = '$buyDateEdit',
                expirationDate = '$expDateEdit',
                `type` = '$typeProdEdit',
                openOrNot = '$opneOrNotEdit',
                units = '$unitsEdit',
                calories = '$calEdit',
                placeNumber = '$infoGetPlaceID->id'
                WHERE id = '$idEdit'
                ";
                //query de l'SQL
                $conn->query($sqlUpdate);

                echo $idEdit;
                exit();
            
            } else{
                echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
                <div style='width: 100%; height: 100%; display: flex; flex-wrap: wrap; justify-content: center; align-content: center;'>
                    <div style='display: flex; color: black; align-content: center; justify-content: center; flex-wrap: wrap; background-color: tomato; width: 300; height: 100px; font-family: monospace; text-align: center; font-size: large;'>
                        Error. 
                    </div>
                </div>";
                header("Refresh:3; url=http://localhost/ProjecteFinal/landingPage/landingPage.php");
                exit();        
            }
        }else{
            echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe' crossorigin='anonymous'></script>
            <div style='width: 100%; height: 100%; display: flex; flex-wrap: wrap; justify-content: center; align-content: center;'>
                <div style='display: flex; color: black; align-content: center; justify-content: center; flex-wrap: wrap; background-color: tomato; width: 300; height: 100px; font-family: monospace; text-align: center; font-size: large;'>
                    Error. 
                </div>
            </div>";
            header("Refresh:5; url=http://localhost/ProjecteFinal/landingPage/landingPage.php");
            exit();   
        }
    }
    
}else{
    //en cas de no tindre els camps necessaris redireccionem a la pàgina principal
    header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
    exit();
}

$conn->close();

?>