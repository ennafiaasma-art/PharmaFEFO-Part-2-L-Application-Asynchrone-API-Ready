<?php

class AuthService
{
    private static function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function isAuthenticated(): bool
    {
        self::startSession();

        return isset($_SESSION['admin']);
    }

    public static function hasRole(string $role): bool
    {
        self::startSession();

        return isset($_SESSION['role'])
            && $_SESSION['role'] === $role;
    }

    public static function checkRole(array $roles): bool
    {
        self::startSession();

        return isset($_SESSION['role'])
            && in_array($_SESSION['role'], $roles);
    }

    public static function requireRole(string $role): void
    {
        self::startSession();

        if (!self::isAuthenticated()) {
            http_response_code(401);
            die('Utilisateur non connecté');
        }

        if (!self::hasRole($role)) {
            http_response_code(403);
            die('Erreur 403 - Accès interdit');
        }
    }
}