<?php

/*
 * Description de c_Insere_Rapport_Visite.php
 * 
 * 
 * 
 * 
*/
/**
 * @package ProjectGSB
 * @subpackage controleur
 * @author Julien
 * @version 04/10/2021
 * @include modele/authentification.inc.php
 * @include modele/bd.rapportvisite.inc.php
 * @include modele/bd.offrir.inc.php
 * @include modele/bd.presenter.inc.php
 * @include vue/fond.html.php
 * @include controleur/c_Rapport_Visite.php
 */
/**
 * Controleur gérant la vérification et l'insertion d'un rapport de visite dans la base de données
 */
//include de fonctions
require_once "$racine/modele/authentification.inc.php";
require_once "$racine/modele/bd.rapportvisite.inc.php";
require_once "$racine/modele/bd.offrir.inc.php";
require_once "$racine/modele/bd.presenter.inc.php";


//Matricule du visiteur et numéro du rapport
$matV = $_SESSION["matV"];
$RAP_NUM = getNumeroRapportById($matV);
$RAP_NUM = $RAP_NUM["RapNum"] === null ? $RAP_NUM = 1 : $RAP_NUM = (int) $RAP_NUM["RapNum"] + 1;

//variable pour les message d'erreur et le message de succès, pattern pour la regex des dates
$pattern_date = "/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
$msgErreur = "";
$message = "";
if (filter_has_var(INPUT_POST, 'RAP_DATEVISITE') && $_POST["RAP_DATEVISITE"] !== "") { // Test si la variable post RAP_DATEVISITE à une valeur et si elle est différente d'une chaîne vide
    $RAP_DATEVISITE = filter_input(INPUT_POST, 'RAP_DATEVISITE', FILTER_SANITIZE_STRING);

    if (preg_match($pattern_date, $RAP_DATEVISITE)) { // Test si RAP_DATEVISITE passe la regex défini au dessus, format : AAAA-MM-JJ
        if (filter_has_var(INPUT_POST, 'PRA_NUM') && $_POST["PRA_NUM"] !== "") { // Test si la variable post PRA_NUM à une valeur et si elle est différente d'une chaîne vide
            $PRA_NUM = filter_input(INPUT_POST, 'PRA_NUM', FILTER_SANITIZE_STRING);

            if (is_numeric($PRA_NUM)) { // Test si PRA_NUM est bien un nombre
                //transforme PRA_NUM en int
                $PRA_NUM = (int) $PRA_NUM;

                if (filter_has_var(INPUT_POST, 'RAP_DATE') && $_POST["RAP_DATE"] !== "") { // Test si la variable post RAP_DATE à une valeur et si elle est différente d'une chaîne vide
                    $RAP_DATE = filter_input(INPUT_POST, 'RAP_DATE', FILTER_SANITIZE_STRING);

                    if (preg_match($pattern_date, $RAP_DATE)) { // Test si RAP_DATE passe la regex défini au dessus, format : AAAA-MM-JJ
                        if (filter_has_var(INPUT_POST, 'RAP_MOTIF') && $_POST["RAP_MOTIF"] !== "") { // Test si la variable post RAP_MOTIF à une valeur et si elle est différente d'une chaîne vide
                            $RAP_MOTIF = filter_input(INPUT_POST, 'RAP_MOTIF', FILTER_SANITIZE_STRING);

                            if ($RAP_MOTIF === "Autre") { // Test si le motif est autre
                                if (filter_has_var(INPUT_POST, 'RAP_MOTIFAUTRE') && $_POST["RAP_MOTIFAUTRE"] !== "") { // Si c'est le cas, // Test si la variable post RAP_MOTIFAUTRE à une valeur et si elle est différente d'une chaîne vide
                                    // On affecte la variable RAP_MOTIF avec les données reçu, résultat de la forme -> Autre : "motif renseigné" 
                                    $RAP_MOTIFAUTRE = filter_input(INPUT_POST, 'RAP_MOTIFAUTRE', FILTER_SANITIZE_STRING);
                                    $RAP_MOTIF = $RAP_MOTIF . " : " . $RAP_MOTIFAUTRE;
                                } else {

                                    $msgErreur = "Veuillez saisir un motif !"; // Msg erreur si le motif est autre et si aucune valeur n'est renseigné
                                }
                            }

                            if ($msgErreur === "") { // Test si msgErreur est différent de chaine vide
                                if (filter_has_var(INPUT_POST, 'RAP_BILAN') && $_POST["RAP_BILAN"] !== "") { // Test si la variable post RAP_BILAN à une valeur et si elle est différente d'une chaîne vide
                                    $RAP_BILAN = filter_input(INPUT_POST, 'RAP_BILAN', FILTER_SANITIZE_STRING);

                                    if (filter_has_var(INPUT_POST, 'PROD1') && $_POST["PROD1"] !== "Produit") { // Test si la variable post PROD1 à une valeur et si elle est différente d'une chaîne vide
                                        $PROD1 = filter_input(INPUT_POST, 'PROD1', FILTER_SANITIZE_STRING);

                                        if (filter_has_var(INPUT_POST, 'PROD2') && $_POST["PROD2"] !== "Produit") { // Test si la variable post PROD2 à une valeur et si elle est différente d'une chaîne vide
                                            $PROD2 = filter_input(INPUT_POST, 'PROD2', FILTER_SANITIZE_STRING);

                                            if (filter_has_var(INPUT_POST, 'RAP_DOC')) { // Test si la case à cocher RAP_DOC est coché ou non
                                                $RAP_DOC = true;
                                            } else {

                                                $RAP_DOC = false;
                                            }

                                            $boolEchantillon = false;
                                            $i = 1;
                                            $echantillons = array(); // tableau à double entrée pour y mettre tous les échantillons renseignés
                                            //Boucle pour tester les échantillons
                                            while (!$boolEchantillon) {

                                                if (isset($_POST["PRA_ECH" . $i])) { //Si l'échantillon i existe
                                                    if (filter_has_var(INPUT_POST, 'PRA_ECH' . $i) && $_POST["PRA_ECH" . $i] !== "Produit") { // Test si la variable post PRA_ECHi à une valeur et si elle est différente d'une chaîne vide
                                                        $echantillons[$i]["PRA_ECH"] = filter_input(INPUT_POST, 'PRA_ECH' . $i, FILTER_SANITIZE_STRING);

                                                        if (filter_has_var(INPUT_POST, 'PRA_QTE' . $i) && $_POST["PRA_QTE" . $i] !== "") { // Test si la variable post PRA_QTEi à une valeur et si elle est différente d'une chaîne vide
                                                            $PRA_QTE = filter_input(INPUT_POST, 'PRA_QTE' . $i, FILTER_SANITIZE_STRING);

                                                            if (is_numeric($PRA_QTE)) { // Si PRA_QTE est bien un nombre
                                                                if ($PRA_QTE >= 1) { // On test si il est supérieur ou égal a 1
                                                                    $echantillons[$i]["PRA_QTE"] = (int) $PRA_QTE;
                                                                    $i++;
                                                                } else { //Message d'erreur QTE >=1
                                                                    $boolEchantillon = true;
                                                                    $msgErreur = "La quantité pour l'échantillon " . $i . " doit être supérieur ou égal à 1 !";
                                                                }
                                                            } else { //Message d'erreur format QTE non valide
                                                                $boolEchantillon = true;
                                                                $msgErreur = "Le format de la quantité pour l'échantillon " . $i . " n'est pas valide !";
                                                            }
                                                        } else { //Message d'erreur champs QTE non rempli
                                                            $boolEchantillon = true;
                                                            $msgErreur = "Sélectionnez la quantité pour l'échantillon " . $i . " !";
                                                        }
                                                    } else { //Message d'erreur échantillon non selectionné
                                                        $boolEchantillon = true;
                                                        $msgErreur = "Sélectionnez l'échantillon " . $i . " !";
                                                    }
                                                } else { //Si pas de nouvel échantillon, on stop la boucle
                                                    $boolEchantillon = true;
                                                }
                                            }
                                            if ($msgErreur === "") {
                                                if (filter_has_var(INPUT_POST, 'RAP_LOCK')) { // Test si la case à cocher RAP_LOCK est coché ou non
                                                    $RAP_LOCK = true;
                                                } else {
                                                    $RAP_LOCK = false;
                                                }

                                                //on insere les infos dans la table RAPPORT_VISITE
                                                $RapportVisiteInsere = insererRapportVisite($matV, $RAP_NUM, $PRA_NUM, $RAP_DATE, $RAP_DATEVISITE, $RAP_BILAN, $RAP_MOTIF, $RAP_DOC, $RAP_LOCK);

                                                if ($RapportVisiteInsere > 0) { // Si la requete ne retourne pas une erreur
                                                    //on insere les infos du produit 1 dans la table PRESENTER
                                                    $PresenterInserer1 = insererPresenter($matV, $RAP_NUM, $PROD1);

                                                    if ($PresenterInserer1 > 0) {// Si la requete ne retourne pas une erreur
                                                        //on insere les infos du produit 2 dans la table PRESENTER
                                                        $PresenterInserer2 = insererPresenter($matV, $RAP_NUM, $PROD2);

                                                        if ($PresenterInserer2 > 0) {// Si la requete ne retourne pas une erreur
                                                            $boolOffrir = false;
                                                            $j = 1;

                                                            //boucle pour inserer tous les échantillons dans la table OFFRIR
                                                            while (!$boolOffrir) {

                                                                //Si l'échantillon j existe
                                                                if (isset($echantillons[$j]["PRA_ECH"])) {

                                                                    //on insere les infos de l'échantillon j dans la table OFFRIR
                                                                    $OffrirInserer = insererOffrir($matV, $RAP_NUM, $echantillons[$j]["PRA_ECH"], $echantillons[$j]["PRA_QTE"]);

                                                                    if ($OffrirInserer > 0) { // Si la requete est un succes, on avance de 1 
                                                                        $j++;
                                                                    } else { // Sinon message erreur
                                                                        $boolOffrir = true;
                                                                        $msgErreur = "Une erreur est survenue lors de l'insertion de l'échantillon " . $j . " !";
                                                                    }
                                                                } else {

                                                                    $boolOffrir = true;
                                                                }
                                                            }
                                                            
                                                            if($message ==="") {
                                                                
                                                                $message = "Rapport enregistré avec succès";
                                                                
                                                            }
                                                        } else { // Si l'insertion sur le produit 2 échoue
                                                            $msgErreur = "Une erreur est survenue lors de l'insertion du produit 2";
                                                        }
                                                    } else { // Si l'insertion sur le produit 1 échoue
                                                        $msgErreur = "Une erreur est survenue lors de l'insertion du produit 1";
                                                    }
                                                } else {// Si l'insertion sur le rapport visite échoue
                                                    $msgErreur = "Une erreur est survenue lors de l'insertion du rapport visite";
                                                }
                                            }
                                        } else { //Message d'erreur produit2 non selectionné
                                            $msgErreur = "Sélectionnez le produit 2 !";
                                        }
                                    } else {//Message d'erreur produit1 non selectionné
                                        $msgErreur = "Sélectionnez le produit 1 !";
                                    }
                                } else { //Message d'erreur bilan non rempli
                                    $msgErreur = "Veuillez remplir la partie bilan !";
                                }
                            }
                        } else { //Message d'erreur motif non selectionné
                            $msgErreur = "Veuillez saisir un motif !";
                        }
                    } else { //Message d'erreur format date incorrect
                        $msgErreur = "Format de date incorrect. Format attendu : année-mois-jour.";
                    }
                } else { //Message d'erreur date non saisie
                    $msgErreur = "Veuillez saisir une date !";
                }
            } else {

                //ERREUR changement de value dans la liste déroulante
            }
        } else { //Message d'erreur praticien non saisi
            $msgErreur = "Veuillez saisir un praticien !";
        }
    } else { //Message d'erreur format date de visite incorrect
        $msgErreur = "Format de date de visite incorrect. Format attendu : année-mois-jour.";
    }
} else { //Message d'erreur date de visite non saisi
    $msgErreur = "Veuillez saisir une date de visite !";
}



require_once "$racine/vue/fond.html.php";
require_once "$racine/controleur/c_Rapport_Visite.php";
