<?php

$file = './database/product.json';

$data = file_get_contents($file);

$products = json_decode($data, true);

$product_id = $_GET['id'] ?? null;

$product = null;

foreach ($products as $item) {

    if ($item['id'] == $product_id) {

        $product = $item;

        break;
    }
}

if ($product === null) {

    die("Product not found");
}

?>

<?php include_once './inc/header.php'; ?>

<!-- Navigation -->
<?php include_once './inc/nav.php'; ?>


<!-- Product Header -->
<header class="bg-dark py-5">

    <div class="container px-4 px-lg-5 my-5">

        <div class="text-center text-white">

            <h1 class="display-4 fw-bolder">
                Product Details
            </h1>

            <p class="lead fw-normal text-white-50 mb-0">
                Discover the perfect item for your collection
            </p>

        </div>

    </div>

</header>


<!-- Product Details -->
<section class="py-5">

    <div class="container px-4 px-lg-5 my-5">

        <div class="row gx-4 gx-lg-5 align-items-center">

            <!-- Product Image -->
            <div class="col-md-6">

                <div class="card shadow-sm">

                    <img
                        class="card-img-top mb-5 mb-md-0"
                        src="<?= htmlspecialchars($product['image_url']) ?>"
                        alt="<?= htmlspecialchars($product['product_name']) ?>"
                    >

                </div>

            </div>


            <!-- Product Information -->
            <div class="col-md-6">

                <div class="small mb-1">
                    Product ID:
                    <?= htmlspecialchars($product['id']) ?>
                </div>


                <h1 class="display-5 fw-bolder">

                    <?= htmlspecialchars($product['product_name']) ?>

                </h1>


                <!-- Price -->
                <div class="fs-5 mb-3">

                    <span>
                        $<?= htmlspecialchars($product['price']) ?>
                    </span>

                </div>


                <!-- Description -->
                <p class="lead">

                    <?= htmlspecialchars($product['description']) ?>

                </p>


                <!-- Stock -->
                <div class="d-flex mb-3">

                    <div>

                        <span class="fw-bold">
                            Availability:
                        </span>

                        <?= htmlspecialchars($product['stock_quantity']) ?>

                        In Stock

                    </div>

                </div>


                <!-- Quantity + Add To Cart -->
                <div class="d-flex mb-4">

                    <form
                        action="./handlers/handelCart.php"
                        method="POST"
                        class="d-flex"
                    >

                        <!-- Quantity -->
                        <input
                            class="form-control text-center me-3"
                            id="inputQuantity"
                            type="number"
                            name="quantity"
                            value="1"
                            min="1"
                            max="<?= htmlspecialchars($product['stock_quantity']) ?>"
                            style="max-width: 5rem"
                        >


                        <!-- Product ID -->
                        <input
                            type="hidden"
                            name="product_id"
                            value="<?= htmlspecialchars($product['id']) ?>"
                        >


                        <!-- Add To Cart -->
                        <button
                            class="btn btn-outline-dark flex-shrink-0"
                            type="submit"
                        >

                            <i class="bi-cart-fill me-1"></i>

                            Add to cart

                        </button>

                    </form>

                </div>


                <!-- Other Actions -->
                <div class="d-flex gap-2">

                    <button
                        class="btn btn-dark"
                        type="button"
                    >
                        Buy Now
                    </button>


                    <button
                        class="btn btn-outline-secondary"
                        type="button"
                    >
                        Save for Later
                    </button>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Product Description -->
<section class="py-5 bg-light">

    <div class="container px-4 px-lg-5">

        <div class="row">

            <div class="col-lg-8 mx-auto">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <h3 class="fw-bolder mb-3">
                            Product Description
                        </h3>

                        <p>
                            <?= htmlspecialchars($product['description']) ?>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Related Products -->
<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        <h2 class="fw-bolder mb-4">
            Related products
        </h2>


        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php foreach ($products as $relatedProduct): ?>

                <?php if ($relatedProduct['id'] != $product['id']): ?>

                    <div class="col mb-5">

                        <div class="card h-100">

                            <!-- Image -->
                            <img
                                class="card-img-top"
                                src="<?= htmlspecialchars($relatedProduct['image_url']) ?>"
                                alt="<?= htmlspecialchars($relatedProduct['product_name']) ?>"
                            >


                            <!-- Details -->
                            <div class="card-body p-4">

                                <div class="text-center">

                                    <h5 class="fw-bolder">

                                        <?= htmlspecialchars($relatedProduct['product_name']) ?>

                                    </h5>


                                    <span>

                                        $<?= htmlspecialchars($relatedProduct['price']) ?>

                                    </span>

                                </div>

                            </div>


                            <!-- Footer -->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">

                                <div class="text-center">

                                    <a
                                        class="btn btn-outline-dark mt-auto"
                                        href="product.php?id=<?= htmlspecialchars($relatedProduct['id']) ?>"
                                    >
                                        View item
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<!-- Footer -->
<?php include_once './inc/footer.php'; ?>