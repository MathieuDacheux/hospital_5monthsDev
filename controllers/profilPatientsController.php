<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');
require_once(__DIR__.'/../helpers/functions.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/displaySpecific.php');

// Appel des fonctions

// Variables
$title = HEAD_TITLE[2];
$description = HEAD_DESCRIPTION[2];

// Instanciation de la classe Profil
$profil = new DisplaySpecific();

// Filtrage de l'ID reçu en GET
$verifyIfIdExistsRequest = 'SELECT `id` FROM `patients` WHERE `id` = '.$profil->getId().' ;';
if ($profil->verifyIfIdExists($verifyIfIdExistsRequest) == true) {
    // Si la donnée est valide, récupération des informations du patient
    $specificInformationsRequest = 'SELECT * FROM `patients` WHERE `id` = '.$profil->getId().' ;';
    $patient = $profil->specificInformations($specificInformationsRequest);
    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($profil->validationInput($_POST['phone'], REGEX_PHONE) == true &&
        $profil->validationInput($_POST['mail'], REGEX_MAIL) == true) {
            // Modification des informations du patient
            $modifyInformationsRequest = 'UPDATE `patients` SET `phone` = "'.$profil->getPhone().'", `mail` = "'.$profil->getMail().'" WHERE `id` = '.$profil->getId().' ;';
            $profil->modifyInformation($modifyInformationsRequest);
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