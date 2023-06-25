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
    <link rel="stylesheet" href="css/facture.css">
    <title>Votre Facture</title>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    if (!empty($_SESSION['panier'])) {
    ?>
        <?php include('php/header2.php') ?>
        <div class="facture">
            <h2>Votre facture</h2>
            <table>
                <tr>
                    <th>Produit</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Référence</th>
                    <th>Prix HT</th>
                    <th>Prix TTC</th>
                    <th>TOTAL</th>
                </tr>

                <?php
                foreach ($_SESSION['panier'] as $tab_min) {
                    echo '<tr class="produit">';
                    echo '<td><img src="' . $tab_min['image'] . '" width="200" height="200"></img></td>';
                    echo '<td>' . $tab_min['nom'] . '</td>';
                    echo
                    '<td>
                                        <div class="quantite">
                                            <input type="text" size="5" id="text_' . $tab_min["code"] . '" readonly="readonly" class="input_btn" value="' . $tab_min["quantity"] . '"/>
                                        </div>
                                    </td>';
                    echo '<td>' . $tab_min["code"] . '</td>';
                    echo '<td>' . (floatval($tab_min["prix"]) * (1 - 20 / 100)) . ' €</td>';
                    echo '<td>' . substr((string) $tab_min['prix'], 0, -5) . ' €</td>';
                    echo '<td class="totalprix"><b>' . floatval($tab_min["prix"]) * floatval($tab_min['quantity']) . ' €<b/></td>';
                    echo '</tr>';
                }
                echo '<tr>
                    <td colspan = 6></td>';
                echo '<td class="total">';
                foreach ($_SESSION['panier'] as $tab_min) {
                    $prixtotHT += (floatval(($tab_min["prix"]) * floatval($tab_min['quantity'])) * (1 - 20 / 100));
                }
                echo $prixtotHT . ' € HT</td></tr> <hr>';

                echo '<tr><td colspan=6></td>';
                echo '<td class="total"><b>';
                foreach ($_SESSION['panier'] as $tab_min) {
                    $prixtot += floatval($tab_min["prix"]) * floatval($tab_min['quantity']);
                }
                echo $prixtot . ' € TTC</b></td></tr>';
                echo '</table>';
                ?>
                <div class="validation">
                    <button id="annuler">Annuler</button>
                    <button id="envoyer">Envoyer</button>
                </div>
                <div class="message_info"></div>
        </div>
        </div>

        <?php include('php/footer.php') ?>

    <?php
    } else {
        echo '<h2> Panier vide veuillez quitter cette page</h2>';
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/facture.js"></script>
</body>

</html>