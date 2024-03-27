<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="jumbotron jumbotron-flud text-center bg-dark w-100">
    <div class="container">
      <h1 class="display-3 text-white">Welcome to <?php echo $data['title']; ?>!</h1>
      <p class="lead text-white"><?php echo $data['description']; ?></p>
      <p class="lead text-white"><?php echo $data['description-down']; ?></p> 
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>