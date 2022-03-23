<?php

/*
 * Description de bd.medicament.inc.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage modele
 * @author Julien
 * @version 04/10/2021
 * @include bd.inc.php
 */
/**
 * Modele incluant les fonctions liées à la table MEDICAMENT
 */
require_once "bd.inc.php";

/**
 * Retourne le nom commercial et le depot legal de tous les médicaments de la table MEDICAMENT
 * @return array
 */
function getMedicaments() {

    $resultat = array();

    try {
        // connexion à la BDD
        $cnx = connexionPDO();
        // création de requete 
        $sql = "select MED_NOMCOMMERCIAL, MED_DEPOTLEGAL from MEDICAMENT";
        // prépare la requete
        $req = $cnx->prepare($sql);
        // l execute
        $req->execute();
        // recupère le 1° enregistrement
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            // recupère l enregistrement suivant
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * Fonction retournant un tableau contenant les médicaments qui intaragissent avec le médicament passé en paramêtre.
 * @param string $med
 * @return array
 */
function getInteraction(string $med) {
    $resultat = array();

    try {
        // connexion à la BDD
        $cnx = connexionPDO();
        // création de requete (tous les medicaments)
        $sql = "select MED_MED_PERTURBE from INTERAGIR where MED_PERTURBATEUR =:idmed  "; //récupère les champs de la table
        // prépare la requete
        $req = $cnx->prepare($sql);
        $req->bindValue(':idmed', $med, PDO::PARAM_STR);
        // l execute
        $req->execute();
        // recupère le 1°enregistrement
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {//tant que $ligne n'est pas vide
            $resultat[] = $ligne; //affectation de la ligne dans le tableau 
            // recupère l enregistrement suivant
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * Fonction retournant un tableau contenant les infos du médicament passé en paramêtre
 * @param type $depotlegal
 * @return array
 */
function getInfosMedicament($depotlegal) {
    $resultat = array();

    try {
        // connexion à la BDD
        $cnx = connexionPDO();
        // création de requete (tous les medicaments)
        $sql = "select * from MEDICAMENT where MED_DEPOTLEGAL=:dlmedic"; //récupère les champs de la table
        // prépare la requete
        $req = $cnx->prepare($sql);
        $req->bindValue(':dlmedic', $depotlegal, PDO::PARAM_STR);
        // l execute
        $req->execute();
        // recupère le 1°enregistrement
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}