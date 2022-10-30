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
            <script defer src="../public/js/openNavbar.js"></script>
            <script defer src="../public/js/autoComplete.js"></script>
            <script defer src="../public/js/showResult.js"></script>';

// Récupération du nombre de pages avec la méthode statique howManyPages
$totalPages = Patient::howManyPages();
// Récupération de la page actuelle avec la méthode statique getPage
$page = Patient::setPage();
// Récupération de la liste des patients par page avec la méthode statique getByTen
$patientsList = Patient::getByTen();

if (isset ($_GET['search'])) {
    if (Database::validationInput($_GET['search'], REGEX_NAME) == true) {
        $name = $_GET['search'];
        if (Patient::searchByName($name) == true) {
            $patientsList = Patient::searchByName($name);
        } else {
            header('Location: /patients');
            exit();         
        }
    } else {
        header('Location: /patients');
        exit();
    }
}

if (isset ($_GET['id'])) {
    if (Database::validationInput($_GET['id'], REGEX_ID) == true) {
        $id = $_GET['id'];
        if (Appointment::verifyIfIdExists($id) == true) {
            Appointment::deleteAppointmentById($id);
            header('Location: /rendez-vous');
            exit();         
        } else {
            header('Location: /rendez-vous');
            exit();         
        }
    } else {
        header('Location: /rendez-vous');
        exit();
    }
}

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
include(__DIR__.'/../views/listPatients.php');
include(__DIR__.'/../views/templates/footer.php');