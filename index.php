<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 25/03/2018
 * Time: 12:23
 */





session_start();
require 'modele/modele.php';
require 'controler/action.php';
//phpinfo();
//var_dump($_POST);
//var_dump($_SESSION);
if (isset($_GET["page"])) {//verification de la selection

    switch ($_GET["page"])//choix
    {
        case "cnx":
            authentification();
            break;

        case "deconnexion":
            session_unset();
            accueil();
            break;
        case "gestconsult":
            gestconsult();
            break;
        case "creeprojet":
            creeprojet();
            break;
        case "consultprojet":
            consultprojet();
            break;
        case "consultprojetchef":
            consultprojetchef();
            break;
        case "consultinge":
            consultprojetinge();
            break;
        case "equipemanager":
            equipemanager();
            break;
        case "imputationmanager":
            imputmanager();
            break;
        case "imputationchef":
            imputchef();
            break;
        case "imputmodif":
            modifiimput();
            break;
        case "formuimputation":
            formuimputation();
            break;
    }
} else {


    accueil();//page pas d�faut


}

?>










