<?php
ini_set( 'display_errors', '1' );



//Premet la création d'un compte
$contenu = "";
$title = "Inscription";




ob_start();
$listeprojet=get_projet();
?>
<!DOCTYPE html>
<html>
<body>
<h1>Consultation des projets:</h1>
<br>
<table border='1px'>
    <table class="table table-striped table-dark">

                <?php foreach($listeprojet as $projet){
                    
                    echo "<tr><td>",$projet["NomProjet"],"</td>";
                    echo "<td>",$projet["DateDebut"],"</td>";
                    echo "<td>",$projet["DateFin"],"</td>";
                    echo "<td>Charge prévue",$projet["ChargeProjet"],"</td>";
                    echo "<td> <input type='hidden' name='idtype' value='",$projet["Type"],"'>";
                    echo "<td> <input type='hidden' name='idchef' value='",$projet["IdConsultant"],"'>";
                    echo "<form method='post' action='#'><td> <input type='hidden' name='idprojetModif' value='",$projet["IdProjet"],"'>";
                    echo "<input type='submit' class='btn btn-primary' value='Modifier' /></form>";
                    echo "</tr>";
                }
                ?>
    </table>
</table>

    <br>
    <a href="index.php"><input type="button" class="btn btn-primary" value="Retour " /> </a>

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
    $idprojet=$_POST["idprojet"];
    $chargeprevue=$_POST["chargeprojet"];
   // print_r($_POST);
   get_modifprojet($datedebut, $datefin, $nom, $idtype, $idchef,$idprojet,$chargeprevue);
    $listechefprojet=get_chefprojet();
    $projet_u = get_projet_unique($_POST["idprojet"]);
    echo"
    <form method='post' action='#'>
    <table>
   
       <tr><td>Nom du projet:<input type='text' name='nom' value='",$projet_u["NomProjet"],"'/>
           </td>  
           <td>
            Chef de projet: <SELECT name='chefprojet' size='1'>";
            
                   foreach($listechefprojet as $type)
                   {
                       if ($type["IdConsultant"] == $projet_u["IdConsultant"]){
                        echo "<option value='",$type['IdConsultant'],"' selected='selected'>",$type['NOM'],"  ",$type['PRENOM'],"</option>";
                       } else {
                        echo "<option value='",$type['IdConsultant'],"'>",$type['NOM'],"  ",$type['PRENOM'],"</option>";
                       }
                   }
         echo "</SELECT>
           </td>
       </tr>
        <tr>
         
            <td>
                Date début: <input type='date'  name='début' value='",$projet_u['DateDebut'],"'/>
            </td>
            <td>
                Date fin:<input type='date' name='fin' value='",$projet_u['DateFin'],"'/>
            </td>


        </tr>
        <tr>
            <td>Type de projet:<SELECT name='typeprojet' size='1'>
            <option value='TEST1' selected='selected'>TEST1</option>
            
            </SELECT>";

           echo "
            </td>
            <td>Charge projet <input name='chargeprojet' type='text' value='",$_POST['chargeprojet'],"'></td>
    </table>
    <p> <input type='hidden' name='idprojet' value='",$_POST['idprojet'],"'>
    <p> <input type='submit' class='btn btn-primary' class='btn btn-primary' value='Valider Modification' /></p>
    <br>

</form>";
}
if(isset($_POST["idprojetModif"])) {

    $listechefprojet=get_chefprojet();
    $projet_u = get_projet_unique($_POST["idprojetModif"]);
    echo "
    <form method='post' action='#'>
    <table>
    <table class=\"table table-striped table-dark\">
       <tr><td>Nom du projet:<input type='text' name='nom' value='",$projet_u["NomProjet"],"'/>
           </td>  
           <td>
            Chef de projet: <SELECT name='chefprojet' size='1'>";
            
                   foreach($listechefprojet as $type)
                   {
                       if ($type["IdConsultant"] == $projet_u["IdConsultant"]){
                        echo "<option value='",$type['IdConsultant'],"' selected='selected'>",$type['NOM'],"  ",$type['PRENOM'],"</option>";
                       } else {
                        echo "<option value='",$type['IdConsultant'],"'>",$type['NOM'],"  ",$type['PRENOM'],"</option>";
                       }
                   }
         echo "</SELECT>
           </td><td></td>
       </tr>
        <tr>
            <td>
                Date début: <input type='date'  name='début' value='",$projet_u['DateDebut'],"'/>
            </td>
            <td>
                Date fin:<input type='date' name='fin' value='",$projet_u['DateFin'],"'/>
            </td>
            <td>
                Charges prévues:<input type='text' name='chargeprojet' value='",$projet_u['ChargeProjet'],"'/>
            </td>


        </tr>
        <tr>
            <td>Type de projet:<SELECT name='typeprojet' size='1'>";
           echo "<option value='TEST1'>TEST1 </option></SELECT>
            </td><td></td><td></td>
        </tr>
    </table>
    </table>
    <p> <input type='hidden' name='idprojet' value='",$_POST['idprojetModif'],"'>
    <p> <input type='submit' class='btn btn-primary' value='Valider Modification' /></p>
    <br>
    <a href='index.php'><input type='button' class='btn btn-primary' value='Retour' /> </a>
</form>";

           echo"";
}


$contenu = ob_get_clean();
render($contenu,  $title);
?>