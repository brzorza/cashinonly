<?php
class Admin{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function getGamesData(){
        //query
        $this->db->query('SELECT * FROM games');

        $row = $this->db->resultSet();

        return $row;
    }
    
    public function updateGameData($data){
        $this->db->query('UPDATE games SET multiplier = :multiplier WHERE name = :name');

        $this->db->bind(':multiplier', $data['multiplier']);
        $this->db->bind(':name', $data['gameName']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }      
    }
}
