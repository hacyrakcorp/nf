<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Etat
 *
 * @author Cécile
 */
class Etat {
    const BROUILLON_ID = 1;
    const SOUMIS_ID = 2;
    const ENCOURS_ID = 3;
    const TRAITER_ID = 4;
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO etat (id, libelle) "
            . "VALUES (:id, :libelle)";
    protected static $sqlRead = "SELECT * FROM etat";
    protected static $sqlUpdate = "UPDATE etat SET libelle = :libelle "
            . "WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM etat";
	
    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $libelle;
    
    public function getId() {
        return $this->id;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }
    
    /**
     * @return Etat[]
     */
    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new Statut();
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
                $obj = new Etat();
                $obj->setId($item['id']);
                $obj->setLibelle($item['libelle']);
                $tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
    
    public static function getByLibelle($libelle)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead.' WHERE libelle = :libelle',
            array(
                ':libelle' => $libelle
            )
        );
        if(count($liste) > 0)
        {
            $tab = array();
            foreach ($liste as $item)
            {
                $obj = new Service();
                $obj->setId($item['id']);
                $obj->setLibelle($item['libelle']);
                $tab[] = $obj;
            }
            return $tab[0];
        }
        else
        {
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
        return $connexionInstance->executer($sql, array(
                    ':id' => $this->getId(),
                    ':libelle' => $this->getLibelle()
                        )
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
