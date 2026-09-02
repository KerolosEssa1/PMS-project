<?php
session_start();
include_once('../core/function.php');
include_once('../core/validation.php');

$errors = [];

if (CheachRequestMethod("POST") && chechpostinput("name")) {
    //sentization 
    foreach ($_POST as $key => $value) {
        $$key = senitizeInput($value); //var var (key)
    }

    // validation 
    //name=>required , min:3 char ,max:25 char
    if (!requiredVal($name)) {
        $errors[] = "name is required";
    } elseif (!minVal($name, 3)) {
        $errors[] = "name must be grater than 3 char";
    } elseif (!maxVal($name, 25)) {
        $errors[] = "name must be less than 25 char";
    }

    //email=>required , valid email
    if (!requiredVal($email)) {
        $errors[] = "email is required";
    } elseif (!emailvalid($email)) {
        $errors[] = "type a valid Email";
    }
    //passwword=>required , min:3 char ,max:25 char
    if (!requiredVal($password)) {
        $errors[] = "password is required";
    } elseif (!minVal($password, 8)) {
        $errors[] = "password must be grater than 8 num";
    } elseif (!maxVal($password, 20)) {
        $errors[] = "password must be less than 20 num";
    }

    //put data in database
    if (empty($errors)) {
        $data = file_get_contents('../database/users.json');
        $users = json_decode($data, true);
        $users[] = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        file_put_contents(
            '../database/users.json',
            json_encode($users, JSON_PRETTY_PRINT)
        );
        $_SESSION['success'] = "Successful registration";
        header("location:../login.php");
        exit;
    } else {
        $_SESSION['errors'] = $errors;
        header("location:../register.php");
    }
} else {
    echo "not supported method";
}
