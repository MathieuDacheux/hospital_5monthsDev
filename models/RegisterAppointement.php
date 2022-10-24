<?php

class RegisterAppointement extends Database {
    private $date;
    private $id;

    public function __construct($date, $id) {
        parent::__construct();
        $this->date = trim(filter_input(INPUT_POST, $date, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->id = trim(filter_input(INPUT_POST, $id, FILTER_SANITIZE_NUMBER_INT));
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
     * Retour l'ID du patient
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
     * Vérifie si l'ID du patient existe dans la base de données
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
     * Vérifie si la date du rendez-vous est disponible
     * @return bool
     */
    function verifyIfDatetimeIsAvailable () :bool {
        if ($this->validationInput($this->getDate(), REGEX_DATETIMELOCAL) == true) {
            $databaseConnection = parent::getPDO();
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
        $databaseConnection = parent::getPDO();
        var_dump(DateTime::createFromFormat('Y-m-d\ \H:i:s', $this->getDate()));
        $queryResult = $databaseConnection->prepare('INSERT INTO `appointments` (dateHour, idPatients) VALUES (:dateHour, :id);');
        $queryResult->bindValue(':dateHour', $this->getDate(), PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $queryResult->execute();
        return true;
    }
}