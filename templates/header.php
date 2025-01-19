<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion Bibliothèque</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script>
    function toggleMenu() {
      const menu = document.getElementById('mobile-menu');
      menu.classList.toggle('hidden');
    }
  </script>
</head>

<body class="bg-gray-100">
  <nav class="bg-blue-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center">
          <a href="/" class="text-white text-xl font-bold">Bibliothèque</a>
        </div>

        <!-- Menu Desktop -->
        <div class="hidden md:flex items-center space-x-4">
          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Accueil</a>
            <a href="/?route=mes-emprunts" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Mes Emprunts</a>
            <a href="/?route=profile" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Profil</a>
            <?php if ($_SESSION['role'] === 'admin'): ?>
              <a href="/?route=create" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Ajouter un livre</a>
              <a href="/?route=list_users" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Gérer les utilisateurs</a>
            <?php endif; ?>
            <a href="/?route=logout" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Déconnexion</a>
          <?php else: ?>
            <a href="/?route=login" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Connexion</a>
            <a href="/?route=register" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Inscription</a>
          <?php endif; ?>
        </div>

        <!-- Menu Mobile Button -->
        <div class="flex md:hidden">
          <button type="button" onclick="toggleMenu()" class="text-white hover:text-gray-300 focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Menu Mobile -->
    <div class="md:hidden hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="/" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700">Accueil</a>
          <a href="/?route=mes-emprunts" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700">Mes Emprunts</a>
          <a href="/?route=profile" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700">Profil</a>
          <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="/?route=create" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700">Ajouter un livre</a>
            <a href="/?route=list_users" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700">Gérer les utilisateurs</a>
          <?php endif; ?>
          <a href="/?route=logout" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700">Déconnexion</a>
        <?php else: ?>
          <a href="/?route=login" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700">Connexion</a>
          <a href="/?route=register" class="text-white block px-3 py-2 rounded-md text-base font-medium hover:bg-blue-700">Inscription</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <div class="container mx-auto p-4 min-h-screen">