<?php
class MdpOublie
{
	// Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO mdp_oublie (id_oublie, mail_oublie, code_oublie, confirme_oublie) VALUES (:id, :mail, :code, :confirme)";
    protected static $sqlRead = "SELECT * FROM mdp_oublie";
    protected static $sqlUpdate = "UPDATE mdp_oublie SET mail_oublie = :mail, code_oublie = :code, confirme_oublie = :confirme WHERE id_oublie = :id";
    protected static $sqlDelete = "DELETE FROM mdp_oublie";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $mail;
	
	 /**
     * @var string
     */
	 private $code;
	
	 /**
     * @var integer
     */
	 private $confirme;
	 
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
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
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
     * @param string $statut
     */
    public function setConfirme($confirme)
    {
        $this->confirme = $confirme;
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
            $obj->setId($item['id_oublie']);
            $obj->setMail($item['mail_oublie']);
            $obj->setCode($item['code_oublie']);
			$obj->setConfirme($item['confirme_oublie']);			
            $tab[] = $obj;
        }

        return $tab;
    }

    /**
     * @param int $id
     * @return MdpOublie
     */
    public static function getById($id)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE id_oublie = :id',
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