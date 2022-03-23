<?php

/*
 * Description de bd.presenter.inc.php
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
 * Modele incluant les fonctions liées à la table PRESENTER
 */
require_once "bd.inc.php";

/**
 * Insere dans la table PRESENTER de la base de données un nouveau produit 
 * @param string $matV
 * @param int $rvNum
 * @param string $produitP
 * @return int
 */
function insererPresenter(string $matV, int $rvNum, string $produitP) {
    try {

        $sql = "INSERT INTO `PRESENTER`(`VIS_MATRICULE`, `RAP_NUM`, `MED_DEPOTLEGAL`) VALUES (:matV,:rvNum,:produitP)";

        $cnx = connexionPDO();
        $req = $cnx->prepare($sql);
        $req->bindValue(':matV', $matV, PDO::PARAM_STR);
        $req->bindValue(':rvNum', $rvNum, PDO::PARAM_INT);
        $req->bindValue(':produitP', $produitP, PDO::PARAM_STR);
        $result = $req->execute();
    } catch (Exception $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $result;
}