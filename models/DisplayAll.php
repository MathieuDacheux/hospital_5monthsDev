<?php

class DisplayInformations extends Database {
    
    private $table;

    public function __construct ($table) {
        parent::__construct();
        $this->numberPerPage = 10;
        $this->page = 1;
        $this->$table = $table;
    }

    /**
     * Retourne le nombre d'éléments par page
     * @return int
     */
    public function getNumberPerPage () :int {
        return $this->numberPerPage;
    }

    /**
     * Retourne la page actuelle
     * @return int
     */
    public function getPage () :int {
        return $this->page;
    }

    /**
     * Retourne le nombre de la table a traiter
     * @return string
     */
    public function getTable ()  {
        return $this->table;
    }

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
        $result = $databaseConnection->prepare('SELECT COUNT(`id`) FROM :table ;');
        $result->bindValue(':table', $this->getTable(), PDO::PARAM_STR);
        // Récupération du résultat
        $resultTotal = $result->fetch(PDO::FETCH_OBJ);
        if ($resultTotal > 10) {
            $totalPages = intdiv($resultTotal->total, $this->getNumberPerPage());
        } else {
            $totalPages = 1;
        }
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
        $query = $databaseConnection->prepare('SELECT * FROM :table ORDER BY `id` ASC LIMIT :numberPerPage OFFSET :offset');
        $query->bindValue(':table', $this->getTable(), PDO::PARAM_STR);
        $query->bindValue(':numberPerPage', $this->getNumberPerPage(), PDO::PARAM_INT);
        $query->bindValue(':offset', ($this->getPage() - 1) * $this->getNumberPerPage(), PDO::PARAM_INT);
        $query->execute();
        // Récupération du résultat
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * Retourne toutl les patients 
     * @return array
     */
    public function getAllPatients () :array {
        // Connexion à la base de données
        $databaseConnection = parent::getPDO();
        // Requête SQL
        $query = $databaseConnection->prepare('SELECT `lastname`, `firstname` FROM `patients` ORDER BY `lastname` ASC');
        $query->execute();
        // Récupération du résultat
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}