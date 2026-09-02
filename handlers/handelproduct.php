<?php
include_once '../core/function.php';
require_once '../core/validation.php';
session_start();
$errors = [];
if (CheachRequestMethod("POST")) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $image_url = $_POST['image_url'];
    $description = $_POST['description'];
    // validation ALL
    //name val
    if (!requiredVal($product_name)) {
        $errors[] = "product name is required";
    }
    //price val
    if (!requiredVal($price)) {
        $errors[] = "price is required";
    } elseif (!is_numeric($price)) {
        $errors[] = "price must be a number";
    }
    //stock val
    if (!requiredVal($stock_quantity)) {
        $errors[] = "stock quantity is required";
    } elseif (!filter_var($stock_quantity, FILTER_VALIDATE_INT) && $stock_quantity !== "0") {
        $errors[] = "stock quantity must be a whole number";
    }
    //description val
    if (!requiredVal($description)) {
        $errors[] = "description is required";
    } elseif (strlen($description) < 10) {
        $errors[] = "description must be at least 10 characters";
    }
    //img val 
    if (!empty($image_url) && !filter_var($image_url, FILTER_VALIDATE_URL)) {
        $errors[] = "image URL must be valid";
    }
    //is there are errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../product-creat.php");
        exit;
    }
    //successful craeted
    if (empty($errors)) {

    // Read product.json
    $file = '../database/product.json';

    $data = file_get_contents($file);

    $products = json_decode($data, true);

    // Make sure products is an array
    if (!is_array($products)) {
        $products = [];
    }

    // Create new product
    $product = [
        "id" => count($products) + 1,
        "product_name" => $product_name,
        "price" => $price,
        "stock_quantity" => $stock_quantity,
        "image_url" => $image_url,
        "description" => $description
    ];

    // Add product to products array
    $products[] = $product;

    // Save data to JSON file

    $jsonData = json_encode(
        $products,
        JSON_PRETTY_PRINT
    );

    file_put_contents($file, $jsonData);

    // Success

    $_SESSION['success'] = "Product created successfully";

    header("Location: ../index.php");
    exit;
}
}