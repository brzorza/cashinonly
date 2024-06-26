<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //get needed user info
    public function getUserInfo(){
      //make query
      $this->db->query('SELECT pay_in, pay_out FROM users WHERE id = :id');
      
      //bind values
      $this->db->bind(':id', $_SESSION['user_id']);

      $row = $this->db->single();

      if(!empty($row)){
        return $row;
      }else{
        return false;
      }
    }

    // Regsiter user
    public function register($data){
      $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Login User
    public function login($email, $password){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }

    // Find user by email
    public function findUserByEmail($email){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      // Bind value
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    //Find usert by name
    public function findUserByName($name){
      $this->db->query('SELECT * FROM users WHERE name = :name');
      // Bind value
      $this->db->bind(':name', $name);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    public function veryfyPassword($name, $password){
      $this->db->query('SELECT * FROM users WHERE name = :name');

      //bind value
      $this->db->bind(':name', $name);

      $row = $this->db->single();

      $hashed_password = $row->password;

      if(password_verify($password, $hashed_password)){
        return true;
      } else {
        return false;
      }
    }

    //edit profile information
    public function editProfileInfo($data){
      if(empty($data['newpassword'])){
        $this->db->query('UPDATE users SET name = :name, email = :email WHERE id = :id');
      }else{
        $this->db->query('UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id');
        $this->db->bind(':password', $data['newpassword']);
      }
    
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':id', $data['id']);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function deleteProfile($data){
      $this->db->query('DELETE FROM users WHERE id = :id');

      $this->db->bind(':id', $data);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    //$data['transaction_type']  str 'pay_in' or 'pay_out'
    //$data['credits_amount']    int
    public function updateCredits($data){
      if($data['transaction_type'] == 'pay_in'){
        //if users add funds
        $this->db->query('UPDATE users SET credits = credits + :additional_credits, pay_in = pay_in + :additional_credits WHERE id = :user_id'); 
        
        //bind values
        $this->db->bind(':additional_credits', $data['credits_amount']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        
        if($this->db->execute()){
          //query info to use for user total creds update
          $this->db->query('SELECT pay_in, pay_out FROM users WHERE id = :user_id');

          $this->db->bind(':user_id', $_SESSION['user_id']);

          $credits_info = $this->db->single();

          // count user creds to get totla
          $total = $credits_info->pay_out - $credits_info->pay_in;

          //update db with new total value
          $this->db->query('UPDATE users SET total = :total WHERE id = :user_id');
          $this->db->bind(':total', $total);
          $this->db->bind(':user_id', $_SESSION['user_id']);
          $this->db->execute();
        }else{
          return false;
        }
      }elseif($data['transaction_type'] == 'pay_out'){
        //if users pays out funds
        $this->db->query('UPDATE users SET credits = credits - :additional_credits, pay_out = pay_out + :additional_credits WHERE id = :user_id'); 
        
        //bind values
        $this->db->bind(':additional_credits', $data['credits_amount']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        
        if($this->db->execute()){
          //query info to use for user total creds update
          $this->db->query('SELECT pay_in, pay_out FROM users WHERE id = :user_id');

          $this->db->bind(':user_id', $_SESSION['user_id']);

          $credits_info = $this->db->single();

          // count user creds to get totla
          $total = $credits_info->pay_out - $credits_info->pay_in;

          //update db with new total value
          $this->db->query('UPDATE users SET total = :total');
          $this->db->bind(':total', $total);
          $this->db->execute();

        }else{
          return false;
        }
      }

      //get user credits after query was executed
      $this->db->query('SELECT credits FROM users where id = :user_id');

      //bind values
      $this->db->bind(':user_id', $_SESSION['user_id']);

      //retuern user data
      $row = $this->db->single();

      return $row;
    }

    

  }