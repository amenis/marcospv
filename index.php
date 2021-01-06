<?php
require_once("config.php");
require_once("core/controladorBase.php");
require_once 'core/dbConnection.php';
require_once 'core/index.php' ;
require_once('core/session.php');
foreach(glob("modelo/*.php") as $file){
    require_once $file;
}


$request = (isset($_GET['request']) ? explode('/', $_GET['request']) : null);

if( isset($request[0]) ){
    
    if(isset($request[1])){
        $controllerObj = loadController($request[0]);       
        launchAction($controllerObj, $request[1]);
    } else {
        $controllerObj = loadController($request[0]);
        //$controllerObj->index();
        launchAction($controllerObj, defaultAtion);
    }
    
} else {
   $controllerObj = loadController(defaultCtl);
   launchAction($controllerObj, defaultAtion);
}

?>