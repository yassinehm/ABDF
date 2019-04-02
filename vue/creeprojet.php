<?php
ini_set( 'display_errors', '1' );



//Premet la création d'un compte
$contenu = "";
$title = "Inscription";

ob_start();
$listechefprojet=get_chefprojet();
?>

<!DOCTYPE html>
<html>
<body>
Création d'un projet:<br>
<form method="post" action="#">

        <table class="table table-striped table-dark">
       <tr><td>Nom du projet:<input type="text" name="nom"/>
           </td>
           <td>
            Chef de projet: <SELECT name="chefprojet" size="1">
                   <?php foreach($listechefprojet as $type)
                   {
                       echo "<option value='",$type["IdConsultant"],"'>",$type["NOM"],"  ",$type["PRENOM"],"</option>";} ?>
               </SELECT>
           </td>
       </tr>
        <tr>
            <td>
                Date début: <input type="date"  name="début"/>
            </td>
            <td>
                Date fin:<input type="date" name="fin"/>
            </td>


        </tr><tr><td>Charge prévue: <input min='0' type='number' name="charge" value="0"></td><td></td></tr>
        <tr>
            <td>Type de projet:<SELECT name="typeprojet" size="1">
                    <option value='Web'> Web</option>
                    <option value='Robotique'> Robotique</option>
                    <option value='base de donnée'> Base de donnée</option>
                </SELECT>
            </td>

        </tr>
        </table></>

    <p> <input type="submit" class="btn btn-primary" value="Crée" /></p>
    <br>
    <a href="index.php"><input type="button" class="btn btn-primary"  value="Retour " /> </a>
</form>
</body>
</html>

<?php
if(isset($_POST["nom"])) {
    $idmanager = $_SESSION["id"];
    $idchef = $_POST["chefprojet"];
    $datedebut = $_POST["début"];
    $datefin = $_POST["fin"];
    $idtype = $_POST["typeprojet"];
    $nom = $_POST["nom"];
    $charge=$_POST["charge"];
    get_creeprojet($datedebut, $datefin, $nom, $idmanager, $idtype, $idchef,$charge);

}
$contenu = ob_get_clean();


render($contenu,  $title);
?>
