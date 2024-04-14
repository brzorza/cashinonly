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
    
    public function updateGameData(){
        
    }
}
