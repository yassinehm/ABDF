<?php
ini_set( 'display_errors', '1' );



//Premet la création d'un compte
$contenu = "";
$title = "";

ob_start();
$id=$_SESSION["id"];
$listeprojet=get_projet();

?>
    <!DOCTYPE html>
    <html>
    <body>
    Consultation des équipes et projets:<br>
        <table class="table table-striped table-dark">

        <?php foreach($listeprojet as $projet){

            echo "<tr><td>",$projet["NomProjet"],"</td>";
            echo "<td>",$projet["DateDebut"],"</td>";
            echo "<td>",$projet["DateFin"],"</td>";
            echo "<td>Charge prévue",$projet["ChargeProjet"],"</td>";
            echo "<td> <input type='hidden' name='idtype' value='",$projet["Type"],"'>";
            echo "<td> <input type='hidden' name='idchef' value='",$projet["IdConsultant"],"'>";
            echo "<form method='post' action='#'><td> <input type='hidden' name='idprojetModif' value='",$projet["IdProjet"],"'>";
            echo "<input type='submit'  class='btn btn-primary' value='Consulter equipe' /></form>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <a href="index.php"><input type="button"  class="btn btn-primary"value="Retour " /> </a>

    </body>
    </html>




<?php
if(isset($_POST["idprojetModif"])) {
    $listeingemanager=getlisteingen($_SESSION["id"]);
    $idprojet = $_POST["idprojetModif"];
    $equipe = getequipeduprojet($idprojet);
    $chef = getchefequipeduprojet($idprojet);
    echo
    "<table>
 <table class=\"table table-striped table-dark\">
    <tr>
       <td>Chef du projet:</td><td>Nom:", $chef["NOM"], "</td><td> Prénom:",$chef["PRENOM"],"</td><td>TJM:",$chef["TJMChef"],"</td>
    </tr>";
    if($equipe==null)
    {echo"<tr><td>Pas de consultant</td></tr>";}
    else{
        foreach ($equipe as $nom) {
            echo "<tr><td>Ingénieur</td><td>Nom:",$nom["nom"],"</td><td>Prénom:",$nom["Prenom"],"</td><td>",$nom["TJMInge"],"</td>
    <td>
    <form method='post' action='#'>
        <input type='hidden' name='idprojretire' value='",$_POST["idprojetModif"],"'/>
    <input type='hidden' name='idretire' value='",$nom["IdConsultant"],"'/>
    <input type='submit'  class='btn btn-primary' value='Retirer'></form>
    </table>
</td>
</tr>";
        }
    }
    echo"</table><table class='table table-striped table-dark'>
";
    foreach ($listeingemanager as $d) {
        echo "<tr><td>Ingénieur</td><td>Nom:",$d["nom"],"</td><td>Prénom:",$d["Prenom"],"</td><td>TJM:",$d["TJMInge"],"</td>
    <td>
    <form method='post' action='#'>
        <input type='hidden' name='idprojetajout' value='",$_POST["idprojetModif"],"'/>
    <input type='hidden' name='idingajout' value='",$d["IdConsultant"],"'/>
    <input type='submit'  class='btn btn-primary'value='Ajouter'></form>
</td>
</tr>";
    }
    echo"</table>";
}
if(isset($_POST["idretire"]))
{$idcretire=$_POST["idretire"]; $idprojeretire=$_POST["idprojretire"];
retireprojet($idcretire,$idprojeretire);
}
if(isset($_POST["idingajout"]))
{ $inge=$_POST["idingajout"];
$projetajout=$_POST["idprojetajout"];
    ajoutprojet($inge,$projetajout);
}
//print_r($listeingemanager);

$contenu = ob_get_clean();
render($contenu,  $title);
?>