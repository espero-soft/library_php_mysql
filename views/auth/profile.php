<?php require 'templates/header.php'; ?>

<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Profil</h1>

  <div class="bg-white p-6 rounded-lg shadow-md max-w-md">
    <div class="mb-4">
      <label class="block text-gray-700 font-bold">Nom d'utilisateur</label>
      <p class="text-gray-800"><?= htmlspecialchars($_SESSION['username']) ?></p>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 font-bold">Rôle</label>
      <p class="text-gray-800"><?= htmlspecialchars($_SESSION['role']) ?></p>
    </div>

    <div class="mt-6">
      <a href="/?route=change_password" class="text-blue-500 hover:text-blue-700">
        Changer le mot de passe
      </a>
    </div>
  </div>
</div>

<?php require 'templates/footer.php'; ?>