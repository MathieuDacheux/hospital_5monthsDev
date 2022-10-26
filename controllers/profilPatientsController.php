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
$title = HEAD_TITLE[2];
$description = HEAD_DESCRIPTION[2];

if (Patient::verifyIfIdExists() == true) {
    // Si la donnée est valide, récupération des informations du patient
    $patient = Patient::specificInformations();
    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (Database::validationInput($_POST['lastname'], REGEX_NAME) == true &&
        Database::validationInput($_POST['firstname'], REGEX_NAME) == true &&
        Database::validationInput($_POST['birthdate'], REGEX_BIRTHDATE) == true &&
        Database::validationInput($_POST['phone'], REGEX_PHONE) == true && 
        Database::validationInput($_POST['mail'], REGEX_MAIL) == true &&
        Database::validationInput($_POST['gender'], REGEX_GENDER) == true) {
            //Instanciation de l'objet patient
            $patient = new Patient('lastname', 'firstname', 'birthdate', 'phone', 'mail', 'gender');
            // Modification des informations du patient
            $modifyInformationsRequest = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail, `gender` = :gender WHERE `id` = :id';
            
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