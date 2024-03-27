<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-dark mt-5 text-white text-center">
        
        <?php flash('gamable_outcome'); ?>
        
        <h2>Dice roll</h2>
        <p class="lead text-white">Roll the dice or get rolled</p>

        <form action="<?php echo URLROOT; ?>/games/dice_roll" method="POST">
        <div class="row">
            <div class="col mt-3">
              <label for="amount">Buy in: <sup>*</sup></label>
              <input type="number" name="amount" min="1" max="100" class="form-control form-control-lg <?php echo (!empty($data['amount_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['amount'] ?>" required>
              <span class="invalid-feedback"><?php echo $data['amount_err']; ?></span>
            </div>
            <div class="col mt-3">
              <label for="amount">Choose number: <sup>*</sup></label>
              <input type="number" name="chosen_number" min="1" max="6" class="form-control form-control-lg <?php echo (!empty($data['chosen_number_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['chosen_number'] ?>" required>
              <span class="invalid-feedback"><?php echo $data['chosen_number_err']; ?></span>
            </div>
          </div>
          <div class="row">
            <div class="col mt-3">
              <input type="submit" value="Let's play!" class="btn btn-success btn-block">
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>