<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 25/03/2018
 * Time: 12:23
 */





function render($contenu,$title)//afficheur des vue via le contenu
{

    ob_start();
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="contenu/css/style.css">


</head>

<body>

<main>

    <header>
        <h2><a title="Retour  l'index du site" href="index.php">ABConsulting</a></h2>
    </header>

    <nav>
        <h3>Menu</h3>

        <ul>

            <?php if (isset($_SESSION["connecter"]) == true && isset($_SESSION["poste"]) ) {

                switch ($_SESSION["poste"])
                {
                    case"manager":
                        echo "<li><a title=''href='index.php?page=gestconsult'>Crée un poste</a></li>";
                        echo "<li><a title=''href='index.php?page=creeprojet'>Crée un Projet</a></li>";
                        echo "<li><a title=''href='index.php?page=consultprojet'>Consulter les projets</a></li>";
                        echo "<li><a title=''href='index.php?page=equipemanager'>Consulter équipe </a></li>";
                        echo "<li><a title=''href='index.php?page=imputationmanager'>Imputation équipe </a></li>";
                        break;
                   case"chefprojet":
                    echo "<li><a title=''href='index.php?page=consultprojetchef'>Consulter les projets</a></li>";
                    break;

                    case "ingenieur":
                        echo "<li><a title='P'href='index.php?page=consultinge'>Consulter projet</a></li>";
                        break;
                }

                echo "<li><a title='Pour ce déconnecter'href='index.php?page=deconnexion'>Deconnexion</a></li>";
                
            }else {

                echo "<li><a  title='Pour ce connecter'href='index.php?page=cnx'>Connexion</a></li>";
            }


            ?>
        </ul>

    </nav>


    <div id="contenu">


        <?php
        echo $contenu;
        ?>
    </div>
    <footer>TEST</footer>


</main>
</body>



    <?php
}


// Affiche la page d'acceuil

/**
 *
 */
function accueil()
{
    require 'vue/accueil.php';
}


/**
 *
 */
function authentification()

{
    require 'vue/authentification.php';
}

/**
 *

function erreurauth()

{
    require 'vue/erreurlogmdp.php';
}
*/
/**
 *
 */
/**
 *
 */
/**
 *
 */
function erreurlogmdp()
{
    require 'vue/erreurlogmdp.php';
}

/**
 *
 */

/**
 *
 */

/**
 *
 */


/**
 *
 */
function inscription()
{
    require'vue/inscription.php';
}

function gestconsult()
{
    require'vue/gestconsultant.php';

}
function creeprojet()
{
    require 'vue/creeprojet.php';
}

function consultprojet()
{
    require 'vue/consultprojet.php';
}

function consultprojetchef()
{
    require 'vue/consultprojetchef.php';
}

function consultprojetinge()
{
    require 'vue/consultinge.php';
}
function equipemanager()
{
    require 'vue/equipemanager.php';
}

function imputmanager()
{
    require 'vue/imputationmanager.php';
}
function imputchef()
{
    require 'vue/imputationchef.php';
}
function modifiimput()
{
    require 'vue/imputall.php';
}
function formuimputation()
{
    require 'vue/formulimput.php';
}
?>