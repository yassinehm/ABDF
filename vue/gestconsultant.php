<?php 
ini_set( 'display_errors', '1' );
	


//Premet la création d'un compte
$contenu = "";
$title = "Inscription";




ob_start();
?>

<!DOCTYPE html>
<html>
<body>
Création d'un compte consultant, veuillez remplir les champs :<br>
<form method="post" action="#">
    <table>
        <table class="table table-striped table-dark">
        <tr>
            <td>Selection du poste:</td>
        <td>Chef de projet <input type="radio" id="poste" name="poste" value="chefprojet" checked ></td>
            <td>Ingénieur<input type="radio" id="poste" name="poste" value="ingenieur"><td>Spécialité<input type="text" id="spec" name="spec"></td>
        </tr>
        <tr>
            <td>Login:</td>
            <td><input title='Saisir  login'type="text" name="login"/></td>
            <td>Mot de passe:</td>
            <td><input title="Saisir  mot de passe" type="text" name="mdp"/></td>
        </tr>
        <tr>
            <td>Nom:</td>
            <td><input  type="text" name="nom"/></td>
            <td>Prénom:</td>
            <td><input  type="text" name="prenom"/></td>
        </tr>
        <tr>
            <td>Téléphone:</td><td><input type="text" name="tel"></td>
            <td>Taux journalier</td><td><input type="text" name="tjm"></td>

        </tr>
        <tr><td>Date:</td><td><input type="date" name="date">  
        <td>Mail:</td><td><input type="text" name="mail"></td>
</tr>
    </table>

</table>
</table>
    <p> <input type="submit" class="btn btn-primary"
               value="Valider" /></p>
    <br>
    <a href="index.php" ><input type="button" class="btn btn-primary"
                                value="Retour " /> </a>
</form>  
</body>
</html>
<?php

  if( isset($_POST["mdp"])== true){
    $idmanager = $_SESSION["id"];
    $role = $_POST["poste"];
    $spec = $_POST["spec"];
    $login = $_POST["login"];
    $mdp = $_POST["mdp"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $tel = $_POST["tel"];
    $tjm = $_POST["tjm"];
    $date = $_POST["date"];
    $mail = $_POST["mail"];
    get_creeconsultant($nom, $prenom, $date, $tel, $mail, $idmanager, $spec, $tjm, $role, $login, $mdp);}


else{
}


?>

<?php 

$contenu = ob_get_clean();


render($contenu,  $title);
?>
