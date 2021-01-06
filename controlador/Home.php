<?php

class Home {
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function index() {
        if($this->session->isset_session('userId')){
            view('home');
        } else {
            redirect();
           // include('vista/index.php');
        }
    }

}