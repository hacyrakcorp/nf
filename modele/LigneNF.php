<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LigneNF {

//put your code here
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO ligne_frais (id, date_ligne, "
            . "object, lieu, montant, id_note_frais) VALUES (:id, :date_ligne,"
            . " :object, :lieu, :montant, :id_note_frais)";
    protected static $sqlRead = "SELECT * FROM ligne_frais";
    protected static $sqlUpdate = "UPDATE ligne_frais SET date_ligne = :date_ligne, "
            . "object = :object, lieu = :lieu, montant = :montant, "
            . "id_note_frais = :id_note_frais"
            . " WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM ligne_frais";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $date_ligne;

    /**
     * @var string
     */
    private $object;

    /**
     * @var string
     */
    private $lieu;

    /**
     * @var float
     */
    private $montant;

    /**
     * @var integer
     */
    private $id_note_frais;

    function getId() {
        return $this->id;
    }

    function getDate_ligne() {
        return $this->date_ligne;
    }

    function getObject() {
        return $this->object;
    }

    function getLieu() {
        return $this->lieu;
    }

    function getMontant() {
        return $this->montant;
    }

    function getId_note_frais() {
        return $this->id_note_frais;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate_ligne($date_ligne) {
        $this->date_ligne = $date_ligne;
    }

    function setObject($object) {
        $this->object = $object;
    }

    function setLieu($lieu) {
        $this->lieu = $lieu;
    }

    function setMontant($montant) {
        $this->montant = $montant;
    }

    function setId_note_frais($id_note_frais) {
        $this->id_note_frais = $id_note_frais;
    }

    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new LigneNF();
            $obj->setId($item['id']);
            $obj->setDate_ligne($item['date_ligne']);
            $obj->setObject($item['object']);
            $obj->setLieu($item['lieu']);
            $obj->setMontant($item['montant']);
            $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
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
                $obj = new LigneNF();
                $obj->setId($item['id']);
                $obj->setDate_ligne($item['date_ligne']);
                $obj->setObject($item['object']);
                $obj->setLieu($item['lieu']);
                $obj->setMontant($item['montant']);
                $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
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
                $obj = new LigneNF();
                $obj->setId($item['id']);
                $obj->setDate_ligne($item['date_ligne']);
                $obj->setObject($item['object']);
                $obj->setLieu($item['lieu']);
                $obj->setMontant($item['montant']);
                $obj->setId_note_frais(NoteDeFrais::getById($item['id_note_frais']));
                $tab[] = $obj;
            }
            return $tab;
        } else {
            return null;
        }
    }
    
    public function dernierID(){
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
            ':date_ligne' => $this->getDate_ligne(),
            ':object' => $this->getObject(),
            ':lieu' => $this->getLieu(),
            ':montant' => $this->getMontant(),
            ':id_note_frais' => $this->getId_note_frais()->getId()
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
