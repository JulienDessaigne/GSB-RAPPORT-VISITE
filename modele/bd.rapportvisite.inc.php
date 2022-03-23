<?php

/*
 * Description de bd.rapportvisite.inc.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage modele
 * @author Julien
 * @version 08/10/2021
 * @include bd.inc.php
 */
/**
 * Modele incluant les fonctions liées à la table RAPPORT_VISITE
 */

require_once "bd.inc.php";

/**
 * Fonction retournant le dernier numéro du rapport du visiteur passé en paramêtre
 * @param string $idR
 * @return array
 * 
 */
function getNumeroRapportById(string $idR) {
    $resultat = array();

    try {
        $cnx = connexionPDO(); //connecter a la base de donnée
        $sql = "SELECT max(RAP_NUM) as RapNum FROM `RAPPORT_VISITE` WHERE VIS_MATRICULE=:idR"; //requete sql
        $req = $cnx->prepare($sql); //phase de préparation
        $req->bindValue(':idR', $idR, PDO::PARAM_STR);
        $req->execute(); //Excecute la requete SQL

        $resultat = $req->fetch(PDO::FETCH_ASSOC); //affecte le résultat de la requete a $resultat
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/**
 * Fonction insérant dans la table RAPPORT_VISITE un rapport de visite
 * @param string $matV
 * @param int $rvNum
 * @param int $praNum
 * @param string $rvDate
 * @param string $rvDateVisite
 * @param string $rvBilan
 * @param string $rvMotif
 * @param bool $rvDoc
 * @param bool $rvSaisieDef
 * @return int
 */
function insererRapportVisite(string $matV, int $rvNum, int $praNum, string $rvDate, string $rvDateVisite, string $rvBilan, string $rvMotif, bool $rvDoc, bool $rvSaisieDef) {

    try {
        $sql = "INSERT INTO `RAPPORT_VISITE`(`VIS_MATRICULE`, `RAP_NUM`, `PRA_NUM`, `RAP_DATE`, `RAP_DATE_VISITE`, `RAP_BILAN`, `RAP_MOTIF`, `DOC_OFFERT`, `SAISIE_DEFINITIVE`) "
                . "VALUES (:matV,:rvNum,:praNum,:rvDate,:rvDateVisite,:rvBilan,:rvmotif,:rvDoc,:rvSaisieDef)";

        $cnx = connexionPDO();
        $req = $cnx->prepare($sql);
        $req->bindValue(':matV', $matV, PDO::PARAM_STR);
        $req->bindValue(':rvNum', $rvNum, PDO::PARAM_INT);
        $req->bindValue(':praNum', $praNum, PDO::PARAM_INT);
        $req->bindValue(':rvDate', $rvDate, PDO::PARAM_STR);
        $req->bindValue(':rvDateVisite', $rvDateVisite, PDO::PARAM_STR);
        $req->bindValue(':rvBilan', $rvBilan, PDO::PARAM_STR);
        $req->bindValue(':rvmotif', $rvMotif, PDO::PARAM_STR);
        $req->bindValue(':rvDoc', $rvDoc, PDO::PARAM_BOOL);
        $req->bindValue(':rvSaisieDef', $rvSaisieDef, PDO::PARAM_BOOL);
        $result = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $result;
}




