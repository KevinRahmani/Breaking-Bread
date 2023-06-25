<?php
session_start();
$_SESSION['page_produit'] = $_GET['produit'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/mentionslegales.css">
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
    <title>Breaking Bread : Viennoiserie, Pâtisserie</title>
</head>

<body>

    <?php
    include('php/header.php');
    ?>

    <div class="legales">
        <p>L'ensemble des onglets présents sur BreakingBread sont édités par SAS BREAKING BREAD détenu par : </p>
        <p> Sarah BERGERE, Clement CASSIET, Kevin RAHMANI, Rayane SEDDIKI.</p>
        <p>Siège social : Avenue du Parc, 95000, Cergy.</p>
        <p>Adresse Mail de la société : breaking.breadcytech@gmail.com </p>
        <p>Directeur de la publication : Renaud VERIN.</p>
        <p>Tél : 06 02 67 66 49</p><br>
        <p>Pour toute demande concernant un produit, et pour toutes suggestions, informations, veuillez remplir <a href="contact.php">ce formulaire.</a></p>
    </div>
    </div>

    <?php
    include('php/footer.php');
    ?>
    <script src="js/index.js"></script>
</body>

</html>