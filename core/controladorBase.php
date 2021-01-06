<?php

function loadController($controller) {
    $strControllerfile =  ucwords($controller);    

    if(is_file('controlador/'.$strControllerfile.'.php')){
        
        require_once("controlador/".$strControllerfile.".php");
        $controllerObject = new $controller;
        return $controllerObject;         
    }

}

function launchAction($controllerObj, $action) {
    if(method_exists($controllerObj, $action)){
        $controllerObj->$action();
    } else {
        echo 'no existe';
    }
}

function view($view, $datos = array() ) {
   foreach($datos as $key => $valor){
       ${$key}= $valor;
   }
   require_once('vista/'.$view.'.php');
}

function redirect(){
    header("Location: http://localhost/mvc/login");
}

?>
