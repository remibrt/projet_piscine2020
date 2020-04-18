<?php
require 'db.php';

if(isset($_SESSION['id'])){
  if($_SESSION['rang'] == 2 || $_SESSION['rang'] == 1){
    if(isset($_POST["submit"])){
      $name = htmlspecialchars($_POST['name']);
      $description = $_POST['description'];
      $price = intval($_POST['price']);
      $typeannonce = intval($_POST['typeannonce']);
      $typeachat = intval($_POST['typeachat']);
      $datefin = $_POST['datefin'];

     if($typeachat == 2){
        if(!empty($_POST['name']) && !empty($_POST['price'])){
              $insertObjet = $conn->prepare("INSERT INTO objets(name, price, Categorie, Achat, description, datefin) VALUES(?, ?, ?, ?, ?, NOW())");
              $insertObjet ->execute(array($name, $price, $typeannonce, $typeachat, $description));    
        }else{
          $message = 'Vous devez remplir tous les champs';
        }
      }else{
        if(!empty($_POST['name']) && !empty($_POST['price'])){
              $insertObjet = $conn->prepare("INSERT INTO objets(name, price, Categorie, Achat, description) VALUES(?, ?, ?, ?, ?)");
              $insertObjet ->execute(array($name, $price, $typeannonce, $typeachat, $description));    
        }else{
          $message = 'Vous devez remplir tous les champs';
        }
      }
    }
  }else{
    $message = 'Vous devez etre vendeur (ou administrateur) pour accéder à cette page';
  }
}else{
  $message ='Vous devez être connecté pour accéder à cette page';
}

  if(isset($message))
  {
    echo '<span class="round radius label" style="background-color:red;">' .$message. "</span>";
  }
?>
