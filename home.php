

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom CSS styles here */
        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Iwacu Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="productform.php">Register Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="report.php">Manage orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add.php">Users portal</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="account.php">Account</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Welcome to the Iwacu dalairy Admin  Dashboard!</h2>
        <!-- Add your dashboard content here -->
        <p>This is where you can manage your Iwacu Dalairy activities.</p>
        <div class="row">
            <div class="col-md-6">
                <h3>Import Items</h3>
                <!-- <p>Click below to import items into the warehouse:</p> -->
                <a href="vieworder.php" class="btn btn-primary">Manage Order</a>
            </div>
            <!-- <div class="col-md-6">
                <h3>Export Items</h3>
                <p>Click below to export items from the warehouse:</p>
                <a href="export.php" class="btn btn-primary">Export Items</a>
            </div> -->
        </div>
    </div>

    <!-- Bootstrap JS (optional, if you need Bootstrap features like dropdowns, modals, etc.) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
