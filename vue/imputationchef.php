
<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 12/01/2019
 * Time: 09:21
 */
ini_set( 'display_errors', '1' );



//Premet la création d'un compte
$contenu = "";
$title = "";

ob_start();
$listeprojet=get_projetchef($_SESSION["id"]);

$contenu = ob_get_clean();
render($contenu,  $title);
?>