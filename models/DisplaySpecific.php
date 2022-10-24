<?php

class DisplaySpecific extends Database {
    private $id;

    public function __construct () {
        parent::__construct();
        $this->id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS));
            $this->mail = trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL));
        }
    }

    /**
     * Retourne l'ID du patient
     * @return int
     */
    public function getId () :int {
        return intval($this->id, 10);
    }

    /**
     * Retourne le nouveau numéro de téléphone du patient
     * @return string
     */
    public function getPhone () :string {
        return $this->phone;
    }

    /**
     * Retourne la nouvelle email du patient
     * @return string
     */
    public function getMail () :string {
        return $this->mail;
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
        $result = $databaseConnection->query('UPDATE `patients` SET `phone` = "'.$this->getPhone().'", `mail` = "'.$this->getMail().'" WHERE `id` = '.$this->getId());
        // Récupération du résultat
        $resultInformations = $result->fetch(PDO::FETCH_OBJ);
        return $resultInformations;
    }
}