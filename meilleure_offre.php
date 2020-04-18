<?php
require 'db.php'; 
require 'header.php';?>
<div class="fond">

	<?php if(isset($_GET['id'])){
		$req6 = $conn->query('SELECT * FROM objets WHERE id = '.$_GET['id']);
		foreach ($req6 as $product):?>
	<?php 
		$meilleure = $conn->query('SELECT * FROM meilleure_offre WHERE id_objet = '.$product['id']);
		$best_offre = 0;
		
		if(empty($meilleure))
		{
			$best_offre = 0;
		}
		else
		{
			foreach ($meilleure as $offre) 
			{
				if($offre['offre'] > $best_offre){$best_offre = $offre['offre'];}
			}
		}
		?>

			<table class="table">

					<?php 
					$reqname = $conn->query('SELECT pseudo FROM user WHERE id ='.$product['id_vendeur']); 
					$pseudo = $reqname->fetch();
					?>
					<tr>
						<td><a href="produits/<?php echo $product['id'];?>.jpg"><img src="produits/<?php echo $product['id'];?>.jpg" style="width: 200px; height: 150px;"></a></td>
						<td><p class="text-justify"><?php echo $product['description']; ?></p>
						<p>Vendu par : <?php echo $pseudo['pseudo']; ?></p></td>
						<td style="width: 100px; margin-right: 30px;"><?php echo $product['price'];?> €</td>

						<td>Faire une offre : <form method="post" action="meilleure_offre.php?id=<?php echo $product['id']?>"><input type="number" name="offre"><input type="submit" name="valider"></form>
							<td>
							<?php 
								echo "La meilleure offre en cours est de : ".$best_offre; ?> €
							<?php
								if(isset($_POST['offre']))
								{
									if ($best_offre < $_POST['offre'])
									{
										$id_obj = $product['id'];
										$id_vendeur = $product['id_vendeur'];
										$id_acheteur = $_SESSION['id']; //recup de l'id de l'acheteur forcemment connecté et profil acheteur pour acceder à cette page.
										$offre = $_POST['offre'];
										$nombre_offre = 0;

            							$requete = $conn->prepare("INSERT INTO meilleure_offre(id_objet, id_vendeur, id_acheteur, nombre_offre, offre) VALUES(?,?,?,?,?)");
           								$requete ->execute(array($id_obj, $id_vendeur, $id_acheteur, $nombre_offre, $offre));
        							}

        							elseif ($best_offre >= $_POST['offre'])
        							{
            							echo "Vous devez faire une meilleure offre que la précedente pour acquérir l'objet !";
        							}
    							}
							?></td>
						</tr>
             </table>
        <?php endforeach;}?>
</div>
<?php require 'footer.php';?>