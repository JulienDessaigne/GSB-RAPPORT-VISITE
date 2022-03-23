<?php

/*
 * Description de bd.visiteur.inc.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage modele
 * @author Julien Logan
 * @version 04/05/2021
 * @include bd.inc.php
 */
/**
 * Modele incluant les fonctions liées à la table VISITEUR
 */
require_once "bd.inc.php";

/**
 * Fonction retournant le matricule et le mdp du visiteur en fonction de son matricule
 * @param string $matV
 * @return array
 */
function getVisiteurByMatV(string $matV) {
    $resultat = array();

    try {
        $cnx = connexionPDO(); //connecter a la base de donnée
        $sql="select VIS_MATRICULE,VIS_MDP from VISITEUR where VIS_MATRICULE=:matV"; //requete sql
        $req = $cnx->prepare($sql); //phase de préparation
        $req->bindValue(':matV', $matV, PDO::PARAM_STR); //remplace la valleur de :mailC par $mailC
        $req->execute(); //Excecute la requete SQL
        $resultat = $req->fetch(PDO::FETCH_ASSOC); //affecte le résultat de la requete a $resultat
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * Fonction permettant de changer le mot de passe d'un visiteur à partir de son matricule et d'un mot de passe
 * @param string $matV
 * @param string $mdpV
 * @return int
 */
function ajouterMotDePasseVisiteur(string $matV, string $mdpV){
    try {
        $sql="UPDATE VISITEUR SET VIS_MDP=:mdpV WHERE VIS_MATRICULE=:matV";
        $cnx = connexionPDO();
        $req = $cnx->prepare($sql);
        $req->bindValue(':matV', $matV, PDO::PARAM_STR);
        $req->bindValue(':mdpV', $mdpV, PDO::PARAM_STR);
        $result = $req->execute();
    } catch (Exception $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $result;
}

/**
 * Récupère les infos du visiteur à partir de son matricule
 * @param string $matV
 * @return array
 */
function getInfoVisiteurbyMatV(string $matV) {
    $resultat = array();

    try {
        $cnx = connexionPDO(); //connecter a la base de donnée
        $sql="select VIS_NOM,VIS_PRENOM, VIS_ADRESSE,VIS_CP, VIS_VILLE from VISITEUR where VIS_MATRICULE=:matV"; //requete sql
        $req = $cnx->prepare($sql); //phase de préparation
        // V1
        $req->bindValue(':matV', $matV, PDO::PARAM_STR); //remplace la valleur de :matV par $matV
        $req->execute(); //Excecute la requete SQL
        // autre version
        // $req->execute(array(':matV' => $matV));
        $resultat = $req->fetch(PDO::FETCH_ASSOC); //affecte le résultat de la requete a $resultat
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}