<?php require 'header.php'; require 'db.php';?>
		<div class="fond">
			<a href="acheter.php">Afficher tous les articles</a>
			<div class="Ferraille">
				<table class="table">
					<h2 style="margin-left: 20px;">Ferrailles ou Trésors : </h2><br>
					<tr><th>Produits : </th> <th>Description : </th><th>Prix : </th></tr>
					<?php foreach ($req3 as $product):?>
					<tr>
						<td><a href="produits/<?php echo $product['id'];?>.jpg"><img src="produits/<?php echo $product['id'];?>.jpg" style="width: 200px; height: 150px;"></a></td>
						<td><p><?php echo $product['description']; ?></p></td>
						<td><?php echo $product['price'];?> €</td>
						<?php if($product['Achat'] == 1){?>
                        <td><a class = "add" href="panier.php?id=<?php echo $product['id'];?>"><img src="img/panier.png" style="width: 30px;height: 30px;"></a></td><?php }else if($product['Achat'] == 2){?>
                        <td><a href="enchere.php?id=<?php echo $product['id'];?>"><img src="img/marteau.png" style="width: 30px;height: 30px;"></a></td><?php }?>
					</tr>
				<?php endforeach ?>
				</table>
			</div>
			<div class="Musée">
				<table class="table">
					<h2 style="margin-left: 20px;">Bon pour le musée</h2><br>
					<tr><th>Produits : </th> <th>Description : </th><th>Prix : </th></tr>
					<?php foreach ($req4 as $product):?>
					<tr>
						<td><a href="produits/<?php echo $product['id'];?>.jpg"><img src="produits/<?php echo $product['id'];?>.jpg" style="width: 200px; height: 150px;"></a></td>
						<td><p><?php echo $product['description']; ?></p></td>
						<td><?php echo $product['price'];?> €</td>
						<?php if($product['Achat'] == 1){?>
                        <td><a class = "add" href="panier.php?id=<?php echo $product['id'];?>"><img src="img/panier.png" style="width: 30px;height: 30px;"></a></td><?php }else if($product['Achat'] == 2){?>
                        <td><a href="enchere.php?id=<?php echo $product['id'];?>"><img src="img/marteau.png" style="width: 30px;height: 30px;"></a></td><?php }?>
					</tr>
				<?php endforeach ?>
				</table>
			</div>

			<div class="VIP">
				<table class="table">
					<h2 style="margin-left: 20px;">Accessoire VIP</h2><br>
					<tr><th>Produits : </th> <th>Description : </th><th>Prix : </th></tr>
					<?php foreach ($req5 as $product):?>
					<tr>
						<td><a href="produits/<?php echo $product['id'];?>.jpg"><img src="produits/<?php echo $product['id'];?>.jpg" style="width: 200px; height: 150px;"></a></td>
						<td><p><?php echo $product['description']; ?></p></td>
						<td><?php echo $product['price'];?> €</td>
                        <?php if($product['Achat'] == 1){?>
                        <td><a class = "add" href="panier.php?id=<?php echo $product['id'];?>"><img src="img/panier.png" style="width: 30px;height: 30px;"></a></td><?php }else if($product['Achat'] == 2){?>
                        <td><a href="enchere.php?id=<?php echo $product['id'];?>"><img src="img/marteau.png" style="width: 30px;height: 30px;"></a></td><?php }?>
					</tr>
				<?php endforeach ?>
				</table>
			</div>

		</div>
<?php require 'footer.php';?>
