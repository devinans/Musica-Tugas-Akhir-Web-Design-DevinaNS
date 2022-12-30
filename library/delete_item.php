<?php
session_start();

    $con = new mysqli("localhost", "root", "", "library");
    $st_check = $con->prepare("delete from temp_order where email=? and productid=?");
    $st_check->bind_param("si", $_SESSION["user"], $_GET["id"]);
    $st_check->execute();
    echo "<script>window.location='menu.php';</script>";
    
?>