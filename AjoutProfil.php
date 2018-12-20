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
		$appliBD = new Connexion();	// Nouvel Objet de connexion : utiliser pour chaque appel de fonction
		$profil = $appliBD->selectAllPersonne(); // Selectionne toutes les personnes de la bdd et les mets en tableau
		$hobbies = $appliBD->selectAllHobbies(); // Selectionne tous les Hobbies de la bdd et les mets en tableau
		$musique = $appliBD->selectAllMusique(); // Selectionne toutes les musiques de la bdd et les mets en tableau
	?>

<!-- barre continu en-tête avec les liens -->
	<div id="top_head">
		<a href="listeContact.php">
			<div class="droite">
				Liste des contacts
			</div>
		</a>
	</div>

<!-- Div contenant le titre de la page ainsi que le formulaire d'ajout d'un nouveau contact -->
	<div id="Contenu">
		<!-- Titre de la page -->
		<h1>Ajouter un contact</h1>
<!-- formulaire qui envois les donné par le serveur  -->
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
<!-- Affiche tout les hobbies existants en BDD et envois un tableau avec les valeurs pour chaque hobby si coché -->
						<?php
							foreach($hobbies as $value){
								echo "<input type=\"checkbox\" name=\"Hobbies[]\" value=\"$value->Id\" id=\"$value->Type\"> <label for=\"$value->Type\">$value->Type</label>";
							}
						?>
					</td>
				</tr>
				<tr>
					<td>Musique :</td>
					<td class="textAlignRight">
<!-- Affiche toutes les musiques existants en BDD et envois un tableau avec les valeurs pour chaque musique si coché -->
						<?php
							foreach($musique as $value){
								echo "<input type=\"checkbox\" name=\"Musique[]\" value=\"$value->Id\" id=\"$value->Type\"> <label for=\"$value->Type\">$value->Type</label>";
							}
						?>
					</td>
				</tr>
				<tr>
					<td class="boutonCentrer" colspan="2">
						<input type="submit" value="Ajouter le contact">
					</td>
				</tr>

			</table>
<!-- Passe en revue toutes les personnes ajoutées de la base de données, creer un tableau d'envois de donnée
et recupère l'id de chaque personne afin d'en faire une relation qui sera egal à la valeur des options du select -->
			<?php
				foreach($profil as $value){
					
					echo "<div class=\"Contacts clair\">";
					echo "<img class=\"imageContact\" src=\"$value->URL_Photo \" alt=\"image de Contact\">" ;
					echo "<p>"."$value->Nom"." "."$value->Prenom"."</p>"; 
					echo "<p>"."<select name=\"Relation[$value->Id]\">
									<option></option>
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