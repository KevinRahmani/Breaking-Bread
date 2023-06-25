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

if(!empty($_POST["categorie_supp"])){
    $val=$_POST["categorie_supp"];
}else{
    $bp='rate';
}

//on supprime la ligne où se trouve la catégorie
if(!empty($val)){
    $fp = fopen('../data/categorie.csv', 'w');

    foreach($tab_csv as $key => $tab_csv_min){
        foreach($tab_xml as $cle => $tab_xml_min){
            if((string) $tab_csv_min["name"] == $val && (string)strtolower($cle) == strtolower($val)){
                unset($tab_xml->$cle);
                unset($tab_csv[$key]);
                $temp=array(
                    ["link", "name","reference","citation","icone"]
                );
                foreach($tab_csv as $min){
                    $temp[]=$min;
                }
                foreach($temp as $tab){
                    fputcsv($fp,$tab);
                }
                $tab_xml->asXML('../data/stock.xml');
                $bo="ok";
                break 2;
            }
        }
    }
    fclose($fp);
}
echo json_encode(['bo' => $bo]);
?>