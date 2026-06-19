<?php 

require_once __DIR__ ."/environment.php";
Env::load(__DIR__ ."/../.env");

class Database{
    private static ?PDO $instance = null;
    private function __construct(){}

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $dsn = "mysql:host=" . $_ENV["HOST"] . ";dbname=" . $_ENV["DB_NAME"] . ";charset=utf8mb4";
                
                self::$instance = new PDO(
                    $dsn, 
                    $_ENV["DB_USER"],
                    $_ENV["DB_PASSW"]
                );

                self::$instance->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );
            }
            catch(PDOException $e){
                die("connexion echouee :" . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
?>