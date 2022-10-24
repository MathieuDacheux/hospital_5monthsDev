<?php

class RegisterPatient extends Database {

    // Propriétés
    private $firstname;
    private $lastname;
    private $birthdate;
    private $phone;
    private $mail;
    private $gender;

    public function __construct($firstname, $lastname, $birthdate, $phone, $mail, $gender) {
        parent::__construct();
        $this->firstname = trim(filter_input(INPUT_POST, $firstname, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->lastname = trim(filter_input(INPUT_POST, $lastname, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->birthdate = trim(filter_input(INPUT_POST, $birthdate, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->phone = trim(filter_input(INPUT_POST, $phone, FILTER_SANITIZE_SPECIAL_CHARS));
        $this->mail = trim(filter_input(INPUT_POST, $mail, FILTER_SANITIZE_EMAIL));
        $this->gender = trim(filter_input(INPUT_POST, $gender, FILTER_SANITIZE_NUMBER_INT));
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
        $query = $databaseConnection->prepare('SELECT * FROM `patients` WHERE lastname = '.$this->getLastName().' AND firstname = '.$this->getFirstName().' AND birthdate = '.$this->getBirthDate());
        $result = $query->fetch(PDO::FETCH_OBJ);
        if ($result != null) {
            return true;
        } else {
            $this->addPatient($databaseConnection);
            return false;
        }
    }
}