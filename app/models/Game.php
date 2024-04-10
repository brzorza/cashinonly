<?php
  class Game {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // update_funds needs
    // $data['win']; bool
    // $data['amount']; int
      public function update_funds($data){

        if($data['win']){
          //if user guessed
          $this->db->query('UPDATE users SET credits = credits + (:additional_credits * (SELECT multiplier FROM games WHERE id = 1)) WHERE id = :user_id'); 
          
          //bind values
          $this->db->bind(':additional_credits', $data['amount']);
          $this->db->bind(':user_id', $_SESSION['user_id']);
          
          if($this->db->execute()){
            
          }else{
            return false;
          }


          //update games table on win
          $this->db->query('UPDATE games SET pay_out = pay_out + (:additional_credits * multiplier), total = total - (:additional_credits * multiplier) WHERE id = 1');
          //bind values
          $this->db->bind(':additional_credits', $data['amount']);
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

          //update games table on lose
          $this->db->query('UPDATE games SET pay_in = pay_in + :additional_credits, total = total + :additional_credits  WHERE id = 1');
        
          //bind values
          $this->db->bind(':additional_credits', $data['amount']);
          
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