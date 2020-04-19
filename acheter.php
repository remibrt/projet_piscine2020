<?php
require 'db.php';
//session_destroy();
?>
<?php require 'header.php';?>
		<div class="fond">
			<?php if(isset($_SESSION['rang'])){?>
			<table class="table">
				<?php if($_SESSION['rang'] == 3 || $_SESSION['rang'] == 1){?>
			<h1 style="margin-left: 20px;">Nouveautés :</h1><br><br>
			<tr><th>Produits : </th> <th>Description : </th><th>Prix : </th></tr>
			<a href="categories.php" style="margin-left: 50px;">Afficher par catégories</a>
				<?php foreach ($req as $product):?>
					<?php $reqname = $conn->query('SELECT pseudo FROM user WHERE id ='.$product['id_vendeur']); 
					$pseudo = $reqname->fetch();?>
					<tr>
						<td><a href="produits/<?php echo $product['id'];?>.jpg"><img src="produits/<?php echo $product['id'];?>.jpg" style="width: 200px; height: 150px;"></a></td>
					<td><p class="text-justify"><?php echo $product['description']; ?></p>
						<p>Vendu par : <?php echo $pseudo['pseudo']; ?></p></td>
					<td><?php echo $product['price'];?> €</td>
					<?php if($product['Achat'] == 1){?>
					<td><a class = "add" href="panier.php?id=<?php echo $product['id'];?>"><img src="img/panier.png" style="width: 30px;height: 30px;"></a></td>
					<td><a class = "add" href="achatimmediat.php?id=<?php echo $product['id'];?>"><img src="img/panier.png" style="width: 30px;height: 30px;"></a></td><?php }else if($product['Achat'] == 2){?>
					<td><a href="enchere.php?id=<?php echo $product['id'];?>"><img src="img/marteau.png" style="width: 30px;height: 30px;"></a></td><?php }else if($product['Achat'] == 3){?>
					<td><a href="meilleure_offre.php?id=<?php echo $product['id'];?>">Faire une offre</a></td><?php }?>
					</tr>
				<?php endforeach; }else{?><h4>Vous ne pouvez pas acceder à cette page car vous n'êtes pas acheteur !</h4><?php } ?>
			</table>
		<?php } else{?><h4>Vous devez être connecté pour acceder à cette page !</h4><?php }?>
		</div>
<?php require 'footer.php';
