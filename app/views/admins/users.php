<?php require APPROOT . '/views/inc/header.php'; ?>

    <?php flash('update_success'); ?>

<div class="container-fluid mt-5">
    <div class="row">
        <?php require APPROOT . '/views/inc/adminNav.php' ?>
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
                            <form action="<?php echo URLROOT; ?>/admins/users" method="POST">
                                <input type="hidden" name="name" value="<?php echo $user->name ?>">
                                <th><p class="text-center"><?php echo $user->name ?></p></th>
                                <th><p class="text-center">
                                    <select name="status" class="admin-users-status-input bg-dark text-white <?php echo (!empty($data['status_err'])) ? 'is-invalid' : ''; ?>" required>
                                        <option value="user" <?php echo ($user->status == 'user') ? 'selected' : '' ?>>User</option>
                                        <option value="sub" <?php echo ($user->status == 'sub') ? 'selected' : '' ?>>Sub</option>
                                        <option value="admin" <?php echo ($user->status == 'admin') ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </p></th>
                                <th><p class="text-center"><input type="number" step="0.01" name="credits" class="admin-games-multiplier-input bg-dark text-white <?php echo (!empty($data['credits_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $user->credits ?>" required></p></th>
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