<?php

class Database {

    public function __construct() {
        $this->database = DATABASE;
        $this->host = HOST;
        $this->user = USER;
        $this->password = PASSWORD;
        $this->charset = CHARSET;
    }

    /**
     * Retourne le nom de la base de données
     * @return string
     */
    public function getDatabase() :string {
        return $this->database;
    }

    /**
     * Retourne l'host de la base de données
     * @return string
     */
    public function getHost() :string {
        return $this->host;
    }

    /**
     * Retourne le nom d'utilisateur de la base de données
     * @return string
     */
    public function getUser() :string {
        return $this->user;
    }

    /**
     * Retourne le mot de passe de la base de données
     * @return string
     */
    public function getPassword() :string {
        return $this->password;
    }

    /**
     * Retourne le charset de la base de données
     * @return string
     */
    public function getCharset() :string {
        return $this->charset;
    }

    /**
     * Retourne la connexion à la base de données
     * @return PDO
     */
    public function getPDO(): PDO {
        try {
            $connectionDatabase = new PDO('mysql:host=' . $this->getHost() . ';dbname=' . $this->getDatabase() . ';charset=' . $this->getCharset(), $this->getUser(), $this->getPassword());
            return $connectionDatabase;
        } catch (PDOException $ex) {
            die('Erreur : ' . $ex->getMessage());
        }
    }
}