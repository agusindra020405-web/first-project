<?php
include('./Config/db.php');

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = [];

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $products[] = $row;
    }
}

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
// array untuk category
$categories = [];

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $categories[] = $row;
    }
}

$conn == null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <h1>Hello, world!</h1>
        <a href="Views/category/create.php">Create Category</a>

        <a href="Views/product/create.php">Create Product</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $index => $product) : ?>
                    <tr>
                        <td scope="col"><?= $index + 1; ?></td>
                        <td scope="col"><?= $product['product_name']; ?></td>
                        <td scope="col"><?= $categories[array_search($product['category_id'], array_column($categories, 'id'))]['category_name'] ?></td>
                        <td scope="col">Rp.<?= $product['price']; ?></td>
                        <td scope="col"><?= $product['stock']; ?></td>
                        <td scope="col">
                            <div>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="changeselectedProductId(<?= $product['id']; ?>)">
                                    <i class="bi bi-trash3"></i>
                                </button>
                                <button type="button" class="btn btn-outline-warning btn-sm" onclick="updateProduct(<?= $product['id']; ?>)">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you really want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deleteProduct()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedProductId = null;

        function changeselectedProductId(id) {
            selectedProductId = id;
        }

        function deleteProduct() {
            window.location.href = `Controllers/product/delete.php?id=${selectedProductId}`
        }

        function updateProduct(id) {
            window.location.href = `Views/product/update.php?id=${id}`
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>