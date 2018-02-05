<?php

class ValeurFrais {

//put your code here
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO valeur_frais (id_nature_frais, "
            . "valeur, "
            . "id_ligne_frais) VALUES (:id_nature_frais, :valeur,"
            . " :id_ligne_frais)";
    protected static $sqlRead = "SELECT * FROM valeur_frais";
    protected static $sqlUpdate = "UPDATE valeur_frais "
            . "SET valeur = :valeur"
            . " WHERE id_nature_frais = :id_nature_frais"
            . "AND id_ligne_frais = :id_ligne_frais";
    protected static $sqlDelete = "DELETE FROM valeur_frais";

    /**
     * @var NatureFrais
     */
    private $id_nature_frais;

    /**
     * @var float
     */
    private $valeur;

    /**
     * @var LigneNF
     */
    private $id_ligne_frais;

    function getId_nature_frais(): NatureFrais {
        return $this->id_nature_frais;
    }

    function getValeur() {
        return $this->valeur;
    }
    
    function getId_ligne_frais(): LigneNF {
        return $this->id_ligne_frais;
    }
    
    function setId_nature_frais(NatureFrais $id_nature_frais) {
        $this->id_nature_frais = $id_nature_frais;
    }

    function setValeur($valeur) {
        $this->valeur = $valeur;
    }

    function setId_ligne_frais(LigneNF $id_ligne_frais) {
        $this->id_ligne_frais = $id_ligne_frais;
    }

    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new ValeurFrais();
            $obj->setId_nature_frais(NatureFrais::getById($item['id_nature_frais']));
            $obj->setValeur($item['valeur']);
            $obj->setId_ligne_frais(LigneNF::getById($item['id_ligne_frais']));
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
                $obj = new ValeurFrais();
                $obj->setId_nature_frais(NatureFrais::getById($item['id_nature_frais']));
                $obj->setValeur($item['valeur']);
                $obj->setId_ligne_frais(LigneNF::getById($item['id_ligne_frais']));
                $tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
    
    public static function getByIdLigneFrais($id_ligne_frais){
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id_ligne_frais = :id_ligne_frais', array(
            ':id_ligne_frais' => $id_ligne_frais
                )
        );
        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
                $obj = new ValeurFrais();
                $obj->setId_nature_frais(NatureFrais::getById($item['id_nature_frais']));
                $obj->setValeur($item['valeur']);
                $obj->setId_ligne_frais(LigneNF::getById($item['id_ligne_frais']));
                $tab[] = $obj;
            }
            return $tab;
        } else {
            return null;
        }
    }

    public function save() {
        /*if ($this->getId() == null) { // INSERT
            $sql = self::$sqlCreate;
        } else { // UPDATE
            $sql = self::$sqlUpdate;
        }*/
        $sql = self::$sqlCreate;
        $connexionInstance = Connexion::getInstance();
        $parametre = array(
            ':id_nature_frais' => intval($this->getId_nature_frais()->getId()),
            ':valeur' => $this->getValeur(),
            ':id_ligne_frais' => intval($this->getId_ligne_frais()->getId()),
        );
        return $connexionInstance->executer($sql, $parametre);
    }

    public function delete() {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer(
                        self::$sqlDelete . 
                ' WHERE id_ligne_frais = :id_ligne_frais', array(
                ':id_ligne_frais' => $this->getId_ligne_frais()->getId()
                        )
        );
    }

}
