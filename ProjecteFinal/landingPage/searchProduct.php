<?php

session_start();
include_once "../Conn_BDD/connexio.php";

if(isset($_POST['searchProd'])){
    $searchProd = $_POST['searchProd'];

    // $searchProd = "SELECT * FROM ";
    $Prod = "SELECT * FROM product";

    // $sql_2 = "SELECT * FROM product WHERE type = '$searchProd'"; 
    $dataSearchProd = $conn->query($Prod);

    if($dataSearchProd !== NULL){
        $infoSearchProd = $dataSearchProd->fetch_object();

        // $output = "";
        while($infoSearchProd != NULL){
            console_log($infoSearchProd);
//             if($infoSearchProd->productName == $searchProd){
//                 $output .=  "
//                 <div id='$infoSearchProd->id' class='container d-flex justify-content-center align-items-center list-group-item' style='padding-block: 5px;'>   
//                     <div style='background-color: rgba(252, 252, 96, 0.9); padding: 1rem;'>
//                         <div>
//                             <h1 id='name_$infoSearchProd->id'  class='d-flex justify-content-center flex-wrap'>$infoSearchProd->productName</h1>
//                             <div name='hide'>
//                             <hr>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Tipus Producte:</b>
//                                 <p id='type_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$infoSearchProd->type</p>
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Data Compra:</b>
//                                 <p id='compra_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$infoSearchProd->shoppingDate</p>
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Data Caducitat:</b>
//                                 <p id='caducitat_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$infoSearchProd->expirationDate</p>
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Envas Obert:</b>
//                                 <p id='obert_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$openOrNot</p>
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Calories:</b>
//                                 <p id='cal_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$infoSearchProd->calories" . "kcal / 100g</p>" . "
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Localització:</b>
//                                 <p id='cal_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$sqlPlaceInfo->placeName</p>
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Unitats:</b>
//                                 <p id='cal_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$infoSearchProd->units</p>
//                             </div>
//                         </div>
//                         </div>
//                         <hr>
//                         <nav class='d-flex flex-row justify-content-around' >
//                             <div onclick='getID($infoSearchProd->id)';>
//                                 <button id='editProduct' type='submit' class='btn btn-outline-primary px-2' onclick='showEditProduct()'>Edit</button>
//                             </div>
//                             <form>
//                                 <div id='llistaCompra' class='btn btn-outline-secondary px-2' type='button'>Llista Compra</div>
//                             </form>
//                             <form action='deleteProduct.php' method='post'>
//                                 <input id='deleteProduct' name='deleteProduct' type='hidden' value='$infoSearchProd->id'>
//                                 <input type='submit' class='btn btn-outline-danger px-2' type='button' value='Delete'>
//                             </form>
//                         </nav>               
//                     </div>
//                 </div>";
                $infoSearchProd = $dataSearchProd->fetch_object();
            }
//             if($infoSearchProd->type == $searchProd){
//                 $output .=  "
//                 <div id='$infoSearchProd->id' class='container d-flex justify-content-center align-items-center list-group-item' style='padding-block: 5px;'>   
//                     <div style='background-color: rgba(252, 252, 96, 0.9); padding: 1rem;'>
//                         <div>
//                             <h1 id='name_$infoSearchProd->id'  class='d-flex justify-content-center flex-wrap'>$infoSearchProd->productName</h1>
//                             <div name='hide'>
//                             <hr>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Tipus Producte:</b>
//                                 <p id='type_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$infoSearchProd->type</p>
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Data Compra:</b>
//                                 <p id='compra_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$infoSearchProd->shoppingDate</p>
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Data Caducitat:</b>
//                                 <p id='caducitat_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$infoSearchProd->expirationDate</p>
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Envas Obert:</b>
//                                 <p id='obert_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$openOrNot</p>
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Calories:</b>
//                                 <p id='cal_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$infoSearchProd->calories" . "kcal / 100g</p>" . "
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Localització:</b>
//                                 <p id='cal_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$sqlPlaceInfo->placeName</p>
//                             </div>
//                             <div class='d-flex'>
//                                 <b style='margin-top: 4px; margin-right: 10px;'>- Unitats:</b>
//                                 <p id='cal_$infoSearchProd->id' class='badge bg-light text-wrap fs-5 text-dark'>$infoSearchProd->units</p>
//                             </div>
//                         </div>
//                         </div>
//                         <hr>
//                         <nav class='d-flex flex-row justify-content-around' >
//                             <div onclick='getID($infoSearchProd->id)';>
//                                 <button id='editProduct' type='submit' class='btn btn-outline-primary px-2' onclick='showEditProduct()'>Edit</button>
//                             </div>
//                             <form>
//                                 <div id='llistaCompra' class='btn btn-outline-secondary px-2' type='button'>Llista Compra</div>
//                             </form>
//                             <form action='deleteProduct.php' method='post'>
//                                 <input id='deleteProduct' name='deleteProduct' type='hidden' value='$infoSearchProd->id'>
//                                 <input type='submit' class='btn btn-outline-danger px-2' type='button' value='Delete'>
//                             </form>
//                         </nav>               
//                     </div>
//                 </div>";
//                 $infoSearchProd = $dataSearchProd->fetch_object();
//             }
//         }
//         console_log($output);
//         return $output;

    }

    header("Location: landingPage.php?Search=".$searchProd."");
    exit();
    
}else{
    header("Location: landingPage.php");
    exit();
}

// $conn->close();
?>
