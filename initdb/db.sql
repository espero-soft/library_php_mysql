CREATE DATABASE IF NOT EXISTS bibliotheque;
    USE bibliotheque;

    CREATE TABLE livres (
      id INT AUTO_INCREMENT PRIMARY KEY,
      titre VARCHAR(255) NOT NULL,
      auteur VARCHAR(255) NOT NULL,
      annee YEAR NOT NULL,
      isbn VARCHAR(20) NOT NULL
    );

    CREATE TABLE users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(255) NOT NULL UNIQUE,
      password VARCHAR(255) NOT NULL,
      role ENUM('user', 'admin') DEFAULT 'user'
    );

    -- Ajouter la table des emprunts
    CREATE TABLE emprunts (
      id INT AUTO_INCREMENT PRIMARY KEY,
      livre_id INT NOT NULL,
      user_id INT NOT NULL,
      date_emprunt DATE NOT NULL,
      date_retour DATE NOT NULL,
      FOREIGN KEY (livre_id) REFERENCES livres(id),
      FOREIGN KEY (user_id) REFERENCES users(id)
    );

    -- Ajouter un index pour optimiser les recherches
    CREATE INDEX idx_emprunts_user ON emprunts(user_id);
    CREATE INDEX idx_emprunts_livre ON emprunts(livre_id);

    INSERT INTO livres (titre, auteur, annee, isbn) VALUES
    ('Le Petit Prince', 'Antoine de Saint-Exupéry', 1943, '9782070408504'),
    ('1984', 'George Orwell', 1949, '9782070368228'),
    ('Le Seigneur des Anneaux', 'J.R.R. Tolkien', 1954, '9782266282362');

    INSERT INTO users (username, password, role) VALUES
    ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
    ('user', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');
