<?php

session_start();

$file = './database/product.json';

$data = file_get_contents($file);

$products = json_decode($data, true);

$cart = $_SESSION['cart'] ?? [];

$totalPrice = 0;

?>

<?php include_once './inc/header.php'; ?>

<body>

    <!-- Navigation -->
    <?php include_once './inc/nav.php'; ?>


    <!-- Cart Section -->
    <section class="py-5">

        <div class="container px-4 px-lg-5 mt-5">

            <div class="row">

                <div class="col-12">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th scope="col">#</th>

                                <th scope="col">Product</th>

                                <th scope="col">Price</th>

                                <th scope="col">Quantity</th>

                                <th scope="col">Total</th>

                                <th scope="col">Delete</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php if (empty($cart)): ?>

                                <tr>

                                    <td colspan="6" class="text-center">

                                        Your cart is empty.

                                    </td>

                                </tr>

                            <?php else: ?>


                                <?php foreach ($cart as $index => $cartItem): ?>

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


                                        <tr>

                                            <!-- Number -->

                                            <th scope="row">

                                                <?= $index + 1 ?>

                                            </th>


                                            <!-- Product -->

                                            <td>

                                                <?= htmlspecialchars($product['product_name']) ?>

                                            </td>


                                            <!-- Price -->

                                            <td>

                                                $<?= htmlspecialchars($product['price']) ?>

                                            </td>


                                            <!-- Quantity -->

                                            <td>

                                                <input

                                                    type="number"

                                                    value="<?= htmlspecialchars($quantity) ?>"

                                                    min="1"

                                                    max="<?= htmlspecialchars($product['stock_quantity']) ?>"

                                                    class="form-control"

                                                    style="width: 100px;"

                                                    readonly>

                                            </td>


                                            <!-- Total -->

                                            <td>

                                                $<?= number_format($itemTotal, 2) ?>

                                            </td>


                                            <!-- Delete -->

                                            <td>

                                                <a

                                                    href="./handlers/handelCart.php?delete=<?= htmlspecialchars($product['id']) ?>"

                                                    class="btn btn-danger">

                                                    Delete

                                                </a>

                                            </td>

                                        </tr>


                                    <?php endif; ?>

                                <?php endforeach; ?>


                                <!-- Total Price -->

                                <tr>

                                    <td colspan="2">

                                        <strong>Total Price</strong>

                                    </td>


                                    <td colspan="3">

                                        <h3>

                                            $<?= number_format($totalPrice, 2) ?>

                                        </h3>

                                    </td>


                                    <td>

                                        <?php if (isset($_SESSION['auth'])): ?>

                                            <a
                                                href="checkout.php"
                                                class="btn btn-primary">
                                                Checkout
                                            </a>

                                        <?php else: ?>

                                            <a
                                                href="login.php"
                                                class="btn btn-primary">
                                                Checkout
                                            </a>

                                        <?php endif; ?>

                                    </td>

                                </tr>


                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>


    <!-- Footer -->

    <?php include_once './inc/footer.php'; ?>

</body>
```