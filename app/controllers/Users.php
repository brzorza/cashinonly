<?php
  class Users extends Controller {
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function register(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        } else {
          // Check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Pleae enter password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Pleae confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated
          
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User
          if($this->userModel->register($data)){
            flash('register_success', 'You are registered and can log in');
            redirect('users/login');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }

      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('users/register', $data);
      }
    }

    public function login(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
        $data =[
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => '',
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        }

        // Check for user/email
        if($this->userModel->findUserByEmail($data['email'])){
          // User found
        } else {
          // User not found
          $data['email_err'] = 'No user found';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);

          if($loggedInUser){
            // Create Session
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_err'] = 'Password incorrect';

            $this->view('users/login', $data);
          }
        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }


      } else {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',        
        ];

        // Load view
        $this->view('users/login', $data);
      }
    }

    public function profile(){
      if(!empty($_SESSION)){
        //render logged in user profile
        $data = [
          'name' => $_SESSION['user_name'],
          'email' => $_SESSION['user_email']
        ];
  
        $this->view('users/profile', $data);
        
      }else{
        //render NOT logged in user profile
        $data = [
          'name' => '',
          'email' => ''
        ];
        //load user profile view
        $this->view('users/profile');
      }
    }

    public function edit(){
      //check if user is logged in
      if(!empty($_SESSION)){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //sanitize data
        $_POST = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        
        // Init data
        $data =[
          'id' => $_SESSION['user_id'],
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'newpassword' => trim($_POST['newpassword']),
          'newpasswordconfirm' => trim($_POST['newpasswordconfirm']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'newpassword_err' => '',
        ];

        //validate name
        if($data['name'] === $_SESSION['user_name']){
          $data['name_err'] = '';
        }elseif(strlen($data['name']) < 3){
          $data['name_err'] = 'Name must be at least 3 characters long!';
        }elseif($this->userModel->findUserByName($data['name'])){
          $data['name_err'] = 'Username already taken!';
        }

        //validate email
        if($data['email'] === $_SESSION['user_email']){
          $data['email_err'] = '';
        }elseif($this->userModel->findUserByEmail($data['email'])){
          $data['email_err'] = 'Email is assigned to another user!';
        }

        //verify passowrd
        if($this->userModel->veryfyPassword($_SESSION['user_name'], $data['password'])){
          $data['password_err'] = '';
        }else{
          $data['password_err'] = "Password deasn't mach!";
        }

        //verify new passwords
        if(empty($data['newpassword'])){
          
        }elseif($data['newpassword'] !== $data['newpasswordconfirm']){
          $data['newpassword_err'] = "Passwords doen't mach!";
        }elseif(strlen($data['newpassword']) < 6){
          $data['newpassword_err'] = "New password is too short!";
        }

        //procces form  
        if(empty($data['name_err']) && empty($data['email_err']) && empty($data['name_err']) && empty($data['newpassword_err'])){

          //hash password if not empty
          if(!empty($data['newpassword'])){
            $data['newpassword'] = password_hash($data['newpassword'], PASSWORD_DEFAULT);
          }

          //edit profile info
          if($this->userModel->editProfileInfo($data)){
            $_SESSION['user_email'] = $data['email'];
            $_SESSION['user_name'] = $data['name'];
            flash('edit_success', 'Edit was successful!');
            redirect('users/profile');
          }else{
            die('Something went wrong :(');
          }
        }else{
          $this->view('users/edit', $data);
        }
        }else{          
          $data = [
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email'],
            'password' => '',
            'newpassword' => '',
            'newpasswordconfirm' => '',
            'name_err' => '',
            'email_err' => '',
            'password_err' => '',
            'newpassword_err' => '',
          ];
          $this->view('users/edit', $data);
        }
      }else{
        redirect('');
      }
    }

    public function delete(){
      if(isset($_SESSION)){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

          if($this->userModel->deleteProfile($_SESSION['user_id'])){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            unset($_SESSION['status']);
            unset($_SESSION['credits']);
            session_destroy();
            redirect('');
          }else{
            die('Something went wrong');
          }

        }else{
          $this->view('users/delete');
        }
      }else{
        redirect('');
      }
    }

    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['user_name'] = $user->name;
      $_SESSION['status'] = $user->status;
      $_SESSION['credits'] = $user->credits;
      redirect('pages/index');
    }

    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['user_name']);
      unset($_SESSION['status']);
      unset($_SESSION['credits']);
      session_destroy();
      redirect('users/login');
    }

    public function isLoggedIn(){
      if(isset($_SESSION['user_id'])){
        return true;
      } else {
        return false;
      }
    }
  }