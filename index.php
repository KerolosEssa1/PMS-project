<?php

session_start();

// Read products from JSON file
$file = './database/product.json';

$data = file_get_contents($file);

$products = json_decode($data, true);

// Make sure products is an array
if (!is_array($products)) {
    $products = [];
}

?>

<?php include_once './inc/header.php'; ?>

<!-- Navigation -->
<?php include_once './inc/nav.php'; ?>


<!-- Header -->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">

            <h1 class="display-4 fw-bolder">
                Shop in style
            </h1>

            <p class="lead fw-normal text-white-50 mb-0">
                Find the perfect product for you
            </p>

        </div>
    </div>
</header>


<!-- Products Section -->
<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php if (empty($products)): ?>

                <div class="col-12 text-center">

                    <div class="alert alert-info">
                        No products available.
                    </div>

                </div>

            <?php else: ?>

                <?php foreach ($products as $product): ?>

                    <div class="col mb-5">

                        <div class="card h-100 shadow-sm">

                            <!-- Product Image -->
                            <img
                                class="card-img-top"
                                src="<?= htmlspecialchars($product['image_url']) ?>"
                                alt="<?= htmlspecialchars($product['product_name']) ?>">

                            <!-- Product Details -->
                            <div class="card-body p-4">

                                <div class="text-center">

                                    <h5 class="fw-bolder">
                                        <?= htmlspecialchars($product['product_name']) ?>
                                    </h5>

                                    <span>
                                        $<?= htmlspecialchars($product['price']) ?>
                                    </span>

                                </div>

                            </div>

                            <!-- Product Actions -->
                            <div class="d-flex justify-content-center gap-2">

                                <!-- View Product -->
                                <a
                                    class="btn btn-outline-dark"
                                    href="product.php?id=<?= $product['id'] ?>">
                                    View item
                                </a>

                                <!-- Add To Cart -->
                                <form action="./handlers/handelCart.php" method="POST">
                                    <input
                                        type="hidden"
                                        name="product_id"
                                        value="<?= htmlspecialchars($product['id']) ?>">

                                    <input
                                        type="hidden"
                                        name="quantity"
                                        value="1">

                                    <button type="submit" class="btn btn-dark">
                                        Add to cart
                                    </button>
                                </form>
                                </form>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </div>

</section>


<!-- Footer -->
<?php include_once './inc/footer.php'; ?>