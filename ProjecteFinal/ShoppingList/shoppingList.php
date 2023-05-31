<?php

session_start();
include_once "../Conn_BDD/connexio.php";

//verifiquem que la sessió estigui oberta
if(isset($_SESSION['idUser']) && isset($_SESSION['idGroup']) && isset($_SESSION['email']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['groupName'])){
    //condició que s'efectuarà quan revi les dades enviades per mitjà d'ajax
    if( $_POST ){
        if(isset($_POST['nameProdList']) && isset($_POST['typeProdList']) && isset($_POST['calList']) && isset($_POST['placeList']) && isset($_SESSION['idGroup'])){
            $nameProdListList=$_POST['nameProdList'];
            $typeProdList=$_POST['typeProdList'];
            $calList=$_POST['calList'];
            $placeList=$_POST['placeList'];
            $groupNum = $_SESSION['idGroup'];
            // console_log($nameProdListList);

            $sqlGetPlaceID = "SELECT id FROM place WHERE placeName = '$placeList'";

            $dataGetPlaceID = $conn->query($sqlGetPlaceID);

            if($dataGetPlaceID !== NULL){
                //guardem el resultat de la query
                $infoGetPlaceID = $dataGetPlaceID->fetch_object();

                //sentencia SQL per afegir el producte a la BDD
                $sqlAddList = "INSERT INTO list (productName, type, calories, groupNumber, placeNumber)
                VALUES ('$nameProdListList', '$typeProdList', '$calList', '$groupNum', '$infoGetPlaceID->id') ";
                //query de l'SQL
                $conn->query($sqlAddList);
            }
        }
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
            $sqlGetList = "SELECT * FROM list WHERE groupNumber = ".$_SESSION['idGroup'];
            if(isset($_GET['ByName'])){
                $sqlGetList .= " ORDER BY ".$_GET['ByName']." ASC";
            }
            if(isset($_GET['ByType'])){
                $sqlGetList .= " ORDER BY ".$_GET['ByType']." ASC";
            }
            if(isset($_GET['ByPlace'])){
                $sqlGetList .= " ORDER BY ".$_GET['ByPlace']." ASC";
            }
    
            //query per efectuar el canvi
            $getListData = $conn->query($sqlGetList);
            //guardem el resultat de la query en un objecte
            $sqlgetListInfo = $getListData->fetch_object();
            // console_log($sqlgetListInfo);
            //variable que utilitzarem per concatenar l'HTML que dspres injectarem a la pàgina
            $output = '';
    
            //bucle que generarà un etiqueta i un popUp(modal), per cada producte de la BDD assignat al grup
            while($sqlgetListInfo != NULL){  
                //sentencia SQL per obtenir les dades de la Place
                $sqlPlace = "SELECT * FROM place WHERE id = '$sqlgetListInfo->placeNumber'";
                //fem la query
                $sqlPlaceData = $conn->query($sqlPlace);
                //guardem el resultat de la query en un objecte
                $sqlPlaceInfo = $sqlPlaceData->fetch_object();
    
                $output .=  "
                <div id='$sqlgetListInfo->id' class='container d-flex justify-content-center align-items-center list-group-item' style='padding-block: 5px;' >   
                    <div id='goodNote'>
                        <div>
                            <h1 id='name_$sqlgetListInfo->id'  class='d-flex justify-content-center flex-wrap'>$sqlgetListInfo->productName</h1>
                            <div name='hide'>
                                <hr>
                                <div class='d-flex'>
                                    <b class='infoProd'>- Type Product:</b>
                                    <p id='type_$sqlgetListInfo->id' class='badge bg-light text-wrap fs-5 text-dark' data_value='$sqlgetListInfo->type'>$sqlgetListInfo->type</p>
                                </div> 
                                <div class='d-flex'>
                                    <b class='infoProd'>- Calories:</b>
                                    <p id='cal_$sqlgetListInfo->id' class='badge bg-light text-wrap fs-5 text-dark' data_value='$sqlgetListInfo->calories'>$sqlgetListInfo->calories" . "kcal / 100g</p>" . "
                                </div>
                                <div class='d-flex'>
                                    <b class='infoProd'>- Place:</b>
                                    <p id='place_$sqlgetListInfo->id' class='badge bg-light text-wrap fs-5 text-dark' data_value='$sqlPlaceInfo->placeName'>$sqlPlaceInfo->placeName</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <nav class='d-flex flex-row justify-content-around'>
                            <div onclick='editID($sqlgetListInfo->id)'>
                                <button id='editProduct' type='submit' class='btn btn-outline-primary px-2' onclick='showEditProduct()'>Edit</button>
                            </div>
                            <div onclick='showAddProduct()'>
                                <button id='addProduct' type='submit' class='btn btn-outline-secondary px-2' onclick='addProd($sqlgetListInfo->id)'>Food List</button>
                            </div>
                            <form id='deleteID_$sqlgetListInfo->id' onsubmit='deleteProd($sqlgetListInfo->id); return false'>
                                <input id='deleteProdList' name='deleteProdList' type='hidden' value='$sqlgetListInfo->id'>
                                <input type='submit' class='btn btn-outline-danger px-2' type='button' value='Delete'>
                            </form>
                        </nav>               
                    </div>
                </div>
                ";
                
                $sqlgetListInfo = $getListData->fetch_object();
            }
            //enviem el resultat de $output quan cridem la funció
            return $output;
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="css/shoppingList.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--  -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    
</head>
<body class="bg-image">
    <nav class=" navbar sticky-top navbar-expand-lg navbar-light">
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
                                <li><a id="ByPlace" type="button" class="dropdown-item" href="/ProjecteFinal/landingPage/landingPage.php?ByPlace=placeNumber">By Place</a></li>
                            </div>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/ProjecteFinal/UserProfile/userProfile.php" >Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="/ProjecteFinal/ShoppingList/shoppingList.php" >ShoppingList</a>
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
    <div class='modal fade' id='formList' tabindex='-1' aria-labelledby='formListlabel' aria-hidden='true'>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add New Product List
                    </h5>
                </div>
                <div class="modal-body">
                    <form id="addProductList" onsubmit='addNewProdList(); return false'>
                        <b><label class="form-label" for="nameProdList">Name:</label></b>
                        <input class="form-control" id="nameProdList" name="nameProdList" type="text">
                        <br>
                        <b><label class="form-label" for="typeProdList">Type Product:</label></b>
                        <select class="form-control" name="typeProdList" id="typeProdList">
                            <option value="" selected>-</option>
                            <option value="Meat">Meat</option>
                            <option value="Fruit">Fruit</option>
                            <option value="Vegetable">Vegetable</option>
                            <option value="Cereal">Cereal</option>
                            <option value="Legumbre">Legume</option>
                            <option value="Lactic">Lactic</option>
                            <option value="Bakery">Bakery</option>
                            <option value="Chuches">Candy</option>
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
                        <b><label class="form-label" for="placeList">Place: </label></b>
                        <span class="d-flex align-items-center d-inline-block">
                            <div id="placeDiv" class="col-md-12 {">
                                <div class="input-group">
                                    <select class="form-control d-flex" name="placeList" id="placeList">
                                        <option value="" selected>-</option>
                                        <?php getPlace($conn); ?>
                                    </select>
                                    <span class="input-group-text" type="button" id="eye_ShowPassw" onclick="showAddPlace()">
                                        <i class="bi bi-plus-square"></i>
                                    </span>
                                </div>
                            </div>
                        </span>
                        <br>
                        <b><label class="form-label" for="calList">Calories:</label></b>
                        <input class="form-control" id="calList" name="calList" type="number">
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Send" class="btn btn-outline-dark">
                    <button type="button" class="btn btn-outline-danger" onclick="hideAddList()">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Formulari per afegir un producte a la taula Product un producte -->
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
                <form  id="setProduct" onsubmit='addProdFood(); return false'>
                    <input type="hidden" id="formList" name="formList" value="formList">    
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
                        <option value="Legume">Legume</option>
                        <option value="Lactic">Lactic</option>
                        <option value="Bakery">Bakery</option>
                        <option value="Candy">Candy</option>
                        <option value="Fish">Fish</option>
                        <option value="Dip">Dip</option>
                        <option value="Species">Species</option>
                        <option value="Egg">Egg</option>
                        <option value="Dry Fruit">Dry Fruit</option>
                        <option value="Oil">Oil</option>
                        <option value="Supplement">Supplement</option>
                        <option value="Bread">Bread</option>
                        <option value="Shellfish">Shellfish</option>
                        <option value="Other">Other</option>
                    </select>
                    <br>
                    <b><labe class="form-label" for="buyDate">Shopping Date:</label></b>
                    <input class="form-control" id="buyDate" name="buyDate" type="date" value="<?= date('Y-m-d'); ?>">
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
                                    <i class="bi bi-plus-square"></i>
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
                <form name="editListForm" id="editListForm" onsubmit='editProdList(); return false'>
                    <input id="idEditList" name="idEditList" type="hidden">
                    <b><label class="form-label" for="nameListEdit">Name:</label></b>
                    <input class="form-control" id="nameListEdit" name="nameListEdit" type="text">
                    <br>
                    <b><label class="form-label" for="typeListEdit">Type Product:</label></b>
                    <select class="form-control" name="typeListEdit" id="typeListEdit">
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
                    <b><label class="form-label" for="placeListEdit">Place: </label></b>
                    <span class="d-flex align-items-center d-inline-block">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control d-flex" name="placeListEdit" id="placeListEdit">
                                    <option value="" selected>-</option>
                                    <?php getPlace($conn); ?>
                                </select>
                                <span class="input-group-text" type="button" id="eye_ShowPassw" onclick="showAddPlace()">
                                    <i class="bi bi-plus-square"></i>
                                </span>
                            </div>
                        </div>
                    </span>
                    <br>
                    <b><label class="form-label" for="calListEdit">Calories:</label></b>
                    <input class="form-control" id="calListEdit" name="calListEdit" type="number" value="">
            </div>
            <div class="modal-footer">
                <input type="submit" value="Send" class="btn btn-outline-dark">
                <button type="button" class="btn btn-outline-danger" onclick="hideEditProduct()">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="mainBody" class="wrapper">



<?php
    //fem un echo de la funció getDataProducts($conn), per crear l'etiqueta de cada producte
    echo getDataProducts($conn);
?>
</div>
<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- botó per afegir els productes -->
<div onclick="showAddList()" type="button" class="btn-flotante">Add Product</div>
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
            <form id="newPlace" onsubmit='sendEditInfo(); return false'>
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
<footer></footer>

</body>
    <!-- cridem al fitxer landingPage.js per executar els scripts -->
    <script src="js/shoppingList.js"></script>

</html>  
<?php
}else{
    //en cas de no tindre els camps necessaris redireccionem a la pàgina principal
    header("Location: http://localhost/projecteFinal/LogIn_&_SignUp/signIn.php");
    exit();
}


$conn->close();

?>