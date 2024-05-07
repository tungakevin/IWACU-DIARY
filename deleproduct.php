<?php
// Include configuration file for database connection
include_once("config.php");

try {
    // Create a new instance of My_Connection to establish a database connection
    $c = new My_connection();
    $conn = $c->open();

    // Retrieve the 'pid' parameter from the GET request (product ID to be deleted)
    $pid = $_GET['pid'];

    // Prepare SQL statement to delete a product from the 'products' table based on 'pid'
    $stmt = $conn->prepare("DELETE FROM products WHERE pid = :pid");
    $stmt->bindParam(':pid', $pid); // Bind the 'pid' parameter to the SQL statement
    $stmt->execute(); // Execute the SQL statement to delete the product

    // Redirect to viewproduct.php after successful deletion
    header("location: viewproduct.php");
} catch (PDOException $e) {
    // Handle any database connection or query errors
    echo "Error: " . $e->getMessage();
}
?>
