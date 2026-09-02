<?php

if (session_status() === PHP_SESSION_NONE) {

    session_start();
}
$currentPage = basename($_SERVER['PHP_SELF']);


$cart = $_SESSION['cart'] ?? [];

$cartCount = 0;

foreach ($cart as $item) {

    $cartCount += $item['quantity'];
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="container px-4 px-lg-5">

        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            EraaSoft PMS
        </a>


        <!-- Mobile Button -->
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>


        <!-- Navbar Content -->
        <div
            class="collapse navbar-collapse"
            id="navbarSupportedContent">

            <!-- Links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">

                <!-- Home -->
                <li class="nav-item">

                    <a
                        class="nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>"
                        href="index.php">
                        Home
                    </a>

                </li>


                <!-- Product -->
                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="index.php">
                        Product
                    </a>

                </li>


                <!-- Create Product -->
                <?php if (isset($_SESSION['auth']) && $_SESSION['auth']['role'] === 'admin'): ?>

                    <!-- Create Product -->
                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="product-create.php">
                            Create Product
                        </a>

                    </li>

                <?php endif; ?>

                <?php if (!isset($_SESSION['auth'])): ?>

                    <!-- Login -->
                    <li class="nav-item">

                        <a
                            class="nav-link <?= $currentPage === 'login.php' ? 'active' : '' ?>"
                            href="login.php">
                            Login
                        </a>

                    </li>


                    <!-- Register -->
                    <li class="nav-item">

                        <a
                            class="nav-link <?= $currentPage === 'register.php' ? 'active' : '' ?>"
                            href="register.php">
                            Register
                        </a>

                    </li>

                <?php else: ?>

                    <!-- Profile -->
                    <li class="nav-item">

                        <a
                            class="nav-link <?= $currentPage === 'profile.php' ? 'active' : '' ?>"
                            href="profile.php">
                            Profile
                        </a>

                    </li>


                    <!-- Logout -->
                    <li class="nav-item">

                        <a
                            class="nav-link"
                            href="logout.php">
                            Logout
                        </a>

                    </li>

                <?php endif; ?>

            </ul>


            <!-- Cart -->
            <form
                class="d-flex"
                action="cart.php"
                method="GET">

                <button
                    class="btn btn-outline-dark"
                    type="submit">

                    <i class="bi-cart-fill me-1"></i>

                    Cart

                    <span class="badge bg-dark text-white ms-1 rounded-pill">

                        <?= $cartCount ?>

                    </span>

                </button>

            </form>

        </div>

    </div>

</nav>

<!-- Header -->