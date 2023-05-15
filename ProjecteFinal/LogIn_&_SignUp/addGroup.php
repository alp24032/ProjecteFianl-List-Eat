<?php
// include_once "forgotPassw.html";
include_once "connexio.php";
session_start();

if(isset($_SESSION['idUser']) && isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['password'])){
    console_log($_SESSION);

    
    // console_log($_POST["newGroup"]);
    // addGroups($conn);
    // console_log($_POST["newGroup"]);

    // if(isset($_POST['userGroups']) && isset($_SESSION['groupID']) && isset($_SESSION['groupName'])){
    if(isset($_POST['userGroups'])){
        $gName = $_POST['userGroups'];

        // busquem sil'id del group per guardar-la en una variable de sessió
        $sqlGroupID = "SELECT id FROM groups WHERE groupName = '$gName'";
        $dataGroupID = $conn->query($sqlGroupID);
        // console_log($dataGroupID);
        $infoGroupID = $dataGroupID->fetch_object();

        $_SESSION['idGroup'] = $infoGroupID->id;
        $_SESSION['groupName'] = $gName;

        // console_log($_SESSION['groupID']);
        // console_log($_SESSION['groupName']);
        header("Location: http://localhost/ProjecteFinal/landingPage/landingPage.php");
        exit();
    }

}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <style>
        #m{
            display: flex;
            justify-content: center;
            /* align-content: center; */
            align-items: center;
            margin-top: 100px;
        }
    </style>
</head>
<body class=" bg-dark min-vh-100">
    <header>
        <div id="head" class="row bg-warning row-cols-auto text-white min-vh-20">
            <div class="col">
                <a href="signIn.html">
                    <img src="/ProjecteFinal/img/LogoProjecte.gif" class="rounded-circle" alt="" width="100" height="100">
                </a>
            </div>
        </div>
    </header>
	<div id="m" class="col ">
        <div class="container d-flex align-items-center justify-content-center p-4 my-5 w-75 bg-white text-dark">
            <form id="selectGroup" class="form" action="addGroup.php" method="post">
                <label class="form-label" for="userGroups">Select Group</label>
                <span class="d-flex align-items-center d-inline-block">
                    <div>
                        <div class="input-group flex-nowrap">
                            <select style="width: 30vw" class="form-control" name="userGroups" id="userGroups">
                                <!-- <option value="" selected>-</option> -->
                                <?php getGroups($conn) ?>
                            </select>
                            <span style="border-radius: 0 50% 50% 0;" class="input-group-text" type="button" id="eye_ShowPassw" onclick="showCreateGroup()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square " viewBox="0 0 16 16">
                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </span>
                <br>
                <input value="Go to List-Eat" type="submit" id="goMainPage" class="form-control my-2 btn btn-primary submit btn-outline-dark">
            </form>
        </div>
    </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->
    <div class='modal fade' id='formGroup' tabindex='-1' aria-labelledby='formGroupLabel' aria-hidden='true'>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Create Group
                    </h5>
                </div>
                <form action="postGroup.php" method="post">
                <div class="modal-body">
                    <input id="newGroup" name="newGroup" type="text" class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Create" class="btn btn-outline-dark">
                    <button type="button" class="btn btn-outline-danger" onclick="hideCreateGroup()">Cancel</button>
                </div>
                </form>
                <!-- <div class="form-group mb-3">
                    <label class="label" for="group_up">Grup Name</label>
                    <span class="d-flex">
                        <input id="group_up" name="group_up" type="text" class="form-control" placeholder="Group Name" required>
                        <i class="bi bi-info-circle fa-lg" onclick="infoGroup()"></i>
                    </span>
                    <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Groups Info
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Els grups serveixen per agrupar als usuaris en conjunts,
                                        per tindre acces a la mateixa Llista de List-Eat.
                                        Si introdueix un grup nou, i aquest no existeix és crearà 
                                        i serà l'adiministrador.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="user_upMesage" class="small text-danger" hidden></div> -->
                </div>
            </div>
        </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
      integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
      crossorigin="anonymous"
    ></script>
    <script src="addGroup.js"></script>
</body>
</html>

<?php

function getGroups($conn){

    $sqlGetGroups = "SELECT groupName FROM users U, groups G, user_belongs_group UG
    WHERE (U.id = UG.userID AND G.id = UG.groupID) AND (U.id = ".$_SESSION['idUser'].")";

    $getDataGroups = $conn->query($sqlGetGroups);

    if($getDataGroups !== NULL){
        $getInfoGroups = $getDataGroups->fetch_object();

        while($getInfoGroups != NULL){
            echo '<option value="'.$getInfoGroups->groupName.'" >'.$getInfoGroups->groupName.'</option>';
            $getInfoGroups = $getDataGroups->fetch_object();
        }
        
    }else{
		echo "<script>alert('Error a l\'hora d\'xecutar la consulta.')</script>";
    }
}

$conn->close();

?>


