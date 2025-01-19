<?php require 'templates/header.php'; ?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Liste des utilisateurs</h1>

    <?php if (!empty($users)): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">Nom d'utilisateur</th>
                        <th class="px-4 py-2">Prénom</th>
                        <th class="px-4 py-2">Nom de famille</th>
                        <th class="px-4 py-2">Rôle</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2"><?= htmlspecialchars($user['username']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($user['givenName']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($user['familyName']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($user['role']) ?></td>
                            <td class="border px-4 py-2">
                                <form method="POST" action="/?route=update_role">
                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                    <select name="role" class="border rounded px-2 py-1">
                                        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrateur</option>
                                    </select>
                                    <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 ml-2">
                                        Mettre à jour
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-gray-600">Aucun utilisateur trouvé.</p>
    <?php endif; ?>
</div>

<?php require 'templates/footer.php'; ?>