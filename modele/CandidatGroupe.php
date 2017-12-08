<?php
class CandidatGroupe
{
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO groupe_candidat (id_gpe_candidat, CE_candidat, CE_session) VALUES (:id, :candidat, :session)";
    protected static $sqlRead = "SELECT * FROM groupe_candidat";
    protected static $sqlUpdate = "UPDATE groupe_candidat SET CE_candidat = :candidat, CE_session = :session WHERE id_binome = :id";
    protected static $sqlDelete = "DELETE FROM groupe_candidat";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $candidat;
	
	/**
     * @var string
     */
    private $session;

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
     * @return Utilisateur
     */
    public function getCandidat()
    {
        return $this->candidat;
    }

    /**
     * @param Utilisateur $candidat
     */
    public function setCandidat($candidat)
    {
        $this->candidat = $candidat;
    }
	
	/**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param Session $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }	
	

    /**
     * @return CandidatGroupe[]
     */
    public static function getAllListe()
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item)
        {
            $obj = new Binome();
            $obj->setId($item['id_gpe_candidat']);
            $obj->setCandidat(Utilisateur::getById($item['CE_candidat']));
			$obj->setSession(Session::getById($item['CE_session']));
            $tab[] = $obj;
        }

        return $tab;
    }

    /**
     * @param int $id
     * @return Discipline
     */
    public static function getById($id)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead.' WHERE id_gpe_candidat = :id',
            array(
                ':id' => $id
            )
        );

        if(count($liste) > 0)
        {
            $tab = array();
            foreach ($liste as $item)
            {
                $obj = new CandidatGroupe();
				$obj->setId($item['id_gpe_candidat']);
				$obj->setCandidat(Utilisateur::getById($item['CE_candidat']));
				$obj->setSession(Session::getById($item['CE_session']));
                $tab[] = $obj;
            }

            return $tab[0];
        }
        else
        {
            return null;
        }
    }

	    public static function getBySession($id)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead.' WHERE CE_session = :id',
            array(
                ':id' => $id
            )
        );

        if(count($liste) > 0)
        {
            $tab = array();
            foreach ($liste as $item)
            {
                $obj = new CandidatGroupe();
				$obj->setId($item['id_gpe_candidat']);
				$obj->setCandidat(Utilisateur::getById($item['CE_candidat']));
                $tab[] = $obj;
            }

            return $tab[0];
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
        $connexionInstance = Connexion::getInstance();
        $result = $connexionInstance->executer($sql, array(
                    ':id' => $this->getId(),
                    ':candidat' => $this->getCandidat()->getId(),
					':session' => $this->getSession()->getId()
                )
        );

		return $result;
    }

    public function delete()
    {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer(
            self::$sqlDelete.' WHERE id_gpe_candidat = :id',
            array(
                ':id' => $this->getId()
            )
        );
    }
}
?>