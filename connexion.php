<?php

// créaction de la classe Connexion pour toutes les fonctions qui demande à ce connecter à la base de données
class Connexion{
		private $connexion;


		// Quand on appel la class, il fait la connexion car la connexion est dans le construct
        public function __construct(){
        	$PARAM_hote='localhost';

            $PARAM_port='3306';

            $PARAM_nom_bd='adminMiniFacebook';

            $PARAM_utilisateur='phpmyadmin';

            $PARAM_mot_passe='digital2018';
            try{
                $this->connexion = new PDO(
                'mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd,
                $PARAM_utilisateur,
                $PARAM_mot_passe
                );
            }
            catch(Exception $e){
                echo 'Erreur : '.$e->getMessage().'<br />';
                echo 'N° : '.$e->getCode();
            }
        }


	// Fonction retournant la connexion
    public function getConnexion(){
        return $this->connexion;
    }


    // Permet d'ajouter un hobby (avec verification quand reussi)
	function insertHobby($hobby){
		try {			
			$requete_prepare=$this->connexion->prepare(
			"INSERT INTO Hobby (Type) values (:hobby)");
			$requete_prepare->execute(
				array( 'hobby' => "$hobby"));
			return true;
		}catch(Exception $e){
			echo 'Erreur : '.$e->getMessag().'<br/>';
			echo 'N° : '.$e->getCode();
			return false;
		}
	}

	// Permet d'ajouter un type de musique 
	function insertMusique($Musique){	
		$requete_prepare=$this->connexion->prepare(
			"INSERT INTO Musique (Type) values (:musique)");
		$requete_prepare->execute(
			array( 'musique' => "$Musique"));
	}

	// permet d'ajouter un personne 
	public function insertPersonne($nom, $prenom, $URL, $date, $Statut){	
		$requete_prepare=$this->connexion->prepare(
		"INSERT INTO Personne (Nom, Prenom, URL_Photo, Date_Naissance, Statut_couple) values (:Nom, :Prenom, :URL, :Date_naissance, :Statut)");			
		$requete_prepare->execute(
			array( 'Nom' => "$nom", 'Prenom' => "$prenom", 'URL' => "$URL", 'Date_naissance' => "$date", 'Statut' => "$Statut"));
	}

	//permet d'inserer une relation entre l'idée du dernier contact ajouté et d'un hobby
	public function insertHobbyPersonne($id, $hobbyId){
		$requete_prepare=$this->connexion->prepare(
		"INSERT INTO RelationHobby (Personne_Id, Hobby_Id) values (:Personne_Id, :Hobby_Id)");			
		$requete_prepare->execute(
			array( 'Personne_Id' => $id, 'Hobby_Id' => $hobbyId));
	}

	//permet d'inserer une relation entre l'idée du dernier contact ajouté et d'une Musique
	public function insertMusiquePersonne	($id, $musiqueId){
		$requete_prepare=$this->connexion->prepare(
		"INSERT INTO RelationMusique (Personne_Id, Musique_Id) values (:Personne_Id, :Musique_Id)");			
		$requete_prepare->execute(
			array( 'Personne_Id' => "$id", 'Musique_Id' => "$musiqueId"));
	}

	// permet(tra) d'inserer la relation entre personne
	public function insertRelationPersonne($id, $relationPersonne, $type){
	$requete_prepare=$this->connexion->prepare(
	"INSERT INTO RelationPersonne (Personne_Id, Relation_Id, Type) values (:Personne_Id, :Relation_Id, :Type)");			
	$requete_prepare->execute(
	array( 'Personne_Id' => $id, 'Relation_Id' => $relationPersonne, 'Type' => $type));
	}


	// affiche les hobby de la bdd
	function afficherHobby(){	
		$requete_prepare=$this->connexion->prepare(
			"SELECT Type FROM Hobby");
		$requete_prepare->execute();
		$resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
		echo ($resultat[0]->Type);	
	}



	// selection des types de hobbies existant dans la bdd
	function selectAllHobbies(){			
			$requete_prepare=$this->connexion->prepare(
				"SELECT * FROM Hobby");
			$requete_prepare->execute();
			$resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
			return $resultat;
	}


