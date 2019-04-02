<?php
ini_set( 'display_errors', '1' );



//Premet la création d'un compte
$contenu = "";
$title = "Inscription";



ob_start();
$id=$_SESSION["id"];
$listeprojet=consultinge($id);
?>
    <table class="table table-striped table-dark">
    <tr><th>Nom du Projet</th><th>Date de début</th><th>Date de fin</th><th></th></tr>
    <?php foreach ($listeprojet as $donnee):?>
        <tr>
            <td><?=$donnee["NomProjet"]?></td><td><?=$donnee["DateDebut"]?></td><td><?=$donnee["DateFin"]?></td>
            <td><select name="periode"><?php
                $listeperiode=consultinge2($id,$donnee["IdProjet"]);
                if($listeperiode==null):?>
                <option>Aucune période </option>
                    <?php endif;
                foreach ($listeperiode as $value):?>

                    <option><?= "Année: ",$value["Annee"],"  Mois: ",$value["Mois"],"  Charge:",$value["Nbjours"]?></option>

                    <?php endforeach;

                    ?></select></td>
        </tr>
   <?php endforeach; ?>
</table>
<?php
$contenu = ob_get_clean();
render($contenu,  $title);
?>