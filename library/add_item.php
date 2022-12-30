<?php
session_start();

    $con=new mysqli("localhost", "root", "", "library");
    $st_check=$con->prepare("insert into temp_order(email,productid) values(?,?)");
    $st_check->bind_param("si", $_SESSION["user"], $_GET["id"]);
    $st_check->execute();
    $rs=$st_check->get_result();
    if($rs->num_rows==0){
        $con = new mysqli("localhost", "root", "", "library");
        $st = $con->prepare("insert into temp_order(email,productid) values(?,?");
        $st->bind_param("si", $_SESSION["user"], $_GET["id"]);
        $st->execute();
    }else {
        $con = new mysqli("localhost", "root", "", "library");
        $st = $con->prepare("update temp_order set qty=qty+1 where email=? and productid=?");
        $st->bind_param("si", $_SESSION["user"], $_GET["id"]);
        $st->execute();
    }
    echo "<script>window.location='menu.php';</script>";
    
?>