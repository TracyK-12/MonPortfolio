-- 🚀 Création de la base de données
CREATE DATABASE IF NOT EXISTS data_nishboard CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE data_nishboard;

-- 👤 Table des utilisateurs (admin & employés)
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'employee') DEFAULT 'employee',
  profile_image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 🏢 Table des appartements
CREATE TABLE IF NOT EXISTS apartments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  address VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  status ENUM('disponible', 'occupé', 'maintenance') DEFAULT 'disponible',
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 📋 Table des tâches assignées
CREATE TABLE IF NOT EXISTS tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  description TEXT,
  assigned_to INT,
  due_date DATE,
  status ENUM('en_attente', 'en_cours', 'terminée') DEFAULT 'en_attente',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (assigned_to) REFERENCES users(id) ON DELETE SET NULL
);

-- 💬 Table des retours / feedback
CREATE TABLE IF NOT EXISTS feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  message TEXT NOT NULL,
  image VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 📁 Table des fichiers envoyés
CREATE TABLE IF NOT EXISTS uploads (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  file_name VARCHAR(255),
  file_path VARCHAR(255),
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 🔐 Utilisateur admin par défaut (mot de passe = "admin123")
-- Tu peux régénérer ce hash en PHP : password_hash("admin123", PASSWORD_BCRYPT);
INSERT INTO users (name, email, password, role) VALUES (
  'Admin', 
  'admin@nishappart.com', 
  '$2y$10$V3ldOmn1g0oMPE1qKPV5sOD5n4F5VDaX6iqVx5H5k2t1Z2bXv3LYi', 
  'admin'
);
-- table articles
CREATE TABLE articles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  category VARCHAR(100),
  quantity INT NOT NULL,
  alert_threshold INT DEFAULT 5,
  image VARCHAR(255),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);


-- 💬 Table des categories
CREATE TABLE IF NOT EXISTS categorie (
  id INT AUTO_INCREMENT PRIMARY KEY,
  
  name VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
 
);
-- table status
-- CREATE TABLE status (
--   id INT AUTO_INCREMENT PRIMARY KEY,
--   role VARCHAR(100) NOT NULL,
--   created_at DATETIME DEFAULT CURRENT_TIMESTAMP
-- );

-- table profile-image
-- CREATE TABLE profile_image (
--   id INT AUTO_INCREMENT PRIMARY KEY,
--   image VARCHAR(255) NOT NULL,
--   created_at DATETIME DEFAULT CURRENT_TIMESTAMP
-- );
✅ 1. Structure suggérée pour la table dashboard
La table peut stocker des statistiques ou des widgets configurables. Voici un exemple de structure simple :

🔧 Requête SQL pour créer la table :
sql
Copier
Modifier
CREATE TABLE dashboard (
  id INT AUTO_INCREMENT PRIMARY KEY,
  total_articles INT DEFAULT 0,
  low_stock_articles INT DEFAULT 0,
  total_users INT DEFAULT 0,
  total_feedbacks INT DEFAULT 0,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
✅ 2. Exemple de requêtes SQL
➕ Ajouter un enregistrement (INSERT) :
sql
Copier
Modifier
INSERT INTO dashboard (total_articles, low_stock_articles, total_users, total_feedbacks)
VALUES (20, 3, 5, 12);
📝 Mettre à jour les stats (UPDATE) :
sql
Copier
Modifier
UPDATE dashboard
SET total_articles = 25,
    low_stock_articles = 2,
    total_users = 6,
    total_feedbacks = 15,
    updated_at = NOW()
WHERE id = 1;
📥 Récupérer les stats (SELECT) :
sql
Copier
Modifier
SELECT * FROM dashboard ORDER BY updated_at DESC LIMIT 1;
✅ 3. Quand utiliser une vraie table dashboard ?
✅ Tu peux utiliser une vraie table dashboard si :

Tu veux enregistrer des snapshots d’activité à chaque jour/semaine/mois.

Tu veux afficher une évolution dans le temps (historique).

Tu veux charger plus vite le dashboard sans recalculer à chaque fois.

❌ Sinon, si tes données changent souvent, le mieux reste de calculer dynamiquement depuis article, user, feedback, etc. (comme dans la version précédente).