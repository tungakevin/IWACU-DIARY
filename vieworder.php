<?php
include_once("config.php");

try {
    $c = new My_Connection();
    $conn = $c->open();

    $stmt = $conn->prepare("SELECT * FROM orders");
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
    <title><h3><b>Orders List</b></h3></title>
</head>
<body>
    <div class="container mt-5">
        <a href="home.php" class="btn btn-primary btn-sm">IWACU Dalairy</a>
        <h1 class="text-center mb-4"><b>Order List</b></h1>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Order ID</th>
                    <th scope="col">Product Number</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">status</th>
                    <th scope="col">User ID </th>
                    <th scope="col">Creation Date</th>
                    
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row): ?>
                    <tr>
                    <th scope="row"><?php echo $row['orderid']; ?></th>
                    <th scope="row"><?php echo $row['pid']; ?></th>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td><?php echo $row['userid']; ?></td>

                        <td><?php echo $row['dateofcreation']; ?></td>
                        <td>
                            <a href="editorders.php?orderid=<?php echo $row['orderid']; ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="changeorder.php?orderid=<?php echo $row['orderid']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- create footer of this  page -->
    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS and Popper.js (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<footer>
    <!-- add needed element -->
    <div class="footer">
        <p>Copyright &copy; 2021</p>
    </div>
    <!-- continue -->
    <div class="footer">
        <p>All rights reserved</p>
    </div>
    

</footer>
</body>
</html>
