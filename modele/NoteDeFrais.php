<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NoteDeFrais
 *
 * @author Cécile
 */
class NoteDeFrais {

//put your code here
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO note_frais (id, mois_annee, "
            . "mode_reglement, numero_cheque, banque, avance, "
            . "net_a_payer, id_utilisateur, id_etat) VALUES (:id, :mois_annee,"
            . " :mode_reglement, :numero_cheque, :banque, :avance, "
            . ":net_a_payer, :id_utilisateur, :id_etat)";
    protected static $sqlRead = "SELECT * FROM note_frais";
    protected static $sqlUpdate = "UPDATE note_frais SET mois_annee = :mois_annee, "
            . "mode_reglement = :mode_reglement, numero_cheque = :numero_cheque,"
            . " banque = :banque, avance = :avance,"
            . " net_a_payer = :net_a_payer, id_utilisateur = :id_utilisateur, "
            . "id_etat = :id_etat"
            . " WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM note_frais";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $mois_annee;

    /**
     * @var string
     */
    private $mode_reglement;
    
    /**
     * @var string
     */
    private $numero_cheque;

    /**
     * @var string
     */
    private $banque;

    /**
     * @var float
     */
    private $avance;

    /**
     * @var float
     */
    private $net_a_payer;

    /**
     * @var Utilisateur
     */
    private $id_utilisateur;
    
    /**
     * @var double
     */
    private $total;

    /**
     * @var Etat
     */
    private $id_etat;
    
    function getNumero_cheque() {
        return $this->numero_cheque;
    }

    function setNumero_cheque($numero_cheque) {
        $this->numero_cheque = $numero_cheque;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getMois_annee() {
        return $this->mois_annee;
    }

    public function getMode_reglement() {
        return $this->mode_reglement;
    }

    public function getBanque() {
        return $this->banque;
    }

    public function getAvance() {
        return $this->avance;
    }

    public function getNet_a_payer() {
        return $this->net_a_payer;
    }

    public function getId_utilisateur() {
        return $this->id_utilisateur;
    }

    public function getId_etat() {
        return $this->id_etat;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setMois_annee($mois_annee) {
        $this->mois_annee = $mois_annee;
    }

    public function setMode_reglement($mode_reglement) {
        $this->mode_reglement = $mode_reglement;
    }

    public function setBanque($banque) {
        $this->banque = $banque;
    }

    public function setAvance($avance) {
        $this->avance = $avance;
    }

    public function setNet_a_payer($net_a_payer) {
        $this->net_a_payer = $net_a_payer;
    }

    public function setId_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function setId_etat($id_etat) {
        $this->id_etat = $id_etat;
    }
    
    function getTotal() {
        return $this->total;
    }

    function setTotal($total) {
        $this->total = $total;
    }

    
    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new NoteDeFrais();
            $obj->setId($item['id']);
            $obj->setMois_annee($item['mois_annee']);
            $obj->setMode_reglement($item['mode_reglement']);
            $obj->setNumero_cheque($item['numero_cheque']);
            $obj->setBanque($item['banque']);
            $obj->setAvance($item['avance']);
            $obj->setNet_a_payer($item['net_a_payer']);
            $obj->setId_utilisateur(Utilisateur::getById($item['id_utilisateur']));
            $obj->setId_etat(Etat::getById($item['id_etat']));
            $obj->totalLigne($item['id']);
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
                $obj = new NoteDeFrais();
                $obj->setId($item['id']);
                $obj->setMois_annee($item['mois_annee']);
                $obj->setMode_reglement($item['mode_reglement']);
                $obj->setNumero_cheque($item['numero_cheque']);
                $obj->setBanque($item['banque']);
                $obj->setAvance($item['avance']);
                $obj->setNet_a_payer($item['net_a_payer']);
                $obj->setId_utilisateur(Utilisateur::getById($item['id_utilisateur']));
                $obj->setId_etat(Etat::getById($item['id_etat']));
                $obj->totalLigne($item['id']);
                $tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getByUtilisateurAll($id_utilisateur) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id_utilisateur = :id_utilisateur ORDER BY mois_annee DESC', array(
            ':id_utilisateur' => $id_utilisateur
                )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
                $obj = new NoteDeFrais();
                $obj->setId($item['id']);
                $obj->setMois_annee($item['mois_annee']);
                $obj->setMode_reglement($item['mode_reglement']);
                $obj->setNumero_cheque($item['numero_cheque']);
                $obj->setBanque($item['banque']);
                $obj->setAvance($item['avance']);
                $obj->setNet_a_payer($item['net_a_payer']);
                $obj->setId_utilisateur(Utilisateur::getById($item['id_utilisateur']));
                $obj->setId_etat(Etat::getById($item['id_etat']));
                $obj->totalLigne($item['id']);
                $tab[] = $obj;
            }
            return $tab;
        } else {
            return null;
        }
    }
    
    public static function getByEtat($id_etat) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id_etat = :id_etat '
                . 'ORDER BY mois_annee DESC', array(
            ':id_etat' => $id_etat
                )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
                $obj = new NoteDeFrais();
                $obj->setId($item['id']);
                $obj->setMois_annee($item['mois_annee']);
                $obj->setMode_reglement($item['mode_reglement']);
                $obj->setNumero_cheque($item['numero_cheque']);
                $obj->setBanque($item['banque']);
                $obj->setAvance($item['avance']);
                $obj->setNet_a_payer($item['net_a_payer']);
                $obj->setId_utilisateur(Utilisateur::getById($item['id_utilisateur']));
                $obj->setId_etat(Etat::getById($item['id_etat']));
                $obj->totalLigne($item['id']);
                $tab[] = $obj;
            }
            return $tab;
        } else {
            return null;
        }
    }

    public function save() {
        if ($this->getId() == null) { // INSERT
            $sql = self::$sqlCreate;
            //last insert id
        } else { // UPDATE
            $sql = self::$sqlUpdate;
        }

        $connexionInstance = Connexion::getInstance();

        if ($this->getId_Etat() != null) {
            $parametre = array(
                ':id' => $this->getId(),
                ':mois_annee' => $this->getMois_annee(),
                ':mode_reglement' => $this->getMode_reglement(),
                ':numero_cheque' => $this->getNumero_cheque(),
                ':banque' => $this->getBanque(),
                ':avance' => $this->getAvance(),
                ':net_a_payer' => $this->getNet_a_payer(),
                ':id_utilisateur' => $this->getId_utilisateur()->getId(),
                ':id_etat' => $this->getId_etat()->getId()
            );
        } else {
            $parametre = array(
                ':id' => $this->getId(),
                ':mois_annee' => $this->getMois_annee(),
                ':mode_reglement' => $this->getMode_reglement(),
                ':numero_cheque' => $this->getNumero_cheque(),
                ':banque' => $this->getBanque(),
                ':avance' => $this->getAvance(),
                ':net_a_payer' => $this->getNet_a_payer(),
                ':id_utilisateur' => $this->getId_utilisateur()->getId(),
                ':id_etat' => $this->getId_etat()->getId()
            );
        }
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

    public function dernierId() {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->dernierID();
    }
    
    public function totalLigne ($id) {
        $sql = "SELECT ROUND(SUM(vf.valeur), 2) + "
                . "IFNULL((SELECT SUM(vf2.valeur * IFNULL(p2.tarif_km,0.52)) "
                . "FROM valeur_frais vf2 "
                . "INNER JOIN ligne_frais lf2 ON vf2.id_ligne_frais = lf2.id "
                . "INNER JOIN note_frais nf2 ON lf2.id_note_frais = nf2.id "
                . "LEFT OUTER JOIN preference p2 ON nf2.mois_annee = p2.mois_annee "
                . "WHERE "
                . "nf2.id = ".$id." AND "
                . "vf2.id_nature_frais = ".NatureFrais::ID_KM."), 0) AS total
                FROM valeur_frais vf 
                INNER JOIN ligne_frais lf ON vf.id_ligne_frais = lf.id 
                INNER JOIN note_frais nf ON lf.id_note_frais = nf.id 
                WHERE 
                nf.id = ".$id." AND 
                vf.id_nature_frais <> ".NatureFrais::ID_KM;
        $connexionInstance = Connexion::getInstance();
        $resultat = $connexionInstance->requeter($sql);
        $this->total = $resultat[0]['total'];
    }
    
    public static function totalLigneOM($id){
        $sql = "SELECT SUM(ligne_ordre_mission.montant) AS total "
                . "FROM ligne_ordre_mission, note_frais "
                . "WHERE note_frais.id = ligne_ordre_mission.id_note_frais "
                . "AND note_frais.id=".$id;
        
        $connexionInstance = Connexion::getInstance();
        $resultat = $connexionInstance->requeter($sql);
        return $resultat[0];
    }
}
