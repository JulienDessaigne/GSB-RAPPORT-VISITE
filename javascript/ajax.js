
/*
 * Description de ajax.js
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
 * Javascript incluant les fonctions liées au traitements AJAX du projet
 */


/**
 * Fonction vérifiant si la fonctionnalité AJAX est disponible sur le navigateur qui lance l'application
 * @returns {ActiveXObject|XMLHttpRequest|getRequeteHttp.requeteHttp}
 */
function getRequeteHttp()
{
    // gestion des divers navigateurs
    var requeteHttp;
    if (window.XMLHttpRequest)
    {	// Mozilla
        requeteHttp = new XMLHttpRequest();
        if (requeteHttp.overrideMimeType)
        { // problème firefox
            requeteHttp.overrideMimeType('text/xml');
        }
    } else
    {
        if (window.ActiveXObject)
        {	// C'est Internet explorer < IE7
            try
            {
                requeteHttp = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e)
            {
                try
                {
                    requeteHttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e)
                {
                    requeteHttp = null;
                }
            }
        }
    }
    return requeteHttp;
}

/**
 * Fonction permettant de créer le fichier XML lié au Coef du praticien passé en paramêtre
 * @author Julien
 * @param {type} idPraticien
 * @returns {undefined}
 */
function envoyerRequeteCoefPraticien(idPraticien)
{


    var requeteHttp = getRequeteHttp();
    if (requeteHttp == null)
    {
        alert("Impossible d'utiliser Ajax sur ce navigateur");
    } else
    {

        requeteHttp.open('POST', 'php_xml/getCoef.php', true);
        requeteHttp.onreadystatechange = function () {
            recevoirCoefPraticien(requeteHttp);
        };
        requeteHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        requeteHttp.send('idPrat=' + escape(idPraticien));
    }
    return;

}

/**
 * Fonction qui reçoit le résultat de la fonction envoyerRequeteCoefPraticien et qui le traite afin d'afficher le coef du praticien à sa selection dans la liste déroulante concernée
 * @author Julien
 * @param {type} requeteHttp
 * @returns void
 */
function recevoirCoefPraticien(requeteHttp)
{
    // traite le flux XML du coef du praticien, change le champ pour afficher le coef du praticien selectionné

    if (requeteHttp.readyState == 4)
    {
        if (requeteHttp.status == 200)
        {

            var coef = requeteHttp.responseXML.getElementsByTagName("coef").item(0).innerHTML;
            document.getElementById("PRA_COEFF").value = coef;

        } else {

            alert("La requête ne s'est pas correctement exécutée");

        }
    }
}

/**
 * Fonction permettant de créer le fichier XML lié aux infos du médicament passé en paramêtre
 * @author Logan
 * @param {type} DLmedicament
 * @returns {undefined}
 */
function envoyerRequeteListeMedicaments(DLmedicament)
{


    var requeteHttp = getRequeteHttp();
    if (requeteHttp === null)
    {
        alert("Impossible d'utiliser Ajax sur ce navigateur");
    } else
    {
        //alert ('POST'+idclasse);
        // declenche un post sur la page getmedicaments.php puis declenchera recevoirInfoMedicaments
        requeteHttp.open('POST', 'php_xml/getMedicament.php', true);
        requeteHttp.onreadystatechange = function () {
            recevoirInfoMedicaments(requeteHttp);
        };
        requeteHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        requeteHttp.send('MED_DEPOTLEGAL=' + escape(DLmedicament));
        //console.log(requeteHttp);
    }
    return;
}

/**
 * Fonction qui reçoit le résultat de la fonction envoyerRequeteListeMedicaments et qui le traite afin d'afficher les infos du médicament dans les champs prévuent à cet effet. 
 * @author Logan
 * @param {type} requeteHttp
 * @returns void
 */
function recevoirInfoMedicaments(requeteHttp)
{
    // traite le flux XML des medicaments, charge les infos des medicaments 

    if (requeteHttp.readyState == 4)
    {
        if (requeteHttp.status == 200)
        {

            var medicament = requeteHttp.responseXML.getElementsByTagName("medicament").item(0);
            var depotlegal, nom, famille, composition, effets, contre_indic, prix_echantillon;
            depotlegal = medicament.getElementsByTagName("depot_legal").item(0).textContent;
            nom = medicament.getElementsByTagName("nom").item(0).textContent;
            famille = medicament.getElementsByTagName("famille").item(0).textContent;
            composition = medicament.getElementsByTagName("composition").item(0).textContent;
            effets = medicament.getElementsByTagName("effets").item(0).textContent;
            contre_indic = medicament.getElementsByTagName("contre_indic").item(0).textContent;
            prix_echantillon = medicament.getElementsByTagName("prix_echantillon").item(0).textContent;


            var bodytableau = document.getElementById("interaction_med");
            bodytableau.innerHTML = "";
            document.getElementById('DepotLegal').value = depotlegal;
            document.getElementById('NomCommercial').value = nom;
            document.getElementById('FamilleCode').value = famille;
            document.getElementById('MedicamentCompo').value = composition;
            document.getElementById('MedEffets').value = effets;
            document.getElementById('MedContrindic').value = contre_indic;
            document.getElementById('MedEchantillon').value = prix_echantillon;
            var bool = false;
            var i = 0;
            var ligne, interaction, colonne;
            while (!bool) {
                if (medicament.getElementsByTagName("interaction" + i).item(0) !== null) {
                    colonne = document.createElement("tr");
                    ligne = document.createElement("td");
                    interaction = document.createTextNode(medicament.getElementsByTagName("interaction" + i).item(0).textContent);
                    ligne.appendChild(interaction);
                    ligne.setAttribute("onClick","javascript:envoyerRequeteListeMedicaments(this.innerText)");
                    colonne.appendChild(ligne);
                    bodytableau.appendChild(colonne);
                    i++;

                } else {
                    bool = true;



                }
            }




        } else {
            alert("La requête ne s'est pas correctement exécutée");
        }
    }
}