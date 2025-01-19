<?php require 'templates/header.php'; ?>

<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Profil</h1>

  <div class="bg-white p-6 rounded-lg shadow-md max-w-md">
    <?php if ($user['picture']): ?>
      <img src="<?= htmlspecialchars($user['picture']) ?>"
        alt="Profile picture"
        class="w-32 h-32 rounded-full mx-auto mb-4">
    <?php endif; ?>

    <div class="mb-4">
      <label class="block text-gray-700 font-bold">Nom d'utilisateur</label>
      <p class="text-gray-800"><?= htmlspecialchars($user['username']) ?></p>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 font-bold">Prénom</label>
      <p class="text-gray-800"><?= htmlspecialchars($user['givenName']) ?></p>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 font-bold">Nom de famille</label>
      <p class="text-gray-800"><?= htmlspecialchars($user['familyName']) ?></p>
    </div>

    <div class="mb-4">
      <label class="block text-gray-700 font-bold">Email</label>
      <p class="text-gray-800"><?= htmlspecialchars($user['email']) ?></p>
    </div>

    <div class="mt-6">
      <a href="/?route=edit_profile"
        class="text-blue-500 hover:text-blue-700">
        Modifier le profil
      </a>
    </div>
  </div>
</div>

<?php require 'templates/footer.php'; ?>