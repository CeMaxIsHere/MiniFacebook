<?php

	require('connexion.php');

	$appliBD = new Connexion();	

	// $relation = $appliBD->Relation(3);




	// Permet de tester la connexion avec la bdd

	if(is_null($appliBD->getConnexion())){
		echo "<br/>La connection n'a pas aboutie";
	}else{
		
		echo "Vous êtes connecté <br/>";
	}



	$hobbies = array(

		foreach($i = 0; $i < ; $i++){
			$hobbies[$i];

		}




	);








	/*
	$relations = $appliBD->getRelation(3);
	foreach($relations as $relation){
		echo "$relation->Prenom"." $relation->Nom"." ma relation avec est :"." $relation->Type"."<br>";
	}
	*/
/*
	if(is_null($appliBD->insertPersonne("marcus", "chieuse", "http://wwww.rebellion.com", "1977.21.05", "En couple"))){
		echo "<br/>Je l'ai pas fait";
	}else{
		
		echo "Je l'ai fais <br/>";
	}
*/

  	// permet d'ajouter une personne dans la bdd
	
	/*
	$appliBD->insertPersonne("D2", "R2", "http://wwww.rebellion.com", "1977.05.21", "En couple");	
	$appliBD->insertPersonne("PO", "C3", "http://wwww.rebellion.com", "1977-05-21", "En couple");
	$appliBD->insertPersonne("Amidala", "Padme", "http://wwww.republique.com", "1999.05.19", "En couple");
	$appliBD->insertPersonne("Skywalker", "Luke", "http://wwww.rebellion.com", "1977.05.19", "Celibataire");
	$appliBD->insertPersonne("Skywalker", "Anakin", "http://wwww.republique.com", "1999.05.19", "En couple");
	$appliBD->insertPersonne("Kenobi", "Obi-wan", "http://wwww.republique.com", "1977.05.19", "Celibataire");
	*/

	// permet de verifier si un hobby à bien été ajouter dans la bdd
	// $appliBD->insertHobby("");
/*
$typeHobby = $appliBD->selectAllHobbies();
echo "<ul>";
foreach($typeHobby as $value){
	echo "<li>"."$value->Type"."</li>";
}
echo "</ul>";
	*/


/*
$personneId = $appliBD->selectPersonneById(3);

echo $personneId->Nom."<br/>";
echo $personneId->Prenom."<br/>";
echo $personneId->Date_Naissance."<br/>";
echo $personneId->Statut_couple."<br/>";
*/



/*
$Personnes = $appliBD->selectPersonneByNomPrenomLike("ana");

echo $Personnes[0]->Prenom."<br/>";
var_dump($Personnes);
*/

/*

echo "<br/>Les Hobbies de Max <br/>";
$hobbies = $appliBD->getPersonneHobby(3);
echo "<br/>".$hobbies[0]->Type."<br/>";
echo "<br/>".$hobbies[1]->Type."<br/>";
echo "<br/>".$hobbies[2]->Type."<br/>";
echo "<br/>".$hobbies[3]->Type."<br/>";


*/


/*
echo "<br/>Les Hobbies de Prisca <br/>";
$hobbies = getPersonneHobby(4);
echo "<br/>".$hobbies[0]->Type."<br/>";
*/


/*
echo "<br/>Les Musiques de R2-D2 <br/>";
$musiques = $appliBD->getPersonneMusique(3);

	foreach($musiques as $value){
		
		echo "$value->Type"."<br/>";
	}



echo "<br/>Les Musiques de Anakin <br/>";

$musiques = $appliBD->getPersonneMusique(7);

	foreach($musiques as $value){
		
		echo "$value->Type"."<br/>";
	}
*/


/*
$appliBD->insertMusique("Metal");
$appliBD->insertMusique("Pop");
$appliBD->insertMusique("Rock");
$appliBD->insertMusique("Hip-Hop");
*/
/* $profilRelation = $appliBD->getRelation(3);
echo "<ul>";
foreach($profilRelation as $value){
	echo "<li>"."$value->Nom"."</li>";
}
echo "</ul>";
*/
?>

<!--

	
	<?php 
	
	$typeMusique = $appliBD->selectAllMusique();
		foreach($typeMusique as $value){
			echo "<input type=\"checkbox\" name=\"genre\" value=\"musique\">" ;
			echo $value->Type;
		}
	?>

-->	

