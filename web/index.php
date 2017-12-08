<?php //Point de départ de l'application
session_start();

//permet de charger les classes choisies automatiquement
//plus besoin de mettre des includes et session start dans chaque page.php
function autoloader($className)
{
    $path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'controleur'.DIRECTORY_SEPARATOR;
    if(file_exists($path.$className.'.php'))
    {
        include $path.$className.'.php';
    } 
	else
	{
		$path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'modele'.DIRECTORY_SEPARATOR;
		if(file_exists($path.$className.'.php'))
		{
			include $path.$className.'.php';
		}
	}
}

spl_autoload_register('autoloader');

$mainController = new MainController(); //permet de rediriger l'utilisateur vers la page autorisé
$mainController->dispatch(); //fonction de redirection

?>