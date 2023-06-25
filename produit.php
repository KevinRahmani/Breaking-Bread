<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breaking Bread</title>
    <link rel="stylesheet" href="css/header2.css">
    <link rel="stylesheet" href="css/produit.css">
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
</head>

<body>
    <script>
        function affiche_stock(e) {
            const stock = document.getElementById("stock");

            if (stock.value == "mode1") {
                stock.innerHTML = "Il en reste " + e + " en stock";
                stock.value = "mode2";
            } else {
                stock.innerHTML = "Appuyer pour afficher le stock";
                stock.value = "mode1";
            }
        }
    </script>
    <?php
    include('php/header2.php');
    ?>

    <?php
    foreach ($tab_xml as $tab_min_xml) {
        if ((int) $tab_min_xml["id"] == $_GET["produit"]) {
            foreach ($tab_min_xml as $tab_produit) {
                if ((string) $tab_produit->code == $_GET["code"]) {

    ?>
                    <section class="resume_produit">

                        <div class="image-wrap">


                            <div class="contour">
                                <div class="image" style="background-image:url('<?php echo $tab_produit->image ?>')">
                                </div>
                            </div>

                            <div class="description">

                                <div class="name"><?php echo $tab_produit->nom . ' :'; ?></div>
                                <hr>

                                <div class="tout_prix">
                                    <div id="montant"><?php echo substr((string) $tab_produit->prix, 0, -5) ?>€</div>
                                    <div id="taxe">
                                        <pre> TTC</pre>
                                    </div>
                                </div><br>

                                <div class="icons" id="<?php echo "icons" . $tab_produit->code; ?>">
                                    <button class="cart-btn envoyer" id="submit"><span>Ajouter au panier<i style="padding-left:6px;" class="fa-solid fa-basket-shopping"></i></span></button>

                                    <button class="fa-solid fa-minus button_rose" id="minus"></button>
                                    <button class="fa-solid fa-plus button_rose" id="plus"></button>
                                    <input type="text" readonly="readonly" class="number_product" id="<?php echo $tab_produit->code; ?>" value="0"></input>
                                </div>
                                <hr>

                                <div class="longue">
                                    <p class="titre_info"><b>DESCRIPTION</b></p>
                                </div>
                                <div class="description_txt">
                                    <?php echo $tab_produit->description ?>
                                </div>
                                <hr>

                                <div class="longue">
                                    <p class="titre_info"><b>INGREDIENTS</b></p>
                                </div>
                                <div class="ingredients_txt">
                                    <?php
                                    $tab_ingredients = explode(",", $tab_produit->ingredients);
                                    echo "<ul>";
                                    $i = 0;
                                    foreach ($tab_ingredients as $ingredient) {
                                        echo '<li>' . $ingredient . '</li>';
                                    }
                                    echo "</ul>";
                                    ?>
                                </div>
                                <hr>

                                <!-- partie a afficher si admin -->
                                <?php
                                if ($_SESSION['connecte'] == 2) {
                                    echo "<br>";
                                    //echo  "<button class='stock' id='stock' onclick='affiche_stock(" . $tab_produit->stock . ")' value='mode1'>Appuyer pour afficher le stock</button>";
                                    echo '<button id="button_admin" value="'.$_GET["code"].'" class="display_stock">Appuyez pour afficher le stock</button>';
                                    echo  "<br><hr>";
                                }
                                ?>

                                <div class="ref_produit">
                                    <p>Référence du produit : <?php echo $tab_produit->code ?></p>
                                </div>

                            </div>
                        </div>
                    </section>
    <?php
                    break 2;
                }
            }
        }
    }

    ?>
    </div>

    <?php
    include('php/footer.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/produit.js"></script>
</body>

</html>