<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="text-white">

      <h1 class="text-center">Scoreboard</h1>
    
      <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Name</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
        <tbody>
          <?php $count = 1; ?>
          <?php foreach ($data as $user): ?>
            <tr>
              <th><p class="text-center"><?php echo $count ?></p></th>
              <th><p class="text-center"><?php echo $user->name ?></p></th>
              <th><p class="text-center"><?php echo $user->total ?></p></th>
            </tr>
            <?php $count++; ?>
          <?php endforeach; ?>
        </tbody>
      
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>