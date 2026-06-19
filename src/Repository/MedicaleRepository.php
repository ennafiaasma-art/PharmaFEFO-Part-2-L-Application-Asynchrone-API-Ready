<?php
require_once __DIR__ . '/../../config/Database.php';

class MedicaleRepository{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo=$pdo;
    }
    public function insertProduct($batchNumero, $created_at, $expiratioDate, $quantity, $code) {
    try {
        $this->pdo->beginTransaction();
        $queryProduct = 'INSERT INTO medicaments (name, code,description,created_at) 
                         VALUES (:name, :description,:code, NOW())';        
        $stmtProduct = $this->pdo->prepare($queryProduct);
        $stmtProduct->execute([
            ':name'        => $batchNumero,
            ':code' => $code,
            ':description' => 'No description provided', 
        ]);
        $productId = $this->pdo->lastInsertId();
        
        if (!$productId) {
            throw new Exception("Impossible de récupérer l'ID du produit inséré.");
        }
        $queryLot = 'INSERT INTO lots (batchNumero, created_at, expiratioDate, quantity) 
                     VALUES (:batchNumero, :created_at, :expiratioDate, :quantity, NOW())';       
        $stmtLot = $this->pdo->prepare($queryLot);
        $stmtLot->execute([
            ':batchNumero'      => $batchNumero,      
            ':created_at'      => $created_at,
            ':expiratioDate' => $expiratioDate,
            ':quantity'        => $quantity,    
        ]);
        $this->pdo->commit();
        return true;
        
    } catch (PDOException $e) {
        if ($this->pdo->inTransaction()) {
            $this->pdo->rollBack();
        }
        throw new Exception("Erreur DB: " . $e->getMessage());
    }
}


 public function GetAllProducts() {
    try {
        $query = 'SELECT 
                    m.name AS product_name, 
                    m.code, 
                    l.batchNumero, 
                    l.expirationDate,  
                    l.status
                  FROM products p
                  INNER JOIN lots l ON m.id = l.medicament_id
                  ORDER BY l.expirationDate ASC';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();       
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException) {
        return [];
    }
}
}