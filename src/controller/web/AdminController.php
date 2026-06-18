<?php

require_once __DIR__ . "/../../Service/AuthService.php";

class AdminController
{
    public function index()
    {
        AuthService::requireRole('ADMIN');

        echo "Bienvenue dans l'espace Administrateur";
    }
}