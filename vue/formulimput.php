<?php
/**
 * Created by PhpStorm.
 * User: ilyas
 * Date: 12/01/2019
 * Time: 19:16
 */
ini_set( 'display_errors', '1' );


//Premet la création d'un compte
$contenu = "";
$title = "";
ob_start();
$periode=listeperiode();
$idconsultant=$_POST["idconsultant"];
$idprojet=$_POST["idprojet"];
$detailrojet=get_projet_unique($idprojet);
$infoprojet=imputationactuelle($idconsultant,$idprojet);
$NOMPROJET=$detailrojet["NomProjet"];

?>




<h1><?=$NOMPROJET?></h1>
<?php if ($infoprojet!=null): ?>
    <table class="table table-striped table-dark">
        <tr>
            <th>Periode</th>
            <th>Nombre de jours travaillés </th>
        </tr>

        <?php foreach($infoprojet as $detail) :  ?>
        <form action='#' method='post'>
            <?php $detaiperiode = listeperiodeunique($detail["IdPeriode"]); ?>
            <tr>
                <td>
                    <input type='radio' name='idperiodeactuelle' value='<?= $detail["IdPeriode"] ?>'>
                    <?= $detaiperiode["Mois"], $detaiperiode["Annee"] ?>
                </td>
                <td>
                   <?= $detail["NbJours"] ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <td>Nouvelles période
                <SELECT name="periode" size="1">
                    <?php foreach ($periode as $item): ?>
                        <option value='<?= $item["IdPeriode"] ?>'> <?= $item["Mois"] , " " , $item["Annee"] ?></option>
                    <?php endforeach; ?>
                </SELECT></td><td>Jour à modifier
                <input type="number" name="nbjour" min="0">
                <input type="hidden" name="idconsultant" value="<?= $idconsultant ?>">
                <input type="hidden" name="idprojet" value="<?= $idprojet ?>">

            </td>
            <td><input type="submit" name='modification' class='btn btn-primary' value="Modifier"></td>
        </form>
    </table>
<?php endif; ?>
<br>
<br>
    <form method="post" action="#" >
        <table class="table table-striped table-dark">
            <tr>
                <td>Nb jour</td>
                <td>
                    <input min="0"  value="0" type="number" name="nbjour"/>
                </td>
            </tr>
            <tr>
                <td>Periode : </td>
                <td>
                    <SELECT name="periode" size="1" >
                    <?php foreach ($periode as $item): ?>
                        <option value='<?= $item["IdPeriode"] ?>'> <?= $item["Mois"] . " " . $item["Annee"] ?></option>
                    <?php endforeach; ?>
                    </SELECT>
                    <input type="hidden" name="idconsultant" value="<?=$idconsultant?>">
                    <input type="hidden" name="idprojet" value="<?=$idprojet?>">
                </td>
            </tr>
            <td>
                <td><input type="submit"  class='btn btn-primary' name="creation" value="Crée"></td>
            </td>
    </table>
    </form>

<?php

if(isset($_POST))
{

    //&& $_POST["nbjour"]!= 0&& isset($_POST["creation"])
    if(isset($_POST['modification'])){
        echo "MODIFICATION";
        $nbjour=$_POST["nbjour"];
        $idnewperiode=$_POST["periode"];
        $idperiodeactuelle=$_POST["idperiodeactuelle"];
        $idconsultant=$_POST["idconsultant"];
        $idprojet=$_POST["idprojet"];
       modifimputation($idperiodeactuelle,$idconsultant,$idprojet,$nbjour,$idnewperiode);
    }
    else if(isset($_POST['creation'])){
        $idperiode=$_POST["periode"];
        $nbjour=$_POST["nbjour"];
        ajoutimputation($idperiode,$idprojet,$idconsultant,$nbjour);
        header('refresh:5;url="/ppe/index.php"');
    }

}
else{
}
$contenu = ob_get_clean();
render($contenu,  $title);
?>