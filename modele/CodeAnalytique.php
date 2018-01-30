<?php

class CodeAnalytique {

    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO code_analytique (id, "
            . "libelle) VALUES (:id, :libelle)";
    protected static $sqlRead = "SELECT * FROM code_analytique ";
    protected static $sqlUpdate = "UPDATE code_analytique "
            . "SET libelle = :libelle "
            . "WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM code_analytique";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $libelle;

    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new CodeAnalytique();
            $obj->setId($item['id']);
            $obj->setLibelle($item['libelle']);
            $tab[] = $obj;
        }
        return $tab;
    }

    public static function getById($id) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id = :id', array(':id' => $id)
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
                $obj = new CodeAnalytique();
                $obj->setId($item['id']);
                $obj->setLibelle($item['libelle']);
                $tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }

}
