<?php

/*
 * Description de bd.offrir.inc.php
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
 * Modele incluant les fonctions liées à la table OFFRIR
 */
require_once "bd.inc.php";

/**
 * Insere dans la table OFFRIR un échantillon
 * @param string $matV
 * @param int $rvNum
 * @param string $produitO
 * @param int $qte
 * @return int
 */
function insererOffrir(string $matV, int $rvNum, string $produitO, int $qte) {
    try {

        $sql = "INSERT INTO `OFFRIR`(`VIS_MATRICULE`, `RAP_NUM`, `MED_DEPOTLEGAL`, `OFF_QTE`) VALUES (:matV,:rvNum,:produitP,:qte)";

        $cnx = connexionPDO();
        $req = $cnx->prepare($sql);
        $req->bindValue(':matV', $matV, PDO::PARAM_STR);
        $req->bindValue(':rvNum', $rvNum, PDO::PARAM_INT);
        $req->bindValue(':produitP', $produitO, PDO::PARAM_STR);
        $req->bindValue(':qte', $qte, PDO::PARAM_INT);
        $result = $req->execute();
    } catch (Exception $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $result;
}