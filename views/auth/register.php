<?php require 'templates/header.php'; ?>

<div class="container mx-auto p-4">
  <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Inscription</h1>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <?= $_SESSION['error'] ?>
      </div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Prénom</label>
        <input type="text" name="givenName" required
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Nom de famille</label>
        <input type="text" name="familyName" required
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Email</label>
        <input type="email" name="email" required
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Nom d'utilisateur</label>
        <input type="text" name="username" required
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 mb-2">Mot de passe</label>
        <input type="password" name="password" required
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 mb-2">Confirmer le mot de passe</label>
        <input type="password" name="confirm_password" required
          class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>

      <button type="submit"
        class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        S'inscrire
      </button>

      <div class="mt-4 text-center">
        <a href="/?route=login" class="text-blue-500 hover:text-blue-700">
          Déjà un compte ? Connectez-vous
        </a>
      </div>
    </form>
  </div>
</div>

<?php require 'templates/footer.php'; ?>