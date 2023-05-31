<?php
session_start();
include_once "../Conn_BDD/connexio.php";

// function addGroups($conn){
    if(isset($_POST["newGroup"])){
        $newGroup = $_POST["newGroup"];
        // console_log($newGroup);

        //verifico si existeix un group amb el nom introduit
        $sqlExistGroup = "SELECT groupName FROM groups WHERE groupName = '$newGroup'";
        $existDataGroup = $conn->query($sqlExistGroup);
        // console_log($existDataGroup);
        
        if($existDataGroup !== NULL){//comprobem que la query s'ha executat        
            $existInfoGroup = $existDataGroup->fetch_object();//guardem el resultat de la query en un objecte
            // console_log($existInfoGroup);
            
            if($existInfoGroup == NULL){//en cas que l'objecte sigui == NULL, significarà que el Group introduit no existeix.
            
                //sentencia SQL que crea el nou grup
                $sqlNewGroup = "INSERT INTO groups (groupName) VALUES ('$newGroup')";
                //fem una query per crear un nou grup amb el valor del formulari 
                $dataNewGroup = $conn->query($sqlNewGroup);

                //tornem a buscar si existeix un grup amb el valor del formulari anterior
                $sqlDebug = "SELECT groupName FROM groups WHERE groupName = '$newGroup'";
                
                $dataDebug = $conn->query($sqlDebug);
                
                $infoDebug = $dataDebug->fetch_object();

                if($dataNewGroup !== NULL){

                    $sqlUserID = "SELECT id FROM users WHERE email = '".$_SESSION['email']."'";
                    $dataUserID = $conn->query($sqlUserID);

                    $sqlGroupID = "SELECT id FROM groups WHERE groupName = '$infoDebug->groupName'";
                    $dataGroupID = $conn->query($sqlGroupID);

                    if($dataUserID !== NULL && $dataGroupID !== NULL){

                        $infoUserID = $dataUserID->fetch_object();
                        $infoGroupID = $dataGroupID->fetch_object();

                        $sqlUsersGroup = "INSERT INTO user_belongs_group (userID, groupID, role, validated)
                        VALUES ( '$infoUserID->id', '$infoGroupID->id', 2, 1)"; 

                        $conn->query($sqlUsersGroup);

                        header("Location: addGroup.php");
                        exit();
                    }else{
            		    echo "<script>alert('Error executing query to add data to intermediate table.')</script>";
                        header("Refresh:2; url=signIn.php");
                    }
                }else{
        		    echo "<script>alert('Error executing New Group insert.')</script>";
                    header("Refresh:5; url=signIn.php");
                }
                echo "<script>alert('Group [".$newGroup."] added successfully.')</script>";
                header("Refresh:5; url=addGroup.php");
            }else{
                echo "<script>alert('Group [".$newGroup."] already exists, create a group with a different name.')</script>";
                header("Refresh:5; url=addGroup.php");
            }
        }else{
		    echo "<script>alert('Error.')</script>";
            header("Refresh:5; url=signIn.php");
        }
    }

// }


?>