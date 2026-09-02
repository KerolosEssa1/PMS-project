<?php

session_start();
include_once('../core/function.php');
include_once('../core/validation.php');

$errors = [];


if (CheachRequestMethod("POST") && chechpostinput("email")) {


    //sentization 
    foreach ($_POST as $key => $value) {
        $$key = senitizeInput($value); //var var (key)
    }

    //validate email
    if (!requiredVal($email)) {
        $errors[] = "Email is required";
    } elseif (!emailvalid($email)) {
        $errors[] = "Type a valid email";
    }

    //validate password
    if (!requiredVal($password)) {
        $errors[] = "Password is required";
    }


    //get data from users.json 
    if (empty($errors)) {
        $data = file_get_contents('../database/users.json');
        $users = json_decode($data, true);

        $userfound = false;

        foreach ($users as $user) {

            if ($email === $user['email']) {

                $userfound = true;

                if (password_verify($password, $user['password'])) {

                    $_SESSION['auth'] = $user;

                    header("location:../profile.php");
                    exit;
                } else {
                    $errors[] = "Email or Password is incorrect";
                }
                break;
            }
        }
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("location:../login.php");
            exit;
        }
    } 
}


