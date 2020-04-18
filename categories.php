<?php require 'header.php'; require 'db.php';?>
		<div class="fond">

			<a href="acheter.php">Afficher tous les articles</a>
			<form method="post" action="categories.php">
			Trier par : 
			<select name="tri">
				<option value="1">Ferrailles ou Trésor</option>
				<option value="2">Bon pour le musée</option>
				<option value="3">VIP</option>
			</select>
			<input type="submit" name="valider">Valider</form>

			<?php if(isset($_POST['tri']))
			{
				if($_POST['tri'] == 1)
				{
					$titre = "Ferrailles ou Trésor";
					$requete = $req3;
				}

				else if($_POST['tri'] == 2)
				{
					$titre = "Bon pour le musée";
					$requete = $req4;
				}

				else if($_POST['tri'] == 3)
				{
					$titre = "VIP";
					$requete = $req5;
				}
				?>
					<table class="table">
					<h2 style="margin-left: 20px;"><?php echo $titre;?> : </h2><br>
					<tr><th>Produits : </th> <th>Description : </th><th>Prix : </th></tr>
					<?php foreach ($requete as $product):?>
					<tr>
						<td><a href="produits/<?php echo $product['id'];?>.jpg"><img src="produits/<?php echo $product['id'];?>.jpg" style="width: 200px; height: 150px;"></a></td>
						<td><p><?php echo $product['description']; ?></p></td>
						<td><?php echo $product['price'];?> €</td>
						<?php if($product['Achat'] == 1){?>
                        <td><a class = "add" href="panier.php?id=<?php echo $product['id'];?>"><img src="img/panier.png" style="width: 30px;height: 30px;"></a></td><?php }else if($product['Achat'] == 2){?>
                        <td><a href="enchere.php?id=<?php echo $product['id'];?>"><img src="img/marteau.png" style="width: 30px;height: 30px;"></a></td><?php }?>
					</tr>
				<?php endforeach; }?>
				</table>
		</div>
<?php require 'footer.php';?>
