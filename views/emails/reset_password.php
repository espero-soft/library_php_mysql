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
            Reset Password Confirmation
        </div>

        <div class="content">
            <p>Bonjour <?= htmlspecialchars($user['givenName'] . ' ' . $user['familyName']) ?>,</p>
            <p>Vous avez demandé à réinitialiser votre mot de passe.</p>
            <p>Merci de cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>

            <div style="margin: 20px 0;">
                <a href="<?= $resetLink ?>">Réinitialiser mon mot de passe</a>
            </div>

            <p>Si vous n'avez pas demandé à réinitialiser votre mot de passe, vous pouvez ignorer cet email.</p>
            <p>Ce lien expirera dans 1 heure.</p>

            <p>À bientôt !</p>
            <p>Merci de votre confiance.</p>
        </div>

        <div class="footer">
            <p>Bibliothèque - © <?= date('Y') ?></p>
        </div>
    </div>
</body>

</html>