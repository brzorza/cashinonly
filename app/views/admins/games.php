<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- <p class="text-white"><?php print_r($data); ?></p> -->

    <div class="text-white">

    <h1 class="text-center my-5">Games performaces and control</h1>

    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Pay In</th>
                <th class="text-center">Pay Out</th>
                <th class="text-center">Total</th>
                <th class="text-center">Multiplier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $game): ?>
            <tr>
                <form action="<?php echo URLROOT; ?>/admins/games" method="POST">
                    <th><p class="text-center"><?php echo $game->name ?></p></th>
                    <th><p class="text-center"><?php echo $game->pay_in ?></p></th>
                    <th><p class="text-center"><?php echo $game->pay_out ?></p></th>
                    <th><p class="text-center"><?php echo $game->total ?></p></th>
                    <th><p class="text-center"><input type="number" name="multiplier" class="admin-games-multiplier-input bg-dark text-white <?php echo (!empty($data['amount_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $game->multiplier ?>" required></p></th>
                    <th><input type="submit" value="Update!" class="btn btn-success btn-block"></th>
                </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>