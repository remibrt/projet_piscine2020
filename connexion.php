<?php
require 'db.php';
if(isset($_POST['formconnexion'])){
  $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
  $mdpconnect = sha1($_POST['mdpconnect']);
  if(!empty($pseudoconnect) AND !empty($mdpconnect)){
    $requser = $conn -> prepare("SELECT * FROM user WHERE pseudo = ? AND mdp = ?");
    $requser -> execute(array($pseudoconnect, $mdpconnect));
    $userexist = $requser -> rowCount();

    if($userexist == 1){
      $userinfo = $requser -> fetch();
      $_SESSION['id'] = $userinfo['id'];
      $_SESSION['pseudo'] = $userinfo['pseudo'];
      $_SESSION['mail'] = $userinfo['mail'];
      $_SESSION['rang'] = $userinfo['rang'];
      //header("location: profil.php?id=".$_SESSION['id']);

    }else{
      $message = "Mauvais mail ou mot de passe";
    }
  }else{
    $message = "Tous les champs doivent être complétés !";
  }
}

?>
  <?php
  if(isset($message)){
    echo '<font color="red">' .$message. "</font>";
  }
  ?>