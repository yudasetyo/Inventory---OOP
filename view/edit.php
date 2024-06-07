<?php 
    require_once '../utilities/config.php';
    require_once '../utilities/Database.php';
    require_once '../utilities/Product.php';

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);

    $product->id = isset($_GET['id']) ? $_GET['id'] : die('Eroor: missing ID.');
    $stmt = $product->readOne();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Tambah Data</h1>
        <form action="../controller/update_product.php" method="post">
            <input type="hidden" name="id" value="<?= $product->id ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($row['name']) ?>" aria-describedby="name">
                <div id="productNameDesc" class="form-text">Pastikan Nama Barang Sudah Benar</div>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" class="form-control" name="stock" id="stock" value="<?= htmlspecialchars($row['stock']) ?>">
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" name="category" id="category" value="<?= htmlspecialchars($row['category']) ?>">
            </div>
            <button type="submit" class="btn btn-primary" value="Update">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>