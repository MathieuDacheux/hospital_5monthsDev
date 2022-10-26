<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');
require_once(__DIR__.'/../helpers/functions.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/Patient.php');
require_once(__DIR__.'/../models/Appointment.php');

// Appel des fonctions

// Variables
$title = HEAD_TITLE[2];
$description = HEAD_DESCRIPTION[2];

if (Patient::verifyIfIdExists() == true) {
    // Si la donnée est valide, récupération des informations du patient
    $patient = Patient::specificInformations();
    // Récupération des rendez-vous du patient
    $appointments = Appointment::getAppointmentByPatient();
    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $profil = new Patient('lastName', 'firstName', 'birthDate', 'phone', 'mail', 'gender');
        if (Database::validationInput($profil->getLastName(), REGEX_NAME) == true &&
        Database::validationInput($profil->getFirstName(), REGEX_NAME) == true &&
        Database::validationInput($profil->getBirthDate(), REGEX_BIRTHDATE) == true &&
        Database::validationInput($profil->getPhone(), REGEX_PHONE) == true && 
        Database::validationInput($profil->getMail(), REGEX_MAIL) == true &&
        Database::validationInput($profil->getGender(), REGEX_GENDER) == true) {
            //Instanciation de l'objet patient
            // Modification des informations du patient
            $profil->modifyInformation(intval($_GET['id'], 10));
            // Redirection vers la page de profil du patient
            header('Location: /profil?id='.$_GET['id']);
            exit();
        } else {
            // Message d'erreur
            var_dump('Veuillez remplir correctement les champs');
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
    include(__DIR__.'/../views/profilPatientModify.php');
} else {
    include(__DIR__.'/../views/profilPatient.php');
}

include(__DIR__.'/../views/templates/footer.php');