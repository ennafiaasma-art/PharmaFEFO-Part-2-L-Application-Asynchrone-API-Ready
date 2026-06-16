<?php 
require_once __DIR__ ."/../../config/Database.php";




class AuthService
{
    public static function isAuthenticated(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['admin']);
    }

    public static function hasRole(string $role): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['role']) && $_SESSION['role'] === $role;
    }

    public static function checkRole(array $roles): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['role']) &&
               in_array($_SESSION['role'], $roles);
    }
}

?>