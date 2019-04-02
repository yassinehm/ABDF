    <?php
    /**
     * Created by PhpStorm.
     * User: vincent
     * Date: 05/01/2018
     * Time: 11:23
     */




    //Page qui sert a la connexion de l'utilisateur.
    $contenu = "";
    $title = "Connexion";


    ob_start();
    ?>
        <title>Connexion</title>
        <body>
        <h1>Connexion</h1>
        <form method="post" action="index.php?page=cnx">
            <table class="table table-striped table-dark">
                <tr>
                    <td>Selectionner votre poste:</td>
                </tr>
                <tr>
                    <td>  Manager <input type="radio" id="poste" name="poste" value="manager" checked>
                    </td>


                </tr>
                <tr>  <td>Chef de projet <input type="radio" id="poste" name="poste" value="chefprojet"></td>
                </tr>
                <tr>  <td>Ingénieur<input type="radio" id="poste" name="poste" value="ingenieur"></td>
                </tr>
                <tr>
                    <td>Login:<input title='Saisir votre login'type="text" name="login"/></td>
                </tr>
                <tr>
                    <td>Mot de passe:<input title="Saisir votre mot de passe" type="password" name="mdp"/></td>
                </tr>
                <tr>
                    <td><input class='btn btn-primary'title="Valider pour ce connecter" type="submit" value="Valider"/></td>
                </tr>
            </table>
            <?php if (isset($_POST["login"]) && isset($_POST["mdp"])) {
                $poste = $_POST["poste"];
                $login = $_POST["login"];
                $mdp = $_POST["mdp"];
                if ($login != null && $mdp != null && $poste != null) {

                    $authen = get_authentif($poste,$login, $mdp);

                   if ($authen == false) {
                        erreurlogmdp();
                    } else {
                        $_SESSION["connecter"] = true;
                        $_SESSION["poste"] = $poste;
                        $_SESSION["id"]=$authen;


                       // header("Refresh: 0.1; URL=http://localhost/ppe/index.php");//refresh obligatoire pour laisser le temps a wamp de charger

                        }
                    }
                else {
                        echo "erreur	 champ";

                }
            }

            else{ echo"TEST erreur vide";}
            ?>
        </form>

        </body>
        </html>

    <?php

    $contenu = ob_get_clean();


    render($contenu, $title);

    ?>