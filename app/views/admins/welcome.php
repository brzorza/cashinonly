<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-fluid mt-5">
    <div class="row">
        <?php require APPROOT . '/views/inc/adminNav.php' ?>
        <div class="col-md-10 bg-dark p-5">
            <h1 class="text-white mb-4">Admin Panel</h1>
            <p class="text-white">Hello, <?php echo $_SESSION['user_name'] ?></p>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>