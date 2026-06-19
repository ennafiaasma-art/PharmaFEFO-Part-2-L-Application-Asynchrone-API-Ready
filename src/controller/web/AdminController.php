<?php

require_once __DIR__ . '/../../../config/database.php';
require_once __DIR__ . '/../../repository/MedicaleRepository.php';

class MedicaleController 
{
    private $repository;
    
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $db = database::getInstance();
        $this->repository = new MedicaleRepository($db); 
    }

    public function handleRequest() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
            $jsonInput = file_get_contents('php://input');
            $decodedData = json_decode($jsonInput, true);
            
            if (is_array($decodedData)) {
                $_POST = $decodedData; 
            }
        }

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'POST') {
            $this->store();
        } elseif ($method === 'GET') {
            $this->index();
        } else {
            $this->sendResponse('error', 'Méthode non autorisée.');
        }
    }

    public function index() {
        try {
            $users = $this->repository->GetAllUsers(); 
            
            echo json_encode([
                'status' => 'success',
                'data' => $users
            ]);
            exit;
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Erreur Database: ' . $e->getMessage()
            ]);
            exit;
        }
    }

    public function store() 
    {
        $data = $_POST;

        if (!$data || empty($data)) {
            $this->sendResponse('error', 'Aucune donnée reçue ou échec de lecture.');
        }
        
        $name = isset($data['name']) ? htmlspecialchars(trim($data['name'])) : '';
        $email    = isset($data['email']) ? htmlspecialchars(trim($data['email'])) : '';
        $role     = isset($data['role']) ? htmlspecialchars(trim($data['role'])) : ''; 

        if (empty($name) || empty($email) || empty($role)) {
            $this->sendResponse('error', 'Tous les champs (Nom Complet, Adresse Email, Rôle) sont obligatoires.');
            exit;
        }

        try { 
            $this->repository->insertUser($name, $email, $role);
            
            $this->sendResponse('success', "L'utilisateur " . $name . " a été ajouté avec succès !");
        } catch (Exception $e) {
            $this->sendResponse('error', 'Erreur lors de l\'enregistrement: ' . $e->getMessage());
        }
    }

    private function sendResponse($status, $message) 
    {
        echo json_encode([
            'status' => $status,
            'message' => $message
        ]);
        exit; 
    }
}

$controller = new MedicaleController();
$controller->handleRequest();