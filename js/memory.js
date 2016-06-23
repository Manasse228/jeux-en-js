
/**
 * 
 * Recupération des informations sur la page web
 * 
 * */
var getIdJeu = document.getElementById('jeu');
var score = document.getElementById('score');
var meilleurScore = document.getElementById('meilleur');


/**
 * 
 * Initialisaton
 * 
 * */
var compteur = 0;
var meilleurScoreCookies = 0;
document.cookie = ""; 


/**
 * 
 * On parcours tous les cookies à la recherhe 
 * du cookies meilleurscore pour récupérer le 
 * meilleur score gardé en mémoire
 * 
 * */
var listCookies = document.cookie.split(';');
for(var j=0; j < listCookies.length;j++){
	var cookie = listCookies[j].split('=');
	if( cookie[0] == "meilleurScore" ){
		meilleurScore.textContent = cookie[1];
		meilleurScoreCookies = parseInt(cookie[1]);
		break;	
	}
}



/* Prend une liste de couleurs en paramètre,
 * ajoute les règles correspondantes dans le CSS, et
 * renvoie une liste de cartes dans un ordre aléatoire. */
function createCartes(couleurs) {
	var cartes = [];
	var i;

	/* Ajout des règles CSS correspondant aux couleurs */
	var css = window.document.styleSheets[0];
	for (i = 0; i < couleurs.length; i++)
		css.insertRule("." + couleurs[i] + " { background: " + couleurs[i] + "; }", 0);

	/* Chaque couleur est dédoublée */
	couleurs = couleurs.concat(couleurs);
	/* Tant qu'il reste une couleur, on en tire une au hasard */
	while (couleurs.length !== 0) {
		/* On tire un indice au hasard dans
		 * la liste des couleurs */
		i = Math.floor(Math.random() * couleurs.length);
		/* On ajoute une carte dans le tableau */
		cartes.push({
			couleur: couleurs[i],
			li: null,
		});
		/* On retire la couleur de la liste */
		couleurs.splice(i, 1);
	}

	return cartes;
}


function updateScores() {
	var couleur1= cartesRetournees[0].couleur;
	var couleur2= cartesRetournees[1].couleur;
	/**
	 *Si les deux couleurs sont égales le compteur s'incrémnte de deux points
	 * dans le cas contraire il désincrémente d' un point
	 *  
	 **/
	if(couleur1 == couleur2){
			compteur += 2;
		}else{compteur -= 1;}
		
		/**
		 * 
		 * Si le score du cookies est inférieur à celui du score courant 
		 * celui du cookies va prendre la valeur de ce dernier
		 * 
		 * */
	 score.textContent = compteur;
	if( meilleurScoreCookies < compteur ){
		document.cookie = "meilleurScore="+compteur;
	}
}

function actionCarte() {
	if (cartesRetournees.length < 2) {
		if( cartesRetournees.length != 0 ){
			if(cartesRetournees[0].li.getAttribute('id') == this.getAttribute('id') )
				return;	
		}
		this.classList.remove("dos");
		cartesRetournees.push(cartes[parseInt(this.id.substring(6), 10)]);
	} else {

		/**
		 * 
		 * Si les deux cartes retournées sont de meme couleurs alors
		 * on les supprimer du tableau 
		 * 
		 **/
		if(cartesRetournees[0].couleur == cartesRetournees[1].couleur){

			cartesRetournees[0].li.classList.add("suppr");
			cartesRetournees[1].li.classList.add("suppr");
			var tailleDuTableau= $('#jeu > li:not(.carte.suppr)').length;
		}else{
			/**
		     * 
			 * Si les deux cartes retournées ne sont pas de meme couleurs alors
		     * on les retourne 
		     * 
		     **/
			cartesRetournees[0].li.classList.add("dos");
			cartesRetournees[1].li.classList.add("dos");
		}
		/**
		 *Mise a jour du score 
		 **/
		updateScores();
		cartesRetournees = [];

		console.log('Le score est de '+compteur);

        if(compteur >=0){
            var data = compteur;
            $.ajax({
                data: data,
                type: "post",
                url: "majScore.php",
                success: function(data){
                    alert("Enregistrement de votre nouveau score: " + data);
                }
            });
        }


		if(tailleDuTableau == 0) {
			console.log('Vue sur la mer ' + numrelated);
			console.log('Le score est de '+compteur);

			var ar = [compteur];
			var json = JSON.stringify(ar);

			alert("Fin de partie");
		}

	}
}

var cartes = createCartes(['purple', 'khaki', 'green', 'tomato', 'royalblue', 'aquamarine', 'hotpink', 'goldenrod']);
var cartesRetournees = [];



/**
 * 
 * Parcours de carte et attribution à l' id jeu
 * 
 * */
for(var i =0; i < cartes.length;i++){
	cartes[i].li = document.createElement('li');
	cartes[i].li.classList.add('carte');
	cartes[i].li.classList.add( cartes[i].couleur );
	cartes[i].li.classList.add('dos');
	cartes[i].li.setAttribute('id','carte_'+i);
	cartes[i].li.onclick = actionCarte;
	getIdJeu.appendChild( cartes[i].li );
}

