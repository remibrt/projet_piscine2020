<?php require 'db.php';

if (isset($_GET['id'])){
  if(isset($_SESSION['id'])){
    if($_SESSION['rang'] == 3){
        $dejaEncherie = $conn->prepare("SELECT * FROM encheres WHERE id_acheteur = ?");
        $dejaEncherie ->execute(array($_SESSION['id'])); 
        $nbEncheres = $dejaEncherie->rowCount();
          if($nbEncheres >= 1){
          exit('Vous avez deja encherie sur cette objet');
        }
        echo $nbEncheres;

      if(isset($_POST["submit"])){
        $price = intval($_POST['price']);
        $id_objet = intval($_GET['id']);

        $insertObjet = $conn->prepare("INSERT INTO encheres(id_acheteur, id_objet, prix) VALUES(?, ?, ?)");
        $insertObjet ->execute(array($_SESSION['id'], $id_objet, $price));    
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
    <input name="price" type="text" placeholder="price" value="<?php if(isset($_POST['price'])) {echo $_POST['price'];} ?>" />
    <input type="submit" value="Valider" name="submit">
  </form>

<?php require 'footer.php';?>

