<?php
// Include configuration file for database connection
include_once("config.php");

try {
    // Create a new instance of My_Connection to establish a database connection
    $c = new My_Connection();
    $conn = $c->open();

    // Check if the HTTP request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve updated product details from the POST request
        $pid = $_POST['pid'];
        $prodname = $_POST['productname'];
        $companyname = $_POST['companyname'];
        $unitprice = $_POST['unitprice'];
        $quantity = $_POST['quantity'];

        // Prepare SQL statement to update the product in the 'products' table
        $stmt = $conn->prepare("UPDATE products SET productname = :productname, companyname = :companyname, unitprice = :unitprice, quantity = :quantity WHERE pid = :pid");
        $stmt->bindParam(':pid', $pid);
        $stmt->bindParam(':productname', $prodname);
        $stmt->bindParam(':companyname', $companyname);
        $stmt->bindParam(':unitprice', $unitprice);
        $stmt->bindParam(':quantity', $quantity);

        // Execute the SQL statement to update the product
        $stmt->execute();

        // Redirect to viewproduct.php after successful update
        header("Location: viewproduct.php");
    }

    // Retrieve 'pid' parameter from the GET request (product ID to be updated)
    $pid = $_GET['pid'];

    // Prepare SQL statement to fetch the product details by 'pid'
    $stmt = $conn->prepare("SELECT * FROM products WHERE pid = :pid");
    $stmt->bindParam(':pid', $pid);
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
    <title>Update Product</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Update Product</h2>
        <form id="updateForm" action="updateproduct.php" method="post">
            <!-- Hidden input field to store the 'pid' for updating the correct product -->
            <input type="hidden" name="pid" value="<?php echo $result['pid']; ?>">

            <div class="form-group">
                <label for="productname">Product Name:</label>
                <input type="text" class="form-control" id="productname" name="productname" value="<?php echo $result['productname']; ?>" required>
            </div>

            <div class="form-group">
                <label for="companyname">Company Name:</label>
                <input type="text" class="form-control" id="companyname" name="companyname" value="<?php echo $result['companyname']; ?>" required>
            </div>

            <div class="form-group">
                <label for="unitprice">Unit Price:</label>
                <input type="number" class="form-control" id="unitprice" name="unitprice" value="<?php echo $result['unitprice']; ?>" required>
            </div>

            <div class="form-group">
                <label for="quantity">Product Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $result['quantity']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
