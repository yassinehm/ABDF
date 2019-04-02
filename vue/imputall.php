<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 12/01/2019
 * Time: 10:30
 */
ini_set( 'display_errors', '1' );



//Premet la création d'un compte
$contenu = "";
$title = "";

ob_start();
$id=$_POST["id"];
$liste=selectionprojet($id);

if($liste!=null) {
    echo "
<table class=\"table table-striped table-dark\">
<tr><th>Nom du Projet</th><th>Date de début</th><th>Date de fin</th><th>Charge total</th></tr>";
    foreach ($liste as $detai) {
        $detailprojet = get_projet_unique($detai["IdProjet"]);

        echo "<tr><td><form method='post' action='index.php?page=formuimputation'>", $detailprojet["NomProjet"], "</td><td>", $detailprojet["DateDebut"], "</td>
<td>", $detailprojet["DateFin"], "</td><td>", $detailprojet["ChargeProjet"], "</td><input type='hidden' name='idprojet' value='",$detailprojet["IdProjet"], "'/>
<input type='hidden' name='idconsultant' value='",$id, "'/>
<td><input type='submit' class='btn btn-primary'  value='Modifier imputation'></td></form></tr>
";
    }
}
    echo "</table>";






$contenu = ob_get_clean();
render($contenu,  $title);
?>