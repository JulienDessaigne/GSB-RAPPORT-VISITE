<?php
require_once "../getRacine.php";
require_once "$racine/modele/bd.praticien.inc.php";
header("Cache-Control: no-cache, must-revalidate");
header('Content-Type: text/xml; charset=UTF-8');

echo '<?xml version="1.0" encoding="UTF-8"?>';

$coef = getCoefByPraticien($_POST['idPrat']);
echo '<coef>';
echo $coef["PRA_COEFNOTORIETE"];
echo '</coef>';