<?php 
session_start();

function csv_to_array($filename, $delimiter)
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

if(file_exists('../data/categorie.csv')){
    $tab_csv=csv_to_array('../data/categorie.csv', ',');
}

if(file_exists('../data/stock.xml')){
    $tab_xml=simplexml_load_file('../data/stock.xml');
}

if(!empty($_POST["produit_supp"])){
    $valeur=$_POST["produit_supp"];
}else{
    $val='rate';
}


// SUPPRESSION DU PRODUIT A PARTIR DE XMLPATH DANS LE FICHIER STOCK XML

if(!empty($valeur)){
    $elements = $tab_xml->xpath('/Categorie/Patisserie/Produit');
    $elements2 = $tab_xml->xpath('/Categorie/Viennoiserie/Produit');
    $elements3 = $tab_xml->xpath('/Categorie/Sandwich/Produit');

    $cpt=0;
    $cpt2=0;
    $cpt3=0;

    foreach($elements as $elem){
        if((string)$elem->nom == (string)$valeur){
            unset($tab_xml->Patisserie->Produit[$cpt]);
            $tab_xml->asXML('../data/stock.xml');
            $val='ok';
            break ;
        }
        $cpt++;
    }

    foreach($elements2 as $elem){
        if((string)$elem->nom == (string)$valeur){
            unset($tab_xml->Viennoiserie->Produit[$cpt2]);
            $tab_xml->asXML('../data/stock.xml');
            $val='ok';
            break ;
        }
        $cpt2++;
    }

    foreach($elements3 as $elem){
        if((string)$elem->nom == (string)$valeur){
            unset($tab_xml->Sandwich->Produit[$cpt3]);
            $tab_xml->asXML('../data/stock.xml');
            $val='ok';
            break ;
        }
        $cpt3++;
    }


    // VERIF SI CATEGORIE VIDE ALORS ON LA SUPPRIME DU CSV 


    $value1 = $tab_xml->xpath('/Categorie/Patisserie/Produit');
    $value2 = $tab_xml->xpath('/Categorie/Viennoiserie/Produit');
    $value3 = $tab_xml->xpath('/Categorie/Sandwich/Produit');

    foreach($tab_csv as $tab_min_csv){
        if(empty($value1)){
            unset($tab_csv[0]);
            $temp= array(
                ["link","name","reference","citation","icone"]
            );
            foreach($tab_csv as $min){
                $temp[]=$min;
            }
            $fp = fopen('../data/categorie.csv', 'w');
            foreach($temp as $tab){
                fputcsv($fp,$tab);
            }
            fclose($fp);
            break ;
        }
        if(empty($value2)){
            unset($tab_csv[1]);
            $temp= array(
                ["link","name","reference","citation","icone"]
            );
            foreach($tab_csv as $min){
                $temp[]=$min;
            }
            $fp = fopen('../data/categorie.csv', 'w');
            foreach($temp as $tab){
                fputcsv($fp,$tab);
            }
            fclose($fp);
            break ;
        }
        if(empty($value3)){
            unset($tab_csv[2]);
            $temp= array(
                ["link","name","reference","citation","icone"]
            );
            foreach($tab_csv as $min){
                $temp[]=$min;
            }
            $fp = fopen('../data/categorie.csv', 'w');
            foreach($temp as $tab){
                fputcsv($fp,$tab);
            }
            fclose($fp);
            break ;
        }
    }
}


echo json_encode(['val' => $val]);
?>