<?php
class Epreuve
{
    // Design Pattern CRUD
    protected static $sqlCreate = "INSERT INTO epreuve (id_epreuve, nom_epreuve) VALUES (:id, :nom)";
    protected static $sqlRead = "SELECT * FROM epreuve";
    protected static $sqlUpdate = "UPDATE epreuve SET nom_epreuve = :nom WHERE id_epreuve = :id";
    protected static $sqlDelete = "DELETE FROM epreuve";

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
     * @return Epreuve[]
     */
    public static function getAllListe()
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(self::$sqlRead);

        $tab = array();
        foreach ($liste as $item)
        {
            $obj = new Epreuve();
            $obj->setId($item['id_epreuve']);
            $obj->setNom($item['nom_epreuve']);
            $tab[] = $obj;
        }

        return $tab;
    }

    /**
     * @param int $id
     * @return Epreuve
     */
    public static function getById($id)
    {
        $connexionInstance = Connexion::getInstance();
        $liste = $connexionInstance->requeter(
            self::$sqlRead.' WHERE id_epreuve = :id',
            array(
                ':id' => $id
            )
        );

        if(count($liste) > 0)
        {
            $tab = array();
            foreach ($liste as $item)
            {
                $obj = new Epreuve();
                $obj->setId($item['id_epreuve']);
                $obj->setNom($item['nom_epreuve']);
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
            self::$sqlDelete.' WHERE id_epreuve = :id',
            array(
                ':id' => $this->getId()
            )
        );
    }
}
?>