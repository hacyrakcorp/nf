<?php
class Binome
{
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO binome (id_binome, CE_jury, CE_session) VALUES (:id, :jury, :session)";
    protected static $sqlRead = "SELECT * FROM binome";
    protected static $sqlUpdate = "UPDATE binome SET CE_jury = :jury, CE_session = :session WHERE id_binome = :id";
    protected static $sqlDelete = "DELETE FROM binome";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $jury;
	
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
    public function getJury()
    {
        return $this->jury;
    }

    /**
     * @param Utilisateur $jury
     */
    public function setJury($jury)
    {
        $this->jury = $jury;
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
     * @return Binome[]
     */
    public static function getAllListe()
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item)
        {
            $obj = new Binome();
            $obj->setId($item['id_binome']);
            $obj->setJury(Utilisateur::getById($item['CE_jury']));
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
            self::$sqlRead.' WHERE id_binome = :id',
            array(
                ':id' => $id
            )
        );

        if(count($liste) > 0)
        {
            $tab = array();
            foreach ($liste as $item)
            {
                $obj = new Binome();
				$obj->setId($item['id_binome']);
				$obj->setJury(Utilisateur::getById($item['CE_jury']));
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
                $obj = new Binome();
				$obj->setId($item['id_binome']);
				$obj->setJury(Utilisateur::getById($item['CE_jury']));
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
        return $connexionInstance->executer($sql, array(
                    ':id' => $this->getId(),
                    ':jury' => $this->getJury()->getId(),
					':session' => $this->getSession()->getId()
                )
        );
    }

    public function delete()
    {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer(
            self::$sqlDelete.' WHERE id_binome = :id',
            array(
                ':id' => $this->getId()
            )
        );
    }
}
?>