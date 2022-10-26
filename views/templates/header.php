<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $description ?>">
    <link rel="stylesheet" href="../../public/css/main.css">
    <link rel="stylesheet" href="../../public/css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="../../public/assets/img/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&display=swap" rel="stylesheet">
    <title><?= $title ?></title>
</head>
<body>

<!-- Container du dashbord -->

<div class="containerDashboard">

    <!-- Début du header -->
    <header class="containerLeft flexCenterBetween">
        <div class="containerLogo flexCenterVertical">
            <a href="/accueil"><img src="../../public/assets/img/logo.png" alt="Logo du logiciel de gestion d'hopital"></a>
            <h3>CareUs</h3>
        </div>
        <nav class="mobileContainerLinks">
            <a class="openModal" href="#"><span class="containerBurger"></span></a>
            <ul class="mobileNavList flexCenterCenterColumn">
                <li>
                    <i class="fa-regular fa-square-check"></i>
                    <span><a href="">Rappels</a></span>
                </li>
                <li>
                    <i class="fa-regular fa-calendar"></i>
                    <span>Calendrier</span>
                </li>
                <li>
                    <i class="fa-regular fa-calendar"></i>
                    <span>Rendez-vous</span>
                </li>
                <li>
                    <i class="fa-regular fa-address-book"></i>
                    <span>Clients</span>
                </li>
                <li>
                    <i class="fa-solid fa-sliders"></i>
                    <span>Paramètres</span>
                </li>
            </ul>           
        </nav>
        <nav class="desktopContainerLinks">
            <ul>
                <div class="containerList">
                    <li>
                        <i class="fa-regular fa-calendar"></i>
                        <span><a href="/nouveau-rendez-vous">Ajout rendez-vous</a></span>
                        
                    </li>
                    <li>
                        <i class="fa-regular fa-address-book"></i>
                        <span><a href="/nouveau-patient">Ajout patient</a></span>
                    </li>
                </div>
                <div class="containerList">
                    <li>
                        <i class="fa-regular fa-calendar"></i>
                        <span><a href="/rendez-vous">Rendez-vous</a></span>
                    </li>
                    <li>
                        <i class="fa-regular fa-address-book"></i>
                        <span><a href="/patients">Patients</a></span>
                    </li>
                </div>
                <li>
                    <i class="fa-solid fa-sliders"></i>
                    <span>Paramètres</span>
                </li>
            </ul>
        </nav>            
    </header>