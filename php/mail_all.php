<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


function envoyer_mail($mail_a_envoyer, $nom_client){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 1;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'breaking.breadcytech@gmail.com';                     //SMTP username
        $mail->Password   = 'Jesaispas123';                               //SMTP password
        $mail->SMTPSecure = 'tls';          //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('breaking.breadcytech@gmail.com', 'Breaking Bread');
        $mail->addAddress($mail_a_envoyer, $nom_client);     //Add a recipient             


        //Attachments         //Add attachments
        $mail->addAttachment('../img/charlotte400-min.png', 'charlotte_aux_fraises.jpg');    //Optional name
        $mail->addAttachment('../img/croissant400-min.jpg', 'Croissant.jpg');    
        $mail->addAttachment('../img/tartePommes400-min.jpg', 'tarte_Pommes.jpg');    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Promotion Breaking Bread !';

        $mail->Body    = "<h2>VENTE FLASH BREAKING BREAD</h2><br><br>Bonjour ".$nom_client.",<br><b>Nos produits phares sont actuellement en promotions !!
                        </b><br>La fameuse <i>charlotte aux fraises</i>, spécialité de nos grands chefs est actuellement en promotion à -30% !<br>Mais ce n'est pas tout ! 
                        la <i>tarte aux pommes</i> et le <i>croissant</i> sont eux aussi en promotion pendant une durée limitée alors venez en profiter !!";

        $mail->send();
    } catch (Exception $e) {
        $succes = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


$file_name='../data/connexion'. '.json';

if(file_exists($file_name))
{
    $current_data=file_get_contents($file_name);
    $array_data=json_decode($current_data, true);
    foreach($array_data as $array_min){
        envoyer_mail((string) $array_min['Mail'], (string) $array_min["Prenom"]);
    }
}

?>