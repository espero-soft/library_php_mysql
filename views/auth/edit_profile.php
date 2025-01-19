<?php require 'templates/header.php'; ?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Modifier le profil</h1>

    <form method="POST" class="max-w-md">
        <div class="mb-4">
            <label class="block text-gray-700">Prénom</label>
            <input type="text" name="givenName"
                value="<?= htmlspecialchars($user['givenName'] ?? '') ?>"
                class="w-full px-3 py-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Nom de famille</label>
            <input type="text" name="familyName"
                value="<?= htmlspecialchars($user['familyName'] ?? '') ?>"
                class="w-full px-3 py-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Photo de profil (URL)</label>
            <input type="url" name="picture"
                value="<?= htmlspecialchars($user['picture'] ?? '') ?>"
                class="w-full px-3 py-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email"
                value="<?= htmlspecialchars($user['email'] ?? '') ?>"
                class="w-full px-3 py-2 border rounded">
        </div>

        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Enregistrer les modifications
        </button>
    </form>
</div>

<?php require 'templates/footer.php'; ?>