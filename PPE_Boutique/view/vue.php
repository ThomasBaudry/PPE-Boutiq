<?php

class vue {
	
	private function entete($lesCategories) {
		echo "
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset='UTF-8'>
					<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">

					<link rel=\"stylesheet\" href=\"css/bootstrap.min.css\">
					<link rel=\"stylesheet\" href=\"css/style.css\">

					<title>BOUTIQ</title>
				</head>
				<body>
				<nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
					<a class=\"navbar-brand\" href=\"#\">BOUTIQ</a>
					<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarSupportedContent\" aria-controls=\"navbarSupportedContent\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
						<span class=\"navbar-toggler-icon\"></span>
					</button>
				
					<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
						<ul class=\"navbar-nav mr-auto\">
							<li class=\"nav-item\">
								<a class=\"nav-link\" href=\"index.php?action=accueil\">
									Accueil
								</a>
							</li>
							
							<li class=\"nav-item dropdown\">
								<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
									Catégories
								</a>
								<div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
			";
			
			foreach($lesCategories as $uneCategorie) {
				echo "<a class=\"dropdown-item\" href=\"index.php?action=categorie&id=".$uneCategorie["idCategorie"]."\">".$uneCategorie["nomCategorie"]."</a>";
			}			

			echo "
								</div>
							</li>
			";

			if(isset($_SESSION["connexion"])) {
				echo "
							<li class=\"nav-item\">
								<a class=\"nav-link\" href=\"index.php?action=deconnexion\">Déconnexion</a>
							</li>
				";
			}
			else {
				echo "
							<li class=\"nav-item\">
								<a class=\"nav-link\" href=\"index.php?action=connexion\">Connexion</a>
							</li>
							<li class=\"nav-item\">
								<a class=\"nav-link\" href=\"index.php?action=inscription\">Inscription</a>
							</li>
				";
			}
			
		echo "
							
						</ul>
						<ul class=\"my-2 my-lg-0 navbar-nav\">
							<li class=\"nav-item\" style=\"margin-left:20px;\">
								<a class=\"nav-link active\" href=\"index.php?action=panier\">
									Panier 
			";

		if(isset($_SESSION["panier"])) {
			echo "(".count($_SESSION["panier"]).")";
		}
		else {
			echo "(0)";
		}

		echo "
								</a>
							</li>
						</form>
					</div>
				</nav>
				<div id=\"content\">
		";
	}
	
	private function fin() {
		echo "
					</div>
					<script src=\"js/jquery-3.5.1.min.js\"></script>
					<script src=\"js/bootstrap.min.js\"></script>
				</body>
			</html>
		";
	}

	public function accueil($lesCategories) {
		$this->entete($lesCategories);

		echo "
			<h1>Bienvenue dans BOUTIQ !</h1>
		";

		$this->fin();
	}

	public function connexion($lesCategories, $connection) {
		$this->entete($lesCategories);

		echo "
			<form method='POST' action='index.php?action=connexion'>
				<h1>Se connecter :</h1>
				<br/>
				<div class=\"form-group\">
					<label for=\"email\">Adresse email</label>
					<input type=\"email\" name=\"email\" class=\"form-control\" id=\"email\" placeholder=\"name@example.com\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"motdepasse\">Mot de passe</label>
					<input type=\"password\" name=\"motdepasse\" class=\"form-control\" id=\"motdepasse\" placeholder=\"●●●●●●\" required>
				</div>
				<br/>
				<a href=\"index.php?action=inscription\">Vous n'êtes pas encore client ? Inscrivez-vous !</a>
				<br/>
				<br/>
				<br/>
				<button type=\"submit\" class=\"btn btn-primary\" name=\"ok\">Connexion</button>";
		if($connection == false){
			echo "<b3 style='color:red'> Email ou Mots de passe invalides.</b3>";
		}	
		echo "</form>";
		$this->fin();
	}

	public function inscription($lesCategories, $inscriptionReussi, $message) {
		$this->entete($lesCategories);

		echo "
			<form method='POST' action='index.php?action=inscription'>
				<h1>S'inscrire :</h1>
				<br/>
				<div class=\"form-group\">
					<label for=\"nom\">Votre nom</label>
					<input type=\"text\" name=\"nom\" class=\"form-control\" id=\"nom\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"prenom\">Votre prénom</label>
					<input type=\"text\" name=\"prenom\" class=\"form-control\" id=\"prenom\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"email\">Adresse email</label>
					<input type=\"email\" name=\"email\" class=\"form-control\" id=\"email\" placeholder=\"name@example.com\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"motdepasse\">Mot de passe</label>
					<input type=\"password\" name=\"motdepasse\" class=\"form-control\" id=\"motdepasse\" placeholder=\"●●●●●●\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"motdepasse2\">Confirmer le mot de passe</label>
					<input type=\"password\" name=\"motdepasse2\" class=\"form-control\" id=\"motdepasse2\" placeholder=\"●●●●●●\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"adresse\">Votre adresse</label>
					<input type=\"text\" name=\"adresse\" class=\"form-control\" id=\"adresse\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"cp\">Votre code postal</label>
					<input type=\"text\" name=\"cp\" class=\"form-control\" id=\"cp\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"ville\">Votre ville</label>
					<input type=\"text\" name=\"ville\" class=\"form-control\" id=\"ville\" required>
				</div>
				<div class=\"form-group\">
					<label for=\"tel\">Votre numéro de téléphone (facultatif)</label>
					<input type=\"tel\" name=\"tel\" class=\"form-control\" id=\"tel\">
				</div>
				<br/>
				<a href=\"index.php?action=connexion\">Vous êtes déjà client ? Connectez-vous !</a>
				<br/>
				<br/>
				<br/>
				<button type=\"submit\" class=\"btn btn-primary\" name=\"ok\">Inscription</button>";
		if($inscriptionReussi == false){
			echo "<b3 style='color:red'>".$message."</b3>";
		}
		echo "</form>";

		$this->fin();
	}

