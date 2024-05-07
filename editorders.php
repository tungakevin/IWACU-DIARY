<?php
// Include configuration file for database connection
include_once("config.php");

try {
    // Create a new database connection instance
    $c = new My_Connection();
    $conn = $c->open();

    // Check if the HTTP request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve updated order details from the POST request
        $orderid = $_POST['orderid'];
        $quantity = $_POST['quantity'];
        $status = $_POST['status'];
        $dateofcreation = $_POST['dateofcreation'];

        // Prepare SQL statement to update the order
        $stmt = $conn->prepare("UPDATE orders SET quantity = :quantity, status = :status, dateofcreation = :dateofcreation WHERE orderid = :orderid");
        $stmt->bindParam(':orderid', $orderid);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':dateofcreation', $dateofcreation);

        // Execute the SQL statement to update the order
        $stmt->execute();

        // Redirect to vieworder.php after successful update
        header("Location: vieworder.php");
    }

    // Retrieve order ID from the GET request parameters
    $orderid = $_GET['orderid'];

    // Prepare SQL statement to fetch the order details by order ID
    $stmt = $conn->prepare("SELECT * FROM orders WHERE orderid = :orderid");
    $stmt->bindParam(':orderid', $orderid);
    $stmt->execute();

    // Fetch the result (single row) from the executed SQL statement
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Handle any database connection or query errors
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Orders</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Update Order</h2>
        <form id="updateForm" action="editorders.php" method="post">
            <!-- Hidden input field to store the order ID -->
            <input type="hidden" name="orderid" value="<?php echo $result['orderid']; ?>">

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $result['quantity']; ?>" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo $result['status']; ?>" required>
            </div>

            <div class="form-group">
                <label for="dateofcreation">Date of Creation:</label>
                <input type="date" class="form-control" id="dateofcreation" name="dateofcreation" value="<?php echo $result['dateofcreation']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
