<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
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
  }