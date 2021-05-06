<?php
class controleur {
	
	public function accueil() {
		$lesCategories = (new categorie)->getAll();
		(new vue)->accueil($lesCategories);
	}
	
	public function erreur404() {
		$lesCategories = (new categorie)->getAll();
		(new vue)->erreur404($lesCategories);
	}

	public function connexion() {
		if(isset($_POST["ok"])) {
			if((new client)->connexion($_POST["email"],$_POST["motdepasse"])){
				$lesCategories = (new categorie)->getAll();
				(new vue)->accueil($lesCategories);
			}
			else{
				$lesCategories = (new categorie)->getAll();
				(new vue)->connexion($lesCategories, false);
			}
		}
		else {
			$lesCategories = (new categorie)->getAll();
			(new vue)->connexion($lesCategories, true);
		}
	}

	public function inscription() {
		if(isset($_POST["ok"])) {
			if((new client)->estDejaInscrit($_POST["email"]) == false){
				if($_POST["motdepasse"] == $_POST["motdepasse2"]){
					$inscription = (new client)->inscriptionClient($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["motdepasse"], $_POST["adresse"], $_POST["cp"], $_POST["ville"], $_POST["tel"]);
				$lesCategories = (new categorie)->getAll();
				(new vue)->inscription($lesCategories, $inscription, "Erreur de saisie. Veullez recommencer.");
				}
				else{
					$lesCategories = (new categorie)->getAll();
				(new vue)->inscription($lesCategories, false, " Les mots de passe ne sont pas identique.");
				}
			}
			else{
				$lesCategories = (new categorie)->getAll();
				(new vue)->inscription($lesCategories, false, " Email deja utilisé. ");
			}
		}
		else {
			$lesCategories = (new categorie)->getAll();
			(new vue)->inscription($lesCategories, true, " ");
		}
	}

	public function produit() {
		if(isset($_GET["id"])) {
			$lesCategories = (new categorie)->getAll();
			$infosArticle = (new produit)->getInfosProduit($_GET["id"]);

			if(count($infosArticle) > 0) {
				$message = null;

				// Action du bouton ajouter au panier sur la page du produit
				if(isset($_POST["ajoutPanier"]) && isset($_POST["quantite"])) {
					if((new produit)->estDispoEnStock($_POST["quantite"], $_GET["id"])) {
						if(!(isset($_SESSION["panier"]))) {
							$_SESSION["panier"] = array();
						}
						for($i = 0; $i < $_POST["quantite"]; $i++) {
							array_push($_SESSION["panier"], $_GET["id"]);
						}

						// Message de succès à retourner à la vue
						$message = '<h3 style="color:green"> Ajout au panier reussi! </h3>';
					}
					else {
						// Message d'erreur à retourner à la vue
						$message = '<h3 style="color:red"> Erreur dans l\'ajout au panier. </h3>';
					}
				}

				(new vue)->produit($lesCategories, $infosArticle, $message);
			}
			else {
				(new vue)->erreur404($lesCategories);
			}
		}
		else {
			$lesCategories = (new categorie)->getAll();
			(new vue)->erreur404($lesCategories);
		}
	}

	public function panier($message) {
		$lesCategories = (new categorie)->getAll();
		$lesArticles = array(); // Toutes les infos des produits du panier seront dans cette variable

		// Récupérer toutes les infos des produits dans le panier
		if(isset($_SESSION["panier"])){
			$lesId = array_count_values($_SESSION["panier"]);
			foreach($lesId as $key => $val){
				$panier = array();
				$article = (new produit)->getInfosProduit($key);
				array_push($panier, $article[0]);
				array_push($panier, $article[1]);
				array_push($panier, $article[2]);
				array_push($panier, $val);

				array_push($lesArticles, $panier);
			}
			
		}
		(new vue)->panier($lesCategories, $lesArticles, $message);
	}

	public function commander() {
		if(isset($_POST["supprimer"])) {
			// Action de suppression d'un produit dans le panier (on mettra le code produit en value du $_POST["supprimer"])
			foreach (array_keys($_SESSION["panier"], $_POST["supprimer"], true) as $key) {
			    unset($_SESSION["panier"][$key]);
			}
			(new controleur)->panier("");
			
		}

		if(isset($_POST["valider"])) {
			// Validation du panier

			/*
				On doit vérifier si l'utilisateur est connecté, si ce n'est pas le cas alors il faut l'inviter à se connecter.
				Si l'utilisateur est connecté alors il faut vérifier que la quantité commandée de chaque produit du panier soit disponbile en stock.
				Si tout est ok alors on créé sa commande dans la base et l'utilisateur doit être averti que sa commande est validée et le panier doit être vidé
				Sinon il faut revenir à la page du panier et avertir l'utilisateur quel produit (préciser sa désignation) pose problème.
			*/

			if(isset($_SESSION["connexion"])){
				$lesId = array_count_values($_SESSION["panier"]);
				$enstock = null;
				foreach($lesId as $key => $val){
					$produit = (new produit)->getInfosProduit($key);
					if($val > $produit[3]){
						$enstock = $produit[1];
					}
				}
				if($enstock == null){
					(new commande)->validerCommande($_SESSION["connexion"], $_SESSION["panier"]);
					unset($_SESSION["panier"]);
					(new controleur)->panier("Commande Validé !");
				}
				else{
					(new controleur)->panier('Quantite insuffisante pour le produit "'.$enstock.'".');
				}
			}
			else{
				(new controleur)->panier("Vous n'êtes pas connecté ! <a class=\"nav-link\" href=\"index.php?action=connexion\">Connectez-Vous</a>");
			}
		}
	}

	public function categorie() {
		$lesCategories = (new categorie)->getAll();

		// Récupérer les articles et le nom de la catégorie
		$nomCategorie = (new categorie)->getNomCategorie($_GET["id"]);
		$lesArticles = (new categorie)->getProduits($_GET["id"]);
		(new vue)->categorie($lesCategories, $lesArticles, $nomCategorie[0], $_GET["id"]);
	}

	public function deconnexion() {
		if(isset($_SESSION["connexion"])) {
			unset($_SESSION["connexion"]);
		}

		$this->accueil();
	}
}