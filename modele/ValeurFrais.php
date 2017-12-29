<?php

class ValeurFrais {

//put your code here
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO valeur_frais (id, valeur, "
            . "id_ligne_frais) VALUES (:id, :valeur,"
            . " :id_ligne_frais)";
    protected static $sqlRead = "SELECT * FROM valeur_frais";
    protected static $sqlUpdate = "UPDATE valeur_frais "
            . "SET valeur = :valeur, "
            . "id_ligne_frais = :id_ligne_frais"
            . " WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM valeur_frais";

    /**
     * @var NatureFrais
     */
    private $id;

    /**
     * @var float
     */
    private $valeur;

    /**
     * @var LigneNF
     */
    private $id_ligne_frais;

    function getId(): NatureFrais {
        return $this->id;
    }

    function getValeur() {
        return $this->valeur;
    }

    function getId_ligne_frais(): LigneNF {
        return $this->id_ligne_frais;
    }

    function setId(NatureFrais $id) {
        $this->id = $id;
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
            $obj->setId(NatureFrais::getById($item['id']));
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
                $obj->setId(NatureFrais::getById($item['id']));
                $obj->setValeur($item['valeur']);
                $obj->setId_ligne_frais(LigneNF::getById($item['id_ligne_frais']));
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
            ':id' => $this->getId()->getId(),
            ':valeur' => $this->getValeur(),
            ':id_ligne_frais' => $this->getId_ligne_frais()->getId(),
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
