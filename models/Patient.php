<?php

class RegisterPatient extends Database {

    // Propriétés
    private $firstname;
    private $lastname;
    private $birthdate;
    private $phone;
    private $mail;
    private $gender;
    private $numberPerPage;
    private $page;

    public function __construct($firstname, $lastname, $birthdate, $phone, $mail, $gender) {
        parent::__construct();
        $this->firstname = trim(filter_input(INPUT_POST, $firstname, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->lastname = trim(filter_input(INPUT_POST, $lastname, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->birthdate = trim(filter_input(INPUT_POST, $birthdate, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->phone = trim(filter_input(INPUT_POST, $phone, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->mail = trim(filter_input(INPUT_POST, $mail, FILTER_SANITIZE_EMAIL));
        $this->gender = trim(filter_input(INPUT_POST, $gender, FILTER_SANITIZE_NUMBER_INT));
        $this->numberPerPage = 10;
        $this->page = 1;
    }

    /**
     * Retourne le prénom du patient
     * @return string
     */
    public function getFirstName() :string {
        return $this->firstname;
    }

    /**
     * Retourne le nom du patient
     * @return string
     */
    public function getLastName() :string {
        return $this->lastname;
    }

    /**
     * Retourne la date de naissance du patient
     * @return string
     */
    public function getBirthDate() :string {
        return $this->birthdate;
    }

    /**
     * Retourne le numéro de téléphone du patient
     * @return string
     */
    public function getPhone() :string {
        return $this->phone;
    }

    /**
     * Retourne l'adresse mail du patient
     * @return string
     */
    public function getMail() :string {
        return $this->mail;
    }

    /**
     * Retourne le genre du patient
     * @return string
     */
    public function getGender() :string {
        return $this->gender;
    }

    /**
     * Retourne le nombre d'éléments par page
     * @return int
     */
    public function getNumberPerPage() :int {
        return $this->numberPerPage;
    }

    /**
     * Retourne le nombre de la page
     * @return int
     */
    public function getPage() :int {
        return $this->page;
    }


    //********************************************** **********************************************/
    //******************************************* CREATE ******************************************/
    //********************************************** **********************************************/
    
    /**
     * Ajout d'un patient dans la base de données
     * @param mixed $databaseConnection
     * 
     * @return bool
     */
    public function addPatient($databaseConnection) :bool {
        $query = $databaseConnection->prepare('INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`, `gender`) VALUES (:lastname, :firstname, :birthdate, :phone, :mail, :gender) ;');
        $query->bindValue(':lastname', $this->getLastName(), PDO::PARAM_STR);
        $query->bindValue(':firstname', $this->getFirstName(), PDO::PARAM_STR);
        $query->bindValue(':birthdate', $this->getBirthDate(), PDO::PARAM_STR);
        $query->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
        $query->bindValue(':mail', $this->getMail(), PDO::PARAM_STR);
        $query->bindValue(':gender', $this->getGender(), PDO::PARAM_STR);
        $result = $query->execute();
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Vérifie si le patient existe déjà dans la base de données
     * @return bool
     */
    public function checkPatient() :bool {
        $databaseConnection = parent::getPDO();
        $query = $databaseConnection->prepare('SELECT * FROM `patients` WHERE `lastname` = :lastname AND `firstname` = :firstname AND `birthdate` = :birthdate ;');
        $query->bindValue(':lastname', $this->getLastName(), PDO::PARAM_STR);
        $query->bindValue(':firstname', $this->getFirstName(), PDO::PARAM_STR);
        $query->bindValue(':birthdate', $this->getBirthDate(), PDO::PARAM_STR);
        $result = $query->execute();
        if ($result == true) {
            return true;
        } else {
            $this->addPatient($databaseConnection);
            return false;
        }
    }

    //********************************************** **********************************************/
    //******************************************* READ ********************************************/
    //********************************************** **********************************************/

    /**
     * Settings d'une nouvelle valeur pour page
     * @return int
     */
    public function setPage () :int {
        if (isset($_GET['page'])) {
            $input = filter_input(INPUT_GET , 'page', FILTER_SANITIZE_NUMBER_INT);
            if (parent::validationInput($input, REGEX_PAGE) == true) {
                $this->page = $input;
            } else {
                $this->page = 1;
            }
        } else {
            $this->page = 1;
        }
        return intval($this->page, 10);
    }

    /**
     * Retourne le nombre total de patients
     * @return int
     */
    public function howManyPages () :int {
        // Connexion à la base de données
        $databaseConnection = parent::getPDO();
        // Requête SQL
        $query = $databaseConnection->prepare('SELECT COUNT(`id`) as total FROM `patients` ;');
        $query->execute();
        // Récupération du résultat
        $resultTotal = $query->fetch(PDO::FETCH_OBJ);
        $totalPages = intdiv($resultTotal->total, $this->getNumberPerPage());
        return $totalPages;
    }

    /**
     * Retourne la liste des patients par page
     * @return array
     */
    public function getByTen () :array {
        // Connexion à la base de données
        $databaseConnection = parent::getPDO();
        // Requête SQL
        $query = $databaseConnection->prepare('SELECT * FROM `patients` ORDER BY `id` ASC LIMIT :numberPerPage OFFSET :offset');
        $query->bindValue(':numberPerPage', $this->getNumberPerPage(), PDO::PARAM_INT);
        $query->bindValue(':offset', ($this->getPage() - 1) * $this->getNumberPerPage(), PDO::PARAM_INT);
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
        $databaseConnection = parent::getPDO();
        // Requête SQL
        $query = $databaseConnection->prepare('SELECT `lastname`, `firstname`, `id` FROM `patients` ORDER BY `id` DESC ;');
        $query->execute();
        // Récupération du résultat
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

}