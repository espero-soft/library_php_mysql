<?php require 'templates/header.php'; ?>

<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Mot de passe oublié</h1>

  <form method="POST" class="max-w-md">
    <div class="mb-4">
      <label class="block text-gray-700">Email</label>
      <input type="email" name="email" required class="w-full px-3 py-2 border rounded">
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
      Réinitialiser le mot de passe
    </button>
  </form>

  <div class="mt-4">
    <a href="/?route=login" class="text-blue-500 hover:text-blue-700">Retour à la connexion</a>
  </div>
</div>

<?php require 'templates/footer.php'; ?>