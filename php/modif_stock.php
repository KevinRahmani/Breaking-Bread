<?php
session_start();

if(file_exists('../data/stock.xml')){
    $tab_xml=simplexml_load_file('../data/stock.xml');
}

foreach($tab_xml as $tab_min_xml){
    foreach($tab_min_xml as $tab_produit_xml){
        if($tab_produit_xml->code == $_GET['id']){
            if(intval($tab_produit_xml->stock) >= $_GET['quantity']){

                $status='ok';                                                                       //retour ajax + retour stock
                $tab_produit_xml->stock=intval($tab_produit_xml->stock)-intval($_GET['quantity']);
                $tab_xml->asXML('../data/stock.xml');

                if(!empty($_SESSION['panier'])){     
                    foreach($_SESSION['panier'] as $key => $tab_min_panier){
                        if($tab_min_panier['code'] == $_GET['id']){               //une ligne de ce produit existe déjà donc on ajoute la quantité désirée
                            $_SESSION['panier'][$key]['quantity']=intval($_SESSION['panier'][$key]['quantity'])+intval($_GET['quantity']);
                            break 3;
                        }              
                    }
                    $newData =array(
                        'nom' => (string) $tab_produit_xml->nom,
                        'code' => (string) $tab_produit_xml->code,
                        'quantity' => $_GET['quantity'],
                        'reference' => (string) $tab_produit_xml->reference,
                        'image' => (string) $tab_produit_xml->image,
                        'prix' => (string) $tab_produit_xml->prix
                    );
                    $_SESSION['panier'][]=$newData;
                    break 2;         
                }else{    
                    $newData =array(
                        'nom' => (string) $tab_produit_xml->nom,
                        'code' => (string) $tab_produit_xml->code,
                        'quantity' => $_GET['quantity'],
                        'reference' => (string) $tab_produit_xml->reference,
                        'image' => (string) $tab_produit_xml->image,
                        'prix' => (string) $tab_produit_xml->prix
                    );
                    $_SESSION['panier'][]=$newData;
                    break 2;
                }                                                                      
            }else{
                $status='not enough';
                $stock=intval($tab_produit_xml->stock);
                break 2;
            }
        }
    }
}


echo json_encode(['status' => $status, 'stock' => $stock]);
?>