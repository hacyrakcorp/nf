<?php
class MdpOublie
{
	// Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO utilisateur (id, login, code_mdp_oublie, confirme_code, date_expiration_code) VALUES (:id, :login, :code, :confirme, :dateExpiration)";
    protected static $sqlRead = "SELECT * FROM utilisateur";
    protected static $sqlUpdate = "UPDATE utilisateur SET login = :login, code_mdp_oublie = :code, confirme_code = :confirme, date_expiration_code= :dateExpiration WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM utilisateur";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $login;
	
	 /**
     * @var string
     */
	 private $code;
	
	 /**
     * @var integer
     */
	 private $confirme;
	 
	 /**
     * @var date
     */
	 private $dateExpiration;
	 
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
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }
	
	/**
     * @return string
     */
	public function getCode()
    {
		return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

	/**
     * @return string
     */
	public function getConfirme()
    {
		return $this->confirme;
    }

    /**
     * @param string $confirme
     */
    public function setConfirme($confirme)
    {
        $this->confirme = $confirme;
    }
	
	/**
     * @return string
     */
	public function getDateExpiration()
    {
		return $this->dateExpiration;
    }

    /**
     * @param string $dateExpiration
     */
    public function setDateExpiration($dateExpiration)
    {
        $this->dateExpiration = $dateExpiration;
    }

	/**
     * @return Utilisateur[]
     */
    public static function getAllListe()
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new MdpOublie();
            $obj->setId($item['id']);
            $obj->setLogin($item['login']);
            $obj->setCode($item['code']);
			$obj->setConfirme($item['confirme']);
			$obj->setdateExpiration($item['dateExpiration']);				
            $tab[] = $obj;
        }

        return $tab;
    }

    /**
     * @param int $id
     * @return Utilisateur
     */
    public static function getById($id)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE id = :id',
            array(
                ':id' => $id
            )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
				$obj = new MdpOublie();
				$obj->setId($item['id_oublie']);
				$obj->setMail($item['mail_oublie']);
				$obj->setCode($item['code_oublie']);
				$obj->setConfirme($item['confirme_oublie']);				
				$tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
	
	public static function getByMailCode($mail, $code)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE mail_oublie = :mail AND code_oublie = :code',
            array(
                ':mail' => $mail,
				':code' => $code
            )
        );
		
        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
				$obj = new MdpOublie();
				$obj->setId($item['id_oublie']);
				$obj->setMail($item['mail_oublie']);
				$obj->setCode($item['code_oublie']);
				$obj->setConfirme($item['confirme_oublie']);
				$tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
	
	public static function getByMail($mail)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE mail_oublie = :mail',
            array(
                ':mail' => $mail
            )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
				$obj = new MdpOublie();
				$obj->setId($item['id_oublie']);
				$obj->setMail($item['mail_oublie']);
				$obj->setCode($item['code_oublie']);
				$obj->setConfirme($item['confirme_oublie']);
				$tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
	

    public function save()
    {
        if ($this->getId() == null) 
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
                ':mail' => $this->getMail(),
                ':code' => $this->getCode(),
				':confirme' => $this->getConfirme()
            )
        );
    }

    public function delete()
    {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer(
            self::$sqlDelete . ' WHERE id_oublie = :id',
            array(
                ':id' => $this->getId()
            )
        );
    }
}
?>