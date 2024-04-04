<?php
    class Admins extends Controller {
        public function __construct(){
            if($_SESSION['status'] != 'admin'){
                redirect('');
            }

            $this->adminModel = $this->model('Admin');
        }

        public function welcome(){
            $this->view('admin/welcome');
        }
    }