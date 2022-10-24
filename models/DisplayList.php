<?php

class DisplayPatient extends Database {

    public function __construct() {
        parent::__construct();
        $this->numberPerPage = 10;
        $this->page = 1;
    }

    /**
     * Retourne le nombre d'éléments par page
     * @return int
     */
    public function getNumberPerPage() :int {
        return $this->numberPerPage;
    }

    /**
     * Retourne la page actuelle
     * @return int
     */
    public function getPage() :int {
        return $this->page;
    }

    /**
     * Settings d'une nouvelle valeur pour page
     * @return int
     */
    public function setPage() :int {
        if (isset($_GET['page'])) {
            $this->page = $_GET['page'];
        } else {
            $this->page = 1;
        }
        return $this->page;
    }

    /**
     * Retourne le nombre total de patients
     * @return int
     */
    public function howManyPages() :int {
        // Connexion à la base de données
        $databaseConnection = parent::getPDO();
        // Requête SQL
        $result = $databaseConnection->query('SELECT COUNT(`id`) AS total FROM `patients`');
        // Récupération du résultat
        $resultTotal = $result->fetch(PDO::FETCH_OBJ);
        // Calcul du nombre de pages
        $totalPages = intdiv($resultTotal->total, $this->getNumberPerPage());
        return $totalPages;
    }

    /**
     * Retourne la liste des patients
     * @return array
     */
    public function getPatientsList() :array {
        // Connexion à la base de données
        $databaseConnection = parent::getPDO();
        // Requête SQL
        $query = $databaseConnection->prepare('SELECT * FROM `patients` ORDER BY `lastname` ASC LIMIT :numberPerPage OFFSET :offset');
        $query->bindValue(':numberPerPage', $this->getNumberPerPage(), PDO::PARAM_INT);
        $query->bindValue(':offset', ($this->getPage() - 1) * $this->getNumberPerPage(), PDO::PARAM_INT);
        $query->execute();
        // Récupération du résultat
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}