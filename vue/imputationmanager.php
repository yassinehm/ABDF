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

$listeingemanager=getlisteing();
$listechefprojet=getlistechef();

echo"<table class=\"table table-striped table-dark\">
<tr>

<td><form method='post' action='#'>
<br> <input type='submit'   class='btn btn-primary' name='chef' value='Chef'></br>
</td><td> 
<input type='submit'  class='btn btn-primary' name='inge' value='Ingénieur'/></td>
</tr></form></table>";

if(isset($_POST["chef"])) {
    echo "<table class=\"table table-striped table-dark\">
";
    foreach ($listechefprojet as $d) {
        echo "<tr><td>Chef de projet</td><td>Nom:", $d["NOM"], "</td><td>Prénom:", $d["PRENOM"], "</td><td>TJM:", $d["TJMChef"], "</td>
    <td>
    <form method='post' action='index.php?page=imputmodif'>
    <input type='hidden' name='id' value='", $d["IdConsultant"], "'/>
   <p> <input type='submit'  class='btn btn-primary' value='Modifier imputation'></form></p>
</td>
</tr>";
    }
    echo "</table>";
}

elseif(isset($_POST["inge"])){
echo"<table class=\"table table-striped table-dark\">";

    foreach ($listeingemanager as $d) {
        echo "<tr><td>Ingénieur</td><td>Nom:",$d["nom"],"</td><td>Prénom:",$d["Prenom"],"</td><td>TJM:",$d["TJMInge"],"</td>
    <td>
    <form method='post' action='index.php?page=imputmodif'>
    <input type='hidden' name='id'value='",$d["IdConsultant"],"'/>
    <p><input type='submit'  class='btn btn-primary' value='Modifier imputation'/></form></p>
</td>
</tr>";
    }
    echo"</table>";}


$contenu = ob_get_clean();
render($contenu,  $title);
?>