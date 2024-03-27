<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-dark mt-5 text-white">
        <?php flash('edit_success'); ?>
        <h2>Edit Profile</h2>
        <p>Edit what you want!</p>
        <form action="<?php echo URLROOT; ?>/users/edit" method="POST">
        <div class="form-group">
            <label for="email">Username: <sup>*</sup></label>
            <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
        </div>
        <div class="form-group">
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
            <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="password">Current password: <sup>*</sup></label>
            <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="password">New password: <sup>*</sup></label>
            <input type="password" name="newpassword" class="form-control form-control-lg <?php echo (!empty($data['newpassword_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['newpassword']; ?>">
            <span class="invalid-feedback"><?php echo $data['newpassword_err']; ?></span>
          </div>
          <div class="form-group">
            <label for="password">Confirm new password: <sup>*</sup></label>
            <input type="password" name="newpasswordconfirm" class="form-control form-control-lg" value="<?php echo $data['newpasswordconfirm']; ?>">
          </div>
          <div class="row">
            <div class="col mt-3">
              <input type="submit" value="Edit" class="btn btn-success btn-block">
            </div>
            <div class="col mt-3">
              <a href="<?php echo URLROOT; ?>/users/profile" class="btn btn-light btn-block">Go back!</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>