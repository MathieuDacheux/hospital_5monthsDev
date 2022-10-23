<?php

/**
 * Retourne le style CSS en fonction de l'URI de la page
 * @return string
 */
function whichCSS () :string {
    if ($_SERVER['REQUEST_URI'] == '/accueil') {
        $style = '<link rel="stylesheet" href="../../public/css/main.css">
                <link rel="stylesheet" href="../../public/css/addPatient.css">';
    }
    return $style;
}