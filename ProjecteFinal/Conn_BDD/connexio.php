<?php

$servername = "localhost"; //nom del servidor
$user = "root"; // usuari amb permis d'acces
$password = "qwert12345"; // contrasenya
$dbname = "list_eat"; // nom de la base de dades

$conn = new mysqli($servername, $user, $password, $dbname); // objecte que estableix la conexió amb la BDD
if ($conn->connect_error) { // comprovació de l'esxistencia de la BDD
    die("CONNEXIÓ FALLIDA: " . $conn->connect_error); // misatge que es mostre en cas d'un error
}

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

//sentencia sql que creara una taula vehicle en cas que no existeixi
// $sqlUser = "CREATE TABLE IF NOT EXISTS  users (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// username VARCHAR(30) NOT NULL,
// email VARCHAR(50) NOT NULL,
// password VARCHAR(15) NOT NULL 
// )";

// $sqlGroup = "CREATE TABLE IF NOT EXISTS  groups (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// groupName UNIQUE VARCHAR(30) NOT NULL,
// validated BOOLEAN DEFAULT 0
// )";

// $sql_user_belongs_group = "CREATE TABLE IF NOT EXISTS  user_belongs_group (
// userID INT(6) UNSIGNED NOT NULL,
// groupID INT(6) UNSIGNED NOT NULL,
// `role` int(10),
// FOREIGN KEY (userID) REFERENCES users(id),
// FOREIGN KEY (groupID) REFERENCES groups(id)
// )";

// $sqlProducts = "CREATE TABLE IF NOT EXISTS  product (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// productName VARCHAR(30) NOT NULL,
// shoppingDate DATE,
// expirationDate DATE,
// type VARCHAR(30),
// openOrNot BOOLEAN DEFAULT 0,
// units INT(10) NOT NULL,
// calories int(10),
// groupNumber INT(6) NOT NULL,
// FOREIGN KEY (groupNumber) REFERENCES groups(id)
// )";

// $sqlList = "CREATE TABLE IF NOT EXISTS  list (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// productName VARCHAR(30) NOT NULL,
// type VARCHAR(30),
// calories int(10),
// groupNumber INT(6) UNSIGNED NOT NULL,
// placeNumber INT(6) UNSIGNED NOT NULL,
// FOREIGN KEY (groupNumber) REFERENCES groups(id),
// FOREIGN KEY (placeNumber) REFERENCES place(id)
// )";

// $sqlProducts = "CREATE TABLE IF NOT EXISTS  product (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     productName VARCHAR(30) NOT NULL,
//     shoppingDate DATE,
//     expirationDate DATE,
//     type VARCHAR(30),
//     openOrNot BOOLEAN DEFAULT 0,
//     units INT(10) NOT NULL,
//     calories int(10),
//     groupNumber INT(6) UNSIGNED NOT NULL,
//     FOREIGN KEY REFERENCES groups(id)
//     )";

// $sql_place_belongs_group = "CREATE TABLE IF NOT EXISTS  place_belongs_group (
// placeID INT(6) UNSIGNED NOT NULL,
// groupID INT(6) UNSIGNED NOT NULL,
// FOREIGN KEY (placeID) REFERENCES place(id),
// FOREIGN KEY (groupID) REFERENCES groups(id)
// )";

// $sql_list_belongs_group = "CREATE TABLE IF NOT EXISTS  list_belongs_group (
// placeID INT(6) UNSIGNED NOT NULL,
// groupID INT(6) UNSIGNED NOT NULL,
// FOREIGN KEY (placeID) REFERENCES place(id),
// FOREIGN KEY (groupID) REFERENCES groups(id)
// )";

// $sqlPlace = "CREATE TABLE IF NOT EXISTS  place (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// placeName VARCHAR(100) NOT NULL,
// productNumber INT(6) UNSIGNED NOT NULL,
// FOREIGN KEY (productNumber) REFERENCES product(id)
// )";

// $sqlLocation = "CREATE TABLE IF NOT EXISTS  location (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
// locationName VARCHAR(100) NOT NULL,
// placeNumber INT(6) UNSIGNED NOT NULL,
// FOREIGN KEY (placeNumber) REFERENCES place(id)
// )";

// ALTER TABLE product ADD placeNumber FOREIGN KEY REFERENCES place(id);
// ALTER TABLE product ADD placeNumber INT FOREIGN KEY REFERENCES place(id);

// ALTER TABLE product ADD FOREIGN KEY(placeNumber) REFERENCES place(id);

?>
