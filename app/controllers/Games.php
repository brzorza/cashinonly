<?php

use function PHPSTORM_META\type;

    class Games extends Controller{
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->gameModel = $this->model('Game');
        }

        public function index(){
            $this->view('games/index');
        }

        public function dice_roll(){

            $data = [
                'amount' => 10,
                'chosen_number' => 1,
                'win' => '',
                'amount_err' => '',
                'chosen_number_err' => ''
            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                //init data
                $data = [
                    'amount' => $_POST['amount'],
                    'chosen_number' => $_POST['chosen_number'],
                    'win' => '',
                    'amount_err' => '',
                    'chosen_number_err' => '',
                    'random_number' => '',
                    'amount_won' => ''
                ];

                //validate chosen_number
                if($_POST['chosen_number'] > 6 || $_POST['chosen_number'] < 1){
                    $data['chosen_number_err'] = "Choose number between 1 and 6!";
                }

                //validate amount
                if($_POST['amount'] > $_SESSION['credits'] || $_POST['amount'] < 1){
                    $_POST['amount_err'] = 'Invalid amount!';
                }

                //rolling the dice
                $data['random_number'] = rand(1, 6);

                if(empty($data['amount_err']) && empty($data['chosen_number_err'])){
                    //set proper flash message
                    if($data['random_number'] != $data['chosen_number']){
                        flash('gamable_outcome', 'You have choose ' . $data['chosen_number'] . ' and dice roll was ' . $data['random_number'] . ' :( GL next time!', 'alert alert-danger');
                        $data['win'] = false;
                    }else{
                        flash('gamable_outcome', 'You have choose ' . $data['chosen_number'] . ' and dice roll was ' . $data['random_number'] . ' :) Congratulations!', 'alert alert-success');
                        $data['win'] = true;
                        $data['amount_won'] = $data['amount'] * 2.71;
                    }

                    //add / reduce funds from user credits
                    if($user = $this->gameModel->update_funds($data)){
                        // print_r($user);
                    }else{
                        die('Something went wrong!');
                    }

                    //reset credists $_SESSION variable to correct one 
                    unset($_SESSION['credits']);
                    $_SESSION['credits'] = $user->credits;
                    
                    $this->view('games/dice_roll', $data);
                }else{
                    $this->view('games/dice_roll', $data);
                }
            }else{
                $this->view('games/dice_roll', $data);
            }
        }
    }