```php
<?php

include_once '../core/function.php';

require_once '../core/validation.php';

session_start();

$errors = [];


// DELETE

if (isset($_GET['delete'])) {

    $product_id = $_GET['delete'];

    if (!isset($_SESSION['cart'])) {

        $_SESSION['cart'] = [];

    }

    foreach ($_SESSION['cart'] as $index => $cartItem) {

        if ($cartItem['product_id'] == $product_id) {

            unset($_SESSION['cart'][$index]);

            $_SESSION['cart'] = array_values($_SESSION['cart']);

            $_SESSION['success'] = "Product deleted from cart successfully";

            header("Location: ../cart.php");

            exit;
        }
    }

    $_SESSION['errors'] = ["Product not found in cart"];

    header("Location: ../cart.php");

    exit;
}


if (CheachRequestMethod("POST")) {

    // Get data from POST

    $product_id = $_POST['product_id'] ?? null;

    $quantity = $_POST['quantity'] ?? null;



    // Product ID validation

    if (!requiredVal($product_id)) {

        $errors[] = "Product ID is required";
    }



    // Quantity validation

    if (!requiredVal($quantity)) {

        $errors[] = "Quantity is required";

    } elseif (!filter_var($quantity, FILTER_VALIDATE_INT)) {

        $errors[] = "Quantity must be a whole number";

    } elseif ($quantity <= 0) {

        $errors[] = "Quantity must be greater than 0";
    }



    // Read products.json

    $file = '../database/product.json';

    $data = file_get_contents($file);

    $products = json_decode($data, true);

    $product = null;



    // Find product

    foreach ($products as $item) {

        if ($item['id'] == $product_id) {

            $product = $item;

            break;
        }
    }



    // Check if product exists

    if ($product === null) {

        $errors[] = "Product not found";
    }



    // Check stock quantity

    if ($product !== null) {

        if ($quantity > $product['stock_quantity']) {

            $errors[] = "Not enough stock available";
        }
    }



    // Add product to cart

    if (empty($errors)) {

        if (!isset($_SESSION['cart'])) {

            $_SESSION['cart'] = [];
        }



        $_SESSION['cart'][] = [

            'product_id' => $product_id,

            'quantity' => $quantity

        ];
    }



    // Handle errors

    if (!empty($errors)) {

        $_SESSION['errors'] = $errors;

        header("Location: ../product.php?id=" . $product_id);

        exit;
    }



    // Success

    $_SESSION['success'] = "Product added to cart successfully";

    header("Location: ../cart.php");

    exit;
}
