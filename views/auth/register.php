<?php require '../templates/header.php'; ?>

    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Inscription</h1>
      
      <form method="POST" class="max-w-md">
        <div class="mb-4">
          <label class="block text-gray-700">Nom d'utilisateur</label>
          <input type="text" name="username" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Mot de passe</label>
          <input type="password" name="password" required class="w-full px-3 py-2 border rounded">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700">Confirmer le mot de passe</label>
          <input type="password" name="confirm_password" required class="w-full px-3 py-2 border rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          S'inscrire
        </button>
      </form>

      <div class="mt-4">
        <a href="/?route=login" class="text-blue-500 hover:text-blue-700">Déjà un compte ? Connectez-vous</a>
      </div>
    </div>

    <?php require '../templates/footer.php'; ?>
