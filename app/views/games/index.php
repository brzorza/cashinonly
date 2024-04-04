<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-dark games-card">
                    <img class="card-img-top" src="./public/img/games_covers/dices.png" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text text-center text-white games-cover-title">Dice game</p>
                    </div>
                    <a class="games-cover-link" href="<?php echo URLROOT ?>/games/dice_roll"></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark games-card">
                    <img class="card-img-top" src="./public/img/games_covers/bombs.jpg" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text text-center text-white games-cover-title">Bombs</p>
                    </div>
                    <a class="games-cover-link" href="<?php echo URLROOT ?>/games/bombs"></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-dark games-card">
                    <img class="card-img-top" src="./public/img/games_covers/dilemma.png" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text text-center text-white games-cover-title">Dilemma</p>
                    </div>
                    <a class="games-cover-link" href="<?php echo URLROOT ?>/games/dilemma"></a>
                </div>
            </div>
        </div>
    </div>


<?php require APPROOT . '/views/inc/footer.php'; ?>