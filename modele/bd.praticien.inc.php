<?php

/*
 * Description de bd.praticien.inc.php
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
 * Modele incluant les fonctions liées à la table PRATICIEN
 */
require_once "bd.inc.php";

/**
 * Retourne le numéro, nom et prénom de tous les praticiens de la table PRATICIEN
 * @return array
 */
function getPraticien() {
    $resultat = array();

    try {
        // connexion à la BDD
        $cnx = connexionPDO();
        // création de requete 
        $sql = "select PRA_NUM, PRA_NOM, PRA_PRENOM from PRATICIEN";
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
 * Fonction retournant le coef du praticien passé en paramêtre 
 * @param int $idP
 * @return array
 */
function getCoefByPraticien(int $idP) {
    $resultat = array();

    try {
        $cnx = connexionPDO(); //connecter a la base de donnée
        $sql = "SELECT PRA_COEFNOTORIETE FROM PRATICIEN WHERE `PRA_NUM`=:idP"; //requete sql
        $req = $cnx->prepare($sql); //phase de préparation
        $req->bindValue(':idP', $idP, PDO::PARAM_INT);
        $req->execute(); //Excecute la requete SQL

        $resultat = $req->fetch(PDO::FETCH_ASSOC); //affecte le résultat de la requete a $resultat
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}
