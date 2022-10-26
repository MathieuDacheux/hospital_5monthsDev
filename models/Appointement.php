<?php

class Appointement {
    protected $date;
    protected $id;

    public function __construct($date, $id) {
        $this->date = trim(filter_input(INPUT_POST, $date, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->id = trim(filter_input(INPUT_POST, $id, FILTER_SANITIZE_NUMBER_INT));
    }

    //********************************************** **********************************************/
    //**************************************** SETTER/GETTER **************************************/
    //********************************************** **********************************************/

    /**
     * Settings de la date
     * @param mixed $date
     * 
     * @return [type]
     */
    public function setDate ($date) {
        $this->date = $date;
    }

    /**
     * Retourne la date du rendez-vous
     * @return string
     */
    public function getDate () :string {
        // convert date to Y-m-d H:m:s
        return $this->date;
    }

    /**
     * Settings de l'id du rendez-vous
     * @param mixed $id
     * 
     * @return [type]
     */
    public function setId ($id) {
        $this->id = $id;
    }
    
    /**
     * Retour l'ID du patient
     * @return int
     */
    public function getId () :int {
        return intval($this->id, 10);
    }

    /**
     * Vérifie si l'ID du patient existe dans la base de données
     * @return bool
     */
    public function verifyIfIdExists () :bool {
        if (Database::validationInput($this->getId(), REGEX_ID) == true) {
            $databaseConnection = Database::getPDO();
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
     * Vérifie si la date du rendez-vous est disponible
     * @return bool
     */
    function verifyIfDatetimeIsAvailable () :bool {
        if (Database::validationInput($this->getDate(), REGEX_DATETIMELOCAL) == true) {
            $databaseConnection = Database::getPDO();
            $queryResult = $databaseConnection->prepare('SELECT `dateHour` FROM `appointments` WHERE `dateHour` = "'.DateTime::createFromFormat('Y-m-d\ \H:i:s', $this->getDate()).'" ;');
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
     * Ajoute un nouveau rendez-vous dans la base de données
     * @return bool
     */
    public function addNewAppointement () :bool {
        $databaseConnection = Database::getPDO();
        $query = $databaseConnection->prepare('INSERT INTO `appointments` (dateHour, idPatients) VALUES (:dateHour, :id);');
        $query->bindValue(':dateHour', $this->getDate(), PDO::PARAM_STR);
        $query->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $query->execute();
        return true;
    }
}