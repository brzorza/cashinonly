<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-2 bg-dark p-5">
        <nav class="nav flex-column">
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/admins/welcome') ? 'currently-chosen' : '' ?>" href="<?php echo URLROOT . '/admins/welcome' ?>">Home</a>
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/admins/games') ? 'currently-chosen' : '' ?>" href="<?php echo URLROOT . '/admins/games' ?>">Games</a>
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/pages/about') ? 'currently-chosen' : '' ?>" href="#">Services</a>
            <a class="nav-link <?php echo strpos($_SERVER['REQUEST_URI'], '/pages/about') ? 'currently-chosen' : '' ?>" href="#">Contact</a>
        </nav>
        </div>
        <div class="col-md-10 bg-dark p-5">
            <h1 class="text-white mb-4">Admin Panel</h1>
            <p class="text-white">Hello, <?php echo $_SESSION['user_name'] ?></p>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>