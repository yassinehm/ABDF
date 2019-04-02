    <?php
    /**
     * Created by PhpStorm.
     * User: vincent
     * Date: 25/03/2018
     * Time: 12:23
     */
    //Fichier ou ce situe tout les demandes a la base de donnée
    include_once dirname(__FILE__) . '/connexion.php';//inclusion fonction de connexion bdd
    //////////////////////////////////////////////////////////////////







    function get_authentif($poste,$login, $mdp)//controle la connexion
    {
        $cnx = connexion();
        switch($poste) {

            case "manager":
            $sql = "select IDManager,Identifiant,Mdp  from manager where Identifiant='$login' and Mdp='$mdp'";

            $res = $cnx->query($sql);

            $row = $res->fetchAll(PDO::FETCH_ASSOC);
                if ($row == true) {
                    print_r($row);
                    return $row[0]['IDManager'];
                } else {
                    return false;
                }
                break;

            case"chefprojet":
                $sql = "select IDConsultant,Identifiant,Mdp  from chefprojet where Identifiant='$login' and Mdp='$mdp'";
                $res = $cnx->query($sql);
                $row = $res->fetchAll(PDO::FETCH_ASSOC);
                if ($row == true) {
                    print_r($row);
                    return $row[0]['IDConsultant'];
                } else {
                    return false;
                }
                break;



            case"ingenieur":
               // $sql = "select IDConsultant,Identifiant,Mdp  from ingenieur where Identifiant='$login' and Mdp='$mdp'";
                $sql = "select IDConsultant,Identifiant,Mdp from ingenieur where Identifiant='$login' and Mdp='$mdp'";

                $res = $cnx->query($sql);
                $row = $res->fetchAll(PDO::FETCH_ASSOC);
                if ($row == true) {
                    print_r($row);
                    return $row[0]['IDConsultant'];
                } else {
                    return false;
                }
                break;
        }



    }

    /////////////////////////////////////
    /**
     * @return array
     */

    //////////////////////////////////ADBPROJECT///////////////////////////////////////////////////////////



    function get_creeconsultant($nom,$prenom,$date,$tel,$mail,$idmanager,$spec,$tjm,$role,$login,$mdp)
    {
    $cnx = connexion();
        $sql="INSERT INTO `consultant` (`NOM`, `PRENOM`, `DateEmbauche`, `Telephone`, `Mail`, `Identifiant`, `Mdp`, `IdManager`) 
VALUES ('$nom', '$prenom', '$date', '$tel', '$mail', '$login', '$mdp', '$idmanager');";
     $cnx->query($sql);
     $sql="Select IDConsultant from consultant where Telephone='$tel' AND DateEmbauche='$date' AND NOM='$nom' AND PRENOM='$prenom' ;";
     $res = $cnx->query($sql);
     $row = $res->fetchall(PDO::FETCH_ASSOC);
     $idconsultant=$row[0]["IDConsultant"];

     if($role=="ingenieur") {
         $sql2 = "INSERT INTO `ingenieur` (`IdConsultant`, `TJMInge`, `Specialite`, `nom`, `Prenom`, `Telephone`, `Mail`, `DateEmbauche`, `Identifiant`, `Mdp`, `IdManager`) 
         VALUES ('$idconsultant', '$tjm', '$spec', '$nom', '$prenom', '$tel', '$mail', '$date', '$login', '$mdp', '$idmanager');";
         $res = $cnx->query($sql2);
     }
     elseif ($role=="chefprojet")
     {
           $sql2 = "INSERT INTO chefprojet
     (`IDconsultant`,`TJMChef`, `NOM`, `PRENOM`, `DateEmbauche`, `Telephone`, `Mail`, `Identifiant`, `Mdp`, `IDManager`)
     VALUES ('$idconsultant', '$tjm', '$nom', '$prenom', '$date', '$tel', '$mail', '$login', '$mdp', '$idmanager')";

         $res = $cnx->query($sql2);

     }
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    function get_chefprojet()
    {
        $cnx = connexion();
        $sql = "Select * from  chefprojet;";
        $cnx->exec('SET NAMES utf8');
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return $row;
    }


    function get_creeprojet($datedebut,$datefin,$nom,$idmanager,$idtype,$idchef,$charge)
    {      $cnx=connexion();
         $sql2="INSERT INTO `projet` (`DateDebut`, `DateFin`, `NomProjet`, `ChargeProjet`, `Type`, `IdManager`, `IdConsultant`) 
VALUES ('$datedebut', '$datefin', '$nom', '$charge', '$idtype', '$idmanager', '$idchef');";
         $cnx->query($sql2);
     $sql3="SELECT IdProjet from projet where DateDebut='$datedebut' and DateFin='$datefin' and NomProjet='$nom';";
        $res = $cnx->query($sql3);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        $nbprojet=$row[0]["IdProjet"];

          $sql4="INSERT INTO `consultg`.`participe` (`IdProjet`, `IdConsultant`) VALUES ('$nbprojet', '$idchef');";
        $cnx->query($sql4);


    }

    function get_creetypeprojet($specialite)
    {      $cnx=connexion();
        $sql2 ="INSERT INTO `projetabd`.`typeprojet` (`Specialite`)
        VALUES ('$specialite')";
         $res = $cnx->query($sql2);

    }

        function get_projet()
    {
        $cnx = connexion();
        $sql = "Select * from projet;";
        $cnx->exec('SET NAMES utf8');
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return $row;
    }
    function get_projetchef($idchef)
    {
        $cnx = connexion();
        $sql = "Select * from projet where IdConsultant=$idchef;";
        $cnx->exec('SET NAMES utf8');
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return $row;
    }

   /* function effacerprojet($idprojet)
    {   $cnx=connexion()
       $sql= "DELETE FROM `projetabd`.`projet` WHERE   IdProjet ='\".$idprojet.\"';";
    $res = $cnx->query($sql);

    }*/


    function get_projet_unique($idprojet)
    {
        $cnx = connexion();
        $sql = "Select * from projet where IdProjet ='".$idprojet."';";
        $cnx->exec('SET NAMES utf8');
        $res = $cnx->query($sql);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    function get_modifprojet($datedebut,$datefin,$nom,$idtype,$idchef,$idprojet,$charge)
    {
        $cnx=connexion();
         $sql2 ="UPDATE `projet` SET `DateDebut` = '$datedebut',
                                                `DateFin`   = '$datefin',
                                                `NomProjet`       = '$nom',
                                                `Type`    = '$idtype',
                                                `IDConsultant`    = '$idchef',
                                                `chargeProjet` ='$charge'
                                          WHERE `IdProjet`  = '$idprojet' ;";
         $res = $cnx->query($sql2);
    }
    function get_consultant()
    {
        $cnx = connexion();
        $sql = "Select * from  consultant;";
        $cnx->exec('SET NAMES utf8');
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
    return $row;
    }
    function get_consultantChef($idchef)
    {
        $cnx = connexion();
        $sql = "select * from consultant, projetconsultant
where consultant.IDCONSULTANT = projetconsultant.IDConsultant
and projetconsultant.IDProjet in (select IdProjet from projet where IDchef =$idchef) group by consultant.IDCONSULTANT";
        $cnx->exec('SET NAMES utf8');
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return $row;
    }


    function get_ProjectConsultantNoIn($idConsultant){
        $cnx = connexion();
        $sql = "Select * from projet where idprojet not in (select IDProjet from projetconsultant where idconsultant = $idConsultant)";

        $cnx->exec('SET NAMES utf8');
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return $row;
    }

    function get_ProjectConsultantNoInChef($idConsultant,$idchef){
        $cnx = connexion();
        $sql = "Select * from projet 
                where idprojet not in (select IDProjet from projetconsultant where idconsultant = $idConsultant) 
                and idprojet in (select IdProjet from projet where IDchef =$idchef)";

        $cnx->exec('SET NAMES utf8');
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return $row;
    }


    function rm_Projet_Consultant($idP, $idC){
        $cnx = connexion();
        $sql = "Delete FROM projetconsultant where idconsultant=$idC and idprojet=$idP";

        return $cnx->query($sql);
    }

    function add_Projet_Consultant($idP, $idC){
        $cnx = connexion();
        $sql = "Insert into projetconsultant values($idP, $idC)";
        return $cnx->query($sql);
    }

    function edit_charge_projet($idp, $idc, $charge){
        $cnx = connexion();
        $sql = "Select * from jrimputeprojet where idprojet=$idp and idconsultant=$idc";
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        if(count($row)>0){
            $q = "UPDATE jrimputeprojet set NbJours=$charge where idconsultant=$idc and idprojet=$idp";
        }
        else{
            $q = "insert into jrimputeprojet values ($idc, $idp, $charge)";
        }

        return  $cnx->query($q);;
    }





//////////////////////ING2NIEUR//////////////////////


    function consultinge($id){
        $cnx = connexion();
        $sql = "Select * from projet where IdProjet in (select IDProjet from participe where IDConsultant = $id)";

        $res = $cnx->query($sql);
        $row = $res->fetchAll(PDO::FETCH_ASSOC);

        return  $row;
    }

    function consultinge2($id,$idprojet){
        $cnx = connexion();
          $sql = "Select Annee,Mois,Nbjours from periode,imputation where imputation.IdConsultant=$id 
and imputation.IdPeriode=periode.IdPeriode and IdProjet=$idprojet;";
        $cnx->exec('SET NAMES utf8');

        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return  $row;
    }

////////////imputation

function creationprojetimput()
{

}
/////////////equipe/
function getchefequipeduprojet($idprojet)
{
    $cnx = connexion();
    $sql = "Select *  from chefprojet where IdConsultant=(select IdConsultant from projet where IdProjet='$idprojet')";
    $res = $cnx->query($sql);
    $row = $res->fetch(PDO::FETCH_ASSOC);
    return  $row;

}
    function getequipeduprojet($idprojet)
{
    $cnx = connexion();
     $sql = "Select  * from ingenieur,participe where participe.IdConsultant=ingenieur.IdConsultant and IdProjet=$idprojet";
    $res = $cnx->query($sql);
    $row = $res->fetchall(PDO::FETCH_ASSOC);
    return  $row;

}

function getlisteingen($idmanager)
{
    $cnx = connexion();
     $sql = "Select *  from ingenieur where IdManager='$idmanager'";
    $res = $cnx->query($sql);
    $row = $res->fetchall(PDO::FETCH_ASSOC);
    return  $row;
}
    function getlisteing()
    {
        $cnx = connexion();
          $sql = "Select *  from ingenieur ";
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return  $row;
    }

    function getlistechef()
    {
        $cnx = connexion();
          $sql = "Select *  from chefprojet ";
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return  $row;
    }

function retireprojet($idC,$idP){
    $cnx = connexion();
 $sql = "Delete FROM participe where IdConsultant=$idC and IdProjet=$idP";
     $cnx->query($sql);
}

function ajoutprojet($idc,$idp)
{
    $cnx=connexion();
    $sql="INSERT INTO `participe` (`IdProjet`, `IdConsultant`) VALUES ('$idp', '$idc');";
    $cnx->query($sql);
}



function selectionprojet($idconsultant)
{
    $cnx = connexion();
      $sql = "Select *  from participe where IdConsultant =$idconsultant ";
    $cnx->exec('SET NAMES utf8');

    $res = $cnx->query($sql);
    $row = $res->fetchall(PDO::FETCH_ASSOC);
    return  $row;
}

function imputationactuelle($idconsultant,$idprojet)
{
    $cnx = connexion();
     $sql = "Select *  from imputation where IdConsultant =$idconsultant and IdProjet=$idprojet ";
    $cnx->exec('SET NAMES utf8');

    $res = $cnx->query($sql);
    $row = $res->fetchall(PDO::FETCH_ASSOC);
    return  $row;
}
    function listeperiode()
    {
        $cnx = connexion();
        $sql = "Select *  from periode  ";
        $cnx->exec('SET NAMES utf8');

        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return  $row;
    }
    function listeperiodeunique($id)
    {
        $cnx = connexion();
        $sql = "Select *  from periode  where IdPeriode=$id";
        $cnx->exec('SET NAMES utf8');
        $res = $cnx->query($sql);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return  $row;
    }
//////////////////////imputationMODIF
    function ajoutimputation($idperiode,$idprojet,$idconsultant,$nbjour)
    {
        $cnx=connexion();
         $sql="INSERT INTO `imputation` (`IdPeriode`, `IdProjet`, `IdConsultant`, `NbJours`)
 VALUES ('$idperiode', '$idprojet', '$idconsultant', '$nbjour');";
        $cnx->query($sql);

    }
function modifimputation($idperiodeactuelle,$idconsultant,$idprojet,$nbjour,$idnewperiode)
{

    $cnx=connexion();
    $sql="
UPDATE `imputation` SET `IdPeriode`='$idnewperiode', `NbJours`='$nbjour' 
WHERE  IdPeriode=$idperiodeactuelle AND `IdProjet`=$idprojet AND `IdConsultant`=$idconsultant;";
  $cnx->query($sql);

}
///////////////////////////////CHEF
function listeprojetparticipant($idprojet)
{
    $cnx = connexion();
    $sql = "Select IdConsultant from participe where IdProjet=$idprojet";
    $cnx->exec('SET NAMES utf8');
    $res = $cnx->query($sql);
    $row = $res->fetchAll(PDO::FETCH_ASSOC);
    return  $row;

}
function recupdcp($idconsultant,$idprojet)
{
    $cnx = connexion();
    $sql = "Select ingenieur.nom,ingenieur.Prenom,imputation.IdPeriode,imputation.NbJours from ingenieur,imputation 
    where ingenieur.IdConsultant=7 and imputation.IdProjet=15";
    $cnx->exec('SET NAMES utf8');
    $res = $cnx->query($sql);
    $row = $res->fetchAll(PDO::FETCH_ASSOC);
    return  $row;
}

    function get_consultantid($id)
    {
        $cnx = connexion();
        $sql = "Select * from  ingenieur where IdConsultant=$id ;";
        $cnx->exec('SET NAMES utf8');
        $res = $cnx->query($sql);
        $row = $res->fetchall(PDO::FETCH_ASSOC);
        return $row;
    }

    ?>

