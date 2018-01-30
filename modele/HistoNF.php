<?php

class HistoNF {

    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO historique_note_frais (id, date_note_frais, id_note_frais) VALUES (:id, :date_note_frais, :id_note_frais)";
    protected static $sqlRead = "SELECT * FROM historique_note_frais";
    protected static $sqlUpdate = "UPDATE historique_note_frais SET date_note_frais = :date_note_frais WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM historique_note_frais";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $date_note_frais;

    /**
     * @var integer
     */
    private $id_note_frais;

    function getId() {
        return $this->id;
    }

    function getDate_note_frais() {
        return $this->date_note_frais;
    }

    function getId_note_frais() {
        return $this->id_note_frais;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate_note_frais($date_note_frais) {
        $this->date_note_frais = $date_note_frais;
    }

    function setId_note_frais($id_note_frais) {
        $this->id_note_frais = $id_note_frais;
    }

    /**
     * @return HistoNF[]
     */
    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new HistoNF();
            $obj->setId($item['id']);
            $obj->setDate_note_frais($item['date_note_frais']);
            $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
            $tab[] = $obj;
        }
        return $tab;
    }

    /**
     * @param int $id
     * @return HistoNF
     */
    public static function getById($id) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id = :id', array(
            ':id' => $id
                )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
            $obj = new HistoNF();
            $obj->setId($item['id']);
            $obj->setDate_note_frais($item['date_note_frais']);
            $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
            $tab[] = $obj;
        }

            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getByDateNF($date_note_frais) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE date_note_frais = :date_note_frais', array(
            ':date_note_frais' => $date_note_frais
                )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
            $obj = new HistoNF();
            $obj->setId($item['id']);
            $obj->setDate_note_frais($item['date_note_frais']);
            $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
            $tab[] = $obj;
        }
            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getByNF($id_note_frais) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id_note_frais = :id_note_frais', array(
            ':id_note_frais' => $id_note_frais
                )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
            $obj = new HistoNF();
            $obj->setId($item['id']);
            $obj->setDate_note_frais($item['date_note_frais']);
            $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
            $tab[] = $obj;
        }

            return $tab;
        } else {
            return null;
        }
    }

    public function save() {
        if ($this->getId() == null) { // INSERT
            $sql = self::$sqlCreate;
        } else { // UPDATE
            $sql = self::$sqlUpdate;
        }
        $parametre = array(
            ':id' => $this->getId(),
            ':date_note_frais' => $this->getDate_note_frais(),
            ':id_note_frais' => $this->getId_note_frais()->getId()
        );
        var_dump($parametre);
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer($sql, $parametre
        );
    }

    public function delete() {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer(
                        self::$sqlDelete . ' WHERE id = :id', array(
                    ':id' => $this->getId()
                        )
        );
    }

}

?>