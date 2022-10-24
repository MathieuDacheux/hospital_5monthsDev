<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');
require_once(__DIR__.'/../helpers/functions.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/DisplayList.php');

// Appel des fonctions

// Variables
$title = HEAD_TITLE[1];
$description = HEAD_DESCRIPTION[1];

// Instanciation de la classe DisplayList
$displayPatient = new DisplayPatient();
// Récupération du nombre de pages
$totalPages = $displayPatient->howManyPages();
// Récupération de la page actuelle
$page = $displayPatient->setPage();
// Récupération de la liste des patients
$patientsList = $displayPatient->getPatientsList();

// Appel des vues
include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/listPatients.php');
include(__DIR__.'/../views/templates/footer.php');