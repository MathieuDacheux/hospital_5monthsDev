<?php

class Database {

    public function __construct() {
        $this->database = 'hospitalE2N';
        $this->host = 'localhost';
        $this->user = 'root';
        $this->password = 'root';
        $this->charset = 'utf8';
    }

    /**
     * Retourne le nom de la base de données
     * @return string
     */
    public function getDatabase(): string {
        return $this->database;
    }

    /**
     * Retourne l'host de la base de données
     * @return string
     */
    public function getHost(): string {
        return $this->host;
    }

    /**
     * Retourne le nom d'utilisateur de la base de données
     * @return string
     */
    public function getUser(): string {
        return $this->user;
    }

    /**
     * Retourne le mot de passe de la base de données
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Retourne le charset de la base de données
     * @return string
     */
    public function getCharset(): string {
        return $this->charset;
    }

    /**
     * Retourne la connexion à la base de données
     * @return PDO
     */
    public function getPDO(): PDO {
        $connectionDatabase = new PDO('mysql:dbname=' . $this->getDatabase() . ';host=' . $this->getHost() . ';charset=' . $this->getCharset(), $this->getUser(), $this->getPassword());
        return $connectionDatabase;
    }
}