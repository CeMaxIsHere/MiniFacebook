<!doctype html>		
<html lang="fr">

<head>
	 <meta charset="utf-8">
	 <meta http-equiv="x-ua-compatible" content="ie=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link href="style2.css" rel="stylesheet">
	 <title>Annuaire - Ajouter un contact</title>
</head>

<body>
	
	<?php
		require('connexion.php'); // page contenant la classe connexion et les fonctions de connexion à la BDD
		$appliBD = new Connexion();	// Objet de connexion
		$profil = $appliBD->selectAllPersonne(); // Selectionne toutes les personnes de la table Personne
		
	?>



	<!-- barre continu en-tête avec les liens -->
	<div id="top_head">
		<a href="listeContact.php">
			<div class="droite">
				Liste des contacts
			</div>
		</a>
	</div>

	<!-- Div contenant le titre de la page ainsi que le formulaire d'ajout d'un nouveau contact et la list des contacts en dessous-->
	<div id="Contenu">
		<h1>Ajouter un contact</h1>

		<form method="POST" action="listeContact.php">
			<table>
				<tr>
					<td>URL Photo :</td>
					<td class="textAlignRight"> <input type="url" name="photoProfil" placeholder="URL de votre photo" required></td>
				</tr>
				<tr>
					<td>Nom :</td>
					<td class="textAlignRight"> <input type="text" name="nom" placeholder="Votre nom" required></td>
				</tr>
				<tr>
					<td>Prénom :</td>
					<td class="textAlignRight"> <input type="text" name="Prenom" placeholder="Votre prénom" required></td>
				</tr>
				<tr>
					<td>Date de naissance :</td>
					<td class="textAlignRight"> <input class="date" type="date" name="dateNaissance" required></td>
				</tr>
				<tr>
					<td>Statut :</td>
					<td class="textAlignRight"> 
						<select name="status">
							<option value="celibataire">Célibataire</option>
							<option value="en Couple">En couple</option>
							<option value="non Defini">Non defini</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Hobbies :</td>
					<td class="textAlignRight">
						<input type="checkbox" name="hobbies" value="1" id="Tennis"> <label for="Tennis">Tennis</label>
						<input type="checkbox" name="hobbies" value="1" id="Foot"><label for="Foot">Foot</label> 
						<input type="checkbox" name="hobbies" value="1" id="Marche"><label for="Marche">Marche</label>
						<input type="checkbox" name="hobbies" value="1" id="Guitare"><label for="Guitare">Guitare</label>
					</td>
				</tr>
				<tr>
					<td>Musique :</td>
					<td class="textAlignRight">
						<input type="checkbox" name="Rock" id="Rock"><label for="Rock">Rock</label>
						<input type="checkbox" name="Metal" id="Metal"><label for="Metal">Metal</label> 
						<input type="checkbox" name="Rap" id="Rap"><label for="Rap">Rap</label> 
						<input type="checkbox" name="Hiphop" id="Hiphop"><label for="Hiphop">Hip-Hop</label> 
					</td>
				</tr>
				<tr>
					<td class="boutonCentrer" colspan="2">
						<input type="submit" value="Ajouter le contact">
					</td>
				</tr>

			</table>

		<!--	<div class="Contacts clair">
				<img class="imageContact" src="imgs/avatar_defaut.png" alt="image de Contact"> 
				<p>
					JEAN-PHILLIPE DE MARINIAQUE - CELIBATAIRE
				</p> 
				<p>
					<select>
						<option value="Relation">Relation</option>
						<option value="Famille">Famille</option>
						<option value="Collegue">Collègue</option>
						<option value="Ami">Ami</option>
					</select>
				</p>
			</div>
		-->
		<?php
			foreach($profil as $value){
				
				echo "<div class=\"Contacts clair\">";
				echo "<img class=\"imageContact\" src=\"$value->URL_Photo \" alt=\"image de Contact\">" ;
				echo "<p>"."$value->Nom"." "."$value->Prenom"."</p>"; 
				echo "<p>"."<select>
								<option value=\"\"></option>
								<option value=\"Famille\">Famille</option>
								<option value=\"Collegue\">Collègue</option>
								<option value=\"Ami\">Ami</option>
							</select>"."</p>";		
				echo "</div>";
				echo "</a>";
			}
		?>

			<table>
				<tr>
					<td class="boutonCentrer">
						<input type="submit" value="Ajouter le contact">
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>