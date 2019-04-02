<?php // connection a la base de donner
/**
 * @return PDO
 */
function connexion(){
	try
	{
		$cnx = new PDO('mysql:host=localhost;dbname=consultg', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());}
	
	return $cnx;
 }
 
 
?>
