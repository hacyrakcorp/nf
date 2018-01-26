<?php

class NatureFrais {
//put your code here
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO nature_frais (id, libelle, "
            . "type_valeur, unite) VALUES (:id, :libelle,"
            . " :type_valeur, :unite)";
    protected static $sqlRead = "SELECT * FROM nature_frais";
    protected static $sqlUpdate = "UPDATE nature_frais "
            . "SET libelle = :libelle, "
            . "type_valeur = :type_valeur, unite = :unite,"
            . " WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM nature_frais";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $libelle;

    /**
     * @var TypeValeur
     */
    private $type_valeur;

    /**
     * @var string
     */
    private $unite;

    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getType_valeur() {
        return $this->type_valeur;
    }

    function getUnite() {
        return $this->unite;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setType_valeur($type_valeur) {
        $this->type_valeur = $type_valeur;
    }

    function setUnite($unite) {
        $this->unite = $unite;
    }

    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new NatureFrais();
            $obj->setId($item['id']);
            $obj->setLibelle($item['libelle']);
            $obj->setType_valeur(TypeValeur::getById($item['type_valeur']));
            $obj->setUnite($item['unite']);
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
                $obj = new NatureFrais();
                $obj->setId($item['id']);
                $obj->setLibelle($item['libelle']);
                $obj->setType_valeur(TypeValeur::getById($item['type_valeur']));
                $obj->setUnite($item['unite']);
                $tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
    
    public static function getByLibelle($libelle) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE libelle = :libelle', array(
            ':libelle' => $libelle
                )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
                $obj = new NatureFrais();
                $obj->setId($item['id']);
                $obj->setLibelle($item['libelle']);
                $obj->setType_valeur(TypeValeur::getById($item['type_valeur']));
                $obj->setUnite($item['unite']);
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
            ':type_valeur' => $this->getType_valeur()->getId(),
            ':unite' => $this->getUnite()
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
