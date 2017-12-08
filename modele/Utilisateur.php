<?php
class Utilisateur
{
	// Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO utilisateur (id, nom, prenom, login, mdp, email, tentative_connection, id_statut, id_service ) VALUES (:id, :nom, :prenom, :login, :mdp, :email, :tentative_connection, :id_statut, :id_service)";
    protected static $sqlRead = "SELECT * FROM utilisateur";
    protected static $sqlUpdate = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, login = :login, mdp = :mdp, email = :email, tentative_connection = :tentative_connection, id_statut = :id_statut, id_service = :id_service WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM utilisateur";

    /**
     * @var integer
     */
    private $id = null;

	/**
     * @var string
     */
    private $nom;
	
	/**
     * @var string
     */
    private $prenom;
	
    /**
     * @var string
     */
    private $login;
	
	 /**
     * @var string
     */
	 private $mdp;
	 
	 /**
     * @var string
     */
	 private $email;
	
	 /**
     * @var Statut
     */
	 private $id_statut;
	 
	 /**
     * @var Service
     */
    private $id_service;
	

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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $login
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
	
	/**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $login
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
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
	public function getMdp()
    {
		return $this->mdp;
    }

    /**
     * @param string $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

	/**
     * @return string
     */
	public function getEmail()
    {
		return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
	
	/**
     * @return int
     */
	public function getTentative_connection()
    {
		return $this->tentative_connection;
    }

    /**
     * @param string $tentative_connection
     */
    public function setTentative_connection($tentative_connection)
    {
        $this->tentative_connection = $tentative_connection;
    }
	
	/**
     * @return Statut
     */
	public function getStatut()
    {
		return $this->statut;
    }

    /**
     * @param Statut $statut
     */
    public function setStatut($id_statut)
    {
        $this->statut = $id_statut;
    }
	
	 /**
     * @return Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param Service $service
     */
    public function setService($id_service)
    {
        $this->service = $id_service;
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
            $obj = new Utilisateur();
            $obj->setId($item['id']);
			$obj->setNom($item['nom']);
			$obj->setPrenom($item['prenom']);
            $obj->setLogin($item['login']);
            $obj->setMdp($item['mdp']);
			$obj->setEmail($item['email']);
			$obj->setTentative_connection($item['tentative_connection']);
			$obj->setStatut(Statut::getById($item['id_statut']));			
            $obj->setService(Service::getById($item['id_service']));
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
				 $obj = new Utilisateur();
				$obj->setId($item['id']);
				$obj->setNom($item['nom']);
				$obj->setPrenom($item['prenom']);
				$obj->setLogin($item['login']);
				$obj->setMdp($item['mdp']);
				$obj->setEmail($item['email']);
				$obj->setTentative_connection($item['tentative_connection']);
				$obj->setStatut(Statut::getById($item['id_statut']));			
				$obj->setService(Service::getById($item['id_service']));
				$tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
	
	public static function getByLogin($login)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE login = :login',
            array(
                ':login' => $login
            )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
				$obj = new Utilisateur();
				$obj->setId($item['id']);
				$obj->setNom($item['nom']);
				$obj->setPrenom($item['prenom']);
				$obj->setLogin($item['login']);
				$obj->setMdp($item['mdp']);
				$obj->setEmail($item['email']);
				$obj->setTentative_connection($item['tentative_connection']);
				$obj->setStatut(Statut::getById($item['id_statut']));			
				$obj->setService(Service::getById($item['id_service']));
				$tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
	
	public static function getByLoginMdp($login, $mdp)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE login = :login AND mdp = :mdp',
            array(
                ':login' => $login,
				':mdp' => $mdp
            )
        );
		
        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
				 $obj = new Utilisateur();
				$obj->setId($item['id']);
				$obj->setNom($item['nom']);
				$obj->setPrenom($item['prenom']);
				$obj->setLogin($item['login']);
				$obj->setMdp($item['mdp']);
				$obj->setEmail($item['email']);
				$obj->setTentative_connection($item['tentative_connection']);
				$obj->setStatut(Statut::getById($item['id_statut']));			
				$obj->setService(Service::getById($item['id_service']));
				$tab[] = $obj;
            }
            return $tab[0]; //info de l'utilisateur
        } else {
            return null;
        }
    }
	
	public static function getByMail($login)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE email = :email',
            array(
                ':email' => $email
            )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
				 $obj = new Utilisateur();
				$obj->setId($item['id']);
				$obj->setNom($item['nom']);
				$obj->setPrenom($item['prenom']);
				$obj->setLogin($item['login']);
				$obj->setMdp($item['mdp']);
				$obj->setEmail($item['email']);
				$obj->setTentative_connection($item['tentative_connection']);
				$obj->setStatut(Statut::getById($item['id_statut']));			
				$obj->setService(Service::getById($item['id_service']));
				$tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
	
	public static function getByService($service)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE id_service = :id_service',
            array(
                ':id_service' => $id_service
            )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
				 $obj = new Utilisateur();
				$obj->setId($item['id']);
				$obj->setNom($item['nom']);
				$obj->setPrenom($item['prenom']);
				$obj->setLogin($item['login']);
				$obj->setMdp($item['mdp']);
				$obj->setEmail($item['email']);
				$obj->setTentative_connection($item['tentative_connection']);
				$obj->setStatut(Statut::getById($item['id_statut']));			
				$obj->setService(Service::getById($item['id_service']));
				$tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
	
	public static function getByStatut($id_statut)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE id_statut = :id_statut',
            array(
                ':id_statut' => $id_statut
            )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
				$obj = new Utilisateur();
				$obj->setId($item['id']);
				$obj->setNom($item['nom']);
				$obj->setPrenom($item['prenom']);
				$obj->setLogin($item['login']);
				$obj->setMdp($item['mdp']);
				$obj->setEmail($item['email']);
				$obj->setTentative_connection($item['tentative_connection']);
				$obj->setStatut(Statut::getById($item['id_statut']));			
				$obj->setService(Service::getById($item['id_service']));
				$tab[] = $obj;
            }
            return $tab;
        } else {
            return null;
        }
    }
	
	public static function getByStatutService($id_statut, $id_service)
    {
        $connexionInstance = Connexion::getInstance();
		if ($id_service!='')
		{
			$liste = $connexionInstance->requeter(
			self::$sqlRead . ' WHERE id_statut = :id_statut AND id_service = :id_service',
			array(
				':id_statut' => $id_statut,
				':id_service' => $id_service
				)
			);
		}
		else
		{
			$liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE id_statut = :id_statut',
            array(
                ':id_statut' => $id_statut
				)
			);	
		}

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
				$obj = new Utilisateur();
				$obj->setId($item['id']);
				$obj->setNom($item['nom']);
				$obj->setPrenom($item['prenom']);
				$obj->setLogin($item['login']);
				$obj->setMdp($item['mdp']);
				$obj->setEmail($item['email']);
				$obj->setTentative_connection($item['tentative_connection']);
				$obj->setStatut(Statut::getById($item['id_statut']));			
				$obj->setService(Service::getById($item['id_service']));
				$tab[] = $obj;
            }
            return $tab;
        } else {
            return null;
        }
    }
	

    public function save()
    {
        if ($this->getId() == null) 
		{ // INSERT
            $sql = self::$sqlCreate;
			//last insert id
        } 
		else 
		{ // UPDATE
            $sql = self::$sqlUpdate;
        }

        $connexionInstance = Connexion::getInstance();
		if ($this->getService() != null) 
		{
			$parametre = array(
                ':id' => $this->getId(),
				':nom' => $this->getNom(),
				':prenom' => $this->getPrenom(),
                ':login' => $this->getLogin(),
                ':mdp' => $this->getMdp(),
				':email' => $this->getEmail(),
				':tentative_connection' => $this->getTentative_connection(),
				':id_statut' => $this->getStatut()->getID(),
				':id_service' => $this->getService()->getId()
				);
		}
		else
		{
			$parametre = array(
                ':id' => $this->getId(),
				':nom' => $this->getNom(),
				':prenom' => $this->getPrenom(),
                ':login' => $this->getLogin(),
                ':mdp' => $this->getMdp(),
				':email' => $this->getEmail(),
				':tentative_connection' => $this->getTentative_connection(),
				':id_statut' => $this->getStatut->getID(),
				':id_service' => null
				);
		}
        return $connexionInstance->executer($sql,$parametre);
    }

    public function delete()
    {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer(
            self::$sqlDelete . ' WHERE id = :id',
            array(
                ':id' => $this->getId()
            )
        );
    }
}
?>