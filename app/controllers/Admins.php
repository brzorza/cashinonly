<?php
    class Admins extends Controller {
        public function __construct(){
            if($_SESSION['status'] != 'admin'){
                redirect('');
            }

            $this->adminModel = $this->model('Admin');
        }

        public function welcome(){
            $this->view('admins/welcome');
        }

        public function games(){

            $data = $this->adminModel->getGamesData();

            //if request POST to change games multipliers
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

            }else{
                //casual load
                $this->view('admins/games', $data);
            }
        }
    }