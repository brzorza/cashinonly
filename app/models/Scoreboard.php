<?php
class Scoreboard{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function getHighScores(){
    
        $this->db->query('SELECT name, pay_in, pay_out FROM users');

        $row = $this->db->resultSet();

        return $row;

    }
}