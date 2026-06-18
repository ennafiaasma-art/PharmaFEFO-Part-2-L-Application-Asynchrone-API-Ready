<?php
require_once __DIR__ . '../../config/Database.php';

class MedicaleController{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo=$pdo;
    }
    public function insertProduct($product_name, $product_lot, $date_expiration, $quantity, $Emplacement) {
    try {
        $this->pdo->beginTransaction();
        $queryProduct = 'INSERT INTO medicaments (name, code,description,created_at) 
                         VALUES (:name, :description,:code, NOW())';        
        $stmtProduct = $this->pdo->prepare($queryProduct);
        $stmtProduct->execute([
            ':name'        => $product_name,
            ':code' => $Emplacement,
            ':description' => 'No description provided', 
        ]);
        $productId = $this->pdo->lastInsertId();
        
        if (!$productId) {
            throw new Exception("Impossible de récupérer l'ID du produit inséré.");
        }
        $queryLot = 'INSERT INTO lots (product_id, lot_number, expiratio_date, quantity,created_at) 
                     VALUES (:product_id, :lot_number, :expiration_date, :quantity, NOW())';       
        $stmtLot = $this->pdo->prepare($queryLot);
        $stmtLot->execute([
            ':product_id'      => $productId,      
            ':lot_number'      => $product_lot,
            ':expiration_date' => $date_expiration,
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
}