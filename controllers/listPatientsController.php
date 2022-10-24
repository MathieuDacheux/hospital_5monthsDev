<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');
require_once(__DIR__.'/../helpers/functions.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/DisplayAll.php');

// Appel des fonctions

// Variables
$title = HEAD_TITLE[1];
$description = HEAD_DESCRIPTION[1];

$howManyPagesRequest = 'SELECT COUNT(`id`) as total FROM `patients` ;';
$getByTenRequest = 'SELECT * FROM `patients` ORDER BY `id` ASC LIMIT :numberPerPage OFFSET :offset';

// Instanciation de la classe DisplayList
$displayPatient = new DisplayAll();
// Récupération du nombre de pages
$totalPages = $displayPatient->howManyPages($howManyPagesRequest);
// Récupération de la page actuelle
$page = $displayPatient->setPage();
// Récupération de la liste des patients
$patientsList = $displayPatient->getByTen($getByTenRequest);

// Appel des vues
include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/listPatients.php');
include(__DIR__.'/../views/templates/footer.php');