<?php
class HistoConnection
{
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO historique_connection (id, date_tentative, id_utilisateur) VALUES (:id, :date_tentative, :id_utilisateur)";
    protected static $sqlRead = "SELECT * FROM historique_connection";
    protected static $sqlUpdate = "UPDATE historique_connection SET date_tentative = :date_tentative WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM historique_connection";
	
    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $date_tentative;
	
	/**
     * @var integer
     */
    private $id_utilisateur;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return date
     */
    public function getDateTentative()
    {
        return $this->date_tentative;
    }

    /**
     * @param date $date_tentative
     */
    public function setDateTentative($date_tentative)
    {
        $this->date_tentative = $date_tentative;
    }
	
	/**
     * @return Utilisateur
     */
	public function getUtilisateur()
    {
		return $this->id_utilisateur;
    }

    /**
     * @param Utilisateur $id_utilisateur
     */
    public function setUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
    }
	

    /**
     * @return HistoConnection[]
     */
    public static function getAllListe()
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item)
        {
            $obj = new HistoConnection();
            $obj->setId($item['id']);
            $obj->setDateTentative($item['date_tentative']);
			$obj->setUtilisateur(Utilisateur::getById($item['id_utilisateur']));
            $tab[] = $obj;
        }

        return $tab;
    }

    /**
     * @param int $id
     * @return HistoConnection
     */
    public static function getById($id)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead.' WHERE id = :id',
            array(
                ':id' => $id
            )
        );

        if(count($liste) > 0)
        {
            $tab = array();
            foreach ($liste as $item)
            {
				$obj = new HistoConnection();
				$obj->setId($item['id']);
				$obj->setDateTentative($item['date_tentative']);
				$obj->setUtilisateur(Utilisateur::getById($item['id_utilisateur']));
				$tab[] = $obj;
            }

            return $tab[0];
        }
        else
        {
            return null;
        }
    }
	
	public static function getByDateConnection($date_tentative)
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
				$obj = new HistoConnection();
				$obj->setId($item['id']);
				$obj->setDateTentative($item['date_tentative']);
				$obj->setUtilisateur(Utilisateur::getById($item['id_utilisateur']));
				$tab[] = $obj;
            }

            return $tab[0];
        }
        else
        {
            return null;
        }
    }
	
	public static function getByUtilisateur($id_utilisateur)
    {//Récup le tableau entier pour avoir toutes les dates d'un utilisateur.
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead.' WHERE id_utilisateur = :id_utilisateur',
            array(
                ':id_utilisateur' => $id_utilisateur
            )
        );

        if(count($liste) > 0)
        {
            $tab = array();
            foreach ($liste as $item)
            {
				$obj = new HistoConnection();
				$obj->setId($item['id']);
				$obj->setDateTentative($item['date_tentative']);
				$obj->setUtilisateur(Utilisateur::getById($item['id_utilisateur']));
				$tab[] = $obj;
            }

            return $tab[count($liste)-1];
        }
        else
        {
            return null;
        }
    }

    public function save()
    {
        if($this->getId() == null)
        { // INSERT
            $sql = self::$sqlCreate;
        }
        else
        { // UPDATE
            $sql = self::$sqlUpdate;
        }
		$parametre = array(
                    ':id' => $this->getId(),
                    ':date_tentative' => $this->getDateTentative(),
					':id_utilisateur' => $this->getUtilisateur()->getId()
                );
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer($sql, $parametre
        );
    }

    public function delete()
    {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer(
            self::$sqlDelete.' WHERE id = :id',
            array(
                ':id' => $this->getId()
            )
        );
    }
}
?>