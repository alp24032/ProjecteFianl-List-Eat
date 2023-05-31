<?php
include_once "../Conn_BDD/connexio.php";

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
	<link rel="stylesheet" href="css/addGroup.css">
    
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
                <label class="form-label d-flex align-items-center justify-content-between" for="userGroups">Select Group
                <div class="form-group mb-3">
                    <i class="bi bi-info-circle fa-lg" onclick="infoGroup()"></i>
                    <div class='modal fade' id='helpGroup' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Help Groups 
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <p>
                                    Groups serve to group users into groups,
                                    to have access to the same List-Eat List.
                                    If you enter a new group, and it does not exist, it will be created
                                    and will be the administrator.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="user_upMesage" class="small text-danger" hidden></div>
                </div>
                </label>
                <span class="d-flex align-items-center d-inline-block">
                    <div>
                        <div class="input-group flex-nowrap">
                            <select id="getGroups" class="form-control" name="userGroups" id="userGroups">
                                <?php getGroups($conn) ?>
                            </select>
                            <span class="input-group-text" type="button" id="eye_ShowPassw" onclick="showCreateGroup()">
                                <i class="bi bi-plus-square"></i>
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
    <script src="js/addGroup.js"></script>
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
		echo "<script>alert('Error.')</script>";
    }
}

$conn->close();

?>


