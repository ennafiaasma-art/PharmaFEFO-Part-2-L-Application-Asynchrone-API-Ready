CREATE DATABASE pharmafefo;
USE pharmafefo;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','pharmacien','preparateur') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE medicaments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    code VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE lots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    medicament_id INT NOT NULL,
    batchNumero VARCHAR(100) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    expirationDate DATE NOT NULL,
    status ENUM(
        'OK',
        'WARNING',
        'CRITICAL',
        'EXPIRED'
    ) DEFAULT 'OK',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_lot_medicament
    FOREIGN KEY (medicament_id)
    REFERENCES medicaments(id)
    ON DELETE CASCADE
);


CREATE TABLE alertes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lot_id INT NOT NULL,
    message TEXT NOT NULL,

    niveau ENUM(
        'VERT',
        'ORANGE',
        'ROUGE'
    ) NOT NULL,

    dateCreation DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_alerte_lot
    FOREIGN KEY (lot_id)
    REFERENCES lots(id)
    ON DELETE CASCADE
);



CREATE TABLE mouvement_stock (
    id INT AUTO_INCREMENT PRIMARY KEY,

    lot_id INT NOT NULL,

    type ENUM(
        'ENTREE',
        'SORTIE'
    ) NOT NULL,

    quantite INT NOT NULL,

    dateMouvement DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_mouvement_lot
    FOREIGN KEY (lot_id)
    REFERENCES lots(id)
    ON DELETE CASCADE
);


INSERT INTO users(name,email,password,role)
VALUES
('Admin','admin@gmail.com','123456','admin'),
('Pharmacien','pharma@gmail.com','123456','pharmacien'),
('Preparateur','prep@gmail.com','123456','preparateur');

INSERT INTO medicaments(name,code,description)
VALUES
('Paracetamol','MED001','Antalgique'),
('Amoxicilline','MED002','Antibiotique');

INSERT INTO lots(
    medicament_id,
    batchNumero,
    quantity,
    expirationDate,
    status
)
VALUES
(1,'LOT001',100,'2026-12-01','OK'),
(1,'LOT002',50,'2026-08-01','WARNING'),
(2,'LOT003',30,'2026-07-01','CRITICAL');

INSERT INTO alertes(
    lot_id,
    message,
    niveau
)
VALUES
(2,'Lot proche de la péremption','ORANGE'),
(3,'Lot critique à traiter rapidement','ROUGE');

INSERT INTO mouvement_stock(
    lot_id,
    type,
    quantite
)
VALUES
(1,'ENTREE',100),
(2,'ENTREE',50),
(3,'ENTREE',30);