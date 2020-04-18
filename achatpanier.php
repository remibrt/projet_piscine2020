<?php
require 'db.php';
require 'addpanier.php';
if(isset($_GET['del']))
{
	unset($_SESSION['panier'][$_GET['del']]);
}

if(isset($_SESSION['panier']) && $_SESSION['panier'] != null){$ids = array_keys($_SESSION['panier']); $products = $conn->query('SELECT * FROM objets WHERE id IN ('.implode(',', $ids).')'); 

foreach ($products as $product):
		$insertObjet = $conn->prepare("INSERT INTO achatimmediat(id_acheteur, id_objet, prix) VALUES(?, ?, ?)");
        $insertObjet ->execute(array($_SESSION['id'], $product['id'], $product['price']));    

        $notforsale = $conn->prepare("UPDATE objets SET sale = :sale WHERE id = :id");
        $notforsale ->execute(array('sale' => "1", 'id' => $product['id']));      				
endforeach; 
}


