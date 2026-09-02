<?php

session_start();

if (!isset($_SESSION['auth'])) {

    header("Location: login.php");

    exit;
}


$file = './database/product.json';
$data = file_get_contents($file);
$products = json_decode($data, true);

$cart = $_SESSION['cart'] ?? [];

$totalPrice = 0;

?>

<?php include_once './inc/header.php'; ?>

<!-- Navigation -->
<?php include_once './inc/nav.php'; ?>

<!-- Header -->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Checkout</h1>
            <p class="lead fw-normal text-white-50 mb-0">
                Complete your order
            </p>
        </div>
    </div>
</header>

<!-- Checkout Section -->
<section class="py-5">

    <div class="container px-4 px-lg-5 mt-5">

        <?php if (empty($cart)): ?>

            <div class="alert alert-info text-center">
                Your cart is empty.
            </div>

            <div class="text-center">
                <a href="index.php" class="btn btn-dark">
                    Continue Shopping
                </a>
            </div>

        <?php else: ?>

            <div class="row">

                <!-- Order Summary -->
                <div class="col-md-4">

                    <div class="border p-3">

                        <h3 class="mb-4">
                            Order Summary
                        </h3>

                        <ul class="list-unstyled">

                            <?php foreach ($cart as $cartItem): ?>

                                <?php

                                $product = null;

                                foreach ($products as $item) {

                                    if ($item['id'] == $cartItem['product_id']) {
                                        $product = $item;
                                        break;
                                    }

                                }

                                ?>

                                <?php if ($product !== null): ?>

                                    <?php

                                    $quantity = $cartItem['quantity'];

                                    $itemTotal = $product['price'] * $quantity;

                                    $totalPrice += $itemTotal;

                                    ?>

                                    <li class="border p-2 my-2">

                                        <div class="d-flex justify-content-between">

                                            <span>
                                                <?= htmlspecialchars($product['product_name']) ?>
                                            </span>

                                            <strong>
                                                <?= htmlspecialchars($quantity) ?>
                                                x
                                                $<?= htmlspecialchars($product['price']) ?>
                                            </strong>

                                        </div>

                                    </li>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </ul>

                        <hr>

                        <h3>
                            Total:
                            $<?= number_format($totalPrice, 2) ?>
                        </h3>

                    </div>

                </div>


                <!-- Customer Information -->
                <div class="col-md-8">

                    <form
                        action="./handlers/handelCheckout.php"
                        method="POST"
                        class="border p-4">

                        <h3 class="mb-4">
                            Customer Information
                        </h3>

                        <!-- Name -->
                        <div class="mb-3">

                            <label for="name" class="form-label">
                                Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control"
                                required>

                        </div>


                        <!-- Email -->
                        <div class="mb-3">

                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control"
                                required>

                        </div>


                        <!-- Address -->
                        <div class="mb-3">

                            <label for="address" class="form-label">
                                Address
                            </label>

                            <input
                                type="text"
                                name="address"
                                id="address"
                                class="form-control"
                                required>

                        </div>


                        <!-- Phone -->
                        <div class="mb-3">

                            <label for="phone" class="form-label">
                                Phone
                            </label>

                            <input
                                type="tel"
                                name="phone"
                                id="phone"
                                class="form-control"
                                required>

                        </div>


                        <!-- Notes -->
                        <div class="mb-3">

                            <label for="notes" class="form-label">
                                Notes
                            </label>

                            <textarea
                                name="notes"
                                id="notes"
                                class="form-control"
                                rows="3"></textarea>

                        </div>


                        <!-- Submit -->
                        <div class="mb-3">

                            <button
                                type="submit"
                                class="btn btn-success">

                                Place Order

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        <?php endif; ?>

    </div>

</section>

<!-- Footer -->
<?php include_once './inc/footer.php'; ?>