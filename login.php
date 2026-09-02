<?php include_once './inc/header.php' ?>

<!-- Navigation-->
<?php include_once  './inc/nav.php' ?>

    <?php include_once('./inc/header.php') ?>
  <?php include_once('./inc/nav.php') ?>
<div class="container">
  <form class="w-50 mx-auto" action="./handlers/handelLogin.php" method="POST">
    <div class="container text-center ">
      <div class="col fw-bold fs-2">Login</div>
    </div>
    <?php
    if (isset($_SESSION['errors'])):
      foreach ($_SESSION['errors'] as $error): ?>
        <div class="alert alert-danger text-center">
          <?php echo $error; ?>
        </div>
    <?php
      endforeach;
      unset($_SESSION['errors']);
    endif;
    ?>
    
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email address</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1">
    </div>

    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label"  >Password</label>
      <input name="password" type="password" class="form-control" id="exampleInputPassword1">
    </div>

   

    <button type="submit" class="btn btn-primary">Submit</button>

  </form>
</div>


<!-- Section-->
<section class="py-5">

</section>
<!-- Footer-->
<?php include_once  './inc/footer.php' ?>