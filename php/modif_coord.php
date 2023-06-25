<?php
session_start();

//verification du formulaire
$nom=htmlentities($_POST['nom_change']);
$prenom=htmlentities($_POST['prenom_change']);
$mail=htmlentities($_POST['mail_change']);
$password=htmlentities($_POST['password_change']);
$sexe=htmlentities($_POST['sexe_change']);
$naissance=htmlentities($_POST['naissance_change']);
$adresse=htmlentities($_POST['adresse_change']);
$metier=htmlentities($_POST['metier_change']);
$success=1;
$info='';

$today = date('Y-m-d');
$date18 = DateTime::createFromFormat('Y-m-d',$today);
$date18->modify('-18 years');
$date18 = $date18->format('Y-m-d');
$date_min = date('1905-01-01');

function istring($var) : bool
{
    if(preg_match("/\d+/", $var)){
        return true;
    }
    return false;
}

if((empty($nom)) || (!isset($nom)) ||(istring($nom))){
    $success=0;
    $info='Veuillez remplir correctement tous les champs';
}
if((empty($prenom))|| (!isset($prenom)) || (istring($prenom))){
    $success=0;
    $info='Veuillez remplir correctement tous les champs';
}
if((empty($mail)) || (!isset($mail)) || $mail == 'admin.eisti@cy.fr' ||(!preg_match ( " /^.+@.+\.[a-zA-Z]{2,}$/ " , $mail))){
    $success=0;
    $info='Veuillez remplir correctement tous les champs';
}
if(empty($password) || (!isset($password))){
    $success=0;
    $info='Veuillez remplir correctement tous les champs';
}
if(empty($sexe) || (!isset($sexe))){
    $success=0;
    $info='Veuillez remplir correctement tous les champs';
}
if(empty($naissance) || (!isset($naissance)) || $date18 < $naissance || $naissance <= $date_min){
    $success=0;
    $info='Veuillez remplir correctement tous les champs';
}
if(empty($adresse) || (!isset($adresse))){
    $success=0;
    $info='Veuillez remplir correctement tous les champs';
}
if((empty($metier)) || (!isset($metier)) ||(istring($metier))){
    $success=0;
    $info='Veuillez remplir correctement tous les champs';
}

//si formulaire bien remplie on change les coordonnées dans le json 
if($success == 1)
{
    $file_name='../data/connexion'. '.json';
    if(file_exists($file_name))
    {
        $current_data=file_get_contents($file_name);
        $array_data=json_decode($current_data, true);
    }
    foreach($array_data as $key => $array_min){
        if((string)$array_min["Mail"] == (string)$_SESSION["utilisateur"]){
            $array_data[$key]["Nom"]=$nom;
            $array_data[$key]["Prenom"]=$prenom;
            $array_data[$key]["Mail"]=$_POST["mail_change"];
            if($array_min["Password"] !== $password){
                $array_data[$key]["Password"]=password_hash($password, PASSWORD_DEFAULT);
            }
            $array_data[$key]["Sexe"]=$sexe;
            $array_data[$key]["Naissance"]=$naissance;
            $array_data[$key]["Adresse"]=$adresse;
            $array_data[$key]["Metier"]=$metier;
            break;
        }
    }
    $tab = json_encode($array_data, JSON_PRETTY_PRINT);
    if(file_put_contents($file_name, $tab)){
        $info='ok';
        $_SESSION['connecte']=1;
        $_SESSION['nom']= $nom.' '.$prenom;
        $_SESSION['utilisateur']=$mail;
    }
    else{
        $info='prb fichier json';
    }
}
echo json_encode(['info' => $info,'mail' => $mail]);
?>