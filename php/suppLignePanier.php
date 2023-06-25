<?php
session_start();

$id=$_GET['id'];
$i=0;
$_SESSION['id']=$_GET['id'];

if(file_exists('../data/stock.xml')){
    $tab_xml=simplexml_load_file('../data/stock.xml');
}

foreach($_SESSION['panier'] as $panier_min){
    if($panier_min['reference'] == $_SESSION['id']){
        $new_tab=$panier_min;
    }
}

foreach($_SESSION['panier'] as $panier_min){
    foreach($tab_xml as $tab_min_xml){
        foreach($tab_min_xml as $tab_produit){
            if((string)$tab_produit->code == (string) $new_tab["code"]){
                $tab_produit->stock=intval($tab_produit->stock) + intval($new_tab['quantity']);
                $tab_xml->asXML('../data/stock.xml');
                $status='ok';
                break 3;
            }
        }
    }
}

//on vide la ligne
foreach($_SESSION['panier'] as $key => $tab_min){
    if($tab_min == $new_tab){
        unset($_SESSION['panier'][$key]);
    }
}

echo json_encode(['status' => $status]);
?>