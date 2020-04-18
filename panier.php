<?php
require 'db.php';
require 'addpanier.php';
if(isset($_GET['del']))
{
	unset($_SESSION['panier'][$_GET['del']]);
}
?>

<?php require 'header.php';?>

		<div class="fond">
			<div class="Info" style="margin-left: 30px;padding-top: 30px;">
				<h5 >Votre Panier :</h5>
				<table class="table">
				
				<?php if(isset($_SESSION['panier']) && $_SESSION['panier'] != null){$ids = array_keys($_SESSION['panier']); $products = $conn->query('SELECT * FROM objets WHERE id IN ('.implode(',', $ids).')');?><tr><th>Produits : </th> <th>Description : </th><th>Prix : </th></tr><?php $prixtot = 0;
					foreach ($products as $product):?>
					<tr>
					<td><a href="produits/<?php echo $product['id'];?>.jpg"><img src="produits/<?php echo $product['id'];?>.jpg" style="width: 200px; height: 150px;"></a></td>
					<td><p><?php echo $product['name']; ?></p></td>
					<td><?php echo $product['price'];?> €</td>
					<td><a href="del.php?del=<?php echo $product['id'];?>">Supprimer du panier</a></td>
					</tr>
				<?php $prixtot += $product['price'];
					endforeach; 
					echo "Prix total =".$prixtot;
				} else{?><p>Votre panier est vide</p><?php } ?>
				</table>
				<a href="acheter.php">Continuer mes achats</a>
				<a href="achatpanier.php">Acheter tout le panier</a>
			</div>
		</div>

<?php require 'footer.php'?>