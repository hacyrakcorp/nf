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
}
