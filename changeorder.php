<?php
include_once("config.php");

try {
    $c= new My_connection();
    $conn=$c->open();
    $orderid=$_GET['orderid'];
    $stmet=$conn->prepare("DELETE FROM orders where orderid=:orderid");
    $stmet->bindParam(':orderid',$orderid);
    $stmet->execute();
    header("location:vieworder.php");

} catch (PDOException $r) {
    echo"error".$s->getMessage();
    
}

?>