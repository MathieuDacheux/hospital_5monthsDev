<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');
require_once(__DIR__.'/../helpers/functions.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/Profil.php');

// Appel des fonctions

// Variables
$title = HEAD_TITLE[2];
$description = HEAD_DESCRIPTION[2];

// Instanciation de la classe Profil
$profil = new Profil();

// Filtrage de l'ID reçu en GET
if ($profil->validationInput($profil->getId(), REGEX_ID) == true) {
    // Si la donnée est valide, récupération des informations du patient
    $patient = $profil->patientInformations();
    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($profil->validationInput($_POST['phone'], REGEX_PHONE) == true &&
        $profil->validationInput($_POST['mail'], REGEX_MAIL) == true) {
            $profil->modifyInformation();
            // Redirection vers la page de profil du patient
            header('Location: /profil?id='.$profil->getId());
            exit();
        } else {
            // Message d'erreur 
            $error = 'Veuillez remplir correctement les champs';
        }
    }
} else {
    // Redirection vers le listing de tous les patients
    header('Location: /patients');
    exit();
}

// Appel des vues
include(__DIR__.'/../views/templates/header.php');
if (isset($_GET['modify'])) {
    include(__DIR__.'/../views/profilPatientsModify.php');
} else {
    include(__DIR__.'/../views/profilPatients.php');
}

include(__DIR__.'/../views/templates/footer.php');