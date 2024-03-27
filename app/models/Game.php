<?php
  class Game {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // update_funds needs
    // $data['win']; bool
    // $data['amount_won']; int
    // $data['amount']; int
      public function update_funds($data){

        if($data['win']){
          //if user guessed
          $this->db->query('UPDATE users SET credits = credits + :additional_credits WHERE id = :user_id'); 
          
          //bind values
          $this->db->bind(':additional_credits', $data['amount_won']);
          $this->db->bind(':user_id', $_SESSION['user_id']);
          
          if($this->db->execute()){
            
          }else{
            return false;
          }

        }else{
          //if user missed 
          $this->db->query('UPDATE users SET credits = credits - :additional_credits WHERE id = :user_id');
        
          //bind values
          $this->db->bind(':additional_credits', $data['amount']);
          $this->db->bind(':user_id', $_SESSION['user_id']);
          
          if($this->db->execute()){
            
          }else{
            return false;
          }

        }

        //get user credits after gamble
        $this->db->query('SELECT credits FROM users where id = :user_id');

        //bind values
        $this->db->bind(':user_id', $_SESSION['user_id']);
 
        //retuern user data
        $row = $this->db->single();

        return $row;
      }
}