<?php
session_start();

if(file_exists('../data/stock.xml')){
    $tab_xml=simplexml_load_file('../data/stock.xml');
}


foreach($_SESSION['panier'] as $panier_min){            //parcours le panier
    foreach($tab_xml as $tab_min_xml){                  //parcours les catégories
        foreach($tab_min_xml as $tab_produit){          //parcours les produits des catégories
            if( (string) $tab_produit->code == (string) $panier_min['code']){
                $tab_produit->stock=intval($tab_produit->stock) + intval($panier_min['quantity']);
                unset($_SESSION['panier'][0]);           //supprime le tableau
                $_SESSION['panier']=array_values($_SESSION['panier']);
                $tab_xml->asXML('../data/stock.xml');
                $statue='ok';
                break 2;   
            }
        }
    }
}

echo json_encode(['statue' => $statue]);
?>