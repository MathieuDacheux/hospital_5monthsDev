<?php

// Appel des configurations
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../config/regex.php');
require_once(__DIR__.'/../helpers/functions.php');

// Appel des models
require_once(__DIR__.'/../models/Database.php');
require_once(__DIR__.'/../models/Patient.php');

// Variables
$title = HEAD_TITLE[0];
$description = HEAD_DESCRIPTION[0];
$getAllRequestPatients = 'SELECT `lastname`, `firstname`, `id` FROM `patients` ORDER BY `id` DESC';
$getAllRequestAppointments = 'SELECT `dateHour`, `idPatients`, `id` FROM `appointments` ORDER BY `id` DESC';



// Appel de la méthode statique getAll
$patients = RegisterPatient::getAll($getAllRequestPatients);
$appointment = $displayAll->getAll($getAllRequestAppointments);

// Appel des vues

include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/templates/main.php');
include(__DIR__.'/../views/templates/footer.php');