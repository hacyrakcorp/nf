<?php

class TypeValeur {
//put your code here
    const DOUBLE_ID = 1;
    const INTEGER_ID = 2;
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO type_valeur (id, libelle, "
            . ") VALUES (:id, :libelle)";
    protected static $sqlRead = "SELECT * FROM type_valeur";
    protected static $sqlUpdate = "UPDATE type_valeur "
            . "SET libelle = :libelle, "
            . " WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM type_valeur";

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
            $obj = new TypeValeur();
            $obj->setId($item['id']);
            $obj->setLibelle($item['libelle']);
            $tab[] = $obj;
        }
        return $tab;
    }

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
                $obj = new TypeValeur();
                $obj->setId($item['id']);
                $obj->setLibelle($item['libelle']);
                $tab[] = $obj;
            }
            return $tab[0];
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
        $connexionInstance = Connexion::getInstance();
        $parametre = array(
            ':id' => $this->getId(),
            ':libelle' => $this->getLibelle(),
        );
        return $connexionInstance->executer($sql, $parametre);
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
