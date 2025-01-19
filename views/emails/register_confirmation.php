<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #3b82f6;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .footer {
            background-color: #f3f4f6;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Confirmation d'emprunt</h1>
        </div>

        <div class="content">
            <p>Bonjour <?= htmlspecialchars($user['givenName'] . ' ' . $user['familyName']) ?>,</p>
            <p>Vous avez emprunté le livre suivant :</p>

            <div style="margin: 20px 0;">
                <p><strong>Titre :</strong> <?= htmlspecialchars($livre['titre']) ?></p>
                <p><strong>Auteur :</strong> <?= htmlspecialchars($livre['auteur']) ?></p>
                <p><strong>Date de retour :</strong> <?= $dateRetour ?></p>
            </div>

            <p>Merci de votre confiance.</p>
        </div>

        <div class="footer">
            <p>Bibliothèque - © <?= date('Y') ?></p>
        </div>
    </div>
</body>

</html>