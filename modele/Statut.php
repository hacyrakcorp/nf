<?php
class Statut
{
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO statut (id, libelle) VALUES (:id, :libelle)";
    protected static $sqlRead = "SELECT * FROM statut";
    protected static $sqlUpdate = "UPDATE statut SET libelle = :libelle WHERE id = :id";
    protected static $sqlDelete = "DELETE FROM statut";
	
    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $libelle;

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
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return Statut[]
     */
    public static function getAllListe()
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item)
        {
            $obj = new Statut();
            $obj->setId($item['id']);
            $obj->setLibelle($item['libelle']);
            $tab[] = $obj;
        }

        return $tab;
    }

    /**
     * @param int $id
     * @return Statut
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
                $obj = new Statut();
                $obj->setId($item['id']);
                $obj->setLibelle($item['libelle']);
                $tab[] = $obj;
            }

            return $tab[0];
        }
        else
        {
            return null;
        }
    }
	
	public static function getByLibelle($libelle)
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
                $obj = new Statut();
                $obj->setId($item['id']);
                $obj->setLibelle($item['libelle']);
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
                    ':libelle' => $this->getLibelle()
                )
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