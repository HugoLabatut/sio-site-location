<?php
// puis création de votre requete  dans l'exemple ci dessous on sélectionne les eleves d'une BDDD 

include '../include/pdo.inc.php';


$keyword = '%' . $_POST['keyword'] . '%';  // récupère la lettre saisie dans le champ texte en provenance de JS 


$sql = "SELECT * FROM typebien WHERE lib_type_bien LIKE (:var)";  // création de la requete avec sélection des résultats sur la lettre 
$req = $con->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();
$list = $req->fetchAll();
foreach ($list as $res) {
    //  affichage
    $libtypesbien = str_replace($_POST['keyword'], '<b>' . $_POST['keyword'] . '</b>', $res['lib_type_bien'] . ' ');
    // sélection 
    echo '<li class="list-group-item" onclick="set_item_tbien(\'' . str_replace("'", "\'", $res['lib_type_bien'] . ' ') . '\',\'' . str_replace("'", "\'", $res['lib_type_bien']) . '\')">' . $libtypesbien . '</li>';
}
?>