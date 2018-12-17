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

		// Si il y'a pas de parametre dans l'url ( get ) -> affiche erreur 404 autre page
		if(!$_GET){
				include("ERROR404.html");
				die();
		}


		// $checkIdPersonne = $appliBD->checkIdPersonne($_GET["id"]);

		

		 // var_dump($appliBD->checkIdPersonne($_GET["id"]));

		

		$checkId = $appliBD->checkIdPersonne();

		foreach($checkId as $value){
			echo "$value->Id <br/>";
		
		}


		if(in_array($_GET["id"], $checkId) == $_GET["id"])
		{
			echo $_GET["id"]." existe";
			die();
		}else{
			echo $_GET["id"]." existe pas";
			die();
		}
	

		if(isset($_GET)){
			$profil = $appliBD->selectPersonneById($_GET["id"]); // Selectionne la liste des gens ajouté dans la BDD
			$profilHobby = $appliBD->getPersonneHobby($_GET["id"]); // affiche les hobby du profil selon l'id de la personne
			$profilMusique = $appliBD->getPersonneMusique($_GET["id"]); // affiche les musique du profil selon l'id de la personne
			$profilRelation = $appliBD->getRelation($_GET["id"]); // affiche les relations du profil selon l'id de la personnes		
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

	<!-- Div contenant le titre de la page ainsi que le formulaire d'ajout d'un nouveau contact et la list des contacts en dessous--> 
	<div id="Contenu">
	    <div id = "profil-header">
            <div id = "profil-data">
	            <img class="img_profil" src= <?php echo "$profil->URL_Photo" ?> alt="Photo de profil" width="120" height="120">
	            <p><?php echo $profil->Nom." ".$profil->Prenom; ?></p>
	            <p><?php echo $profil->Date_Naissance; ?></p>
	            <p><?php echo $profil->Statut_couple; ?></p> 
			</div>    

        </div>

        <div id = "activite">  
            <h2>Activité</h2>
                 
            <div id="contenu_musique">
                <h4>Musique</h4>
                
                <div  id="musique">  
                	<?php  
                		// Boucle passant en revu toutes les musiques de l'id
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
				<div id = "hoppies">
                 	<?php  
                 		// Boucle passant en revu tout les Hobby de l'id
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
            
           <!--  
			Modele HTML d'affichage des relations de la personne
           <a href="annuaireProfil.php">
	            <div class="listeContactsRelation ">
					<img class="imageContact" src="imgs/avatar_defaut.jpg" alt="image profil contact"> 
					<p>
						JEAN-PHILLIPE DE MARINIAQUE 
					</p> 
					<p>
						CELIBATAIRE
					</p> 
					<p>
						Famille
					</p> 
					
				</div>
			</a>
			
			-->

			
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