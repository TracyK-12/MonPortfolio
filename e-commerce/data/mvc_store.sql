CREATE DATABASE data_store;

USE data_store;

CREATE TABLE produit (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    categorie_id INT(11) NOT NULL,
    prix FLOAT NOT NULL
);
-- insertion de quelques produits dans la table produit
INSERT INTO produit (nom, description, categorie_id, prix) VALUES
('Ordinateur Portable', 'Ordinateur portable performant pour le travail et les loisirs', 1, 799.99),
('Smartphone', 'Smartphone avec écran AMOLED et grande autonomie', 1, 599.99),
('Casque Audio', 'Casque audio sans fil avec réduction de bruit', 2, 199.99),
('Télévision 4K', 'Télévision 4K UHD avec HDR pour une qualité d''image exceptionnelle', 3, 999.99),
('Tablette', 'Tablette légère et puissante pour la productivité et le divertissement', 1, 399.99);

-- creation de la table categorie avec les champs id (auto increment) et nom  et description
CREATE TABLE categorie (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL
);
-- insertion de quelques categories dans la table categorie
INSERT INTO categorie (nom, description) VALUES
('Informatique', 'Produits informatiques tels que ordinateurs, tablettes et accessoires'),
('Audio', 'Produits audio tels que casques, enceintes et systèmes audio'),
('Télévision', 'Produits de télévision tels que téléviseurs et accessoires'),
('Téléphonie', 'Produits de téléphonie tels que smartphones et accessoires'),
('Jeux Vidéo', 'Produits de jeux vidéo tels que consoles, jeux et accessoires');

-- Creation de la table utilisateur avec les champs id (auto increment), nom, prenom, email, password et statut
CREATE TABLE utilisateur (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    statut VARCHAR(50) NOT NULL  
);
--
-- Cette commande SQL modifie la table "produit" en ajoutant une nouvelle colonne appelée "image".
-- La colonne "image" est de type VARCHAR avec une longueur maximale de 255 caractères.
-- Elle accepte des valeurs NULL et a une valeur par défaut de NULL si aucune donnée n'est fournie.
ALTER TABLE produit ADD image VARCHAR(255) DEFAULT NULL;
