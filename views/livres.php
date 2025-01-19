<?php
      $query = $pdo->query("SELECT * FROM livres");
      $livres = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="bg-white p-6 rounded-lg shadow">
      <table class="min-w-full">
        <thead>
          <tr>
            <th class="px-4 py-2">Titre</th>
            <th class="px-4 py-2">Auteur</th>
            <th class="px-4 py-2">Année</th>
            <th class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($livres as $livre): ?>
            <tr>
              <td class="border px-4 py-2"><?= $livre['titre'] ?></td>
              <td class="border px-4 py-2"><?= $livre['auteur'] ?></td>
              <td class="border px-4 py-2"><?= $livre['annee'] ?></td>
              <td class="border px-4 py-2">
                <a href="edit.php?id=<?= $livre['id'] ?>" class="text-blue-500 hover:text-blue-700">Modifier</a>
                <a href="delete.php?id=<?= $livre['id'] ?>" class="text-red-500 hover:text-red-700 ml-2">Supprimer</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
