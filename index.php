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
    <link rel="stylesheet" href="css/index.css">
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
    <title>Breaking Bread : Viennoiserie, Pâtisserie</title>
</head>

<body>

    <?php
    include('php/header.php');
    ?>

    <div class="rightpart">
        <section class="children">
            <div class="slider">
                <img src="img/patisserie-min.jpg" alt="pain Suisse" width="1700" height="200" class="img_slider active">
                <img src="img/slide1-min.jpg" alt="Muffin au chocolat" class="img_slider">
                <div class="suivant">
                    <i class="fa-solid fa-circle-right"></i>
                </div>
                <div class="precedent">
                    <i class="fa-solid fa-circle-left"></i>
                </div>
                <div class="promotion">NOS PROMOTIONS: -50% JUSQU'A LA FIN DU MOIS !</div>
            </div>
        </section>
        <section class="children">
            <div class="slider">
                <img src="img/croissant_min.jpg" alt="croissant" class="img_slider2 active2">
                <img src="img/mille-feuille_min.jpg" width="800" height="200" alt="Mille Feuilles" class="img_slider2">
                <div class="suivant2">
                    <i class="fa-solid fa-forward"></i>
                </div>
                <div class="precedent2">
                    <i class="fa-solid fa-backward"></i>
                </div>
                <div class="nouveaute">NOS NOUVEAUTÉS !</div>
            </div>
        </section>
        <section class="children">
            <div class="slider">
                <img src="img/macarons_min.jpg" alt="macarons" class="img_slider3 active3">
                <img src="img/sandwich_min.jpg" alt="Croissants" class="img_slider3">
                <div class="suivant3">
                    <i class="fa-solid fa-arrow-right-long"></i>
                </div>
                <div class="precedent3">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </div>
                <div class="best-seller">NOS BEST-SELLERS !</div>
            </div>
        </section>
    </div>
    </div>
    <?php
    include('php/footer.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
</body>

</html>