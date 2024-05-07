<?php
include_once("config.php");
if ($_POST) {
    $username=$_POST['username'];
    $usertype=$_POST['usertype'];
    try {
        $c=new My_connection();
        $conn =$c->open();
        if (isset($username) && $username !==null) {
            $stmt= $conn->prepare("INSERT INTO users (username, usertype) Value (:username,:usertype)");
            $stmt->bindParam(":username",$username);
            $stmt->bindParam(":usertype",$usertype);
            $stmt->execute();


        echo"Record inserted successfully";
        header("location : selename.php");
        }else{
            echo "error : 'username' is not provided or is null .";

        }
    } catch (PDOException $v) {
        echo "Error : ".$v->getMessage();
        

    }

}

?>