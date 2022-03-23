<?php
require_once "../getRacine.php";
require_once "$racine/modele/bd.medicament.inc.php";
header("Cache-Control: no-cache, must-revalidate");
header('Content-Type: text/xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
$lesmedicaments = getInfosMedicament($_POST['MED_DEPOTLEGAL']);
$lesinteraction = getInteraction($_POST['MED_DEPOTLEGAL']);
$i=0;
$bool=false;
echo '<medicament>';
echo '<depot_legal>' . $lesmedicaments['MED_DEPOTLEGAL'] . '</depot_legal>';
echo '<nom>' . $lesmedicaments['MED_NOMCOMMERCIAL'] . '</nom>';
echo '<famille>' . $lesmedicaments['FAM_CODE'] . '</famille>';
echo '<composition>' . $lesmedicaments['MED_COMPOSITION'] . '</composition>';
echo '<effets>' . $lesmedicaments['MED_EFFETS'] . '</effets>';
echo '<contre_indic>' . $lesmedicaments['MED_CONTREINDIC'] . '</contre_indic>';
echo '<prix_echantillon>' . $lesmedicaments['MED_PRIXECHANTILLON'] . '</prix_echantillon>';

while(!$bool) {
    
    
   if(isset($lesinteraction[$i]["MED_MED_PERTURBE"])) {
      echo '<interaction'.$i.'>' . $lesinteraction[$i]["MED_MED_PERTURBE"] . '</interaction'.$i.'>'; 
      $i++;
       
   }else {
       
       $bool=true;
   }
    
    
    
}

echo '</medicament>';
?>