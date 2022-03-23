<?php
/*
 * Description de bd.inc.php
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
 */
/**
 * Procédure de connexion à la base de donnée grâce à PDO
 * @return \PDO
 */
function connexionPDO() {
    $login = "20ap2g01";
    $mdp = ")laraVel3";
    $bd = "20ap2g01";
    $serveur = "localhost"; // localhost ou adresse IP du serveur de BDD
    try {
        $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        print "Erreur de connexion PDO ";
        die();
    }
}
