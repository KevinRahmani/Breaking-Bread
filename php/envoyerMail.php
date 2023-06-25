<?php
session_start();
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$prix_tot = 0;

foreach ($_SESSION['panier'] as $tab_min) {
    $prix_tot += floatval($tab_min["prix"]) * floatval($tab_min['quantity']);
}

echo '<h2>Breaking Bread vous remercie de votre achat</h2><br><br>';
echo 'Bonjour ' . $_SESSION['nom'] . ',<br>L\'équipe Breaking Bread est heureuse de vous envoyer votre récapitulatif de commande :<br><br>';
echo '<h4>Commande :</h4>';
foreach ($_SESSION['panier'] as $tab_min) {
    echo "Nom : " . $tab_min['nom'] . "<br>";
    echo "Référence : " . $tab_min['code'] . "<br>";
    echo "Quantité : " . $tab_min['quantity'] . "<br>";
    echo "Prix unitaire : " . $tab_min['prix'] . "<br><br>";
}
echo "Prix total : " . $prix_tot . " euros.";
echo "<br>Nous vous remercions de votre confiance, à très vite";

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
    $mail->addAddress($_SESSION['utilisateur'], $_SESSION["nom"]);     //Add a recipient             

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Commande Breaking Bread !';

    $mail->Body    = ob_get_clean();


    $mail->send();
    $succes = 'ok';
} catch (Exception $e) {
    $succes = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


$file_name = '../data/connexion' . '.json';
if (file_exists($file_name)) {
    $current_data = file_get_contents($file_name);
    $array_data = json_decode($current_data, true);
}

foreach ($array_data as $key => $array_min) {
    foreach ($_SESSION["panier"] as $panier_min) {
        if ($array_min["Mail"] == $_SESSION["utilisateur"]) {
            $array_data[$key]["historique"] .= '<br><br><u><b>Nom du produit</b></u> : ' . $panier_min["nom"] . '<br><u><b>Quantité</b></u> : ' . $panier_min["quantity"] . '_';
        }
    }
}

$tab = json_encode($array_data, JSON_PRETTY_PRINT);
file_put_contents($file_name, $tab);

unset($_SESSION['panier']);
echo json_encode(['succes' => $succes]);
?>