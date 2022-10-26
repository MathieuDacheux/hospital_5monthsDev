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

// Récupération du nombre de pages avec la méthode statique howManyPages
$totalPages = Patient::howManyPages();
// Récupération de la page actuelle avec la méthode statique getPage
$page = Patient::setPage();
// Récupération de la liste des patients par page avec la méthode statique getByTen
$patientsList = Patient::getByTen();

// Appel des vues
include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/listPatients.php');
include(__DIR__.'/../views/templates/footer.php');