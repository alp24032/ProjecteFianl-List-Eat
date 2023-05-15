<?php
session_start();
include_once "../Conn_BDD/connexio.php";

if(isset($_POST['createPlace'])){

    $place = $_POST['createPlace'];
    $groupNum = $_SESSION['idGroup'];

    $sqlNoRepit = "SELECT id, placeName FROM place WHERE placeName = '".$place. "'";

    $noRepitData = $conn->query($sqlNoRepit);

    if($noRepitData !== NULL){//comprobem que la query s'ha executata correctament
        $noRepitInfo = $noRepitData->fetch_object();//guardem el resultat de la query en un objecte

        if($noRepitInfo == NULL){//en cas que l'objecte == NULL, significarà que la place no existeix
            //sql per afegir la nova place
            $sqlNewPalce = "INSERT INTO place (placeName)
            VALUES ('$place')";
            //fem la query per guardar la nova place
            $conn->query($sqlNewPalce);
            //consulta sql per obtenir l'id de la place creada anteriorment
            $getPalceID = "SELECT id FROM place WHERE placeName = '$place'";
            $place_id = $conn->query($getPalceID);
    
            if($place_id !== NULL){//comprobem que la query s'ha executata correctament
                $infoPlace = $place_id->fetch_object();//guardem el resultat de la query en un objecte
                // console_log($infoPlace);
                
                //connectem els diferents places a un grup determinat amb la taula intermitja place_belongs_group
                $sqlRelation = "INSERT INTO place_belongs_group (placeID, groupID)
                VALUES ('$infoPlace->id', '$groupNum')";
                
                //fem la query per guardar la relació
                $conn->query($sqlRelation);

                header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
                exit();
            }


        } else{
            try{
                $sqlRelation = "INSERT INTO place_belongs_group (placeID, groupID)
                VALUES ('$noRepitInfo->id', '$groupNum')";
                
                $dataRelation = $conn->query($sqlRelation);

                header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
                exit();
            }catch (Exception $e) {
                // echo 'Excepción capturada: ',  $e->getMessage(), "\n";
                header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
                exit();
            }

        }
    }

} else{
    echo "<script>alert('Error');</script>";
}
?>