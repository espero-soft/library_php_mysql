CREATE DATABASE IF NOT EXISTS library;
USE library;

CREATE TABLE livres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titre VARCHAR(255) NOT NULL,
  auteur VARCHAR(255) NOT NULL,
  annee INT NOT NULL,
  isbn VARCHAR(20) NOT NULL
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('user', 'admin') DEFAULT 'user',
  givenName VARCHAR(255),
  familyName VARCHAR(255),
  picture VARCHAR(255),
  email VARCHAR(255),
  reset_token VARCHAR(255),
  reset_token_expires DATETIME
);

CREATE TABLE emprunts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  livre_id INT NOT NULL,
  user_id INT NOT NULL,
  date_emprunt DATE NOT NULL,
  date_retour DATE NOT NULL,
  FOREIGN KEY (livre_id) REFERENCES livres(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE INDEX idx_emprunts_user ON emprunts(user_id);
CREATE INDEX idx_emprunts_livre ON emprunts(livre_id);

INSERT INTO livres (titre, auteur, annee, isbn) VALUES
('Le Petit Prince', 'Antoine de Saint-Exupéry', 1943, '9782070408504'),
('1984', 'George Orwell', 1949, '9782070368228'),
('Le Seigneur des Anneaux', 'J.R.R. Tolkien', 1954, '9782266282362'),
('Le Rouge et le Noir', 'Stendhal', 1830, '9782070408505'),
('Les Trois Mousquetaires', 'Alexandre Dumas', 1844, '9782070408506'),
('Voyage au bout de la nuit', 'Louis-Ferdinand Céline', 1932, '9782070368229'),
('Le Grand Meaulnes', 'Alain-Fournier', 1913, '9782070368230'),
('Les Misérables', 'Victor Hugo', 1862, '9782070368231'),
('Les Fleurs du Mal', 'Charles Baudelaire', 1857, '9782070368232'),
('Les Liaisons dangereuses', 'Pierre Choderlos de Laclos', 1782, '9782070368233');

INSERT INTO users (username, password, role, givenName, familyName, picture, email) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', 'Admin', 'User', 'https://example.com/admin.jpg', 'admin@example.com'),
('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'John', 'Doe', 'https://example.com/user.jpg', 'user@example.com'),
('jane_doe', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Jane', 'Doe', 'https://example.com/jane.jpg', 'jane.doe@example.com'),
('alice', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Alice', 'Smith', 'https://example.com/alice.jpg', 'alice.smith@example.com'),
('bob', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Bob', 'Johnson', 'https://example.com/bob.jpg', 'bob.johnson@example.com'),
('charlie', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Charlie', 'Brown', 'https://example.com/charlie.jpg', 'charlie.brown@example.com'),
('david', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'David', 'Wilson', 'https://example.com/david.jpg', 'david.wilson@example.com'),
('eve', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Eve', 'Davis', 'https://example.com/eve.jpg', 'eve.davis@example.com'),
('frank', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Frank', 'Miller', 'https://example.com/frank.jpg', 'frank.miller@example.com'),
('grace', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Grace', 'Lee', 'https://example.com/grace.jpg', 'grace.lee@example.com'),
('henry', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Henry', 'Martinez', 'https://example.com/henry.jpg', 'henry.martinez@example.com'),
('isabel', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Isabel', 'Garcia', 'https://example.com/isabel.jpg', 'isabel.garcia@example.com');

INSERT INTO emprunts (livre_id, user_id, date_emprunt, date_retour) VALUES
(1, 1, '2021-01-01', '2021-01-15'),
(2, 1, '2021-01-01', '2021-01-15'),
(3, 1, '2021-01-01', '2021-01-15');
