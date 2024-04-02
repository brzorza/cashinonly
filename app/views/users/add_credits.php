<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-dark mt-5 text-white">
        <?php flash('credits_added_success'); ?>
        <h2>Add credits</h2>
        <form action="<?php echo URLROOT; ?>/users/add_credits" method="post">
          <div class="form-group">
            <label for="credits">Amount<sup>*</sup></label>
            <input type="number" name="credits" class="form-control form-control-lg <?php echo (!empty($data['credits_amount_err'])) ? 'is-invalid' : ''; ?>" value="10" required>
            <input class="hidden-input" type="text" name="type" value="pay_in" required>
            <span class="invalid-feedback"><?php echo $data['credits_amount_err']; ?></span>
            <span class="invalid-feedback"><?php echo $data['transaction_type_err']; ?></span>
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Add" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URLROOT; ?>/games" class="btn btn-light btn-block">Go play some games!</a>
            </div>
          </div>
        </form>
      </div>
      <div class="card card-body bg-dark mt-5 text-white">
        <?php flash('credits_subtracted_success'); ?>
        <h2>Payout credits</h2>
        <form action="<?php echo URLROOT; ?>/users/add_credits" method="post">
          <div class="form-group">
            <label for="credits">Amount<sup>*</sup></label>
            <input type="number" name="credits" class="form-control form-control-lg <?php echo (!empty($data['credits_amount_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $_SESSION['credits'] ?>" required>
            <input class="hidden-input" type="text" name="type" value="pay_out" required>
            <span class="invalid-feedback"><?php echo $data['credits_amount_err']; ?></span>
            <span class="invalid-feedback"><?php echo $data['transaction_type_err']; ?></span>
          </div>
          <div class="row">
            <div class="col">
              <input type="submit" value="Payout" class="btn btn-success btn-block">
            </div>
            <div class="col">
              <a href="<?php echo URLROOT; ?>/games" class="btn btn-light btn-block">Go play some games!</a>
            </div>
          </div>
        </form>
      </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>