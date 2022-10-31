<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');
require_once(__DIR__.'/../helpers/functions.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/Patient.php');
require_once(__DIR__.'/../models/Appointment.php');

// Variables
$title = HEAD_TITLE[0];
$description = HEAD_DESCRIPTION[0];
$getAllRequestPatients = 'SELECT `lastname`, `firstname`, `id` FROM `patients` ORDER BY `id` DESC';
$getAllRequestAppointments = 'SELECT `dateHour`, `idPatients`, `id` FROM `appointments` ORDER BY `id` DESC';
$style = '<link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/leftbar.css">
    <link rel="stylesheet" href="../public/css/addAll.css">
    <link rel="stylesheet" href="../public/css/rightbar.css">';

$javascript = '<script defer src="../public/js/openNavbar.js"></script>';


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Instanciation de la classe RegisterPatient
    $register = new Patient('firstName', 'lastName', 'birthDate', 'phone', 'mail', 'gender');
    // Validation des inputs soumis en méthode POST
    if (Database::validationInput($register->getFirstName(), REGEX_NAME) == false) {
        $errorsRegistration['firstName'] = 'Données non conformes';
    }
    if (Database::validationInput($register->getLastName(), REGEX_NAME) == false) {
        $errorsRegistration['lastName'] = 'Données non conformes';
    }
    if (Database::validationInput($register->getBirthDate(), REGEX_BIRTHDATE) == false) {
        $errorsRegistration['birthDate'] = 'La date de naissance doit être au format JJ/MM/AAAA';
    }
    if (Database::validationInput($register->getPhone(), REGEX_PHONE) == false) {
        $errorsRegistration['phone'] = 'Le numéro de téléphone doit être au format 0123456789';
    }
    if (Database::validationInput($register->getMail(), REGEX_MAIL) == false) {
        $errorsRegistration['mail'] = 'L\'adresse mail n\'est pas valide';
    }
    if (Database::validationInput($register->getGender(), REGEX_GENDER) == false) {
        $errorsRegistration['gender'] = 'Le genre n\'est pas valide';
    }
    if (empty($errorsRegistration)) {
        // Ajout du patient dans la base de données
        if ($register->checkPatient() == true) {
            $isExist = true;
        } else {
            $confirmation = true;
        }
    } else {
        $confirmation = false;
    }
}

// Appel des vues

include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/addAll.php');
include(__DIR__.'/../views/templates/footer.php');