<?php
include_once("config.php");

try {
    $c = new My_Connection();
    $conn = $c->open();

    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Product List</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Product List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Company Name</th>
                    
                    <th scope="col">Unit Price</th>
                    <th scope="col">Product Qunatity</th>
                    <!-- <th scope="col">Date of Creation</th> -->
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <th scope="row"><?php echo $row['pid']; ?></th>
                        <td><?php echo $row['productname']; ?></td>
                        <td><?php echo $row['companyname']; ?></td>
                        <td><?php echo $row['unitprice']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <!-- <td><?php echo $row['datecreated']; ?></td> -->
                        <td>
                            <a href="updateproduct.php?pid=<?php echo $row['pid']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="deleproduct.php?pid=<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and Popper.js (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
