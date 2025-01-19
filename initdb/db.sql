CREATE DATABASE IF NOT EXISTS library CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE library;

CREATE TABLE livres (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titre VARCHAR(255) NOT NULL,
  auteur VARCHAR(255) NOT NULL,
  annee INT NOT NULL,
  isbn VARCHAR(20) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY (isbn)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

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
  reset_token_expires DATETIME,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE emprunts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  livre_id INT NOT NULL,
  user_id INT NOT NULL,
  date_emprunt DATE NOT NULL,
  date_retour DATE NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (livre_id) REFERENCES livres(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE email_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  email VARCHAR(255) NOT NULL,
  subject VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  data TEXT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  status ENUM('sent', 'failed') DEFAULT 'sent',
  FOREIGN KEY (user_id) REFERENCES users(id)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

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
('Les Liaisons dangereuses', 'Pierre Choderlos de Laclos', 1782, '9782070368233'),
('La Chartreuse de Parme', 'Stendhal', 1839, '9782070368234'),
('Les Thibault', 'Roger Martin du Gard', 1922, '9782070368235'),
('Les Rois maudits', 'Maurice Druon', 1955, '9782070368236'),
('Les Fourberies de Scapin', 'Molière', 1671, '9782070368237'),
('Les Confessions', 'Jean-Jacques Rousseau', 1782, '9782070368238'),
('Les Essais', 'Michel de Montaigne', 1580, '9782070368239'),
('Les Caractères', 'Jean de La Bruyère', 1688, '9782070368240'),
('Madame Bovary', 'Gustave Flaubert', 1857, '9782070368241'),
('À la recherche du temps perdu', 'Marcel Proust', 1913, '9782070368242'),
('Le Comte de Monte-Cristo', 'Alexandre Dumas', 1844, '9782070368243'),
('Candide', 'Voltaire', 1759, '9782070368244'),
('Les Misérables', 'Victor Hugo', 1862, '9782070368245'),
('Le Père Goriot', 'Honoré de Balzac', 1835, '9782070368246'),
('Germinal', 'Émile Zola', 1885, '9782070368247'),
('La Peste', 'Albert Camus', 1947, '9782070368248'),
('Les Mains sales', 'Jean-Paul Sartre', 1948, '9782070368249'),
('Le Deuxième Sexe', 'Simone de Beauvoir', 1949, '9782070368250'),
('Les Enfants terribles', 'Jean Cocteau', 1929, '9782070368251'),
('La Condition humaine', 'André Malraux', 1933, '9782070368252'),
('Le Silence de la mer', 'Vercors', 1942, '9782070368253'),
('La Nausée', 'Jean-Paul Sartre', 1938, '9782070368254'),
('Les Mandarins', 'Simone de Beauvoir', 1954, '9782070368255'),
('La Symphonie pastorale', 'André Gide', 1919, '9782070368256'),
('Le Diable au corps', 'Raymond Radiguet', 1923, '9782070368257'),
('La Jalousie', 'Alain Robbe-Grillet', 1957, '9782070368258');

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
('isabel', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Isabel', 'Garcia', 'https://example.com/isabel.jpg', 'isabel.garcia@example.com'),
('jack', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Jack', 'White', 'https://example.com/jack.jpg', 'jack.white@example.com'),
('karen', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Karen', 'Taylor', 'https://example.com/karen.jpg', 'karen.taylor@example.com'),
('leo', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Leo', 'Harris', 'https://example.com/leo.jpg', 'leo.harris@example.com'),
('mia', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Mia', 'Clark', 'https://example.com/mia.jpg', 'mia.clark@example.com'),
('noah', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Noah', 'Lewis', 'https://example.com/noah.jpg', 'noah.lewis@example.com'),
('olivia', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Olivia', 'Walker', 'https://example.com/olivia.jpg', 'olivia.walker@example.com'),
('peter', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Peter', 'Hall', 'https://example.com/peter.jpg', 'peter.hall@example.com'),
('quinn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Quinn', 'Allen', 'https://example.com/quinn.jpg', 'quinn.allen@example.com'),
('rachel', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Rachel', 'Young', 'https://example.com/rachel.jpg', 'rachel.young@example.com'),
('sam', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Sam', 'King', 'https://example.com/sam.jpg', 'sam.king@example.com'),
('tina', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Tina', 'Wright', 'https://example.com/tina.jpg', 'tina.wright@example.com'),
('ursula', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Ursula', 'Lopez', 'https://example.com/ursula.jpg', 'ursula.lopez@example.com'),
('victor', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Victor', 'Hill', 'https://example.com/victor.jpg', 'victor.hill@example.com'),
('wendy', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Wendy', 'Scott', 'https://example.com/wendy.jpg', 'wendy.scott@example.com'),
('xander', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Xander', 'Green', 'https://example.com/xander.jpg', 'xander.green@example.com'),
('yara', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Yara', 'Adams', 'https://example.com/yara.jpg', 'yara.adams@example.com'),
('zach', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Zach', 'Baker', 'https://example.com/zach.jpg', 'zach.baker@example.com'),
('amy', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Amy', 'Nelson', 'https://example.com/amy.jpg', 'amy.nelson@example.com'),
('ben', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', 'Ben', 'Carter', 'https://example.com/ben.jpg', 'ben.carter@example.com');

INSERT INTO emprunts (livre_id, user_id, date_emprunt, date_retour) VALUES
(1, 1, '2021-01-01', '2021-01-15'),
(2, 1, '2021-01-01', '2021-01-15'),
(3, 1, '2021-01-01', '2021-01-15');
