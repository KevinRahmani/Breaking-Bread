<?php
session_start();

$mail=htmlentities($_POST['email']);
$password=htmlentities($_POST['mdp']);
$response='';
$tab=array();

if((!empty($mail)) && (!empty($password))){
    if(preg_match ( " /^.+@.+\.[a-zA-Z]{2,}$/ " , $mail)){
        $file_name='../data/connexion.json';
        if(file_exists($file_name)){
            $current_data=file_get_contents($file_name);
            $tab=json_decode($current_data, true);
            $response='Mot de passe ou email incorrect, veuillez vous créer un compte';
            foreach($tab as $ligne){
                if($mail == 'admin.eisti@cy.fr' && password_verify($password, $tab[0]['Password'])){
                    $_SESSION['connecte']=2;
                    $_SESSION['utilisateur']=$mail;
                    $response='yes';
                    break;
                }
                if($ligne['Mail']==$mail && password_verify($password,$ligne['Password'])){
                    $_SESSION['connecte']=1;
                    $_SESSION['nom']=$ligne['Nom'].' '.$ligne["Prenom"];
                    $_SESSION['utilisateur']=$mail;
                    $response='yes';
                    break;
                }
            }
        }else{
            $response='fichier json non trouvable';
        }
    }else
    {
        $response='Veuillez saisir une adresse mail correct';
    }
}
else{
    $response='Veuillez remplir correctement les champs';
}


echo json_encode(['response' => $response, 'tab' => $tab]);
?>