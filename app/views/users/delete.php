<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card card-body bg-dark mt-5 text-white text-center">
        <?php flash('edit_success'); ?>
        <img src="" alt="Sad image, beacuse you want to delete accaunt.">
        <h2>Delete Profile?</h2>
        <form action="<?php echo URLROOT; ?>/users/delete" method="POST">
          <div class="row">
            <div class="col mt-3">
              <input type="submit" value="Delete" class="btn btn-danger btn-block">
            </div>
            <div class="col mt-3">
              <a href="<?php echo URLROOT; ?>/users/profile" class="btn btn-light btn-block">I want to stay!</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>