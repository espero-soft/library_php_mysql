<?php require 'templates/header.php'; ?>

<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Changer le mot de passe</h1>

  <form method="POST" class="max-w-md">
    <div class="mb-4">
      <label class="block text-gray-700">Mot de passe actuel</label>
      <input type="password" name="current_password" required class="w-full px-3 py-2 border rounded">
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Nouveau mot de passe</label>
      <input type="password" name="new_password" required class="w-full px-3 py-2 border rounded">
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Confirmer le nouveau mot de passe</label>
      <input type="password" name="confirm_new_password" required class="w-full px-3 py-2 border rounded">
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
      Changer le mot de passe
    </button>
  </form>
</div>

<?php require 'templates/footer.php'; ?>