<?php

class Appointment {
    
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
        return date('Y-m-d H:i', strtotime($this->date));
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
        return $this->id;
    }

    //********************************************** **********************************************/
    //******************************************* CREATE ******************************************/
    //********************************************** **********************************************/

    /**
     * Vérifie si l'ID du patient existe dans la base de données
     * @return bool
     */
    public function idExists () :bool {
        $databaseConnection = Database::getPDO();
        $query = $databaseConnection->prepare('SELECT `id` FROM `patients` WHERE `id` = :id');
        $query->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if ($result != null) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Vérifie si la date du rendez-vous est disponible
     * @return bool
     */
    function datetimeIsAvailable () :bool {
        $databaseConnection = Database::getPDO();
        $query = $databaseConnection->prepare('SELECT `dateHour` FROM `appointments` WHERE `dateHour` = :dateHour');
        $query->bindValue(':dateHour', $this->getDate(), PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        if ($result != null) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Ajoute un nouveau rendez-vous dans la base de données
     * @return bool
     */
    public function addAppointement () :bool {
        $databaseConnection = Database::getPDO();
        $query = $databaseConnection->prepare('INSERT INTO `appointments` (dateHour, idPatients) VALUES (:dateHour, :id);');
        $query->bindValue(':dateHour', $this->getDate(), PDO::PARAM_STR);
        $query->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $query->execute();
        return true;
    }

    //********************************************** **********************************************/
    //******************************************* READ ********************************************/
    //********************************************** **********************************************/

    /**
     * Settings d'une nouvelle valeur pour page
     * @return int
     */
    public static function setPage () :int {
        if (isset($_GET['page'])) {
            $input = filter_input(INPUT_GET , 'page', FILTER_SANITIZE_NUMBER_INT);
            if (Database::validationInput($input, REGEX_PAGE) == true) {
                $page = $input;
            } else {
                $page = 1;
            }
        } else {
            $page = 1;
        }
        return intval($page, 10);
    }

    /**
     * Retourne le nombre total de patients
     * @return int
     */
    public static function howManyPages () :int {
        // Connexion à la base de données
        $databaseConnection = Database::getPDO();
        // Requête SQL
        $query = $databaseConnection->prepare('SELECT COUNT(`id`) as total FROM `appointments` ;');
        $query->execute();
        // Récupération du résultat
        $resultTotal = $query->fetch(PDO::FETCH_OBJ);
        $totalPages = intdiv($resultTotal->total, 10);
        if ($resultTotal->total % 10 != 0) {
            $totalPages++;
        }
        return $totalPages;
    }

    /**
     * Retourne la liste des patients par page
     * @return array
     */
    public static function getByTen () :array {
        // Connexion à la base de données
        $databaseConnection = Database::getPDO();
        // Requête SQL
        $query = $databaseConnection->prepare('SELECT `patients`.`lastname`, `patients`.`firstname`, `patients`.`id`, `appointments`.`dateHour` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` ORDER BY `dateHour` ASC LIMIT :numberPerPage OFFSET :offset ;');
        $query->bindValue(':numberPerPage', 10, PDO::PARAM_INT);
        $query->bindValue(':offset', (Appointment::howManyPages() - 1) * 10, PDO::PARAM_INT);
        $query->execute();
        // Récupération du résultat
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * Retourne tous les patients 
     * @return array
     */
    public static function getAll () :array {
        // Connexion à la base de données
        $databaseConnection = Database::getPDO();
        // Requête SQL
        $query = $databaseConnection->prepare('SELECT `patients`.`lastname`, `patients`.`firstname`, `patients`.`id` ,`dateHour` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` ORDER BY `dateHour` ;');
        $query->execute();
        // Récupération du résultat
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * Vérifie si l'ID du patient existe
     * @return bool
     */
    public static function verifyIfIdExists () :bool {
        if (Database::validationInput($_GET['id'] , REGEX_ID) == true) {
            $databaseConnection = Database::getPDO();
            $queryResult = $databaseConnection->prepare('SELECT `id` FROM `appointments` WHERE `id` = '.$_GET['id'].' ;');
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
     * Retourne les rendez-vous d'un patient
     * @return array
     */
    public static function getAppointmentByPatient () :array {
        if (Database::validationInput($_GET['id'] , REGEX_ID) == true) {
            $databaseConnection = Database::getPDO();
            $queryResult = $databaseConnection->prepare('SELECT `dateHour` FROM `appointments` WHERE `idPatients` = '.$_GET['id'].' ;');
            $queryResult->execute();
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } else {
            return false;
        }
    }
}