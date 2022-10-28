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
    <link rel="stylesheet" href="../public/css/dashboard.css">
    <link rel="stylesheet" href="../public/css/rightbar.css">';

$javascript = '<script defer src="../public/js/openModal.js"></script>
        <script defer src="../public/js/openNavbar.js"></script>';

// Appel de la méthode statique getAll de la classe Patient
$patients = Patient::getAll();

// Appel de la méthode statique getAll de la classe Appointment
$appointments = Appointment::getAll();

// Appel des vues

include(__DIR__.'/../views/templates/header.php');
include(__DIR__.'/../views/templates/main.php');
include(__DIR__.'/../views/templates/footer.php');