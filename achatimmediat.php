<?php require 'db.php';

if (isset($_GET['id'])){
  if(isset($_SESSION['id'])){
    if($_SESSION['rang'] == 3){

      if(isset($_POST["submit"])){
        $price = intval($_POST['price']);
        $id_objet = intval($_GET['id']);

        $insertObjet = $conn->prepare("INSERT INTO achatimmediat(id_acheteur, id_objet, prix) VALUES(?, ?, ?)");
        $insertObjet ->execute(array($_SESSION['id'], $id_objet, $price));    

        $notforsale = $conn->prepare("UPDATE objets SET sale = :sale WHERE id = :id");
        $notforsale ->execute(array('sale' => "1", 'id' => $id_objet));           
        echo "Enchere bien prise en compte";
      }

    }else{
      $message = 'Vous devez etre acheteur pour accéder à cette page';
    }
  }else{
    $message ='Vous devez être connecté pour accéder à cette page';
  }
  if(isset($message))
  {
    echo '<span class="round radius label" style="background-color:red;">' .$message. "</span>";
  }
}else{
  echo 'Erreur';
}
?>


<?php require 'header.php';?>

<form method="POST">
    <input type="submit" value="Cliquer ici pour confirmer votre achat" name="submit">
  </form>

<?php require 'footer.php';?>

