<?php
class Discipline
{
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO discipline (id_discipline, nom_discipline) VALUES (:id, :nom)";
    protected static $sqlRead = "SELECT * FROM discipline";
    protected static $sqlUpdate = "UPDATE discipline SET nom_discipline = :nom WHERE id_discipline = :id";
    protected static $sqlDelete = "DELETE FROM discipline";

    /**
     * @var integer
     */
    private $id = null;

    /**
     * @var string
     */
    private $nom;

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
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return Discipline[]
     */
    public static function getAllListe()
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item)
        {
            $obj = new Discipline();
            $obj->setId($item['id_discipline']);
            $obj->setNom($item['nom_discipline']);
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
            self::$sqlRead.' WHERE id_discipline = :id',
            array(
                ':id' => $id
            )
        );

        if(count($liste) > 0)
        {
            $tab = array();
            foreach ($liste as $item)
            {
                $obj = new Discipline();
                $obj->setId($item['id_discipline']);
                $obj->setNom($item['nom_discipline']);
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
                    ':nom' => $this->getNom()
                )
        );
    }

    public function delete()
    {
        $connexionInstance = Connexion::getInstance();
        return $connexionInstance->executer(
            self::$sqlDelete.' WHERE id_discipline = :id',
            array(
                ':id' => $this->getId()
            )
        );
    }
}
?>