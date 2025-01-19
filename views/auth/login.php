<?php require 'templates/header.php'; ?>

<div class="container mx-auto p-4">
  <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Connexion</h1>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?= $_SESSION['error'] ?>
      </div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Nom d'utilisateur</label>
        <input type="text" name="username" required
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 mb-2">Mot de passe</label>
        <input type="password" name="password" required
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <button type="submit"
        class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        Se connecter
      </button>

      <div class="mt-4 text-center">
        <a href="/?route=register" class="text-blue-500 hover:text-blue-700">
          Pas encore de compte ? S'inscrire
        </a>
      </div>

      <div class="mt-2 text-center">
        <a href="/?route=forgot_password" class="text-blue-500 hover:text-blue-700">
          Mot de passe oublié ?
        </a>
      </div>
    </form>
  </div>
</div>

<?php require 'templates/footer.php'; ?>