	public function produit($lesCategories, $infoArticle, $message) {
		$this->entete($lesCategories);

		// Fiche du produit à construire
		echo '
			<div class="container">
				<div class="row row-cols-2">
					<div class="col" >
						<div class="row" style="margin-right: 1rem">
						<img id="image" src="images/'.$infoArticle[4].'">
						</div>
					</div>
					<div class="col">
						<div class="row">	
						<h2>'.$infoArticle[1].'</h2><br/><br/>
						</div>
						<div class="row">	
						<h2 style="color:red"> PRIX : '.$infoArticle[2].' €</h2>
						</div>
						<div class="row">	
						Stock : '.$infoArticle[3].'<br/><br/>
						</div>
						<div class="row">	
						<h3> Ajouter ce produit au panier : </h3>
						<br/><br/>
						</div>
						<div class="row">	
						<form name="prod" method="POST">
						Quantité : <select name="quantite" class="form-control">';
		for($i=1; $i<11; $i++){
			echo '<option value="'.$i.'">'.$i.'</option>';			
		}
		echo '
						</select><br/>
						<input type="submit" class="btn btn-secondary btn-lg" name="ajoutPanier" value="Ajout Panier"></input>
						</form>
						<br/>'.$message.'
						</div>
					</div>
				</div>
			</div>
		';
		


		$this->fin();
	}

	public function panier($lesCategories, $lesArticles, $message) {
		$this->entete($lesCategories);

		echo '
			<h1>Panier :</h1>
			<form method="POST" action="index.php?action=commander">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">Désignation des articles</th>
							<th scope="col">Prix unitaire</th>
							<th scope="col">Quantité</th>
							<th scope="col">TOTAL</th>
							<th scope="col">Supprimer</th>
						</tr>
					</thead>
					<tbody>
		';

		// Créer un ligne du tableau pour chaque article du panier. Mettre un bouton supprimer dans la dernière colonne pour supprimer l'article du panier
		foreach($lesArticles as $articles){
			echo'
				<tr>
					<th scope="row">'.$articles[1].'</th>
					<td>'.$articles[2].'</td>
					<td>'.$articles[3].'</td>
					<td>'.($articles[2]*$articles[3]).'</td>
					<td><button type="submit" class=\"btn btn-primary\" name="supprimer" value="'.$articles[0].'">Supprimer</button></th>
				</tr>
			';
		}

		echo "
					</tbody>
				</table>

				<button type='submit' class=\"btn btn-primary\" name='valider'>Valider le panier</button>
			</form>
			<h4>".$message."</h4>
		";

		$this->fin();
	}

	public function categorie($lesCategories, $lesArticles, $nomCategorie, $idCategorie) {
		$this->entete($lesCategories);
		// Afficher les articles de la catégorie sous forme de grille (https://getbootstrap.com/docs/4.5/layout/grid/#row-columns) avec pour chaque article, à afficher : photo, désignation (avec lien pour aller sur la page du produit), prix
		echo "
			<h1>".$nomCategorie."</h1>

			<div class=\"container\">
				<div class=\"row row-cols-3\">
		";
		foreach($lesArticles as $articles){
			echo "<div class=\"col\">
					<a class=\"dropdown-item\" href=\"index.php?action=produit&id=".$articles[0].'">
						<div class="card" style="width: 18rem;">
						  <img src="images/'.$articles[4].'" class="card-img-top" alt="Image"  style="height: 18rem;">
						  <div class="card-body">
						    <p class="card-title text-break" style="height: 9rem;"><b>'.$articles[1].'</b></p>
						    <p class="card-text" style="color:red">PRIX : '.$articles[2].' €</p>
						  </div>
						</div>
					</a>

				</div>';
		}
		echo "
				</div>
			</div>
		";

		$this->fin();
	}

	public function commandeValidee($lesCategories) {
		$this->entete($lesCategories);

		echo "
			<h1>Commande effectuée !</h1>
			<p>
				Votre commande a été validée avec succès !
			</p>
		";

		$this->fin();
	}

	public function erreur404($lesCategories) {
		http_response_code(404);

		$this->entete($lesCategories);

		echo "
			<h1>Erreur 404 : page introuvable !</h1>
			<br/>
			<p>
				Cette page n'existe pas ou a été supprimée !
			</p>
		";

		$this->fin();
	}
}