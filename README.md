# Gestion de Bibliothèque - PHP/MySQL

![Badge](https://img.shields.io/badge/version-1.0.0-blue)
![Badge](https://img.shields.io/badge/license-MIT-green)
![Badge](https://img.shields.io/badge/php-8.2+-brightgreen)
![Badge](https://img.shields.io/badge/mysql-8.0+-orange)

## 📖 Description

Application web de gestion de bibliothèque développée en PHP avec MySQL comme base de données. Cette application permet :

- La gestion des livres (CRUD)
- L'authentification des utilisateurs (admin/user)
- L'emprunt de livres pour 15 jours
- La gestion des profils utilisateurs
- La réinitialisation de mot de passe

## 🚀 Fonctionnalités

### Pour tous les utilisateurs

- Inscription et connexion
- Réinitialisation de mot de passe
- Consultation des livres disponibles
- Emprunt de livres (connecté seulement)

### Pour les utilisateurs connectés

- Visualisation des emprunts en cours
- Modification du profil
- Changement de mot de passe

### Pour les administrateurs

- Gestion complète des livres (ajout, modification, suppression)
- Visualisation de tous les emprunts

## 🛠️ Installation

### Pré-requis

- Docker et Docker Compose installés
- PHP 8.2+
- MySQL 8.0+
- Composer (pour les dépendances PHP)

### Étapes d'installation

1. Cloner le dépôt :

   ```bash
   git clone https://github.com/votre-utilisateur/gestion-library.git
   cd gestion-library
   ```

2. Configurer l'environnement :

   ```bash
   cp .env.example .env
   ```

3. Démarrer les containers Docker :

   ```bash
   docker-compose up -d
   ```

4. Installer les dépendances :

   ```bash
   docker-compose exec web composer install
   ```

5. Initialiser la base de données :

   ```bash
   docker-compose exec db mysql -u root -psecret library < initdb/db.sql
   ```

6. Accéder à l'application :
   - Application : http://localhost:8080
   - phpMyAdmin : http://localhost:8081

## 🧑‍💻 Utilisation

### Comptes par défaut

- Administrateur :
  - Identifiant : admin
  - Mot de passe : password
- Utilisateur standard :
  - Identifiant : user
  - Mot de passe : password

### Emprunt de livres

1. Connectez-vous avec un compte utilisateur
2. Naviguez dans la liste des livres
3. Cliquez sur "Emprunter" pour un livre disponible
4. Consultez vos emprunts dans "Mes emprunts"

### Gestion des livres (admin)

1. Connectez-vous avec le compte admin
2. Utilisez les boutons "Ajouter", "Modifier", "Supprimer"
3. Toutes les modifications sont immédiatement visibles

## 🗂️ Structure du projet

```
gestion-library/
├── app/
│   ├── Controllers/
│   ├── Models/
├── config/
├── initdb/
├── public/
├── templates/
├── views/
│   ├── auth/
│   ├── livres/
│   ├── emprunts/
├── .env.example
├── docker-compose.yml
├── Dockerfile
├── README.md
└── index.php
```

## ⚙️ Configuration

Modifiez le fichier `.env` pour configurer :

```env
DB_HOST=db
DB_NAME=library
DB_USER=root
DB_PASSWORD=secret
APP_ENV=development
APP_URL=http://localhost:8080
```

## 🧪 Tests

Pour exécuter les tests :

```bash
docker-compose exec web vendor/bin/phpunit
```

## 🤝 Contribution

1. Forker le projet
2. Créer une branche (`git checkout -b feature/AmazingFeature`)
3. Committer vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Pousser la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 🙏 Remerciements

- [Tailwind CSS](https://tailwindcss.com/) pour le style
- [Docker](https://www.docker.com/) pour l'environnement de développement
- [phpMyAdmin](https://www.phpmyadmin.net/) pour la gestion de la base de données

## 📧 Contact

Pour toute question ou suggestion, contactez :

- [contact@espero-soft.com](mailto:contact@espero-soft.com)
- [@votre-twitter](https://twitter.com/votre-twitter)
