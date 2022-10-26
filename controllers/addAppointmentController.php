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
$title = HEAD_TITLE[3];
$description = HEAD_DESCRIPTION[3];
$getAllRequest = 'SELECT `lastname`, `firstname` FROM `patients` ORDER BY `lastname` ASC';

// Récupération des patients
$patientsList = Patient::getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Instanciation de la classe RegisterAppointement
    $registerAppointement = new Appointment('dateHour', 'id');
    if (Database::validationInput($registerAppointement->getDate(), REGEX_DATETIME) && 
    Database::validationInput($registerAppointement->getId(), REGEX_ID)) {
        if ($registerAppointement->idExists() == true) {
            if ($registerAppointement->datetimeIsAvailable() == true) {
                $registerAppointement->addAppointement();
                $confirmation = 'Le rendez-vous a bien été enregistré';
            } else {
                $error = 'La date et l\'heure du rendez-vous ne sont pas disponibles';
            }
        } else {
            $error = 'Le patient n\'existe pas';
        }
    } else {
        $error = 'Les données ne sont pas conformes';
    }
}

// Appel des vues
include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/addAppointement.php');
include(__DIR__.'/../views/templates/footer.php');