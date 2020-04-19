<?php
session_start();
$conn =new PDO('mysql:host=localhost;dbname=projetpiscine','root','root');

$req = $conn->query('SELECT * FROM objets');
$req3 = $conn->query('SELECT * FROM objets WHERE categorie = 1');
$req4 = $conn->query('SELECT * FROM objets WHERE categorie = 2');
$req5 = $conn->query('SELECT * FROM objets WHERE categorie = 3');


?>