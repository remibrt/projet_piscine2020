<?php require 'header.php';
require 'connexion.php';
if(isset($_GET['deco']) && $_GET['deco'] == 1)
{
	$_SESSION = array();
	session_destroy();
}

?>
	<div class="fond">
		<?php if(!isset($_SESSION['id'])){?>
			<div class="row" style="padding-top: 50px;">
				<div class="connexion" style="margin-left: 50px; border: 0.5px solid black; width: 500px;padding-top: 30px; text-align: center;">
					<h3>Se connecter :</h3><br><br>
					 <form method="POST" action = "Votre_compte.php" id="monform" name="formconnexion"><br>
    					<input type="text" name="pseudoconnect" placeholder="Pseudo" /><br><br>
    					<input type="password" name="mdpconnect" placeholder="Mot de passe" /><br /><br>
    					<input type="submit" name="formconnexion" id="boutoninscriptionconnexion" class="top-3"  value="Se connecter" />
  					</form>
				</div>

				<div style="width: 300px;"></div>

				<div class="inscription" style="border: 0.5px solid black; width: 500px; height: auto ;text-align: center;">
					<form method="POST">
						<br><h3>S'inscrire :</h3><br>
       				 	<input name="pseudo" type="text" placeholder="Pseudo" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['pseudo'];} ?>" /><br><br>
       				 	<input name="nom" type="text" placeholder="Nom" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['nom'];} ?>" /><br><br>
        			 	<input name="prenom" type="text" placeholder="Prenom" value="<?php if(isset($_POST['pseudo'])) {echo $_POST['prenom'];} ?>" /><br><br>
       				 	<input name="mdp" type="password" placeholder="Mot de Passe" /><br><br>
       				 	<input name="mdp2" type="password" placeholder="Confirmation Mot de Passe" /><br><br>
       				 	<input name="mail" type="email" placeholder="Entrez votre mail" value="<?php if(isset($_POST['mail'])) {echo $_POST['mail'];} ?>"/><br><br>
       				 	<p>Type d'utilisateur :</p><select name="rang">
            				<option value="1">Administrateur</option> 
            				<option value="2">Vendeur</option> 
           				 	<option value="3">Acheteur</option> 
       					</select><br><br>
      				 	<input type="submit" value="Valider" name="submit"><br><br>
      				</form>
      				<?php require 'inscription.php'; ?>
				</div>
			</div>
		<?php } else if(isset($_SESSION['id']) && $_SESSION['id'] != null){require'profil.php';?>
		<table style="font-size: 30px;">
			<tr><td>Profil de <?php echo $userinfo['prenom']; ?></td></tr>
			<tr><td>Pseudo = <?php echo $userinfo['pseudo']; ?></td></tr>
			<tr><td>Prenom = <?php echo $userinfo['prenom']; ?></td></tr>
			<tr><td>Nom = <?php echo $userinfo['nom']; ?></td></tr>
			<tr><td>Mail = <?php echo $userinfo['mail']; ?></td></tr>
			<tr><td><?php if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']){ ?>
 				<a href="Votre_compte.php?deco=1">Se déconnecter</a><?php }?></td></tr>
		</table><?php }else {session_destroy();}?>
	</div>
<?php require 'footer.php';?>