<?php
class Session
{
	// Design Pattern CRUD
     protected static $sqlCreate = "INSERT INTO session (id_session, CE_discipline, annee_session, CE_epreuve) VALUES (:id, :discipline, :annee, :epreuve)";
    protected static $sqlRead = "SELECT * FROM session";
    protected static $sqlUpdate = "UPDATE session SET CE_discipline = :discipline, annee_session = :annee, CE_epreuve = :epreuve WHERE id_session = :id";
    protected static $sqlDelete = "DELETE FROM session";


    /**
     * @var integer
     */
    private $id = null;
	
	private $discipline;
	
	private $annee;
	
	private $epreuve;
	
	
	
	
	public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
	
		 public function getDiscipline()
    {
        return $this->discipline;
    }

    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;
    }
	
	public function getAnnee()
    {
        return $this->annee;
    }

    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }
	
	public function getEpreuve()
    {
        return $this->epreuve;
    }

    public function setEpreuve($epreuve)
    {
        $this->epreuve = $epreuve;
    }
	
	public static function getAllListe()
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item) {
            $obj = new Session();
            $obj->setId($item['id_session']);
			$obj->setDiscipline(Discipline::getById($item['CE_discipline']));
			$obj->setAnnee($item['annee_session']);
            $obj->setEpreuve(Epreuve::getById($item['CE_epreuve']));
            $tab[] = $obj;
        }
        return $tab;
    }
	
	 public static function getById($id)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead . ' WHERE id_session = :id',
            array(
                ':id' => $id
            )
        );

        if (count($liste) > 0) {
            $tab = array();
            foreach ($liste as $item) {
				$obj = new Session();
				$obj->setId($item['id_session']);
				$obj->setDiscipline(Discipline::getById($item['CE_discipline']));
				$obj->setAnnee($item['annee_session']);
				$obj->setEpreuve(Epreuve::getById($item['CE_epreuve']));
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
			//last insert id
        } 
		else 
		{ // UPDATE
            $sql = self::$sqlUpdate;
        }

        $connexionInstance = Connexion::getInstance();

		$parametre = array(
			':id' => $this->getId(),
			':annee' => $this->getAnnee(),
			':discipline' => $this->getDiscipline()->getId(),
            ':epreuve' => $this->getEpreuve()->getId()
			);
			
        return $connexionInstance->executer($sql,$parametre);
    }
	
	public function delete()
    {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer(
            self::$sqlDelete . ' WHERE id_session = :id',
            array(
                ':id' => $this->getId()
            )
        );
    }
	
	
}