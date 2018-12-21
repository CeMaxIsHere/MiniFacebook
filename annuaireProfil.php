<!doctype html>
<html lang="fr">

<head>
	 <meta charset="utf-8">
	 <meta http-equiv="x-ua-compatible" content="ie=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link href="style.css" rel="stylesheet">
	 <title>Annuaire - Profil</title>
</head>

<body>
	<?php
		require('connexion.php'); // page contenant la classe connexion et les fonctions de connexion à la BDD
		$appliBD = new Connexion();	// Nouvel Objet de connexion : utiliser pour chaque appel de fonction
		
// Si il y'a pas de requete GET, nous affichons le contenu de la page ERROR404.html et stoppons le programme
		if(!$_GET){
				include("ERROR404.html");
				die();
		}
// Si il y'a une requete GET
		if(isset($_GET)){
// On passe ne parametre la valeur de Id de la requete GET, de la fonction qui selectionne les personne selon leur Id, dans $profil
			$profil = $appliBD->selectPersonneById($_GET["id"]);
/* Nous verrions si l'Id entrée en valeur dans la requete est null (si elle existe), Si elle est nul, elle n'existe pas
et nous affichons le contenu de la page ERROR404.html et arretons le programme */
			if($profil == null){
				include("ERROR404.html");
				die();
			}
// recupère les hobbies de l'Id passé en parametre dans $profilHobby
			$profilHobby = $appliBD->getPersonneHobby($_GET["id"]); 
// recupère les musique de l'Id passé en parametre dans $profilHobby
			$profilMusique = $appliBD->getPersonneMusique($_GET["id"]); 
// recupère les relation de l'Id passé en parametre dans $profilHobby
			$profilRelation = $appliBD->getRelation($_GET["id"]); 		
		}			
	?>

<!-- barre continu en-tête avec les liens --> 
	<div id="top_head"> 
		<a href="listeContact.php"> 
			<div class="droite"> 
				Liste des profils  
			</div>
		</a> 
		<a href="AjoutProfil.php"> 
			<div class="droite"> 
				Ajouter un profil
			</div> 
		</a> 
	</div> 

<!-- Div contenant tout les données de profil --> 
	<div id="Contenu">
<!-- En-tête du profil
on appel les elements que nous voulons passé dans $profil -->
	    <div id = "profil-header">
            <div id = "profil-data">
	            <img class="img_profil" src= <?php echo "$profil->URL_Photo" ?> alt="Photo de profil" width="120" height="120">
	            <p>
	            	<?php echo $profil->Nom." ".$profil->Prenom; ?>	            
	           	</p>
	            <p>
	            	<?php echo $profil->Date_Naissance; ?>	            		
	            </p>
	            <p>
	            	<?php echo $profil->Statut_couple; ?>
	            </p> 
			</div>    

        </div>
<!-- block qui contient les activités l'une a côté de l'autre -->
        <div id = "activite">  
            <h2>Activité</h2>
                 
            <div id="contenu_musique">
                <h4>Musique</h4>
                
                <div  id="musique">  
                	<?php  
// Passe en boucle toutes les musiques et ressort la valeur de Type dans une liste non ordonée
                  		echo "<ul>";
						foreach($profilMusique as $value){
							echo "<li>"."$value->Type"."</li>";
						}
						echo "</ul>";
					?>
                </div>
            </div> 
            <div id="contenu_hobbies">
                <h4>Hobbies</h4>
				<div id = "hobbies">
                 	<?php  
// Passe en boucle tout les hobbies et ressort la valeur de Type dans une liste non ordonée
                  		echo "<ul>";
						foreach($profilHobby as $value){
							echo "<li>"."$value->Type"."</li>";
						}
						echo "</ul>";
					?>
                </div>
            </div>

        </div>

        <div id = "contact">
            <h2>Relation</h2>
            
			<?php 
// Passage en revue de toutes les relations du contacts - n'affiche rien s'il n'en a pas
				foreach($profilRelation as $value){
					echo "<a href='annuaireProfil.php?id=$value->Id'>";
					echo "<div class=\"listeContactsRelation\">";
					echo "<img class=\"imageContact\" src=\"$value->URL_Photo \" alt=\"image profil contact\">" ;
					echo "<p>"."$value->Nom"." "."$value->Prenom"."</p>"; 
					echo "<p>"."$value->Statut_couple"."</p>"; 
					echo "<p>"."$value->Type"."</p>"; 
					echo "</div>";
					echo "</a>";
				}		
			?>

        </div>
    </div>
</body>
</html>