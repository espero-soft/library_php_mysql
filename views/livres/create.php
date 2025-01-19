<?php require 'templates/header.php'; ?>

<div class="container mx-auto p-4">
  <h1 class="text-2xl font-bold mb-4">Ajouter un livre</h1>

  <form method="POST" class="max-w-md">
    <div class="mb-4">
      <label class="block text-gray-700">Titre</label>
      <input type="text" name="titre" required class="w-full px-3 py-2 border rounded">
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Auteur</label>
      <input type="text" name="auteur" required class="w-full px-3 py-2 border rounded">
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">Année</label>
      <input type="number" name="annee" required class="w-full px-3 py-2 border rounded">
    </div>

    <div class="mb-4">
      <label class="block text-gray-700">ISBN</label>
      <input type="text" name="isbn" required class="w-full px-3 py-2 border rounded">
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
      Ajouter
    </button>
  </form>
</div>

<?php require 'templates/footer.php'; ?>