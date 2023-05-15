<?php
//mantenim la sessió oberta
session_start();
//afegim el deocument de connexió per fer les peticions SQL a la BDD
include_once "../Conn_BDD/connexio.php";
//comprobem que les variables de sessió necesaries existeixen
if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])) {

    $currentDate = date('Y-m-d');
    console_log($_SESSION['password']);
?>
<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- HTML de la pàgina -->
<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="landingPage.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous">
    </script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
      integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
      crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	
    <script type="text/javascript" src="/ProjecteFinal/Global_Function_JS/function.js"></script>
    
</head>
<body class="bg-image" style="background-image: url('/ProjecteFinal/img/background0.jpg');">
    <nav class=" navbar sticky-top navbar-expand-lg navbar-light" style="background-color: rgba(247, 215, 5, 1);">
        <div class="container-fluid" >
            <a class="navbar-brand" href="/ProjecteFinal/landingPage/landingPage.php">
                <img src="/ProjecteFinal/img/LogoProjecte.gif" class="rounded-circle" alt="" width="100" height="100">
            </a>
            <button id="toggler" class="navbar-toggler collapsed bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation" onclick="toogleMenu()">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse me-auto mb-2 mb-lg-0 justify-content-between" id="navbarToggler">
                <ul class="navbar-nav d-flex justify-content-between">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/ProjecteFinal/landingPage/landingPage.php">Food</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="http://localhost/ProjecteFinal/LogIn_&_SignUp/addGroup.php">Group</a>
                    </li>
                    <li class="nav-item dropdown" >
                        <div id="navFilter" class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="filterToggle()">
                            Filter
                        </div>
                        <ul id="ulFilter" class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <div class="d-flex">
                            <li><a id="ByName" type="button" class="dropdown-item" href="/ProjecteFinal/landingPage/landingPage.php?ByName=productName">By Name</a></li>
                            </div>

                            <div class="d-flex">
                            <li><a id="ByType" type="button" class="dropdown-item" href="/ProjecteFinal/landingPage/landingPage.php?ByType=type">By Type</a></li>
                            </div>                            

                            <div class="d-flex">
                                <li><a id="ByDateF_Asc" type="button" class="dropdown-item" href="/ProjecteFinal/landingPage/landingPage.php?ByDateF_Asc=expirationDate">By Expir Date(Asc)</a></li>
                                <li><a id="ByDateF_Desc" type="button" class="dropdown-item" href="/ProjecteFinal/landingPage/landingPage.php?ByDateF_Desc=expirationDate">By Expir Date(Desc)</a></li>
                            </div>

                            <div class="d-flex">
                                <li><a id="ByDateS_Asc" type="button" class="dropdown-item" href="/ProjecteFinal/landingPage/landingPage.php?ByDateS_Asc=shoppingDate">By Buy Date(Asc)</a></li>
                                <li><a id="ByDateS_Desc" type="button" class="dropdown-item" href="/ProjecteFinal/landingPage/landingPage.php?ByDateS_Desc=shoppingDate">By Buy Date(Desc)</a></li>
                            </div>

                            <div class="d-flex">
                                <li><a id="ByPlace" type="button" class="dropdown-item" href="/ProjecteFinal/landingPage/landingPage.php?ByPlace=placeNumber">By Place</a></li>
                            </div>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/ProjecteFinal/UserProfile/userProfile.php" >Profile</a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link text-dark" href="/ProjecteFinal/UserProfile/userProfile.php" onclick="hideProduct()">Hide/Show</div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Formulari per afegir  un nou producte -->
<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
    <div class='modal fade' id='formProduct' tabindex='-1' aria-labelledby='formProductlabel' aria-hidden='true'>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add New Product
                    </h5>
                </div>
                <div class="modal-body">
                    <form action="postProducts.php" method="post">
                        <b><label class="form-label" for="nameProd">Name:</label></b>
                        <input class="form-control" id="nameProd" name="nameProd" type="text">
                        <br>
                        <b><label class="form-label" for="typeProd">Type Product:</label></b>
                        <select class="form-control" name="typeProd" id="typeProd">
                            <option value="" selected>-</option>
                            <option value="Meat">Meat</option>
                            <option value="Fruit">Fruit</option>
                            <option value="Vegetable">Vegetable</option>
                            <option value="Cereal">Cereal</option>
                            <option value="Legumbre">Legume</option>
                            <option value="Lactic">Lactic</option>
                            <option value="Bakery">Bakery</option>
                            <option value="Chuches">Chuches</option>
                            <option value="Fish">Fish</option>
                            <option value="Dip">Dip</option>
                            <option value="Species">Species</option>
                            <option value="Egg">Egg</option>
                            <option value="Frutos Secos">Frutos Secos</option>
                            <option value="Oil">Oil</option>
                            <option value="Supplement">Supplement</option>
                            <option value="Bread">Bread</option>
                            <option value="Shellfish">Shellfish</option>
                            <option value="Other">Other</option>
                        </select>
                        <br>
                        <b><labe class="form-label" for="buyDate">Shopping Date:</label></b>
                        <input class="form-control" id="buyDate" name="buyDate" type="date" value="<?=$currentDate?>">
                        <br>
                        <b><label class="form-label" for="expDate">Expiration Date:</label></b>
                        <input class="form-control" id="expDate" name="expDate" type="date">
                        <br>
                        <b><label class="form-label" for="place">Place: </label></b>
                        <span class="d-flex align-items-center d-inline-block">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control d-flex" name="place" id="place">
                                        <option value="" selected>-</option>
                                        <?php getPlace($conn); ?>
                                    </select>
                                    <span class="input-group-text" type="button" id="eye_ShowPassw" onclick="showAddPlace()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                    </span>
                                </div>
                            </div>
                        </span>
                        <br>
                        <b><label class="form-label" for="opneOrNot">Open?:</label></b>
                        <input class="form-check-input" id="opneOrNot" name="opneOrNot" type="checkbox">
                        <br>
                        <b><label class="form-label" for="cal">Calories:</label></b>
                        <input class="form-control" id="cal" name="cal" type="number">
                        <br>
                        <b><label class="form-label" for="units">Units:</label></b>
                        <input class="form-control" id="units" name="units" type="number">
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Send" class="btn btn-outline-dark">
                    <button type="button" class="btn btn-outline-danger" onclick="hideAddProduct()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Formulari per modificar un producte -->
<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->

<div class='modal fade' id='formEdit' tabindex='-1' aria-labelledby='formEditlabel' aria-hidden='true'>
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Edit Product
                </h5>
            </div>
            <div class="modal-body">
                <form name="editForm" action="editProduct.php" method="post">
                    <input id="idEdit" name="idEdit" type="hidden">
                    <b><label class="form-label" for="nameProdEdit">Name:</label></b>
                    <input class="form-control" id="nameProdEdit" name="nameProdEdit" type="text">
                    <br>
                    <b><label class="form-label" for="typeProdEdit">Type Product:</label></b>
                    <select class="form-control" name="typeProdEdit" id="typeProdEdit">
                        <option value="">-</option>
                        <option value="Meat">Meat</option>
                        <option value="Fruit">Fruit</option>
                        <option value="Vegetable">Vegetable</option>
                        <option value="Cereal">Cereal</option>
                        <option value="Legumbre">Legume</option>
                        <option value="Lactic">Lactic</option>
                        <option value="Bakery">Bakery</option>
                        <option value="Chuches">Chuches</option>
                        <option value="Fish">Fish</option>
                        <option value="Dip">Dip</option>
                        <option value="Species">Species</option>
                        <option value="Egg">Egg</option>
                        <option value="Frutos Secos">Frutos Secos</option>
                        <option value="Oil">Oil</option>
                        <option value="Supplement">Supplement</option>
                        <option value="Bread">Bread</option>
                        <option value="Shellfish">Shellfish</option>
                        <option value="Other">Other</option>
                    </select>
                    <br>
                    <b><labe class="form-label" for="buyDateEdit">Shopping Date:</label></b>
                    <input class="form-control" id="buyDateEdit" name="buyDateEdit" type="date" >
                    <br>
                    <b><label class="form-label" for="expDateEdit">Expiration Date:</label></b>
                    <input class="form-control" id="expDateEdit" name="expDateEdit" type="date" >
                    <br>
                    <b><label class="form-label" for="placeEdit">Place: </label></b>
                    <span class="d-flex align-items-center d-inline-block">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control d-flex" name="placeEdit" id="placeEdit">
                                    <option value="" selected>-</option>
                                    <?php getPlace($conn); ?>
                                </select>
                                <span class="input-group-text" type="button" id="eye_ShowPassw" onclick="showAddPlace()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                                </span>
                            </div>
                        </div>
                    </span>
                    <br>
                    <b><label class="form-label" for="opneOrNotEdit">Open?:</label></b>
                    <input class="form-check-input" id="opneOrNotEdit" name="opneOrNotEdit" type="checkbox" >
                    <br>
                    <b><label class="form-label" for="calEdit">Calories:</label></b>
                    <input class="form-control" id="calEdit" name="calEdit" type="number" value="">
                    <br>
                    <b><label class="form-label" for="unitsEdit">Units:</label></b>
                    <input class="form-control" id="unitsEdit" name="unitsEdit" type="number" >
            </div>
            <div class="modal-footer">
                <input type="submit" value="Send" class="btn btn-outline-dark">
                <button type="button" class="btn btn-outline-danger" onclick="hideEditProduct()">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
    //fem un echo de la funció getDataProducts($conn), per crear l'etiqueta de cada producte
    echo getDataProducts($conn);
?>
<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- botó per afegir els productes -->
<div onclick="showAddProduct()" type="button" class="btn-flotante">Add Product</div>
<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Formulari per afegir una nova PLace -->
<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
<div class='modal fade' id='formPlace' tabindex='-1' aria-labelledby='formPlaceLabel' aria-hidden='true'>
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-warning">
            <div class="modal-header">
                <h5 class="modal-title">
                    Add New Place
                </h5>
            </div>
            <form action="addPlace.php" method="post">
                <div class="modal-body">
                    <input id="createPlace" name="createPlace" type="text" class="form-control">
                    <div id="placeMessage" class="small text-danger" hidden></div>
                </div>
                <div class="modal-footer">
                    <input value="Create" type="submit" class="btn btn-outline-dark" onclick="return noEmptyPlace()">
                    <button type="button" class="btn btn-outline-danger" onclick="hideAddPlace()">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- espai adicional per hevitar conflites amb els botons de les etiquetes i el botó d'afegir producte -->
<footer style="height: 5vh; " ></footer>

</body>
    <!-- cridem al fitxer landingPage.js per executar els scripts -->
    <script src="landingPage.js"></script>

    <script>
        function getID(id){
            var x = document.getElementById(id).id;
            console.log(x);

            var idEdit = document.getElementById('idEdit');
            idEdit.value = x;

            var name = document.getElementById('name_'+x).innerHTML;
            var nameEdit = document.getElementById('nameProdEdit');
            nameEdit.value = name;

            var type = document.getElementById('type_'+x).getAttribute('data_value');
            document.getElementById('typeProdEdit').value = type;

            var buyDate = document.getElementById('compra_'+x).innerHTML;
            var buyDateEdit = document.getElementById('buyDateEdit');
            buyDateEdit.value = buyDate;

            var expDate = document.getElementById('caducitat_'+x).innerHTML;
            var expDateEdit = document.getElementById('expDateEdit');
            expDateEdit.value = expDate;

            var place = document.getElementById('place_'+x).getAttribute('data_value');
            document.getElementById('placeEdit').value = place;

            var opneOrNot = document.getElementById('obert_'+x).innerHTML;
            var opneOrNotEdit = document.getElementById('opneOrNotEdit');
            if(opneOrNot == 'SI'){
                opneOrNotEdit.checked = true;
            }else if(opneOrNot == 'NO'){
                opneOrNotEdit.checked = false;
            }

            var cal = document.getElementById('cal_'+x).getAttribute('data_value');
            var calEdit = document.getElementById('calEdit');
            calEdit.value = cal;

            var unit = document.getElementById('unit_'+x).innerHTML;
            var unitsEdit = document.getElementById('unitsEdit');
            unitsEdit.value = unit;
            

        }

    </script>


</html>    


<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->

<?php

}else{
    //en cas que no tinguem les varables de sessió necesaries tornem al sigIn.php
    header("Location: signIn.php");
    exit();
}

