<?php

class Utilisateur {

    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO utilisateur (id, nom, prenom, "
            . "login, mdp, tentative_connection, id_statut, id_service, "
            . "code_mdp_oublie, confirme_code, date_expiration_code, bloque) "
            . "VALUES (:id, :nom, :prenom, :login, :mdp, "
            . ":tentative_connection, :id_statut, :id_service, :code, "
            . ":confirme, :dateExpiration, :bloque)";
    protected static $sqlRead = "SELECT * FROM utilisateur";
    protected static $sqlUpdate = "UPDATE utilisateur SET nom = :nom, "
            . "prenom = :prenom, login = :login, mdp = :mdp, "
            . "tentative_connection = :tentative_connection, "
            . "id_statut = :id_statut, id_service = :id_service, "
            . "code_mdp_oublie = :code, confirme_code = :confirme, "
            . "date_expiration_code = :dateExpiration, bloque = :bloque "
            . "WHERE id = :id";
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
     * @var boolean
     */
    private $bloque;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    /**
     * @param string $login
     */
    public function setNom($nom) {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom() {
        return $this->prenom;
    }

    /**
     * @param string $login
     */
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login) {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getMdp() {
        return $this->mdp;
    }

    /**
     * @param string $mdp
     */
    public function setMdp($mdp) {
        $this->mdp = $mdp;
    }

    /**
     * @return int
     */
    public function getTentative_connection() {
        return $this->tentative_connection;
    }

    /**
     * @param string $tentative_connection
     */
    public function setTentative_connection($tentative_connection) {
        $this->tentative_connection = $tentative_connection;
    }

    /**
     * @return Statut
     */
    public function getStatut() {
        return $this->statut;
    }

    /**
     * @param Statut $statut
     */
    public function setStatut($id_statut) {
        $this->statut = $id_statut;
    }

    /**
     * @return Service
     */
    public function getService() {
        return $this->service;
    }

    /**
     * @param Service $service
     */
    public function setService($id_service) {
        $this->service = $id_service;
    }

    /**
     * @return string
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code) {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getConfirme() {
        return $this->confirme;
    }

    /**
     * @param string $confirme
     */
    public function setConfirme($confirme) {
        $this->confirme = $confirme;
    }

    /**
     * @return string
     */
    public function getDateExpiration() {
        return $this->dateExpiration;
    }

    /**
     * @param string $dateExpiration
     */
    public function setDateExpiration($dateExpiration) {
        $this->dateExpiration = $dateExpiration;
    }

    /**
     * @return boolean
     */
    public function getBloque() {
        return $this->bloque;
    }

    /**
     * @param string $dateExpiration
     */
    public function setBloque($bloque) {
        $this->bloque = $bloque;
    }

    /**
     * @return Utilisateur[]
     */
    public static function getAllListe() {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead .
                ' ORDER BY nom ASC');

        $tab = array();
        foreach ($liste as $item) {
            $obj = new Utilisateur();
            $obj->setId($item['id']);
            $obj->setNom($item['nom']);
            $obj->setPrenom($item['prenom']);
            $obj->setLogin($item['login']);
            $obj->setMdp($item['mdp']);
            $obj->setTentative_connection($item['tentative_connection']);
            $obj->setStatut(Statut::getById($item['id_statut']));
            $obj->setService(Service::getById($item['id_service']));
            $obj->setCode($item['code_mdp_oublie']);
            $obj->setConfirme($item['confirme_code']);
            $obj->setDateExpiration($item['date_expiration_code']);
            $obj->setBloque($item['bloque']);
            $tab[] = $obj;
        }

        return $tab;
    }

    /**
     * @param int $id
     * @return Utilisateur
     */
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
                $obj = new Utilisateur();
                $obj->setId($item['id']);
                $obj->setNom($item['nom']);
                $obj->setPrenom($item['prenom']);
                $obj->setLogin($item['login']);
                $obj->setMdp($item['mdp']);
                $obj->setTentative_connection($item['tentative_connection']);
                $obj->setStatut(Statut::getById($item['id_statut']));
                $obj->setService(Service::getById($item['id_service']));
                $obj->setCode($item['code_mdp_oublie']);
                $obj->setConfirme($item['confirme_code']);
                $obj->setDateExpiration($item['date_expiration_code']);
                $obj->setBloque($item['bloque']);
                $tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getByLogin($login) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE login = :login', array(
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
                $obj->setTentative_connection($item['tentative_connection']);
                $obj->setStatut(Statut::getById($item['id_statut']));
                $obj->setService(Service::getById($item['id_service']));
                $obj->setCode($item['code_mdp_oublie']);
                $obj->setConfirme($item['confirme_code']);
                $obj->setDateExpiration($item['date_expiration_code']);
                $obj->setBloque($item['bloque']);
                $tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getByLoginMdp($login, $mdp) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE login = :login AND mdp = :mdp', array(
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
                $obj->setTentative_connection($item['tentative_connection']);
                $obj->setStatut(Statut::getById($item['id_statut']));
                $obj->setService(Service::getById($item['id_service']));
                $obj->setCode($item['code_mdp_oublie']);
                $obj->setConfirme($item['confirme_code']);
                $obj->setDateExpiration($item['date_expiration_code']);
                $obj->setBloque($item['bloque']);
                $tab[] = $obj;
            }
            return $tab[0]; //info de l'utilisateur
        } else {
            return null;
        }
    }

    public static function getByLoginCode($login, $code) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE login = :login AND '
                . 'code_mdp_oublie = :code', array(
            ':login' => $login,
            ':code' => $code
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
                $obj->setTentative_connection($item['tentative_connection']);
                $obj->setStatut(Statut::getById($item['id_statut']));
                $obj->setService(Service::getById($item['id_service']));
                $obj->setCode($item['code_mdp_oublie']);
                $obj->setConfirme($item['confirme_code']);
                $obj->setDateExpiration($item['date_expiration_code']);
                $obj->setBloque($item['bloque']);
                $tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }

    public static function getByService($id_service) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id_service = :id_service', array(
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
                $obj->setTentative_connection($item['tentative_connection']);
                $obj->setStatut(Statut::getById($item['id_statut']));
                $obj->setService(Service::getById($item['id_service']));
                $obj->setCode($item['code_mdp_oublie']);
                $obj->setConfirme($item['confirme_code']);
                $obj->setDateExpiration($item['date_expiration_code']);
                $obj->setBloque($item['bloque']);
                $tab[] = $obj;
            }
            return $tab[0];
        } else {
            return null;
        }
    }
    
    public static function getByServiceAll($id_service) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id_service = :id_service', array(
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
                $obj->setTentative_connection($item['tentative_connection']);
                $obj->setStatut(Statut::getById($item['id_statut']));
                $obj->setService(Service::getById($item['id_service']));
                $obj->setCode($item['code_mdp_oublie']);
                $obj->setConfirme($item['confirme_code']);
                $obj->setDateExpiration($item['date_expiration_code']);
                $obj->setBloque($item['bloque']);
                $tab[] = $obj;
            }
            return $tab;
        } else {
            return null;
        }
    }

    public static function getByStatut($id_statut) {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
                self::$sqlRead . ' WHERE id_statut = :id_statut', array(
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
                $obj->setTentative_connection($item['tentative_connection']);
                $obj->setStatut(Statut::getById($item['id_statut']));
                $obj->setService(Service::getById($item['id_service']));
                $obj->setCode($item['code_mdp_oublie']);
                $obj->setConfirme($item['confirme_code']);
                $obj->setDateExpiration($item['date_expiration_code']);
                $obj->setBloque($item['bloque']);
                $tab[] = $obj;
            }
            return $tab;
        } else {
            return null;
        }
    }
    
    public static function getAllDeclarant() {
        $connexionInstance = Connexion::getInstance();
        
        $liste = $connexionInstance->requeter(
                self::$sqlRead . " WHERE id_statut = " . Statut::SALARIE_ID 
                . " OR id_statut = " .Statut::EXTERNE_ID
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
                $obj->setTentative_connection($item['tentative_connection']);
                $obj->setStatut(Statut::getById($item['id_statut']));
                $obj->setService(Service::getById($item['id_service']));
                $obj->setCode($item['code_mdp_oublie']);
                $obj->setConfirme($item['confirme_code']);
                $obj->setDateExpiration($item['date_expiration_code']);
                $obj->setBloque($item['bloque']);
                $tab[] = $obj;
            }
            return $tab;
        } else {
            return null;
        }
    }

    public static function getByStatutService($id_statut, $id_service) {
        $connexionInstance = Connexion::getInstance();
        if ($id_service != '') {
            $liste = $connexionInstance->requeter(
                    self::$sqlRead . ' WHERE id_statut = :id_statut AND '
                    . 'id_service = :id_service', array(
                ':id_statut' => $id_statut,
                ':id_service' => $id_service
                    )
            );
        } else {
            $liste = $connexionInstance->requeter(
                    self::$sqlRead . ' WHERE id_statut = :id_statut', array(
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
                $obj->setTentative_connection($item['tentative_connection']);
                $obj->setStatut(Statut::getById($item['id_statut']));
                $obj->setService(Service::getById($item['id_service']));
                $obj->setCode($item['code_mdp_oublie']);
                $obj->setConfirme($item['confirme_code']);
                $obj->setDateExpiration($item['date_expiration_code']);
                $obj->setBloque($item['bloque']);
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
        if (empty($this->getCode())
                AND empty($this->getConfirme())
                AND empty($this->getDateExpiration())
                AND empty($this->getBloque()) ){
            $parametre = array(
                ':id' => $this->getId(),
                ':nom' => $this->getNom(),
                ':prenom' => $this->getPrenom(),
                ':login' => $this->getLogin(),
                ':mdp' => $this->getMdp(),
                ':tentative_connection' => null,
                ':id_statut' => $this->getStatut()->getID(),
                ':id_service' => $this->getService()->getId(),
                ':code' => null,
                ':confirme' => null,
                ':dateExpiration' => null,
                ':bloque' => null
            );
        } else {
            $parametre = array(
                ':id' => $this->getId(),
                ':nom' => $this->getNom(),
                ':prenom' => $this->getPrenom(),
                ':login' => $this->getLogin(),
                ':mdp' => $this->getMdp(),
                ':email' => $this->getEmail(),
                ':tentative_connection' => $this->getTentative_connection(),
                ':id_statut' => $this->getStatut()->getID(),
                ':id_service' => $this->getService()->getId(),
                ':code' => $this->getCode(),
                ':confirme' => $this->getConfirme(),
                ':dateExpiration' => $this->getDateExpiration(),
                ':bloque' => $this->getBloque()
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

}

?>