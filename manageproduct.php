<?php
include_once("config.php");


if ($_POST) {
   
    $productname = $_POST['productname'];
    $companyname = $_POST['companyname'];
    $unitprice = $_POST['unitprice'];
    $quantity=$_POST['quantity'];

    try {
        // $conn = My_Connection->open();
        $c = new My_Connection();
        $conn = $c->open();
        
        // Check if 'userid' is provided and not null
      
            $stmt = $conn->prepare("INSERT INTO products (productname, companyname, unitprice,quantity) VALUES (:productname, :companyname, :unitprice,:quantity)");
            $stmt->bindParam(':productname', $productname);
            $stmt->bindParam(':companyname', $companyname);
            $stmt->bindParam(':unitprice', $unitprice);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->execute();
            header("location:viewproduct.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
