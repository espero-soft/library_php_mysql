<!DOCTYPE html>
    <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Gestion Bibliothèque</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <style>
        .navbar {
          background-color: #1e40af;
          color: white;
          padding: 1rem;
        }
        .navbar a {
          color: white;
          margin-right: 1rem;
          text-decoration: none;
        }
        .navbar a:hover {
          text-decoration: underline;
        }
      </style>
    </head>
    <body>
      <nav class="navbar">
        <div class="container mx-auto flex justify-between items-center">
          <a href="/" class="text-xl font-bold">Bibliothèque</a>
          <div>
            <?php if (isset($_SESSION['user_id'])): ?>
              <span>Bienvenue, <?= htmlspecialchars($_SESSION['username'] ?? 'Utilisateur') ?></span>
              <a href="/?route=logout" class="ml-4">Déconnexion</a>
            <?php else: ?>
              <a href="/?route=login">Connexion</a>
            <?php endif; ?>
          </div>
        </div>
      </nav>
      <div class="container mx-auto">
