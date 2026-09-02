<?php include_once './inc/header.php' ?>

<!-- Navigation-->
<?php include_once  './inc/nav.php' ?>
<?php

session_start();
include './core/function.php';

session_destroy();
redirect("login.php");
?>
<!-- Section-->
<section class="py-5">

</section>
<!-- Footer-->
<?php include_once  './inc/footer.php' ?>