<?php
require 'db.php';
//session_destroy();
?>
<?php require 'header.php';?>
		<div class="fond">
			<table class="table">
			<h1 style="margin-left: 20px;">Nouveautés :</h1><br><br>
			<tr><th>Produits : </th> <th>Description : </th><th>Prix : </th></tr>
				<?php foreach ($req as $product):?>
					<tr>
						<td><a href="produits/<?php echo $product['id'];?>.jpg"><img src="produits/<?php echo $product['id'];?>.jpg" style="width: 200px; height: 150px;"></a></td>
					<td><p class="text-justify"><?php echo $product['description']; ?></p></td>
					<td><?php echo $product['price'];?> €</td>
					<td><a class = "add" href="panier.php?id=<?php echo $product['id'];?>"><img src="img/panier.png" style="width: 30px;height: 30px;"></a></td>
					</tr>
				<?php endforeach ?>
			</table>
		</div>
<?php require 'footer.php';