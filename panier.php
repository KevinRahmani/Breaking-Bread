<?php
session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header2.css">
    <link rel="stylesheet" href="css/panier.css">
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
    <title>Votre panier</title>
</head>

<body>
    <?php
    include('php/header2.php');
    ?>
    <div class="resume_panier">
        <?php
        if (!empty($_SESSION['panier'])) {
        ?>
            <h2>Votre panier :</h2>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Référence</th>
                    <th>Prix unitaire</th>
                </tr>
                <?php
                foreach ($_SESSION['panier'] as $tab_min) {
                    echo '<tr>';
                    echo '<td><img src="' . $tab_min['image'] . '" width="200" height="200"></img></td>';
                    echo '<td>' . $tab_min['nom'] . '</td>';
                    echo
                    '<td>
                                    <div class="change_quantity">
                                        <button class="button-minus" id="minus-' . $tab_min["code"] . '" role="button"><i class="fa-solid fa-minus"></i></button>
                                        <input type="text" size="5" id="text_' . $tab_min["code"] . '" readonly="readonly" class="input_btn" value="' . $tab_min["quantity"] . '"/>
                                        <button class="button-add" id="plus-' . $tab_min["code"] . '" role="button"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </td>';
                    echo '<td>' . $tab_min["code"] . '</td>';
                    echo '<td>' . $tab_min["prix"] . '</td>';
                    echo '<td class="bg_none"><button id="' . $tab_min["reference"] . '"><i class="fa-solid fa-xmark"></i></button></td>';
                    echo '</tr>';
                }
                echo '</table>';
                ?>
                <div class="validation">
                    <button id="annuler">Annuler</button>
                    <button id="valider">Valider</button>
                </div>
                <div class="erreur" id="erreur"></div>
            <?php
        } else {
            echo '<h2>Votre panier est vide</h2>';
        }
            ?>
    </div>
    </div>

    <?php
    include('php/footer.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/panier.js"></script>
</body>

</html>