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
              $insertObjet = $conn->prepare("INSERT INTO objets(name, id_vendeur, price, Categorie, Achat, description, photo, datefin) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
              $insertObjet ->execute(array($name, $_SESSION['id'], $price, $typeannonce, $typeachat, $description, 'default.png', $datefin));   
        }else{
          $message = 'Vous devez remplir tous les champs';
        }
      }
      else{
        if(!empty($_POST['name']) && !empty($_POST['price'])){
              $insertObjet = $conn->prepare("INSERT INTO objets(name, id_vendeur, price, Categorie, Achat, description, photo) VALUES(?, ?, ?, ?, ?, ?, ?)");
              $insertObjet ->execute(array($name, $_SESSION['id'], $price, $typeannonce, $typeachat, $description, 'default.png'));    
        }else{
          $message = 'Vous devez remplir tous les champs';
        }
    }

    if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name']))
    {
      $tailleMax = 2097152;
      $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
    if($_FILES['photo']['size'] <= $tailleMax)       
    {
      $extentionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
    if(in_array($extentionUpload, $extensionsValides))
    {
      $req = $conn->query("SELECT id FROM objets ORDER BY id DESC LIMIT 0, 1");
      $lastId = $req->fetch()['id'];

      $chemin = "produits/".$lastId.".".$extentionUpload;
      $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
    if($resultat)
    {
      $updatephoto = $conn->prepare('UPDATE objets SET photo = :photo WHERE id = :id');
      $updatephoto->execute(array('photo' => $lastId.".".$extentionUpload,'id' => $lastId));
    }else{
      $msg = "Erreur durant l'importation de votre photo de profil";
    }
    }else{
      $msg = "Votre photo de profil doit être aux formats : jpg, jpeg, gif ou png.";
    }
    }else{
      $msg = "Votre photo de profil ne doit pas dépasser 2Mo ";
    } 
    }
  
  }
  }else{
    $message = 'Vous devez etre vendeur (ou administrateur) pour accéder à cette page';
  }
}

  if(isset($message))
  {
    echo '<span class="round radius label" style="background-color:red;">' .$message. "</span>";
  }
  if(isset($msg))
  {
    echo '<span class="round radius label" style="background-color:red;">' .$msg. "</span>";
  }
?>
