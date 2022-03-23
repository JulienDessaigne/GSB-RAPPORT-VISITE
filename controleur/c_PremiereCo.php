<?php
/*
 * Description de c_PremiereCo.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage controleur
 * @author Julien Logan
 * @version 04/05/2021
 * @include modele/authentification.inc.php
 * @include vue/fond.html.php
 * @include vue/vuePremiereCo.php
 */

/**
 * Controleur permettant de définir un mot de passe au visiteur
 */
require_once "$racine/modele/authentification.inc.php";

$message = "";
$msgErreur = "";
$newMDP=0;

if (filter_has_var(INPUT_POST, 'matV') && $_POST["matV"]!=="") { //on test la présence des données envoyées

    if (filter_has_var(INPUT_POST, 'mdpV') && filter_has_var(INPUT_POST, 'mdpV2') && $_POST["mdpV"]!=="" && $_POST["mdpV"]!=="") { //on test la présence des données envoyées
        
        //filtrage des informations obtenues
        
        $matV = filter_input(INPUT_POST,'matV',FILTER_SANITIZE_STRING);
        $mdpV = sha1(filter_input(INPUT_POST,'mdpV',FILTER_SANITIZE_STRING));
        $mdpV2 = sha1(filter_input(INPUT_POST,'mdpV2',FILTER_SANITIZE_STRING));

        if ($mdpV === $mdpV2) { // si les deux mots de passe sont identique
            
            //ajout du nouveau mdp dans la base de données
            $newMDP = ajouterMotDePasseVisiteur($matV, $mdpV);

            if ($newMDP > 0) { //si l'opération s'est bien effectuée

                $message = "Mot de passe changé";
            } else { //si l'opération a échoué

                $msgErreur = "opération échoué";
            }
        } else { // si les deux mots de passe ne sont pas identique

            $msgErreur = "Mot de passe non identique";
        }
    } else { //si aucun mdp n'est renseigné

        $msgErreur = "Nouveau mot de passe requis";
    }
}


require "$racine/vue/fond.html.php";
require "$racine/vue/vuePremiereCo.php";
