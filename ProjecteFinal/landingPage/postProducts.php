<?php

session_start();
include_once "../Conn_BDD/connexio.php";
if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])) {
    //validem si s'han envait els camps necesaris per afegir un producte
    if(isset($_POST['nameProd']) && isset($_POST['typeProd']) && isset($_POST['buyDate']) && isset($_POST['expDate']) && isset($_POST['cal'])){
        //condició per evitar problemes amb el value de l'input checkbox
        if(!isset($_POST['opneOrNot'])){
            $opneOrNot = 0;
        }  
        if(isset($_POST['opneOrNot'])){
            $opneOrNot = 1;
        }  

        $nameProd = $_POST['nameProd'];
        $typeProd = $_POST['typeProd'];
        $buyDate = $_POST['buyDate'];
        $expDate = $_POST['expDate'];
        $cal = $_POST['cal'];
        // $opneOrNot = $_POST['opneOrNot'];
        $units = $_POST['units'];    
        $place = $_POST['place'];
        $groupNum = $_SESSION['idGroup'];

        //condició per canviar el valor del input checkbox per un mes adequat
        if($opneOrNot === null){
            $opneOrNot = false;
        }else if($opneOrNot === 'on'){
            $opneOrNot = true;
        }

        //sentencia SQL per obtenir l'id pels Place
        $sqlGetPlaceID = "SELECT id FROM place WHERE placeName = '$place'";
        //query de l'SQL
        $dataGetPlaceID = $conn->query($sqlGetPlaceID);

        if($dataGetPlaceID !== NULL){
            //guardem el resultat de la query
            $infoGetPlaceID = $dataGetPlaceID->fetch_object();

            //sentencia SQL per afegir el producte a la BDD
            $sqlProduct = "INSERT INTO product (productName, shoppingDate, expirationDate, type, openOrNot, units, calories, groupNumber, placeNumber)
            VALUES ('$nameProd', '$buyDate', '$expDate', '$typeProd', '$opneOrNot', '$units', '$cal', '$groupNum', '$infoGetPlaceID->id') ";
            //query de l'SQL
            $conn->query($sqlProduct);

            // redirecció a la pagina principal
            header("Refresh:2; url=http://localhost/ProjecteFinal/landingPage/landingPage.php");
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
        //en cas de no tindre els camps necessaris redireccionem a la pàgina principal
        header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
        exit();
    }
}else{
    //en cas de no tindre els camps necessaris redireccionem a la pàgina principal
    header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
    exit();
}

$conn->close();
?>