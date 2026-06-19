<?php
require_once __DIR__ . '/../../config/Database.php';
class MedicaleRepository {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

   
    public function GetAllUsers() {
        try {
            $query = 'SELECT name, email, role FROM users ORDER BY name ASC';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();       
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur DB lors de la récupération: " . $e->getMessage());
        }
    }

   
    public function insertUser($name, $email, $role) {
        try {
            $checkQuery = 'SELECT COUNT(*) FROM users WHERE email = :email';
            $checkStmt = $this->pdo->prepare($checkQuery);
            $checkStmt->execute([':email' => $email]);
            if ($checkStmt->fetchColumn() > 0) {
                throw new Exception("Cette adresse email est déjà utilisée.");
            }

            $query = 'INSERT INTO users ( name, email, role) VALUES (:name, :email, :role)';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':name' => $name,
                ':email'    => $email,
                ':role'     => $role
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Erreur DB lors de l'insertion: " . $e->getMessage());
        }
    } }