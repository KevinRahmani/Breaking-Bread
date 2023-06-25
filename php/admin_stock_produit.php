<?php
session_start();

if(file_exists('../data/stock.xml')){
    $tab_xml=simplexml_load_file('../data/stock.xml');
}

//recupere le stock
foreach($tab_xml as $tab_min){
    foreach($tab_min as $tab_produit){
        if((string)$tab_produit->code == (string) $_GET["id"]){
            $git=intval($tab_produit->stock);
            break 2;
        }
    }
}

echo json_encode(['git' => $git]);
?>