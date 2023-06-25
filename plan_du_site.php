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
    <link rel="stylesheet" href="css/plan_du_site.css">
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
    <title>Breaking Bread : Viennoiserie, Pâtisserie</title>
</head>

<body>
    <?php
    include('php/header.php');
    ?>
    <div class="contenu">
        <h1><i>Plan du site</i></h1>
        <h2>Pages</h2>
        <hr>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="contact.php">Contactez-nous</a></li>
            <li><a href="connexion.php">Connexion/Inscription</a></li>
            <li><a href="mentionslegales.php">Mention légales</a></li>
            <li><a href="panier.php">Panier</a></li>
            <li><a href="plan_du_site.php">Plan du site</a></li>
            <li>Produit
                <ul>
                    <?php
                    if (file_exists('data/categorie.csv')) {
                        $tab_csv = csv_to_array('data/categorie.csv', ',');
                    }
                    if (file_exists('data/stock.xml')) {
                        $tab_xml = simplexml_load_file('data/stock.xml');
                    }
                    foreach ($tab_xml as $tab_min_xml) {
                        foreach ($tab_csv as $tab_min_csv) {
                            if ($tab_min_csv['link'] !== '' && $tab_min_csv['name'] !== '') {
                                $tab_xml_attribute = (int)$tab_min_xml['id'];
                                if ($tab_min_csv['reference'] == $tab_xml_attribute) {
                                    echo '<li><a href="' . $tab_min_csv["link"] . '">' . $tab_min_csv["name"] . '</a></li>';
                                    break;
                                }
                            }
                        }
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </div>
    </div>
    <?php
    include('php/footer.php');
    ?>
</body>

</html>