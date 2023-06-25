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
    <link rel="stylesheet" href="css/header2.css">
    <link rel="stylesheet" href="css/categorie.css">
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
    <title>Breaking Bread : Viennoiserie, Pâtisserie</title>
</head>

<body>

    <?php
    include('php/header2.php');
    ?>
    <div class="fond_accueil"></div>
    <div class="container">
        <div class="titre_section">
            <?php
            foreach ($tab_csv as $tab_min_csv) {
                if (intval($_SESSION['page_produit']) == (int) $tab_min_csv['reference']) {
                    echo $tab_min_csv['name'];
                    break;
                }
            }
            ?>
        </div>
        <div class="citation">
            <?php
            foreach ($tab_csv as $tab_min_csv) {
                if (intval($_SESSION['page_produit']) == (int) $tab_min_csv['reference']) {
                    echo $tab_min_csv['citation'];
                    break;
                }
            }
            ?>
        </div>
        <div class="lien_ancre">
            <a href="#produit">Commander maintenant !</a>
        </div>
    </div>
    </div>

    <section class="products" id="produit">
        <h1 class="titre_produit">NOS DERNIERS PRODUITS :</h1>
        <div class="box-container">
            <?php
            foreach ($tab_xml as $tab_min_xml) {
                if (intval($_SESSION['page_produit']) == (int) $tab_min_xml['id']) {
                    foreach ($tab_min_xml as $tab_produit) {
                        if ((int)$tab_produit->stock > 0) {
            ?>
                            <div class="box">
                                <span class="discount"><?php echo '-' . rand(5, 30) . '%';  ?></span>
                                <div class="image">
                                    <img src="<?php echo $tab_produit->image; ?>" alt="<?php echo $tab_produit->nom ?>">
                                    <div class="icons" id="<?php echo "icons" . $tab_produit->code; ?>">
                                        <button class="fa-solid fa-minus button_rose" id="minus"></button>
                                        <button class="cart-btn envoyer" id="submit"><span>Ajouter au panier</span></button>
                                        <button class="fa-solid fa-plus button_rose" id="plus"></button>
                                        <input type="text" readonly="readonly" class="number_product" id="<?php echo $tab_produit->code; ?>" value="0"></input>
                                    </div>
                                    <div class="content">
                                        <h3><?php echo $tab_produit->nom; ?></h3>
                                        <div class="price"><?php
                                                            echo $tab_produit->prix;
                                                            if ($_SESSION['connecte'] == 2) {
                                                                echo '  | Stock : ' . $tab_produit->stock;
                                                            }
                                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php
                        }
                    }
                    break;
                }
            }
            ?>
        </div>
    </section>


    <?php
    include('php/footer.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/categorie.js"></script>
</body>

</html>