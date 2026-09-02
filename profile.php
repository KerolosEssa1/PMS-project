<?php include_once './inc/header.php' ?>

<!-- Navigation-->
<?php include_once  './inc/nav.php' ?>
<?php include_once('./inc/header.php') ?>
<?php include_once('./inc/nav.php') ?>


<div class="container">
  <div class="row">
    <div class="col-8 mx-auto my-5 border p-2">

      <h2 class="border border-success bg-success text-white my-2 p-2">
        Name: <?php echo $_SESSION['auth']['name']; ?>
      </h2>

      <h2 class="border border-danger bg-danger text-white my-2 p-2">
        Email: <?php echo $_SESSION['auth']['email']; ?>
      </h2>

    </div>
  </div>
</div>

<!-- Section-->
<section class="py-5">

</section>
<!-- Footer-->
<?php include_once  './inc/footer.php' ?>