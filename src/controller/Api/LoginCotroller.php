<?php

class LoginController
{
    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];   

        $user = $this->model->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {

            session_start();

            $_SESSION['admin'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            header('Location: index.php?url=admin');
            exit;
        }

        echo "Email ou mot de passe incorrect";
    }
}