<?php 
require_once __DIR__ ."/../src/controller/Api/ApiDashboardController.php";
require_once __DIR__ ."/../src/controller/web/AdminController.php";
$url=$_GET['url'] ?? "dashboard" ;
switch($url){
    case 'dashboard':
        $controller= new  ApiDashboardController() ;
        $controller->index();
        break;
        case 'admin':
            $controller =new AdminController();
            $controller->index();
            break;
            default:
            echo " 404 -  Page non trouvée " ;
}



?>