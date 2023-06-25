<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$today = date('Y-m-d');
$date_min = date('1905-01-01');

$prenom = htmlentities($_POST['prenom']);
$nom = htmlentities($_POST['nom']);
$metier = htmlentities($_POST['metier']);
$sujet = htmlentities($_POST['sujet']);
$email = htmlentities($_POST['email']);
$genre = htmlentities($_POST['genre']);
$date_contact = htmlentities($_POST['date_contact']);
$date_naissance = htmlentities($_POST['date_naissance']);
$contenu = htmlentities($_POST['Contenu']);
$envoyer = $_POST["envoyer"];

$erreurNom = "";
$erreurPrenom = "";
$erreurNaissance = "";
$erreurMail = "";
$erreurMetier = "";
$erreurPrenom = "";
$erreurContact = "";
$erreurSujet = "";
$erreurContenu = "";
$erreurGenre = "";
$nbr_erreur = 0;

if (isset($envoyer)) {
    if (empty($genre) || !isset($genre)) {
        $erreurGenre = '<pre class="erreurGenre" style="color:red;">Séléctionnez un genre</pre>';
        $nbr_erreur++;
    }
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (empty($email) || !isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurMail = '<pre class="erreurMail" style="color: red;">Entrez une adresse mail correct</pre>';
        $nbr_erreur++;
    }
    if ((empty($prenom)) || (!isset($prenom)) || (!preg_match("/^[a-zA-ZÀ-ú\s]*$/", $prenom))) {
        $erreurPrenom = '<pre class="erreurPrenom" style="color: red;">Entrez un prénom correct</pre>';
        $nbr_erreur++;
    }
    if (empty($nom) || !isset($nom) || (!preg_match("/^[a-zA-ZÀ-ú\s]*$/", $nom))) {
        $erreurNom = '<pre class="erreurNom" style="color: red;">Entrez un nom correct</pre>';
        $nbr_erreur++;
    }
    if (empty($metier) || !isset($metier) || (!preg_match('/^[a-zA-ZÀ-ú\s]*$/', $metier))) {
        $erreurMetier = '<pre class="erreurMetier" style="color: red;">Entrez seulement des lettres</pre>';
        $nbr_erreur++;
    }
    if (empty($sujet) || !isset($sujet) || (!preg_match('/./', $sujet))) {
        $erreurSujet = '<pre class="erreurSujet" style="color: red;">Ne pas mettre de caractère spécial</pre>';
        $nbr_erreur++;
    }
    if (empty($date_naissance) || !isset($date_naissance) || $today <= $date_naissance || $date_naissance <= $date_min) {
        $erreurNaissance = '<pre class="erreurNaissance" style="color: red;">Séléctionnez une date correct</pre>';
        $nbr_erreur++;
    }
    if (empty($date_contact) || !isset($date_contact) || $date_contact != $today) {
        $erreurContact = '<pre class="erreurContact" style="color: red;">Séléctionnez la date d\'aujourd\'hui</pre>';
        $nbr_erreur++;
    }

    if (empty($contenu) || !isset($contenu) || (!preg_match('/./', $contenu))) {
        $erreurContenu = '<pre class="erreurContenu" style="color: red;">Entrez un message</pre>';
        $nbr_erreur++;
    }
    if ($nbr_erreur == 0) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'breaking.breadcytech@gmail.com';                     //SMTP username
            $mail->Password   = 'Jesaispas123';                               //SMTP password
            $mail->SMTPSecure = 'tls';          //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('breaking.breadcytech@gmail.com', 'Breaking Bread');
            $mail->addAddress('rahmani.kevin9@gmail.com', 'Webmaster');     //Add a recipient             

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $sujet;
            $mail->Body    = '<h2>Bonjour Webmaster,</h2><br><br> Un nouveau client vous a envoyé un message :<br>Nom du client : ' . $nom . ' ' . $prenom . '<br>Contenu : ' . $contenu . '<br><br>Passez une agréable journée jeune maitre.';
            $mail->send();
            $succes = 'Votre requête a été envoyé';
        } catch (Exception $e) {
            $succes = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contact.css">
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/header.css">
    <title>Contactez Breaking Bread</title>
</head>

<body>
    <?php
    include('php/header.php');
    ?>
    <div class="formulaire">
        <div class="formulaire_titre">Demande de contact</div>

        <form action="#" method="post" id="form_contact">
            <div class=boite>
                <div class="gauche">
                    <div class="div_nom">
                        <input type="text" name="nom" placeholder="Entrer votre nom" size="10" id="Nom" class="Nom" value="<?php if (isset($nom)) echo $nom; ?>"><?php echo $erreurNom; ?>
                    </div>

                    <div class="div_mail">
                        <input type="mail" name="email" placeholder="Entrer votre adresse email" size="15" id="mail" class="mail" value="<?php if (isset($email)) echo $email; ?>"><?php echo $erreurMail; ?>
                    </div>

                    <div class="div_naissance">
                        <label for="Date_de_Naissance">Date de Naissance :</label>
                        <input type="date" name="date_naissance" id="Naissance" class="Naissance" min="1905-01-01" max="2030-01-01" value="<?php if (isset($date_naissance)) echo $date_naissance; ?>"><?php echo $erreurNaissance; ?>
                    </div>
                    <div class="div_metier">
                        <input type="text" name="metier" placeholder="Métier" size="15" id="Metier" class="Metier" value="<?php if (isset($metier)) echo $metier; ?>"> <?php echo $erreurMetier; ?>
                    </div>
                </div>

                <div class="droite">
                    <div class="div_prenom">
                        <input type="text" name="prenom" placeholder="Entrer votre prénom" size="10" id="Prenom" class="Prenom" value="<?php if (isset($prenom)) echo $prenom; ?>"><?php echo $erreurPrenom; ?>
                    </div>

                    <div class="GenreRadio">
                        <label for="genre" class="genre">Genre :</label>
                        <input type="radio" name="genre" value="Homme" <?php if ($genre == 'Homme') echo 'checked = "checked"'; ?>><label for="homme">Homme</label>
                        <input type="radio" name="genre" value="Femme" <?php if ($genre == 'Femme') echo 'checked = "checked"'; ?>><label for="femme">Femme</label><?php echo $erreurGenre; ?>
                    </div>

                    <div class="div_contact">
                        <label for="Date_de_Contact" id="Date2contact">Date de Contact :</label>
                        <input type="date" name="date_contact" id="Contact" class="Contact" value="<?php if (isset($date_contact)) echo $date_contact; ?>"><?php echo $erreurContact; ?>
                    </div>
                    <div class="div_sujet">
                        <input type="text" name="sujet" placeholder="Entrer le sujet de votre mail" size="16" id="sujet" class="sujet" value="<?php if (isset($sujet)) echo $sujet; ?>"><?php echo $erreurSujet; ?>
                    </div>
                </div>
            </div>

            <div class="contenu_sujet">
                <textarea name="Contenu" cols="70" rows="8" placeholder="Contenu de votre message ici" id="contenu" class="contenu"><?php if (isset($contenu)) echo $contenu; ?></textarea><?php echo $erreurContenu; ?>
            </div>

            <input type="submit" value="Envoyer" name="envoyer" id="button-sbt">
            <div><?php echo $succes; ?></div>
        </form>
    </div>

    <div class="imageContact">
        <img src="img/contactez-min.jpg" alt="">
    </div>
    </div>
    </div><br><br><br>
    <footer class="foot"><br>
        <center>
            <div class="up">SAS © <i>Breaking Bread 2022</i></div>
        </center>
        <center>
            <div class="down"><a href="mentionslegales.php">Mentions légales</a> <a href="plan_du_site.php">Plan du site</a></div>
        </center>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/contact.js"></script>
</body>

</html>