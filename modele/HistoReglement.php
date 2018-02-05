<?php

class HistoReglement {

    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO historique_reglement "
            . "(id, date_reglement, id_note_frais) "
            . "VALUES (:id, :date_reglement, :id_note_frais)";
    protected static $sqlRead = "SELECT * FROM historique_reglement";
    protected static $sqlUpdate = "UPDATE historique_reglement "
            . "SET date_reglement = :date_reglement "
            . "WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM historique_reglement";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $date_reglement;

    /**
     * @var integer
     */
    private $id_note_frais;

    function getId() {
        return $this->id;
    }

    function getDate_reglement() {
        return $this->date_reglement;
    }

    function getId_note_frais() {
        return $this->id_note_frais;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate_reglement($date_reglement) {
        $this->date_reglement = $date_reglement;
    }

    function setId_note_frais($id_note_frais) {
        $this->id_note_frais = $id_note_frais;
    }

    /**
     * @return HistoReglement[]
     */
    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new HistoReglement();
            $obj->setId($item['id']);
            $obj->setDateReglement($item['date_reglement']);
            $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
            $tab[] = $obj;
        }
        return $tab;
    }

    /**
     * @param int $id
     * @return HistoReglement
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
                $obj = new HistoReglement();
                $obj->setId($item['id']);
                $obj->setDateReglement($item['date_reglement']);
                $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
                $tab[] = $obj;
            }

            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getByDateReglement($date_reglement) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE date_reglement = :date_reglement', array(
            ':date_reglement' => $date_reglement
                )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
                $obj = new HistoReglement();
                $obj->setId($item['id']);
                $obj->setDateReglement($item['date_reglement']);
                $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
                $tab[] = $obj;
            }

            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getByNoteFrais($id_note_frais) {//Récup le tableau entier pour avoir toutes les dates d'un utilisateur.
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id_note_frais = :id_note_frais', array(
            ':id_note_frais' => $id_note_frais
                )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
                $obj = new HistoReglement();
                $obj->setId($item['id']);
                $obj->setDate_reglement($item['date_reglement']);
                $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
                $tab[] = $obj;
            }

            return $tab[count($liste) - 1];
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
            ':date_reglement' => $this->getDate_reglement(),
            ':id_note_frais' => $this->getId_note_frais()->getId()
        );
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