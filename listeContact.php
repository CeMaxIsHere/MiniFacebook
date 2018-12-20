
<!doctype html>
<html lang="fr">

<head>
	 <meta charset="utf-8">
	 <meta http-equiv="x-ua-compatible" content="ie=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link href="style2.css" rel="stylesheet">
	 <title>Annuaire - Liste des contacts</title> 
</head>

<body>

	<?php
		require('connexion.php'); // page contenant la classe connexion et les fonctions de connexion à la BDD
		$appliBD = new Connexion();	// Nouvel Objet de connexion : utiliser pour chaque appel de fonction

// Si la page recois une requete POST, on lui demande de faire la fonction inscription() 
		if($_POST){
			$appliBD->inscription();
		}
// indépendament de la condition ci-dessus, nous mettons toutes les peronnes de la BDD dans $profil 
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

<!-- Div contenant le titre de la page, un formulaire permetant de rechercher des personnes dans la liste de contact
et la liste de tout les contacts -->
	<div id="Contenu">

<!-- Formulaire de recherche de contact -->
		<h1>Liste des contacts</h1>
		<form action="listeContact.php" class="formulaireRecherche" method = "GET">
            <input class="champRecherche" name="recherche" type="text" placeholder="Rechercer un profil"/>
            <input class="boutonRecherche" type="submit" value="Rechercher"/>  
        </form>

<!-- Si il n'y a pas de requete GET nous demandons de faire un affichage
de la liste des contacts de notre base de données 

Si il y'a une requete GET, nous appelons la fonction de recherche de contact 
selon la valeur entrée dans le formulaire ci-dessus, on stock le resultat 
dans le tableau $recherchePersonne et le passons en revue pour voir 
tout les resultats de la recherche -->
		<?php
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

