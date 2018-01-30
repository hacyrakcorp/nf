<?php

class LigneOM {

    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO ligne_ordre_mission (id, "
            . "numero_rapport, affaire, montant"
            . "id_note_frais, id_code_analytique) VALUES (:id, :numero_rapport, "
            . ":affaire, :montant, :id_note_frais, :id_code_analytique)";
    protected static $sqlRead = "SELECT * FROM ligne_ordre_mission ";
    protected static $sqlUpdate = "UPDATE ligne_ordre_mission "
            . "SET numero_rapport = :numero_rapport, "
            . "affaire = :affaire, montant = :montant"
            . "id_note_frais = :id_note_frais, "
            . "id_code_analytique = :id_code_analytique"
            . " WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM ligne_ordre_mission";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $numero_rapport;

    /**
     * @var string
     */
    private $affaire;
    
    /**
     * @var string
     */
    private $montant;

    /**
     * @var integer
     */
    private $id_note_frais;

    /**
     * @var integer
     */
    private $id_code_analytique;

    function getId() {
        return $this->id;
    }

    function getNumero_rapport() {
        return $this->numero_rapport;
    }

    function getAffaire() {
        return $this->affaire;
    }

    function getMontant() {
        return $this->montant;
    }

    function getId_note_frais() {
        return $this->id_note_frais;
    }

    function getId_code_analytique() {
        return $this->id_code_analytique;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNumero_rapport($numero_rapport) {
        $this->numero_rapport = $numero_rapport;
    }

    function setAffaire($affaire) {
        $this->affaire = $affaire;
    }

    function setMontant($montant) {
        $this->montant = $montant;
    }

    function setId_note_frais($id_note_frais) {
        $this->id_note_frais = $id_note_frais;
    }

    function setId_code_analytique($id_code_analytique) {
        $this->id_code_analytique = $id_code_analytique;
    }

    
    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new LigneOM();
            $obj->setId($item['id']);
            $obj->setNumero_rapport($item['numero_rapport']);
            $obj->setAffaire($item['affaire']);
            $obj->setMontant($item['montant']);
            $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
            $obj->setId_code_analytique(CodeAnalytique::getById($item['code_analytique']));
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
                $obj = new LigneOM();
                $obj->setId($item['id']);
                $obj->setNumero_rapport($item['numero_rapport']);
                $obj->setAffaire($item['affaire']);
                $obj->setMontant($item['montant']);
                $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
                $obj->setId_code_analytique(CodeAnalytique::getById($item['code_analytique']));
                $tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getByNFAll($id_note_frais) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id_note_frais = :id_note_frais', array(
            ':id_note_frais' => $id_note_frais
                )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
                $obj = new LigneOM();
                $obj->setId($item['id']);
                $obj->setNumero_rapport($item['numero_rapport']);
                $obj->setAffaire($item['affaire']);
                $obj->setMontant($item['montant']);
                $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
                $obj->setId_code_analytique(CodeAnalytique::getById($item['code_analytique']));
                $tab[] = $obj;
            }
            return $tab;
        } else {
            return null;
        }
    }

    public function dernierID() {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->dernierID();
    }

    public function save() {
        if ($this->getId() == null) { // INSERT
            $sql = self::$sqlCreate;
            //last insert id
        } else { // UPDATE
            $sql = self::$sqlUpdate;
        }

        $connexionInstance = Connexion::getInstance();

        $parametre = array(
            ':id' => $this->getId(),
            ':numero_rapport' => $this->getNumero_rapport(),
            ':affaire' => $this->getAffaire(),
            ':montant' => $this->getMontant(),
            ':id_note_frais' => $this->getId_note_frais()->getId(),
            ':id_code_analytique' => $this->getId_code_analytique()->getId()
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
