<?php
session_start();
$tab=explode("-",$_GET["id"]);
$signe=$tab[0];
$id_recup=$tab[1];

if(file_exists('../data/stock.xml')){
    $tab_xml=simplexml_load_file('../data/stock.xml');
}

// on récupère le stock avant qu'il ne soit modifié 
foreach($tab_xml as $tab_min_xml){
    foreach($tab_min_xml as $tab_produit){
        if((string) $tab_produit->code == (string)$id_recup){
            $stat4=intval($tab_produit->stock);
            break 2;
        }
    }
}

//on met à jour les quantités du panier
foreach($_SESSION['panier'] as $key => $tab_panier){
    if((string) $tab_panier['code'] == $id_recup && $signe == 'plus' && $stat4 > 0){
        $_SESSION['panier'][$key]['quantity']=intval($_SESSION['panier'][$key]['quantity']) + 1;
        break;
    }
    if((string) $tab_panier['code'] == $id_recup && $signe == 'minus' && intval($tab_panier['quantity']) > 0){
        $_SESSION['panier'][$key]['quantity']=intval($_SESSION['panier'][$key]['quantity']) - 1;
        if(intval($_SESSION['panier'][$key]['quantity']) == 0){
            unset($_SESSION['panier'][$key]);
        }
        break;
    }
}

//on met à jour les quantités du stock xml
foreach($tab_xml as $tab_min_xml){
    foreach($tab_min_xml as $tab_produit){
        if((string) $signe == 'plus'){
            if((string) $tab_produit->code == (string)$id_recup){
                if(intval($tab_produit->stock) >= 1){
                    $tab_produit->stock=intval($tab_produit->stock)-1;
                    $tab_xml->asXML('../data/stock.xml');
                    $stat='ok';
                    break 2;
                }
            }
        }
        if((string) $signe == 'minus'){
            if((string) $tab_produit->code == (string)$id_recup){
                $tab_produit->stock=intval($tab_produit->stock)+1;
                $tab_xml->asXML('../data/stock.xml');
                $stat='ok';
                break 2;
            }
        }
    }
}



echo json_encode(['stat' => $stat, 'stat2' => $signe,'stat4' => $stat4]);
?>