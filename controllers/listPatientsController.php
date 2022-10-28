<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');
require_once(__DIR__.'/../helpers/functions.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/Patient.php');

// Appel des fonctions

// Variables
$title = HEAD_TITLE[1];
$description = HEAD_DESCRIPTION[1];
$style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/leftbar.css">
    <link rel="stylesheet" href="../public/css/listing.css">
    <link rel="stylesheet" href="../public/css/rightbar.css">';

$javascript = '<script defer src="../public/js/openModal.js"></script>
            <script defer src="../public/js/openNavbar.js"></script>';

// Récupération du nombre de pages avec la méthode statique howManyPages
$totalPages = Patient::howManyPages();
// Récupération de la page actuelle avec la méthode statique getPage
$page = Patient::setPage();
// Récupération de la liste des patients par page avec la méthode statique getByTen
$patientsList = Patient::getByTen();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Instanciation de la classe RegisterPatient
    $register = new Patient('firstName', 'lastName', 'birthDate', 'phone', 'mail', 'gender');
    // Validation des inputs soumis en méthode POST
    if (Database::validationInput($register->getFirstName(), REGEX_NAME) == true && 
    Database::validationInput($register->getLastName(), REGEX_NAME) == true && 
    Database::validationInput($register->getBirthDate(), REGEX_BIRTHDATE) == true && 
    Database::validationInput($register->getPhone(), REGEX_PHONE) == true && 
    Database::validationInput($register->getMail(), REGEX_MAIL) == true && 
    Database::validationInput($register->getGender(), REGEX_GENDER) == true) {
        // Ajout du patient dans la base de données
        if ($register->checkPatient() == true) {
            $confirmation = 'Le patient existe déjà';
        } else {
            $confirmation = 'Le patient a bien été ajouté';
        }
        // Affichage du message de succès
    } else {
        // Affichage du message d'erreur
        $error = 'Veuillez remplir correctement le formulaire';
    }
}

// Appel des vues
include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/listPatients.php');
include(__DIR__.'/../views/templates/footer.php');