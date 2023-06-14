<?php
if ( isset($_GET["id"]) ) {
    $id_booking = $_GET["id"];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "pbd";

    //Create Connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM booking WHERE id_booking=$id_booking";
    $connection->query($sql);
}

header("location: /pbd/index.php");
exit;
?>