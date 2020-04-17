<?php

if(isset($_POST["submit"])){

  $rang = intval($_POST['rang']);
  $nom = htmlspecialchars($_POST['nom']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $mail = htmlspecialchars($_POST['mail']);
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $mdp = sha1($_POST['mdp']);
  $mdp2 = sha1($_POST['mdp2']);

  if(!empty($_POST['pseudo']) && !empty($_POST['mdp']) & !empty($_POST['mdp2'])){
  $pseudolength = strlen($pseudo);
 
    if($pseudolength < 255){
      $reqpseu = $conn->prepare("SELECT * FROM user WHERE pseudo = ?");
      $reqpseu ->execute(array($pseudo));
      $pseudoexist = $reqpseu->rowCount();

      $reqmail = $conn->prepare("SELECT * FROM user WHERE mail = ?");
      $reqmail->execute(array($mail));
      $mailexist = $reqmail->rowCount();

      if($mailexist == 0){

        if($pseudoexist == 0){

          if($mdp == $mdp2){

            $insertmbr = $conn->prepare("INSERT INTO user(pseudo, nom, prenom, mdp, mail, rang) VALUES(?, ?, ?, ?, ?, ?)");
            $insertmbr ->execute(array($pseudo, $nom, $prenom, $mdp, $mail, $rang)); 
          
          }else{
            $message = "Vos mots de passe ne correspondent pas !";
          }  

        }else{
          $message = "Pseudo déjà utilisé !";
        }

      }else {
        $message = "votre adresse mail n'est pas valide";
      }

    }else{
      $message = "Votre pseudo ne doit pas dépasser 255 caractères!";
    }

  }else{
  $message = "Tous les champs doivent être complétés";
  }
}

  ?>
    <?php
      if(isset($message))
      {
        echo '<span class="round radius label" style="background-color:red;">' .$message. "</span>";
      }
    ?> 