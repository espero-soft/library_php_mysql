<?php require 'templates/header.php'; ?>

<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Mes emprunts</h1>

  <?php if (!empty($emprunts)): ?>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2">Titre</th>
            <th class="px-4 py-2">Auteur</th>
            <th class="px-4 py-2">Date d'emprunt</th>
            <th class="px-4 py-2">Date de retour</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($emprunts as $emprunt): ?>
            <tr class="hover:bg-gray-50">
              <td class="border px-4 py-2"><?= htmlspecialchars($emprunt['titre']) ?></td>
              <td class="border px-4 py-2"><?= htmlspecialchars($emprunt['auteur']) ?></td>
              <td class="border px-4 py-2"><?= htmlspecialchars($emprunt['date_emprunt']) ?></td>
              <td class="border px-4 py-2"><?= htmlspecialchars($emprunt['date_retour']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <p class="text-gray-600">Vous n'avez aucun emprunt en cours.</p>
  <?php endif; ?>
</div>

<?php require 'templates/footer.php'; ?>