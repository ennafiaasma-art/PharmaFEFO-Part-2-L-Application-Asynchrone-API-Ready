<?php

require_once __DIR__ . '/../../../config/database.php';
// تأكد من أن الـ Repository يحتوي على الدوال الخاصة بالمستخدمين أو قم بتغيير المسار إذا كان هناك UserRepository
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
        // إذا كان الطلب قادماً بصيغة JSON، نقوم بقراءته وتحويله إلى مصفوفة PHP
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== false) {
            $jsonInput = file_get_contents('php://input');
            $decodedData = json_decode($jsonInput, true);
            
            if (is_array($decodedData)) {
                $_POST = $decodedData; // نملأ مصفوفة $_POST بالبيانات القادمة من الـ Fetch
            }
        }

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

    // جلب المستخدمين لعرضهم في جدول المستخدمين
    public function index() {
        try {
            // ملاحظة: تأكد أن هذه الدالة موجودة في الـ Repository الخاص بك لجلب المستخدمين
            // إذا كانت هناك دالة مثل getAllUsers() قم بتغييرها هنا
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

    // حفظ مستخدم جديد
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
        
        // استقبال بيانات المستخدم المتوافقة مع الفورم والجافا سكريبت
        $fullname = isset($data['fullname']) ? htmlspecialchars(trim($data['fullname'])) : '';
        $email    = isset($data['email']) ? htmlspecialchars(trim($data['email'])) : '';
        $role     = isset($data['role']) ? htmlspecialchars(trim($data['role'])) : ''; 

        // التحقق من أن حقول المستخدم ليست فارغة
        if (empty($fullname) || empty($email) || empty($role)) {
            $this->sendResponse('error', 'Tous les champs (Nom Complet, Adresse Email, Rôle) sont obligatoires.');
        }

        try { 
            // تأكد من وجود دالة insertUser بداخل الـ MedicaleRepository الخاص بك
            // إذا كانت الدالة بأسماء بارامترات مختلفة، قم بتعديلها هنا لتطابق الـ Repository
            $this->repository->insertUser($fullname, $email, $role);
            
            $this->sendResponse('success', "L'utilisateur " . $fullname . " a été ajouté avec succès !");
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