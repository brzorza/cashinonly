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

            //if request POST to change games multipliers
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data = [
                    'gameName' => $_POST['game-name'],
                    'multiplier' => $_POST['multiplier'],
                    'multiplier_err' => '',
                ];

                // validating form
                if(empty($data['multiplier_err'])){
                    if($this->adminModel->updateGameData($data)){
                        //set flash message
                        flash('update_success', $data['gameName'] . ' multiplier updated successfuly!', 'alert alert-success');

                        //get data after update and render updated view
                        $data = $this->adminModel->getGamesData();
                        $this->view('admins/games', $data);
                    }else{
                        die('Something went wrong!');
                    }
                }else{
                    $data['multiplier_err'] = 'Wrong multiplier value, use float!';
                    $this->view('admins/games', $data);    
                }
            }else{
                $data = $this->adminModel->getGamesData();
                //casual load
                $this->view('admins/games', $data);
            }
        }
    }