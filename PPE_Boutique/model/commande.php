<?php

class commande {
	
	// Objet PDO servant à la connexion à la base
	private $pdo;

	// Connexion à la base de données
	public function __construct() {
		$config = parse_ini_file("config.ini");
		
		try {
			$this->pdo = new \PDO("mysql:host=".$config["host"].";dbname=".$config["database"].";charset=utf8", $config["user"], $config["password"]);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}
	
	// Récupérer toutes les commandes d'un client passé en paramètre
	public function getCommandesClient($client) {
		$sql = "SELECT * FROM commande WHERE idClient = :id";
		
		$req = $this->pdo->prepare($sql);
		$req->bindParam(':id', $client, PDO::PARAM_INT);
		$req->execute();
		
		return $req->fetchAll();
	}
	
	// Permet de créer la commande du client passé en paramètre avec l'ensemble des articles qu'il a commandé en paramètre
	public function validerCommande($client, $lesArticles) {
		$sql = $this->pdo->query("INSERT INTO commande (`dateCommande`,`idCLient`) VALUES (CURRENT_DATE(),".$client.");");

		foreach($this->getCommandesClient($client) as $commande){
			$idcommande = $commande[0];
		}
		$lesId = array_count_values($_SESSION["panier"]);
		foreach($lesId as $key => $val){
			$sql = $this->pdo->query("INSERT INTO commander (`numeroCommande`,`codeProduit`,`quantite`) VALUES (".$idcommande.",".$key.",".$val.");");

			$stock = (new produit)->getInfosProduit($key);
			$sql = $this->pdo->query("UPDATE produit SET stockProduit =".($stock[3]-$val)." WHERE codeProduit = ".$key.";");
		}
	}
}