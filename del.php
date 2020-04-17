<?php
require 'panier.php';
if(isset($_GET['del']))
{
	unset($_SESSION['panier'][$_GET['del']]);
}
?>