//funcio per obtenir un llistat de tots els llocs on podem guardar els productes, de la BDD en funció del grup
function getPlace($conn){

    $sqlGetPlace = " SELECT placeName FROM place P, groups G, place_belongs_group PG 
    WHERE (P.id = PG.placeID AND G.id = PG.groupID) AND (G.id = ".$_SESSION['idGroup'].")";

    $sqlGetPlaceData = $conn->query($sqlGetPlace);

    $sqlGetPlaceInfo = $sqlGetPlaceData->fetch_object();
    while ($sqlGetPlaceInfo != NULL) {

        echo '<option value="'.$sqlGetPlaceInfo->placeName.'" >'.$sqlGetPlaceInfo->placeName.'</option>';
        $sqlGetPlaceInfo = $sqlGetPlaceData->fetch_object();

    }
}

function getDataProducts($conn){
    //sentencies SQL per ordenar els productes de diverses maneres
    $sqlgetProducts = "SELECT * FROM product WHERE groupNumber = ".$_SESSION['idGroup'];
    if(isset($_GET['ByName'])){
        $sqlgetProducts .= " ORDER BY ".$_GET['ByName']." ASC";
    }
    if(isset($_GET['ByType'])){
        $sqlgetProducts .= " ORDER BY ".$_GET['ByType']." ASC";
    }
    if(isset($_GET['ByDateS_Desc'])){
        $sqlgetProducts .= " ORDER BY ".$_GET['ByDateS_Desc']." DESC";
    }
    if(isset($_GET['ByDateS_Asc'])){
        $sqlgetProducts .= " ORDER BY ".$_GET['ByDateS_Asc']." ASC";
    }
    if(isset($_GET['ByDateF_Desc'])){
        $sqlgetProducts .= " ORDER BY ".$_GET['ByDateF_Desc']." DESC";
    }
    if(isset($_GET['ByDateF_Asc'])){
        $sqlgetProducts .= " ORDER BY ".$_GET['ByDateF_Asc']." ASC";
    }
    if(isset($_GET['ByPlace'])){
        $sqlgetProducts .= " ORDER BY ".$_GET['ByPlace']." ASC";
    }

    //query per efectuar el canvi
    $getProductsData = $conn->query($sqlgetProducts);
    //guardem el resultat de la query en un objecte
    $sqlgetProductsInfo = $getProductsData->fetch_object();
    //obtenim la data actual
    $currentDate = date('Y-m-d');

    //variable que utilitzarem per concatenar l'HTML que dspres injectarem a la pàgina
    $output = '';

    //bucle que generarà un etiqueta i un popUp(modal), per cada producte de la BDD assignat al grup
    while($sqlgetProductsInfo != NULL){
        //com el value de $sqlgetProductsInfo->openOrNot retorna 1 o 0, fem un if per canviar els que és veurà a l'etiqueta
        if($sqlgetProductsInfo->openOrNot == 0){
            $openOrNot = 'NO';
        }else if($sqlgetProductsInfo->openOrNot == 1){
            $openOrNot = 'SI';
        }

        //obtenim la data de caducitat del producrte 
        $caducity = new DateTime("$sqlgetProductsInfo->expirationDate");
        //obtenim la data actual  
        $now = new DateTime("now");
        
        //guardem la data de caducitat amb un format especific
        $caducityFormated = new DateTime(date_format($caducity, "Y/m/d"));
        //guardem la data actual amb un format especific
        $nowFormated = new DateTime(date_format($now, "Y/m/d"));

        //fem l'operació per obtenir la differencia entre les dues dates
        $dateOperation = date_diff($now, $caducity);    
        
        //condicions per generar un popUp(modal) diferent depent de la data de cducitat
        if($caducity >= $now && $dateOperation->format('%a') >= 6){//condició en la qual si la data de caducitat es més gran que la data actal i es major o igual a 6
            $days_left = $dateOperation->format('%a');
            $output .= "
            <div class=' modalCaducity modal fade' id='modalCaducity_$sqlgetProductsInfo->id' name='modalCaducity' tabindex='-1' aria-labelledby='modalCaducityLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='bg-success modal-content'>
                        <h3 class='modal-body d-flex justify-content-center text-light'>
                            $days_left days left to Expiration Date
                        </h3>
                    </div>
                </div>
            </div>";
        } else if($caducity >= $now && $dateOperation->format('%a') < 6){//condició en la qual si la data de caducitat es més gran que la data actal i es menor a 6
                $days_left = $dateOperation->format('%a');
                $output .= "
                <div class=' modalCaducity modal fade' id='modalCaducity_$sqlgetProductsInfo->id' name='modalCaducity' tabindex='-1' aria-labelledby='modalCaducityLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered'>
                        <div class='bg-warning modal-content'>
                            <h3 class='modal-body d-flex justify-content-center text-light'>
                                $days_left days left to Expiration Date
                            </h3>
                        </div>
                    </div>
                </div>";
        } else if($dateOperation->format('%a') == 0){//condició en la qual si la data de caducitat es igual que la data actal
            $output .= "
            <div class='modalCaducity modal fade' id='modalCaducity_$sqlgetProductsInfo->id' name='modalCaducity' tabindex='-1' aria-labelledby='modalCaducityLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='bg-warning modal-content'>
                        <h3 class='modal-body d-flex justify-content-center text-light'>
                            To day is the Expiration Date
                        </h3>
                    </div>
                </div>
            </div>";
        } else if($caducity < $now){//condició en la qual si la data de caducitat es més petita que la data actal
            $days_of_caducity = $dateOperation->format('%a');
            $output .= "
            <div class=' modalCaducity modal fade' id='modalCaducity_$sqlgetProductsInfo->id' name='modalCaducity' tabindex='-1' aria-labelledby='modalCaducityLabel' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered'>
                    <div class='bg-danger modal-content'>
                        <h3 class='modal-body d-flex justify-content-center text-light'>
                            $days_of_caducity days since Expiration Date
                        </h3>
                    </div>
                </div>
            </div>";
        }

        //sentencia SQL per obtenir les dades de la Place
        $sqlPlace = "SELECT * FROM place WHERE id = '$sqlgetProductsInfo->placeNumber'";
        //fem la query
        $sqlPlaceData = $conn->query($sqlPlace);
        //guardem el resultat de la query en un objecte
        $sqlPlaceInfo = $sqlPlaceData->fetch_object();

        //condicions per generar una etiquet diferent depent de la data de cducitat
        if($caducity < $now){//condició en la qual si la data de caducitat es més petita que la data actal
            $output .=  "
            <div id='$sqlgetProductsInfo->id' class='container d-flex justify-content-center align-items-center list-group-item' style='padding-block: 5px;' >   
                <div style='background-color: rgba(245, 39, 39, 0.9); padding: 1rem;'>
                    <div>
                        <h1 id='name_$sqlgetProductsInfo->id'  class='d-flex justify-content-center flex-wrap text-light'>$sqlgetProductsInfo->productName</h1>
    
                        <div name='hide'>
                            <hr>
                            <div class='d-flex'>
                                <b style='color: white; margin-top: 4px; margin-right: 10px;'>- Tipus Producte:</b>
                                <p id='type_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark' data_value='$sqlgetProductsInfo->type'>$sqlgetProductsInfo->type</p>
                            </div>
                            <div class='d-flex'>
                                <b style='color: white; margin-top: 4px; margin-right: 10px;'>- Data Compra:</b>
                                <p id='compra_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark'>$sqlgetProductsInfo->shoppingDate</p>
                            </div>
                            ";
                            ?><?php
                                $output .= "
                                <div class='d-flex' onclick='modalID($sqlgetProductsInfo->id)'>
                                    <b style='color: white; margin-top: 4px; margin-right: 10px;'>- Data Caducitat:</b>
                                    <p id='caducitat_$sqlgetProductsInfo->id' class='badge bg-dark text-wrap fs-5 text-light'>$sqlgetProductsInfo->expirationDate</p>
                                </div>";
                            ?><?php
                            $output .= "
                            <div class='d-flex'>
                                <b style='color: white;margin-top: 4px; margin-right: 10px;'>- Envas Obert:</b>
                                <p id='obert_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark'>$openOrNot</p>
                            </div>
                            <div class='d-flex'>
                                <b style='color: white; margin-top: 4px; margin-right: 10px;'>- Calories:</b>
                                <p id='cal_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark' data_value='$sqlgetProductsInfo->calories'>$sqlgetProductsInfo->calories" . "kcal / 100g</p>" . "
                            </div>
                            <div class='d-flex'>
                                <b style='color: white; margin-top: 4px; margin-right: 10px;'>- Localització:</b>
                                <p id='place_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark' data_value='$sqlPlaceInfo->placeName'>$sqlPlaceInfo->placeName</p>
                            </div>
                            <div class='d-flex'>
                                <b style='color: white; margin-top: 4px; margin-right: 10px;'>- Unitats:</b>
                                <p id='unit_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark'>$sqlgetProductsInfo->units</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <nav class='d-flex flex-row justify-content-around' >
                        <div onclick='getID($sqlgetProductsInfo->id)';>
                            <button id='editProduct' type='submit' class='btn btn-primary px-2 border' onclick='showEditProduct()'>Edit</button>
                        </div>
                        <form>
                            <div id='llistaCompra' class='btn btn-secondary px-2 border' type='button'>Llista Compra</div>
                        </form>
                        <form action='deleteProduct.php' method='post'>
                            <input id='deleteProduct' name='deleteProduct' type='hidden' value='$sqlgetProductsInfo->id'>
                            <input type='submit' class='btn btn-danger px-2 border' type='button' value='Delete'>
                        </form>
                    </nav>               
                </div>
            </div>
            ";
        } else{//condició en la qual si la data de caducitat es més gran que la data actal
            $output .=  "
            <div id='$sqlgetProductsInfo->id' class='container d-flex justify-content-center align-items-center list-group-item' style='padding-block: 5px;' >   
                <div style='background-color: rgba(252, 252, 96, 0.9); padding: 1rem;'>
                    <div>
                        <h1 id='name_$sqlgetProductsInfo->id'  class='d-flex justify-content-center flex-wrap'>$sqlgetProductsInfo->productName</h1>

                        <div name='hide'>
                            <hr>
                            <div class='d-flex'>
                                <b style='margin-top: 4px; margin-right: 10px;'>- Tipus Producte:</b>
                                <p id='type_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark' data_value='$sqlgetProductsInfo->type'>$sqlgetProductsInfo->type</p>
                            </div>
                            <div class='d-flex'>
                                <b style='margin-top: 4px; margin-right: 10px;'>- Data Compra:</b>
                                <p id='compra_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark'>$sqlgetProductsInfo->shoppingDate</p>
                            </div>
                            ";
                            ?><?php
                            //condicions per generar un estil diferent depent de la data de cducitat
                            if($caducity >= $now && $dateOperation->format('%a') <= 3){
                                $output .= "
                                <div class='d-flex' onclick='modalID($sqlgetProductsInfo->id)'>
                                    <b style='margin-top: 4px; margin-right: 10px;'>- Data Caducitat:</b>
                                    <p id='caducitat_$sqlgetProductsInfo->id' class='badge bg-danger text-wrap fs-5 text-light'>$sqlgetProductsInfo->expirationDate</p>
                                </div>";
                            }else if($caducity >= $now && 3 < $dateOperation->format('%a')  && $dateOperation->format('%a') <= 6){
                                $output .= "
                                <div id='caducity' class='d-flex' onclick='modalID($sqlgetProductsInfo->id)'>
                                    <b style='margin-top: 4px; margin-right: 10px;'>- Data Caducitat:</b>
                                    <p id='caducitat_$sqlgetProductsInfo->id' class='badge bg-warning text-wrap fs-5 text-light'>$sqlgetProductsInfo->expirationDate</p>
                                </div>";
                            }else{
                                $output .= "
                                <div class='d-flex' onclick='modalID($sqlgetProductsInfo->id)'>
                                    <b style='margin-top: 4px; margin-right: 10px;'>- Data Caducitat:</b>
                                    <p id='caducitat_$sqlgetProductsInfo->id' class='badge bg-success text-wrap fs-5 text-light'>$sqlgetProductsInfo->expirationDate</p>
                                </div>";   
                            }

                            ?><?php
                            $output .= "
                            <div class='d-flex'>
                                <b style='margin-top: 4px; margin-right: 10px;'>- Envas Obert:</b>
                                <p id='obert_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark'>$openOrNot</p>
                            </div>
                            <div class='d-flex'>
                                <b style='margin-top: 4px; margin-right: 10px;'>- Calories:</b>
                                <p id='cal_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark' data_value='$sqlgetProductsInfo->calories'>$sqlgetProductsInfo->calories" . "kcal / 100g</p>" . "
                            </div>
                            <div class='d-flex'>
                                <b style='margin-top: 4px; margin-right: 10px;'>- Localització:</b>
                                <p id='place_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark' data_value='$sqlPlaceInfo->placeName'>$sqlPlaceInfo->placeName</p>
                            </div>
                            <div class='d-flex'>
                                <b style='margin-top: 4px; margin-right: 10px;'>- Unitats:</b>
                                <p id='unit_$sqlgetProductsInfo->id' class='badge bg-light text-wrap fs-5 text-dark'>$sqlgetProductsInfo->units</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <nav class='d-flex flex-row justify-content-around' >
                        <div onclick='getID($sqlgetProductsInfo->id)';>
                            <button id='editProduct' type='submit' class='btn btn-outline-primary px-2' onclick='showEditProduct()'>Edit</button>
                        </div>
                        <form>
                            <div id='llistaCompra' class='btn btn-outline-secondary px-2' type='button'>Llista Compra</div>
                        </form>
                        <form action='deleteProduct.php' method='post'>
                            <input id='deleteProduct' name='deleteProduct' type='hidden' value='$sqlgetProductsInfo->id'>
                            <input type='submit' class='btn btn-outline-danger px-2' type='button' value='Delete'>
                        </form>
                    </nav>               
                </div>
            </div>
            ";
        }
        $sqlgetProductsInfo = $getProductsData->fetch_object();
    }
    //enviem el resultat de $output quan cridem la funció
    return $output;
}


?>