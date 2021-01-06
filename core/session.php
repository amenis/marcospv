<?php
session_start();

class Session {
   

    function set_session($name, $param) {  
        $_SESSION[$name] = $param;
    }

    function get_session($name) {
        return $_SESSION[$name];
    }

    function unset_session(){
        session_unset();
        session_destroy();
    }

    function isset_session($name){
        return isset($_SESSION[$name]);
    }


}


?>