<?php
if(isset($_GET['id'])){
	$_SESSION['panier'][$_GET['id']] = 1;
}

?>