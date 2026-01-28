<?php
include('../../Config/db.php');

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);

$product = null;

if ($result->rowCount() > 0) {
    $product = $result->fetch(PDO::FETCH_ASSOC);
}

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<!-- bagian body -->
<body>
    <div class="container">
        <h2>Update Product</h2>
        <a href="../../index.php">Back to Product List</a>
        <form action="../../Controllers/product/update.php" method="post">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">

            <div class="mb-3" style="width: 400px">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" name="product_name" placeholder="Enter product name ..." class="form-control" value="<?= $product['product_name'] ?>">
            </div>

            <div class="mb-3" style="width: 400px">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" name="category_id">
                    <option selected>Select product category ...</option>
                    <?php foreach ($categories as $category) : ?>
                        <option
                            value="<?= $category['id'] ?>"
                            <?php if ($product['category_id'] == $category['id']) echo 'selected'; ?>>
                            <?= $category['category_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3" style="width: 400px">
                <label for="price">Price</label>
                <input name="price" placeholder="Enter Price ..." class="form-control" required value="<?= $product['price'] ?>">
            </div>

            <div class="mb-3" style="width: 400px">
                <label for="stock">Stock</label>
                <input type="text" name="stock" placeholder="Enter stock ..." class="form-control" required value="<?= $product['stock'] ?>">
            </div>

            <input type="submit" value="Update Product" class="btn btn-warning">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>