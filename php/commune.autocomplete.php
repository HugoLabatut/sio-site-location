<?php
// puis création de votre requete  dans l'exemple ci dessous on sélectionne les eleves d'une BDDD 

include '../include/pdo.inc.php';


$keyword = '%' . $_POST['keyword'] . '%';  // récupère la lettre saisie dans le champ texte en provenance de JS 


$sql = "SELECT * FROM communes WHERE libelle_commune LIKE (:var) oR code_commune like (:var) ";  // création de la requete avec sélection des résultats sur la lettre 
$req = $con->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();
$list = $req->fetchAll();
foreach ($list as $res) {
    //  affichage
    $nom_list_id = str_replace($_POST['keyword'], '<b>' . $_POST['keyword'] . '</b>', $res['code_commune'] . ' ' . $res['libelle_commune']);
    // sélection 
    echo '<li class="list-group-item" onclick="set_item_commune(\'' . str_replace("'", "\'", $res['code_commune']) . '\',\'' . str_replace("'", "\'", $res['libelle_commune']) . '\')">' . $nom_list_id . '</li>';
}
?>