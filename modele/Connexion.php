<?php

class Connexion
{
	private static $instance;

	public $connectionBDD;

	private function __construct() 
	{ //connection à la base de donnée nf    
		try 
		{      
			$this->connectionBDD = new PDO('mysql:host=localhost;dbname=nf;charset=utf8', 'root', 'root') or die("Connection failed");
		}
		catch(Exception $e) 
		{
			throw new Exception("ConnexionBDD - Exception: " . $e->getMessage());
		}
	}

	public static function getInstance()
	{ //singleton pour avoir une seule connexion active à la base
		if (!self::$instance)
		{
		    self::$instance = new Connexion();
		}
        return self::$instance;
	}

    private function __clone() {} //Protection contre les clones d'objets

	public function executer($sql, $parametre = array())
	{ // INSERT, UPDATE, DELETE
        $requete = $this->connectionBDD->prepare($sql);
        return $requete->execute($parametre);
	}

	public function requeter($sql, $parametre = array())
	{ // SELECT
		$requete = $this->connectionBDD->prepare($sql);
        $requete->execute($parametre);
		return $requete->fetchAll();
	}
	
	public function dernierID()
	{ //Retourne le dernier ID
		$dernierID = $this->connectionBDD;
		return $dernierID->lastInsertId();
	}

} 
?>