<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');
require_once(__DIR__.'/../helpers/functions.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/DisplayAll.php');
require_once(__DIR__.'/../models/RegisterAppointement.php');

// Appel des fonctions

// Variables
$title = HEAD_TITLE[3];
$description = HEAD_DESCRIPTION[3];

// Instanciation de la classe DisplayList
$displayPatient = new DisplayAll();

// Récupération des patients
$patientsList = $displayPatient->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Instanciation de la classe RegisterAppointement
    $registerAppointement = new RegisterAppointement('datetime', 'id');
    // Vérification de la validité des inputs
    if ($this->verifyIfIdExists() == true && $this->verifyIfDatetimeIsAvailable() == true) {
        if ($registerAppointement->addNewAppointement() == true) {
            // Redirection vers la page de liste des rendez-vous
            header('Location: /rendez_vous');
            exit();
        } else {
            $error = 'Le créneau horaire est déjà pris';
        }
    } else {
        $error = 'Les données fournies sont non conformes';
    }
}

// Appel des vues
include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/addAppointement.php');
include(__DIR__.'/../views/templates/footer.php');