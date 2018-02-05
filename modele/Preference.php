<?php

class Preference {
   
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO preference (mois_annee, tarif_km) "
            . "VALUES (:mois_annee, :tarif_km)";
    protected static $sqlRead = "SELECT * FROM preference";
    protected static $sqlUpdate = "UPDATE preference SET tarif_km = :tarif_km "
            . "WHERE mois_annee = :mois_annee";
    protected static $sqlDelete = "DELETE FROM preference";

    /**
     * @var string
     */
    private $mois_annee;

    /**
     * @var double
     */
    private $tarif_km;
    
    private $isNew = true;

    function getMois_annee() {
        return $this->mois_annee;
    }

    function getTarif_km() {
        return $this->tarif_km;
    }
    
    function getIsNew() {
        return $this->isNew;
    }

    function setIsNew($isNew) {
        $this->isNew = $isNew;
    }

    function setMois_annee($mois_annee) {
        $this->mois_annee = $mois_annee;
    }

    function setTarif_km($tarif_km) {
        $this->tarif_km = $tarif_km;
    }

    
     /**
     * @return Preference[]
     */
    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new Preference();
            $obj->setIsNew(false);
            $obj->setMois_annee($item['mois_annee']);
            $obj->setTarif_km($item['tarif_km']);
            $tab[] = $obj;
        }

        return $tab;
    }

    /**
     * @param double $mois_annee
     * @return Preference
     */
    public static function getByMois_annee($mois_annee) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE mois_annee = :mois_annee', array(
            ':mois_annee' => $mois_annee
                )
        );

        if (count($liste) > 0) {
            $tab = array();
             foreach ($liste as $item) {
            $obj = new Preference();
            $obj->setIsNew(false);
            $obj->setMois_annee($item['mois_annee']);
            $obj->setTarif_km($item['tarif_km']);
            $tab[] = $obj;
        }

            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getByTarifKm($tarif_km) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE tarif_km = :tarif_km', array(
            ':tarif_km' => $tarif_km
                )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
                $obj = new Preference();
                $obj->setIsNew(false);
                $obj->setMois_annee($item['mois_annee']);
                $obj->setTarif_km($item['tarif_km']);
                $tab[] = $obj;
            }

            return $tab[0];
        } else {
            return null;
        }
    }

    public function save() {
        if ($this->getIsNew()) { // INSERT
            $sql = self::$sqlCreate;
        } else { // UPDATE
            $sql = self::$sqlUpdate;
        }

        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer($sql, array(
                    ':mois_annee' => $this->getMois_annee(),
                    ':tarif_km' => $this->getTarif_km()
                        )
        );
    }

    public function delete() {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer(
                        self::$sqlDelete . ' WHERE mois_annee = :mois_annee', array(
                    ':mois_annee' => $this->getMois_annee()
                        )
        );
    }

}

?>