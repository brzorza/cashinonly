<?php
    class Scoreboards extends Controller {
        public function __construct(){
            $this->scoreboardModel = $this->model('Scoreboard');
        }

        public function index(){

            //Fetch all users and their payed ins and pay outs
            $scores = $this->scoreboardModel->getHighScores();

            $data = [];

            //Loop to make array with name and total money
            foreach($scores as $score){
                $name = $score->name;
                $total = $score->pay_out - $score->pay_in;

                $obj = new stdClass();
                $obj->name = $name;
                $obj->total = $total;

                $data[] = $obj;
            }

            $this->view('scoreboards/index', $data);
        }

    }