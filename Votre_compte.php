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


		<?php } if(isset($_SESSION['id']) && $_SESSION['id'] != null){require'profil.php';?>
		<table style="font-size: 30px;">
			<tr><td>Profil de <?php echo $userinfo['prenom']; ?></td></tr>
			<tr><td>Pseudo = <?php echo $userinfo['pseudo']; ?></td></tr>
			<tr><td>Prenom = <?php echo $userinfo['prenom']; ?></td></tr>
			<tr><td>Nom = <?php echo $userinfo['nom']; ?></td></tr>
			<tr><td>Mail = <?php echo $userinfo['mail']; ?></td></tr>
			<tr><td><?php if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']){ ?>
 				<a href="Votre_compte.php?deco=1">Se déconnecter</a><?php }?></td></tr>
		</table><?php }else {session_destroy();}?>
		<?php

		if(isset($_SESSION['id'])){
			if($_SESSION['rang'] == 2){
			    $reqobjets = $conn->prepare('SELECT * FROM objets WHERE id_vendeur = ?');
			    $reqobjets->execute(array($_SESSION['id']));
		?><br><br><br>
		<h3>Mes Objets à vendre : </h3>
		<?php while ($objetInfo = $reqobjets->fetch()) {if($objetInfo['Achat'] == 2){?>
			<table style="font-size: 30px;">
			<tr><td><?php echo $objetInfo['name']; ?></td></tr>
			<tr><td><?php echo $objetInfo['price']; ?></td></tr>
			<tr><td><?php echo $objetInfo['description']; ?></td></tr>
			<?php if($objetInfo['datefin'] > date("Y-m-d")){ 
				$reqenchere = $conn->prepare('SELECT * FROM encheres WHERE id_objet = ?');
			    $reqenchere->execute(array($objetInfo['id']));
			    $reqenchere2 = $conn->prepare('SELECT * FROM encheres WHERE id_objet = ?');
			    $reqenchere2->execute(array($objetInfo['id']));

			    $prixmax = 0;
			    $Deuxprixmax = 0;
			    while ($enchere = $reqenchere->fetch()) {
			    	if($prixmax < $enchere['prix']){
			    		$prixmax = $enchere['prix'];
			    		$id_gagnant = $enchere['id_acheteur'];
			    	}
			    }
			   	while ($enchere = $reqenchere2->fetch()) {
			    	if($Deuxprixmax < $enchere['prix'] AND $enchere['prix'] != $prixmax){
			    		$Deuxprixmax = $enchere['prix'];
			    	}
			    }
			    $prix_gagnant = $Deuxprixmax +1;

			    echo "L'acheteur avec l'id:".$id_gagnant." à gagné l'enchère au prix de".$prix_gagnant;
			}else{
				echo "objet en court de vente";
			}
		}
		?>
		</table>
				<?php 

				if($objetInfo['Achat'] == 3)
				{

					?>
					<table class="table">
				
					<?php
							
					 		$reqall = $conn->query('SELECT * FROM objets WHERE Achat = 3');

							$product = $reqall->fetch();
							?>
							<tr>
								<td><a href="produits/<?php echo $product['id'];?>.jpg"><img src="produits/<?php echo $product['id'];?>.jpg" style="width: 100px; height: 75px;"></a></td>
								<td><p style="text-justify;"><?php echo $product['description']; ?></p></td>
								<td><?php echo $product['price'];?> €</td>

								<?php $reqoffre = $conn->query('SELECT * FROM meilleure_offre WHERE id_vendeur = '.$_SESSION['id']);
								while($offer = $reqoffre->fetch()){ ?>
								<td><p>Offre : <?php echo $offer['offre'];?></p></td>
							</tr>
							<tr><a href="Votre_compte.php?ctr=<?php echo $offer['id_acheteur'];?>">Refuser l'offre</a></tr>
							<tr><a href="Votre_compte.php?ctr=0">Accepter l'offre</a></tr><?php } ?>

							<?php 
							if(isset($_GET['ctr'])){
								if($_GET['ctr'] == $offer['id_acheteur'] && $offer['nombre_offre'] <= 5){$acheteur = $_GET['ctr'];?>
								<form method="POST" action="Votre_compte.php">Faire une contre offre : 
									<input type="number" name="contre_offre">
									<input type="submit" name="valider">
								</form>

								<?php $nombre_offre = $nombre_offre + 1;
									  $supprimer = $conn->prepare('DELETE FROM meilleure_offre WHERE id_objet='.$product['id']);
									  $supprimer->execute();

									  $remplacer = $conn->prepare('INSERT INTO meilleure_offre(id_objet, id_vendeur, id_acheteur, nombre_offre, offre, contre_offre) VALUES (?,?,?,?,?,?)');
									  $remplacer ->execute(array($product['id'], $_SESSION['id'], $acheteur, $nombre_offre, 0, $_POST['contre_offre']));
									}
							
								if($_GET['ctr'] == 0){echo "Vous venez d'accepter l'offre !"; $supprimer = $conn->prepare('DELETE FROM meilleure_offre WHERE id_objet='.$product['id']);$supprimer->execute();} if($offer['nombre_offre'] > 5){echo "Vous ne pouvez pas refuser encore une fois offre";}
							}
								?>
					</table><?php
			}
		}
	}


			if ($_SESSION['rang'] == 3) 
			{

				$reqoffre = $conn->query('SELECT * FROM meilleure_offre WHERE id_acheteur = '.$_SESSION['id']);

					while($reponse = $reqoffre->fetch()) {?>
					<?php
						$reqall = $conn->query('SELECT * FROM objets WHERE id ='.$reponse['id_objet']);
						$product = $reqall->fetch();?>
					<table class="table">

					<tr>Vos offres postés :
						<td><a href="produits/<?php echo $product['id'];?>.jpg"><img src="produits/<?php echo $product['id'];?>.jpg" style="width: 100px; height: 75px;"></a></td>
						<td style="text-justify;"><?php echo $product['description']; ?></td>
						<td>Offre : <?php echo $reponse['offre'];?></td>
						<td>
						<?php if($reponse['contre_offre'] == null)
						{
							echo "Vous n'avez pas encore eu de réponse à votre offre";
						}?>
						</td>
					</tr>

					
					<tr>Réponses des vendeurs :
							<?php if($reponse['contre_offre'] != null)
							{
								?><p><?php echo "Le vendeur vous propose une contre offre de ".$reponse['contre_offre'];?></p><br><br>
								<tr><a href="Votre_compte.php?ctr=1?>">Refuser l'offre</a></tr>
								<tr><a href="Votre_compte.php?ctr=0">Accepter l'offre</a></tr>
							<?php ?>

							<?php if(isset($_GET['ctr'])){?>

								<form method="POST" action="Votre_compte.php">Faire une contre offre : 
									<input type="number" name="contre_offre">
									<input type="submit" name="valider">
								</form>

								<?php $nombre_offre = $nombre_offre + 1;
									  $supprimer = $conn->prepare('DELETE FROM meilleure_offre WHERE id_objet='.$product['id']);
									  $supprimer->execute();
									  $remplacer = $conn->prepare('INSERT INTO meilleure_offre(id_objet, id_vendeur, id_acheteur, nombre_offre, offre, contre_offre) VALUES (?,?,?,?,?,?)');
									  $remplacer ->execute(array($product['id'], $product['id_vendeur'], $_SESSION['id'], $nombre_offre, $_POST['contre_offre'],0 ));
									}
							
								else{echo "Vous venez d'accepter l'offre !"; $supprimer = $conn->prepare('DELETE FROM meilleure_offre WHERE id_objet='.$product['id']);$supprimer->execute();} }?>
							</tr>
						</table>
						<?php 
					}
				}
			} ?>
	</div>

<?php require 'footer.php';?>