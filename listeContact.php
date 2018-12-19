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
		
		
		
		// Si il y'a des informations dans POST, alors insert personne selon les informations

		
		if($_POST){
			$appliBD->insertPersonne($_POST["nom"], $_POST["Prenom"], $_POST["photoProfil"], $_POST["dateNaissance"], $_POST["status"]);
			$lastIdPersonne = $appliBD->getLastEntry(); 
			$hobbies = $_POST["Hobbies"];
			$musique = $_POST["Musique"];
			

			foreach( $hobbies as $value){
				$appliBD->insertHobbyPersonne($lastIdPersonne->Id, $value);
			}
			foreach( $musique as $value){
				$appliBD->insertMusiquePersonne($lastIdPersonne->Id, $value);
			}

			if($_POST["Relation"]){
		
				$relations = $_POST["Relation"];
				foreach( $relations as $key=>$value){
					if($value != ""){
						$appliBD->insertRelationPersonne($lastIdPersonne->Id,$key,$value);
					}
				}
			}	
		}
		
	
		$profil = $appliBD->selectAllPersonne();
	?>

	<!-- barre continu en-tête avec les liens -->
	<div id="top_head">
		<a href="AjoutProfil.php">
			<div class="droite">
				Ajouter un profil
			</div>
		</a>
	</div>

	<!-- Div contenant le titre de la page ainsi qu'un formulaire de recherche des contacts et de la liste des contacts-->
	<div id="Contenu">

		<!-- Formulaire de recherche de contact -->
		<h1>Liste des contacts</h1>
		<form action="listeContact.php" class="formulaireRecherche" method = "GET">
            <input class="champRecherche" name="recherche" type="text" placeholder="Rechercer un profil"/>
            <input class="boutonRecherche" type="submit" value="Rechercher"/>  
        </form>

		
		

		<!-- 
		Affichage HTML de base pour le modele de contact (1 par 1)
		<a href="annuaireProfil.php?id=">
			<div class="listeContacts clair">
				<img class="imageContact" src="imgs/avatar_defaut.png" alt="image profil contact"> 
				<p>
					JEAN-PHILLIPE DE MARINIAQUE 
				</p> 
				<p>
					CELIBATAIRE
				</p> 
			</div>
		</a>
		-->

		<?php 
			// Affichage php de tout les contacts ajouter en BDD. S'affiche selon le model HTML ci-dessus 
			// si GET est pas set, afficher tout les contacts. Si GET est set, afficher la recherche des contacts effectuee

			if(!$_GET){
				foreach($profil as $value){
					echo "<a href='annuaireProfil.php?id=$value->Id'>";
					echo "<div class=\"listeContacts\">";
					echo "<img class=\"imageContact\" src=\"$value->URL_Photo \" alt=\"image profil contact\">" ;
					echo "<p>"."$value->Nom"." "."$value->Prenom"."</p>"; 	
					echo "</div>";
					echo "</a>";
				}
			}elseif(isset($_GET)){
				$recherchePersonne = $appliBD->selectPersonneByNomPrenomLike($_GET["recherche"]);
				foreach($recherchePersonne as $value){
					echo "<a href='annuaireProfil.php?id=$value->Id'>";
					echo "<div class=\"listeContacts\">";
					echo "<img class=\"imageContact\" src=\"$value->URL_Photo \" alt=\"image profil contact\">" ;
					echo "<p>"."$value->Nom"." "."$value->Prenom"."</p>"; 		
					echo "</div>";
					echo "</a>";
				}
			}				
		?>
	
	</div>
</body>
</html>

