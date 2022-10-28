<?php

class Patient {

    // Propriétés
    protected $firstname;
    protected $lastname;
    protected $birthdate;
    protected $phone;
    protected $mail;
    protected $gender;

    public function __construct($firstname, $lastname, $birthdate, $phone, $mail, $gender) {
        $this->firstname = trim(filter_input(INPUT_POST, $firstname, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->lastname = trim(filter_input(INPUT_POST, $lastname, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->birthdate = trim(filter_input(INPUT_POST, $birthdate, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->phone = trim(filter_input(INPUT_POST, $phone, FILTER_SANITIZE_NUMBER_INT));
        $this->mail = trim(filter_input(INPUT_POST, $mail, FILTER_SANITIZE_EMAIL));
        $this->gender = trim(filter_input(INPUT_POST, $gender, FILTER_SANITIZE_NUMBER_INT));
    }

    //********************************************** **********************************************/
    //**************************************** SETTER/GETTER **************************************/
    //********************************************** **********************************************/

    /**
     * Settings du fistname
     * @param mixed $firstname
     * 
     * @return void
     */
    public function setFirstName ($firstname) :void {
        $this->firstname = trim(filter_input(INPUT_POST, $firstname, FILTER_SANITIZE_SPECIAL_CHARS));
    }

    /**
     * Retourne le prénom du patient
     * @return string
     */
    public function getFirstName () :string {
        return $this->firstname;
    }

    /**
     * Settings du lastname
     * @param mixed $lastname
     * 
     * @return void
     */
    public function setLastName ($lastname) :void {
        $this->lastname = trim(filter_input(INPUT_POST, $lastname, FILTER_SANITIZE_SPECIAL_CHARS));
    }


    /**
     * Retourne le nom du patient
     * @return string
     */
    public function getLastName () :string {
        return $this->lastname;
    }

    /**
     * Settings du birthdate
     * @param mixed $birthdate
     * 
     * @return void
     */
    public function setBirthDate ($birthdate) :void {
        $this->birthdate = trim(filter_input(INPUT_POST, $birthdate, FILTER_SANITIZE_SPECIAL_CHARS));
    } 

    /**
     * Retourne la date de naissance du patient
     * @return string
     */
    public function getBirthDate () :string {
        return $this->birthdate;
    }

    /**
     * Settings du phone
     * @param mixed $phone
     * 
     * @return void
     */
    public function setPhone ($phone) :void {
        $this->phone = trim(filter_input(INPUT_POST, $phone, FILTER_SANITIZE_NUMBER_INT));
    }

    /**
     * Retourne le numéro de téléphone du patient
     * @return string
     */
    public function getPhone () :string {
        return $this->phone;
    }

    /**
     * Settings du mail
     * @param mixed $mail
     * 
     * @return void
     */
    public function setMail ($mail) :void {
        $this->mail = trim(filter_input(INPUT_POST, $mail, FILTER_SANITIZE_EMAIL));
    }

    /**
     * Retourne l'adresse mail du patient
     * @return string
     */
    public function getMail () :string {
       return $this->mail;
    }

    /**
     * Settings du genre
     * @param mixed $gender
     * 
     * @return void
     */
    public function setGender ($gender) :void {
        $this->gender = trim(filter_input(INPUT_POST, $gender, FILTER_SANITIZE_NUMBER_INT));
    }
    
    /**
     * Retourne le genre du patient
     * @return string
     */
    public function getGender() :string {
        return $this->gender;
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
        $databaseConnection = Database::getPDO();
        $query = $databaseConnection->prepare('SELECT * FROM `patients` WHERE `lastname` = :lastname AND `firstname` = :firstname AND `birthdate` = :birthdate ;');
        $query->bindValue(':lastname', $this->getLastName(), PDO::PARAM_STR);
        $query->bindValue(':firstname', $this->getFirstName(), PDO::PARAM_STR);
        $query->bindValue(':birthdate', $this->getBirthDate(), PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
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
        $query = $databaseConnection->prepare('SELECT COUNT(`id`) as total FROM `patients` ;');
        $query->execute();
        // Récupération du résultat
        $resultTotal = $query->fetch(PDO::FETCH_OBJ);
        $totalPages = intdiv($resultTotal->total, 10);
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
        $query = $databaseConnection->prepare('SELECT * FROM `patients` ORDER BY `id` DESC LIMIT :numberPerPage OFFSET :offset');
        $query->bindValue(':numberPerPage', 9, PDO::PARAM_INT);
        $query->bindValue(':offset', (Patient::setPage() - 1) * 10, PDO::PARAM_INT);
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
        $query = $databaseConnection->prepare('SELECT `lastname`, `firstname`, `id` FROM `patients` ORDER BY `id` DESC ;');
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
            $queryResult = $databaseConnection->prepare('SELECT `id` FROM `patients` WHERE `id` = '.$_GET['id'].' ;');
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
    public static function specificInformations () :array {
        // Connexion à la base de données
        $databaseConnection = Database::getPDO();
        // Requête SQL
        $result = $databaseConnection->query('SELECT * FROM `patients` WHERE `id` = '.$_GET['id'].' ;');
        // Récupération du résultat
        $resultInformations = $result->fetchAll(PDO::FETCH_OBJ);
        return $resultInformations;
    }

    //********************************************** **********************************************/
    //******************************************* UPDATE ******************************************/
    //********************************************** **********************************************/

    /**
     * Update des informations du patient
     * @return bool
     */
    public function modifyInformation ($id) :bool {
        // Connexion à la base de données
        $databaseConnection = Database::getPDO();
        // Requête SQL
        $query = $databaseConnection->prepare('UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `phone` = :phone, `mail` = :mail, `gender` = :gender WHERE `id` = :id ;');
        $query->bindValue(':lastname', $this->getLastName(), PDO::PARAM_STR);
        $query->bindValue(':firstname', $this->getFirstName(), PDO::PARAM_STR);
        $query->bindValue(':birthdate', $this->getBirthDate(), PDO::PARAM_STR_CHAR);
        $query->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
        $query->bindValue(':mail', $this->getMail(), PDO::PARAM_STR);
        $query->bindValue(':gender', $this->getGender(), PDO::PARAM_STR);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        // Récupération du résultat
        $resultInformations = $query->fetch(PDO::FETCH_OBJ);
        return $resultInformations;
    }

    //********************************************** **********************************************/
    //******************************************* DELETE ******************************************/
    //********************************************** **********************************************/

    /**
     * Supprime le patient
     * @return bool
     */
    public static function deletePatient () :bool {
        // Connexion à la base de données
        $databaseConnection = Database::getPDO();
        // Requête SQL
        $query = $databaseConnection->prepare('DELETE FROM `patients` WHERE `id` = :id ;');
        $query->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $query->execute();
        // Récupération du résultat
        $resultInformations = $query->fetch(PDO::FETCH_OBJ);
        return $resultInformations;
    }
}