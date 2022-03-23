/*
 * Description de fonctions.js
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage javascript
 * @author Julien Logan
 * @version 08/10/2021
 */
/**
 * Javascript incluant les fonctions utiles dans le projet
 */


/**
 * fonction qui ajoute une nouvelle ligne afin de saisir un nouvel échantillon
 * @author Julien
 * @param {type} pNumero
 * @returns void
 */
function ajoutLigne(pNumero) {//ajoute une ligne de produits/qté à la div "lignes"     
    //masque le bouton en cours
    document.getElementById("but" + pNumero).setAttribute("hidden", "true");
    pNumero++;										//incrémente le numéro de ligne
    var laDiv = document.getElementById("lignes");	//récupère l'objet DOM qui contient les données
    var titre = document.createElement("label");	//crée un label
    laDiv.appendChild(titre);						//l'ajoute à la DIV
    titre.setAttribute("class", "titre");			//définit les propriétés
    titre.innerHTML = "   Produit : ";
    var liste = document.createElement("select");	//ajoute une liste pour proposer les produits
    laDiv.appendChild(liste);
    liste.setAttribute("name", "PRA_ECH" + pNumero);
    liste.setAttribute("class", "zone");
    //remplit la liste avec les valeurs de la première liste construite en PHP à partir de la base
    liste.innerHTML = formRAPPORT_VISITE.elements["PRA_ECH1"].innerHTML;
    var qte = document.createElement("input");
    laDiv.appendChild(qte);
    qte.setAttribute("name", "PRA_QTE" + pNumero);
    qte.setAttribute("size", "2");
    qte.setAttribute("class", "zone");
    qte.setAttribute("type", "text");
    var bouton = document.createElement("input");
    laDiv.appendChild(bouton);
    //ajoute une gestion évenementielle en faisant évoluer le numéro de la ligne
    bouton.setAttribute("onClick", "ajoutLigne(" + pNumero + ");");
    bouton.setAttribute("type", "button");
    bouton.setAttribute("value", "+");
    bouton.setAttribute("class", "zone");
    bouton.setAttribute("id", "but" + pNumero);
}

/**
 * Fonction qui permet de saisir un motif autre en rendant le champ input écrivable
 * @author Julien
 * @param {type} pValeur
 * @param {type} pSelection
 * @param {type} pObjet
 * @returns {void}
 */
function selectionne(pValeur, pSelection, pObjet) {
    //active l'objet pObjet du formulaire si la valeur sélectionnée (pSelection) est égale à la valeur attendue (pValeur)
    if (pSelection == pValeur)
    {
        formRAPPORT_VISITE.elements[pObjet].disabled = false;
    } else {
        formRAPPORT_VISITE.elements[pObjet].disabled = true;
    }
}

/**
 * Fonction affichant le médicament n-1 losqu'on appuie sur le bouton <
 * @author Logan
 * @returns {void}
 */
function boutonsretour() {
    var selected = document.getElementById("select_medicament")
    var index = selected.selectedIndex;
    var longueur = document.getElementById("select_medicament").length
    if (index == 0) {
        index = longueur - 1
    } else {
        index = index - 1
    }
    selected.selectedIndex = index
    envoyerRequeteListeMedicaments(selected.value)
}
/**
 * Fonction affichant le médicament n+1 losqu'on appuie sur le bouton >
 * @author Logan
 * @returns {void}
 */
function boutonsavant() {
    var selected = document.getElementById("select_medicament")
    var index = selected.selectedIndex;
    var longueur = document.getElementById("select_medicament").length
    if (index == longueur - 1) {
        index = 0
    } else {
        index = index + 1
    }
    selected.selectedIndex = index
    envoyerRequeteListeMedicaments(selected.value)
}