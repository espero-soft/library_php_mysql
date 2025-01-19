<?php
// Initialisation des contrôleurs
require 'app/Controllers/AuthController.php';
require 'app/Controllers/LivreController.php';
require 'app/Controllers/EmpruntController.php';

$authController = new AuthController($userModel);
$livreController = new LivreController($livreModel);
$empruntController = new EmpruntController($empruntModel, $livreModel);
