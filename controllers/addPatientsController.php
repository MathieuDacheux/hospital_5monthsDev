<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/Register.php');

// Appel des fonctions

// Variables
$title = HEAD_TITLE[0];
$description = HEAD_DESCRIPTION[0];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $register = new Register('firstName', 'lastName', 'birthDate', 'phone', 'mail');
    if ($register->validationInput($register->getFirstName(), REGEX_NAME) == true && $register->validationInput($register->getLastName(), REGEX_NAME) == true && $register->validationInput($register->getBirthDate(), REGEX_BIRTHDATE) == true && $register->validationInput($register->getPhone(), REGEX_PHONE) == true && $register->validationInput($register->getMail(), REGEX_MAIL) == true) {
        $register->checkPatient();
    } else {
        $error = 'Veuillez remplir correctement le formulaire';
        echo $error;
    }
}

// Appel des vues

include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/addPatients.php');
include(__DIR__.'/../views/templates/footer.php');