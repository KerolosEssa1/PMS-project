<?php

session_start();

if (!isset($_SESSION['auth'])) {

    header("Location: login.php");

    exit;
}

if ($_SESSION['auth']['role'] !== 'admin') {

    header("Location: index.php");

    exit;
}

?>


<?php include_once './inc/header.php' ?>
<!-- Navigation-->
<?php include_once  './inc/nav.php' ?>
<!-- header -->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Create Product</h1>
            <p class="lead fw-normal text-white-50 mb-0">Add a new product to your store</p>
        </div>
    </div>
</header>
<? session_start();?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <?php if (isset($_SESSION['success'])): ?>

                <div class="alert alert-success">
                    <?= $_SESSION['success'] ?>
                </div>

                <?php unset($_SESSION['success']); ?>

            <?php endif; ?>
            <form action="./handlers/handelproduct.php" method="post" class="border rounded p-4 shadow-sm bg-white">
                <div class="mb-3">
                    <label for="product_name" class="form-label fw-bold">Product Name</label>
                    <input type="text" id="product_name" name="product_name" class="form-control border border-success" placeholder="Enter product name" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label fw-bold">Price</label>
                        <input type="number" id="price" name="price" class="form-control border border-success" step="0.01" min="0" placeholder="0.00" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="stock" class="form-label fw-bold">Stock Quantity</label>
                        <input type="number" id="stock" name="stock_quantity" class="form-control border border-success" min="0" value="1" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image_url" class="form-label fw-bold">Image URL</label>
                    <input type="url" id="image_url" name="image_url" class="form-control border border-success" placeholder="https://example.com/product.jpg">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description</label>
                    <textarea id="description" name="description" rows="5" class="form-control border border-success" placeholder="Write a short product description..." required></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold d-block">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                        <label class="form-check-label" for="inactive">Inactive</label>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <input type="submit" value="Add Product" class="btn btn-primary px-4">
                    <a href="product.php" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer-->
<?php include_once  './inc/footer.php' ?>