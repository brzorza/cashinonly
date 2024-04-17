<?php require APPROOT . '/views/inc/header.php'; ?>

    

    
    
    <?php flash('update_success'); ?>

    
    

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-2 bg-dark p-5">
        <nav class="nav flex-column">
            <a class="nav-link text-white <?php echo strpos($_SERVER['REQUEST_URI'], '/admins/welcome') ? 'currently-chosen' : '' ?>" href="<?php echo URLROOT . '/admins/welcome' ?>">Home</a>
            <a class="nav-link text-white <?php echo strpos($_SERVER['REQUEST_URI'], '/admins/games') ? 'currently-chosen' : '' ?>" href="<?php echo URLROOT . '/admins/games' ?>">Games</a>
            <a class="nav-link text-white <?php echo strpos($_SERVER['REQUEST_URI'], '/admins/users') ? 'currently-chosen' : '' ?>" href="<?php echo URLROOT . '/admins/users' ?>">Users</a>
            <a class="nav-link text-white <?php echo strpos($_SERVER['REQUEST_URI'], '/pages/about') ? 'currently-chosen' : '' ?>" href="#">Contact</a>
        </nav>
        </div>
        <div class="col-md-10 bg-dark p-5">
            <div class="text-white">
                <h1 class="mb-4">Users and their exact stats</h1>

                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Credits</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $user): ?>
                        <tr>
                            <form action="<?php echo URLROOT; ?>/admins/games" method="POST">
                                <input type="hidden" name="game-name" value="<?php echo $user->name ?>">
                                <th><p class="text-center"><?php echo $user->name ?></p></th>
                                <th><p class="text-center"><?php echo $user->status ?></p></th>
                                <th><p class="text-center"><?php echo $user->credits ?></p></th>
                                <th><p class="text-center"><?php echo $user->total ?></p></th>
                                <th><p class="text-center"><?php echo $user->created_at ?></p></th>
                                <th><input type="submit" value="Update!" class="btn btn-success btn-block"></th>
                            </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>