<?php

class DisplaySpecific extends Database {
    private $id;

    public function __construct () {
        parent::__construct();
        $this->id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Retourne l'ID du patient
     * @return int
     */
    public function getId () :int {
        return intval($this->id, 10);
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

    /**
     * Vérifie si l'ID du patient existe
     * @return bool
     */
    public function verifyIfIdExists () :bool {
        if ($this->validationInput($this->getId(), REGEX_ID) == true) {
            $databaseConnection = parent::getPDO();
            $queryResult = $databaseConnection->prepare('SELECT `id` FROM `patients` WHERE `id` = '.$this->getId().' ;');
            $queryResult->execute();
            $result = $queryResult->fetch(PDO::FETCH_OBJ);
            if ($result != null) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
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

    /**
     * Update des informations du patient
     * @return bool
     */
    public function modifyInformation () :bool {
        // Connexion à la base de données
        $databaseConnection = parent::getPDO();
        // Requête SQL
        $result = $databaseConnection->query('UPDATE `patients` SET `phone` = "'.$_POST['phone'].'", `mail` = "'.$_POST['mail'].'" WHERE `id` = '.$this->getId());
        // Récupération du résultat
        $resultInformations = $result->fetch(PDO::FETCH_OBJ);
        return $resultInformations;
    }
}