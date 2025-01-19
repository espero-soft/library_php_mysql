<?php require 'templates/header.php'; ?>

<div class="p-4">
  <h1 class="text-2xl font-bold mb-4">Liste des livres</h1>

  <?php if (!empty($livres)): ?>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2">Titre</th>
            <th class="px-4 py-2">Auteur</th>
            <th class="px-4 py-2">Année</th>
            <th class="px-4 py-2">ISBN</th>
            <th class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($livres as $livre): ?>
            <tr class="hover:bg-gray-50">
              <td class="border px-4 py-2"><?= htmlspecialchars($livre['titre']) ?></td>
              <td class="border px-4 py-2"><?= htmlspecialchars($livre['auteur']) ?></td>
              <td class="border px-4 py-2"><?= htmlspecialchars($livre['annee']) ?></td>
              <td class="border px-4 py-2"><?= htmlspecialchars($livre['isbn']) ?></td>
              <td class="border px-4 py-2">
                <?php if (isset($_SESSION['user_id'])): ?>
                  <a href="/?route=emprunter&id=<?= $livre['id'] ?>" class="text-blue-500 hover:text-blue-700">Emprunter</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                  <a href="/?route=edit&id=<?= $livre['id'] ?>" class="text-blue-500 hover:text-blue-700 ml-2">Modifier</a>
                  <a href="/?route=delete&id=<?= $livre['id'] ?>" class="text-red-500 hover:text-red-700 ml-2">Supprimer</a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <p class="text-gray-600">Aucun livre trouvé.</p>
  <?php endif; ?>

  <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <div class="mt-4">
      <a href="/?route=create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Ajouter un livre
      </a>
    </div>
  <?php endif; ?>
</div>

<?php require 'templates/footer.php'; ?>