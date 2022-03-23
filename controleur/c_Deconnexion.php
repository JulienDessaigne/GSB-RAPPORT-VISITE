<?php
/*
 * Description de c_Deconnexion.php
 * 
 * 
 * 
 * 
 */
/**
 * @package ProjectGSB
 * @subpackage controleur
 * @author  Julien
 * @version 08/10/2021
 * @include modele/authentification.inc.php
 * @include controleur/c_Connexion.php
 */
/**
 * Controleur gérant la déconnexion de l'utilisateur
 */
require_once "$racine/modele/authentification.inc.php";

//déconnecte l'utilisateur en supprimant les variables de session. 
logout();

require_once "$racine/controleur/c_Connexion.php";

