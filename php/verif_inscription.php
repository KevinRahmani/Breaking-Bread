<?php
session_start();

$nom=htmlentities($_POST['nom']);
$prenom=htmlentities($_POST['prenom']);
$mail=htmlentities($_POST['mail']);
$password=htmlentities($_POST['mot_de_passe']);
$sexe=htmlentities($_POST['sexe']);
$naissance=htmlentities($_POST['naissance']);
$adresse=htmlentities($_POST['adresse']);
$metier=htmlentities($_POST['metier']);
$success=1;
$response='';

function istring($var) : bool
{
    if(preg_match("/\d+/", $var)){
        return true;
    }
    return false;
}

$today = date('Y-m-d');
$date18 = DateTime::createFromFormat('Y-m-d',$today);
$date18->modify('-18 years');
$date18 = $date18->format('Y-m-d');

$date_min = date('1905-01-01');

if((empty($nom)) ||(istring($nom))){
    $success=0;
    $response='Veuillez remplir tous les champs';
}
if((empty($prenom)) || (istring($prenom))){
    $success=0;
    $response='Veuillez remplir tous les champs';
}
if((empty($mail)) || (!preg_match ( " /^.+@.+\.[a-zA-Z]{2,}$/ " , $mail))){
    $success=0;
    $response='Veuillez remplir tous les champs';
}
if(empty($password)){
    $success=0;
    $response='Veuillez remplir tous les champs';
}
if(empty($sexe)){
    $success=0;
    $response='Veuillez remplir tous les champs';
}
if(empty($naissance) || (!isset($naissance)) || $date18< $naissance || $naissance <= $date_min){
    $success=0;
    $response='Veuillez remplir tous les champs';
}
if(empty($adresse)){
    $success=0;
    $response='Veuillez remplir tous les champs';
}
if((empty($metier)) ||(istring($metier))){
    $success=0;
    $response='Veuillez remplir tous les champs';
}

if($success == 1)
{
    $file_name='../data/connexion'. '.json';
    if(file_exists($file_name))
    {
        $current_data=file_get_contents($file_name);
        $array_data=json_decode($current_data, true);

        $arraySup=array(
            'Nom' => $nom,
            'Prenom' => $prenom,
            'Mail' => $mail,
            'Password' => password_hash($password, PASSWORD_DEFAULT),
            'Sexe' => $sexe,
            'Naissance' => $naissance,
            'Adresse' => $adresse,
            'Metier' => $metier,
            'code_client' => uniqid("", true)
        );
        $array_data[]=$arraySup;
        $tab = json_encode($array_data, JSON_PRETTY_PRINT);
        if(file_put_contents($file_name, $tab)){
            $response='ok';
            $_SESSION['connecte']=1;
            $_SESSION['nom']= $nom.' '.$prenom;
            $_SESSION['utilisateur']=$mail;
        }
        else{
            $response='prb fichier json';
        }
    }
}


echo json_encode(['response' => $response]);
?>