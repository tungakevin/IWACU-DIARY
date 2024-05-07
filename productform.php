<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>Vegetable CRUD</title>
</head>
<body>
    <div class="container mt-5">
    <a href="home.php" class="btn btn-primary btn-sm">IWACU Dalairy</a>
        <h2 class="text-center mb-4">Register New Product</h2>
        <form id="vegetableForm" action="manageproduct.php" method="post">
            <div class="form-group">
                <label for="companyname">Company Name:</label>
                <select class="form-control" id="companyname" name="companyname" required>
                    <option value="Iwacu Dairly">Iwacu Dairly</option>
                </select>
            </div>
            <div class="form-group">
                <label for="productname">Product Name:</label>
                <select class="form-control" id="productname" name="productname" required>
                    <option value="Amata">Amata</option>
                    <option value="Amavuta">Amavuta</option>
                </select>
            </div>

            <div class="form-group">
                <label for="unitprice">Unit Price:</label>
                <input type="number" class="form-control" id="unitprice" name="unitprice" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>

            <button type="submit" class="btn btn-success" name="add">Register Product</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
