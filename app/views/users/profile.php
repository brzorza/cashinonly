<?php require APPROOT . '/views/inc/header.php'; ?>
<?php if(isset($_SESSION['user_id'])) : ?>
    <!-- IF USER IS LOGGED IN -->
    <div class="container">
        <div class="row no-gutters ">
            <div class="col-12 bg-dark text-center left-profile-border">
                <div class="m-5">
                    <img class="profile-pic" src="../img/users_profile_pics/brzorza_profile_pic.jpg" alt="profile picture">
                </div>
            </div>
            <div class="col-7 bg-dark text-left text-white right-profile-border">
                <div class="m-5">
                    <table class="table profile-table">
                        <tr>
                            <th><strong>Username</strong></th>
                            <th><?php echo $data['name'] ?></th>
                        </tr>
                        <tr>
                            <th><strong>Email</strong></th>
                            <th><?php echo $data['email'] ?></th>
                        </tr>
                    </table>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <a href="<?php echo URLROOT . '/users/edit' ?>" class="btn btn-edit">Edit</a>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo URLROOT . '/users/delete' ?>" class="btn btn-delete">DELETE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5 bg-dark text-left text-white">
                <div class="m-5">
                        <table class="table profile-table">
                            <tr>
                                <th><strong>Payed In</strong></th>
                                <th><?php echo $data['pay_in'] ?>cr</th>
                            </tr>
                            <tr>
                                <th><strong>Payed Out</strong></th>
                                <th><?php echo $data['pay_out'] ?>cr</th>
                            </tr>
                            <tr>
                                <th class="<?php echo ($data['total'])>=0 ? 'total-positive' : 'total-negative'; ?>"><strong>Total</strong></th>
                                <th class="<?php echo ($data['total'])>=0 ? 'total-positive' : 'total-negative'; ?>"><?php echo $data['total'] ?>cr</th>
                            </tr>
                        </table>
                    </div>
            </div>
        </div>
    </div>

<?php else : ?>
    <!-- IF USER IS NOT LOGGED IN -->
    <div class="bg-dark py-5 mx-3 text-center text-white">
        <h3>This is the place were you can see and edit yor profile info, but you are not logged in :(</h3>
        <p>But fortunetly for you have two options you can take <span>red pill</span> to register or <span>blue pill</span> to login</p>
        <div class="pills-box">
            <a href="<?php echo URLROOT; ?>/users/login" class="btn text-white mx-5 pill-blue">Login</a>
            <a href="<?php echo URLROOT; ?>/users/register" class="btn text-white mx-5 pill-red">Register</a>
        </div>
    </div>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>