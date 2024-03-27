<?php
  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      $data = [
        'title' => 'CAShINOnly',
        'description' => 'Where you can either send us some money or lose it all :)',
        'description-down' => 'At least you will have some fun!'
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      $data = [
        'title' => 'About Us',
        'description' => 'App to share posts with other users'
      ];

      $this->view('pages/about', $data);
    }
    public function games(){
      //check if is logged in
      if(!empty($_SESSION)){
        $data = [''];
        $this->view('pages/games', $data);
      }else{
        redirect('');
      }
    }

    public function profile(){
      $data = [
        'name' => '',
        'email' => ''
      ];

      $this->view('pages/profile', $data);
    }
  }