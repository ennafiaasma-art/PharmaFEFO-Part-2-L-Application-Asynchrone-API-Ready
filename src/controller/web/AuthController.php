<?php


require_once __DIR__."/../../../config/Database.php";
class AuthController{
    private $repository;
    public function __construct(){
      $db=  Database::getInstance();
        $this->repository=new AuthRepository($db);
    }
   
}