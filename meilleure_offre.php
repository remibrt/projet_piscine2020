<?php
require 'db.php'; 
require 'header.php';?>
<div class="fond">

	<?php if(isset($_GET['id'])){
		$req6 = $conn->query('SELECT * FROM objets WHERE id = '.$_GET['id']);
		$product = $req6->fetch();?>

	<?php 
		$meilleure = $conn->query('SELECT * FROM meilleure_offre WHERE id_objet = '.$product['id']);
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
						<?php $test = $conn->query('SELECT * FROM meilleure_offre WHERE id_acheteur = '.$_SESSION['id']);
						if($test = $test->fetchall() == array() || $test[$product['id']] == array()){?>
						<td>Faire une offre : <form method="post" action="meilleure_offre.php?id=<?php echo $product['id']?>"><input type="number" name="offre"><input type="submit" name="valider"></form>
							<td>

							<?php
								if(isset($_POST['offre']))
								{
									$nombre_offre = 0;
									$requete = $conn->prepare("INSERT INTO meilleure_offre(id_objet, id_vendeur, id_acheteur, nombre_offre, offre) VALUES(?,?,?,?,?)");
           							$requete ->execute(array($product['id'], $product['id_vendeur'], $_SESSION['id'],$nombre_offre, $_POST['offre']));
    							}
    						}
    						else{echo "Vous avez déja fait une offre pour cet objet ";}
							?></td>
						</tr>
             </table>
        <?php } ?>
</div>
<?php require 'footer.php';?>
