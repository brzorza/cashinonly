<div class="col-md-2 bg-dark p-5">
    <nav class="nav flex-column">
        <a class="nav-link text-white <?php echo strpos($_SERVER['REQUEST_URI'], '/admins/welcome') ? 'currently-chosen' : '' ?>" href="<?php echo URLROOT . '/admins/welcome' ?>">Home</a>
        <a class="nav-link text-white <?php echo strpos($_SERVER['REQUEST_URI'], '/admins/games') ? 'currently-chosen' : '' ?>" href="<?php echo URLROOT . '/admins/games' ?>">Games</a>
        <a class="nav-link text-white <?php echo strpos($_SERVER['REQUEST_URI'], '/admins/users') ? 'currently-chosen' : '' ?>" href="<?php echo URLROOT . '/admins/users' ?>">Users</a>
        <a class="nav-link text-white <?php echo strpos($_SERVER['REQUEST_URI'], '/pages/about') ? 'currently-chosen' : '' ?>" href="#">Contact</a>
    </nav>
</div>