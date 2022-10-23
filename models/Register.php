<?php

class RegisterPatient extends Database {

    // Propriétés
    protected $firstname;
    protected $lastname;
    protected $birthdate;
    protected $phone;
    protected $mail;

    public function __construct($firstname, $lastname, $birthdate, $phone, $mail) {
        parent::__construct();
        $this->firstname = trim(filter_input(INPUT_POST, $firstname, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->lastname = trim(filter_input(INPUT_POST, $lastname, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->birthdate = trim(filter_input(INPUT_POST, $birthdate, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->phone = trim(filter_input(INPUT_POST, $phone, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->mail = trim(filter_input(INPUT_POST, $mail, FILTER_SANITIZE_SPECIAL_CHARS));
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
     * Validation des inputs envoyés via le formulaire
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
     * Ajout d'un patient dans la base de données
     * @param mixed $databaseConnection
     * 
     * @return bool
     */
    public function addPatient($databaseConnection) :bool {
        $query = $databaseConnection->prepare('INSERT INTO `patients` (lastname, firstname, birthdate, phone, mail) VALUES (:lastname, :firstname, :birthdate, :phone, :mail)');
        $query->bindValue(':lastname', $this->getLastName(), PDO::PARAM_STR);
        $query->bindValue(':firstname', $this->getFirstName(), PDO::PARAM_STR);
        $query->bindValue(':birthdate', $this->getBirthDate(), PDO::PARAM_STR);
        $query->bindValue(':phone', $this->getPhone(), PDO::PARAM_STR);
        $query->bindValue(':mail', $this->getMail(), PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
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
        $query = $databaseConnection->prepare('SELECT * FROM patients WHERE lastname = '.$this->getLastName().' AND firstname = '.$this->getFirstName().' AND birthdate = '.$this->getBirthDate());
        $result = $query->fetch(PDO::FETCH_OBJ);
        if ($result == []) {
            return true;
        } else {
            $this->addPatient($databaseConnection);
            return false;
        }
    }
}