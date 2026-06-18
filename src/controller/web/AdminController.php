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
        $users = $this->repository->GetAllProducts();
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
    header('Content-Type: application/json');
    
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data) {
        parse_str($json, $data);
    }

    if (!$data || empty($data)) {
        $this->sendResponse('error', 'Aucune donnée reçue.');
    }
    
    $product_name    = isset($data['product_name']) ? htmlspecialchars(trim($data['product_name'])) : '';
    $product_lot     = isset($data['product_lot']) ? htmlspecialchars(trim($data['product_lot'])) : '';
    $date_expiration = $data['date_expiration'] ?? ''; 
    $quantity        = isset($data['stock']) ? htmlspecialchars(trim($data['stock'])) : ''; // تقرأ stock
    $Emplacement     = isset($data['emplacement']) ? htmlspecialchars(trim($data['emplacement'])) : ''; // تقرأ emplacement

    if (empty($product_name) || empty($product_lot) || empty($date_expiration) || empty($quantity) || empty($Emplacement)) {
        $this->sendResponse('error', 'Tous les champs (Médicament, Lot, Expiration, Quantité, Emplacement) sont obligatoires.');
    }

   try { 
    $this->repository->insertProduct($product_name, $product_lot, $date_expiration, $quantity, $Emplacement);
    $this->sendResponse('success', 'Le produit ' . $product_name . ' a été classé avec succès !');
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