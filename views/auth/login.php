<?php require '../templates/header.php'; ?>

    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Connexion</h1>
      
      <form method="POST" class="max-w-md">
        <div class="mb-4">
          <label class="block text-gray-700">Nom d'utilisateur</label>
          <input type="text" name="username" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Mot de passe</label>
          <input type="password" name="password" required class="w-full px-3 py-2 border rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          Se connecter
        </button>
      </form>
    </div>

    <?php require '../templates/footer.php'; ?>