	// selection des types de musique existant dans la bdd
	function selectAllMusique(){			
			$requete_prepare=$this->connexion->prepare(
				"SELECT * FROM Musique");
			$requete_prepare->execute();
			$resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
			return $resultat;
	}


	// Selection tout les champs de toutes les personnes ajouté a la BDD
	function selectAllPersonne(){			
			$requete_prepare=$this->connexion->prepare(
				"SELECT * FROM Personne");
			$requete_prepare->execute();
			$resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
			return $resultat;
	}



	// selection une personne selon son id
	function selectPersonneById(int $id){			
			$requete_prepare=$this->connexion->prepare(
				"SELECT * FROM Personne WHERE Id = :id");
			$requete_prepare->execute(array('id' => $id));
			$resultat=$requete_prepare->fetch(PDO::FETCH_OBJ);
			return $resultat;
	}



	// on utilise % avant la variable dans l'execute pour dire que il y'a d'autre character possible  avant la recherche possible. 
	function selectPersonneByNomPrenomLike($pattern){		
		$requete_prepare=$this->connexion->prepare(
			"SELECT * FROM Personne WHERE Nom LIKE :nom
			OR Prenom LIKE :prenom");
		$requete_prepare->execute(array("nom" => "%$pattern%", "prenom" => "%$pattern%"));
		$resultat=$requete_prepare->fetchAll(PDO::FETCH_OBJ);
		return $resultat;	
	}



	// Fonction qui retourne la liste des hobby selon l'id de la personne
	function getPersonneHobby($personneId){
		
		$requete_prepare = $this->connexion->prepare(
			"SELECT Type from Hobby h
			INNER JOIN RelationHobby rh On h.Id = rh.Hobby_Id
			WHERE rh.Personne_Id = :id");
		$requete_prepare->execute (
			array("id" => $personneId));
		$hobbies = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
		return $hobbies;
	}



	// Fonction qui retourne la liste des musique selon l'id de la personne
	function getPersonneMusique($personneId){
		
		$requete_prepare = $this->connexion->prepare(
			"SELECT Type from Musique m
			INNER JOIN RelationMusique rm On m.Id = rm.Musique_Id
			WHERE rm.Personne_Id = :id");
		$requete_prepare->execute (
			array("id" => $personneId));
		$musique = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
		return $musique;
	}



	// ------ A verifier / pas utiliser
	function getRelationPersonne($personneId){
		
		$requete_prepare = $this->connexion->prepare(
			"SELECT rp.Type from Hobby h
			INNER JOIN RelationPersonne rp On rp.Personne_Id = p.Id
			WHERE rp.Personne_Id = :id");
		$requete_prepare->execute (
			array("id" => $personneId));
		$relationPersonne = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
		return $relationPersonne;
	}



	// Affiche les relations d'un contact via son ID
	public function getRelation($personneId){
		$requete_prepare = $this->connexion->prepare(
		"SELECT p.Nom,p.Prenom,rp.Type,p.URL_Photo,p.Statut_couple,p.Id from Personne p
		INNER JOIN RelationPersonne rp On rp.Relation_Id = p.Id
		WHERE rp.Personne_Id = :id");
		$requete_prepare->execute (
			array("id" => $personneId));
		$relationPersonne = $requete_prepare->fetchAll(PDO::FETCH_OBJ);
		return $relationPersonne;
	}



	// Fonction retournant l'id du dernier contact ajouté
	public function getLastEntry(){
		$requete_prepare = $this->connexion->prepare(
		"SELECT MAX(Id) as Id FROM Personne");
		$requete_prepare->execute();
		$lastEntry = $requete_prepare->fetch(PDO::FETCH_OBJ);
		return $lastEntry;	
	}

	/*public function longueurHobby(){
		$requete_prepare = $this->connexion->prepare(
		"SELECT MAX(Id) as Id FROM Personne");
		$requete_prepare->execute();
		$lastEntry = $requete_prepare->fetch(PDO::FETCH_OBJ);
		return $lastEntry;	
	}
	*/


	// Fonction qui verifie si un ID Existe
	public function checkIdPersonne(){
            $requete_prepare = $this->connexion->prepare(
			"SELECT Id FROM Personne ");
			$requete_prepare->execute();
			$checkID = $requete_prepare->fetchAll(PDO::FETCH_OBJ);		
			return $checkID;

	}



}	
?>