<?php

class Profil extends Database {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Retourne l'ID du patient
     * @return int
     */
    public function getId() :int {
        return $this->id;
    }

    /**
     * Validation des inputs
     * @param mixed $input
     * @param mixed $REGEX
     * 
     * @return bool
     */
    public function validationInput ($input, $REGEX) :bool {
        if(empty($input)) {
            return false;
        } else {
            $isOk = filter_var($input, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $REGEX)));
            if (!$isOk) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function verifyIfIDExists() {
        if (validationInput($this->id, REGEX_ID) == true) {
        }
    }

    /**
     * Retourne les informations du patient
     * @return array
     */
    public function patientInformations () {
        // Connexion à la base de données
        $databaseConnection = parent::getPDO();
        // Requête SQL
        $result = $databaseConnection->query('SELECT * FROM `patients` WHERE `id` = '.$this->getId());
        // Récupération du résultat
        $resultInformations = $result->fetch(PDO::FETCH_OBJ);
        return $resultInformations;
    }

    public function modifyInformation () {
        // Connexion à la base de données
        $databaseConnection = parent::getPDO();
        // Requête SQL
        $result = $databaseConnection->query('UPDATE `patients` SET `phone` = "'.$_POST['phone'].'", `mail` = "'.$_POST['mail'].'" WHERE `id` = '.$this->getId());
        // Récupération du résultat
        $resultInformations = $result->fetch(PDO::FETCH_OBJ);
        return $resultInformations;
    }
}