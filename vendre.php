<?php require 'header.php';
require 'ajout_article.php';?>

<div class="fond">
	<div class="vendre" style="text-justify; margin-left: 40px; font-size: 20px;">
		<h1>Ajouter un article à vendre :</h1><br>
		<form method="POST" action="vendre.php" enctype="multipart/form-data">
			<table>
			<tr><td>Type d'objet :</td>
 			<td><select name="typeannonce"> 
      			<option value="1">Ferraille ou Trésor,</option> 
      			<option value="2">Bon pour le Musée</option> 
     		 	<option value="3">Accessoire VIP</option> 
  			</select></td></tr>
  			<tr><td>Type de vente : </td>
  			<td><select name="typeachat" onChange="afficherOuNon(this.selectedIndex);"> 
            <option value="1">Achetez-le maintenant</option>
      			<option value="2">Enchères</option>
      			<option value="3">Meilleure offre</option>
  			</select></td>
        <td><div style="display:none;" id="datefin">Jusqu'au : <input name="datefin" type="date" placeholder="datefin" value="<?php if(isset($_POST['datefin'])) {echo $_POST['datefin'];}else{ echo date("Y-m-d" );} ?>" /></div></td></tr>
  			<tr><td>Nom de l'objet : </td>
  			<td><input name="name" type="text" placeholder="name" value="<?php if(isset($_POST['name'])) {echo $_POST['name'];} ?>" /></td></tr>
  			<tr><td>Prix : </td>
 			 <td><input name="price" type="text" placeholder="price" value="<?php if(isset($_POST['price'])) {echo $_POST['price'];} ?>" /></td></tr>
 			 <tr><td>Description : </td>
 			 <td><input name="description" type="text" placeholder="description" value="<?php if(isset($_POST['description'])) {echo $_POST['description'];}
        ?>" /></td></tr>
        <input type='file' name="photo">

 			 <tr><td><input type="submit" value="Valider" name="submit"></td></tr>
 			</table>
 		</form>

    <script type="text/javascript">
      function afficherOuNon(i) {
      var divDuree = document.getElementById('datefin');
      switch(i) {
          case 1 : divDuree.style.display = ''; 
          break;
          default: divDuree.style.display = 'none'; break;
          }
      }
    </script>


	</div>
</div>

<?php require 'footer.php';?>