<?php

function csv_to_array($filename, $delimiter)
{
    if (!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}
?>
<div class="top"></div>


<header>
    <div class="uphead">
        <div class="logo_croissant">
            <a href="index.php" title="Accueil">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="70.000000pt" height="70.000000pt" viewBox="0 0 30.000000 30.000000" preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0.000000,30.000000) scale(0.014085,-0.013761)" fill="#53301c" stroke="none">
                        <path d="M835 1936 c-160 -53 -269 -119 -389 -235 -129 -125 -220 -272 -267 -433 -24 -82 -22 -112 14 -153 22 -26 91 -49 706 -236 197 -60 196 -60 298 44 85 85 98 112 82 170 -22 84 -242 793 -251 810 -13 25 -68 57 -98 57 -14 -1 -56 -11 -95 -24z" />
                        <path d="M1205 1954 c-11 -3 -30 -7 -42 -9 -21 -5 -21 -7 -9 -38 7 -17 64 -196 126 -397 63 -201 116 -369 120 -373 13 -15 59 36 245 274 187 240 190 244 190 292 0 46 -3 52 -45 89 -54 48 -201 120 -290 142 -65 17 -257 30 -295 20z" />
                        <path d="M1760 1360 c-78 -100 -140 -182 -139 -184 8 -5 326 -56 352 -56 35 0 92 53 103 95 11 43 -23 127 -91 229 -33 49 -65 91 -71 93 -6 2 -75 -78 -154 -177z" />
                        <path d="M173 943 c-16 -56 -7 -244 16 -328 27 -99 91 -231 139 -286 31 -34 45 -42 83 -46 l45 -5 235 182 c244 190 299 237 299 255 0 6 -177 64 -392 129 -216 66 -398 121 -405 123 -7 3 -16 -8 -20 -24z" />
                        <path d="M760 360 c-96 -76 -176 -143 -178 -149 -5 -14 113 -95 198 -135 99 -48 131 -47 181 3 23 23 39 48 39 62 1 35 -54 359 -60 359 -3 -1 -84 -63 -180 -140z" />
                    </g>
                </svg>
            </a>
        </div>
        <!-- le nom-->
        <div class="nom">
            <a href="index.php">BREAKING BREAD</a>
        </div>

        <!-- les logo à droite-->
        <div class="reste">
            <div class="panier">
                <a href="panier.php"><i class="fa-solid fa-basket-shopping icone"></i>
                    <?php
                    if (!empty($_SESSION['panier'])) {
                        foreach ($_SESSION['panier'] as $tab_min) {
                            $total_quantity = intval($total_quantity) + intval($tab_min['quantity']);
                            $prix_total = floatval($prix_total) + (floatval($tab_min['prix']) * intval($tab_min['quantity']));
                        }
                        echo $total_quantity . ' produits achetés - ' . $prix_total . ' euros';
                    }
                    ?>
                </a>
            </div>
            <div class="connexion">
                <?php
                if ($_SESSION['connecte'] == 1 || $_SESSION['connecte'] == 2) {
                    echo '<a href="connexion.php"><i class="fa-solid fa-user icone"></i> ' . $_SESSION['utilisateur'] . '</a>';
                } else {
                    echo '<a href="connexion.php"><i class="fa-solid fa-user icone"></i></a>';
                }
                ?>
            </div>
            <?php
            if ($_SESSION['connecte'] == 1 || $_SESSION['connecte'] == 2) {
                echo '<div class="deconnexion"><a href="php/logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></div>';
            }
            ?>
        </div>
    </div>
    <!-- le menu-->
    <div class="parent_bottomhead">
        <nav class="bottomhead">
            <ul>
                <li class="menu_categorie"><a href="index.php">ACCUEIL</a></li>

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
                                echo '<li class="menu_categorie"><a href="' . $tab_min_csv["link"] . '">' . $tab_min_csv["name"] . '</a>';
                                echo '<ul class="submenu">';
                                foreach ($tab_min_xml as $tab_produit_xml) {
                                    if (intval($tab_produit_xml->stock) > 0) {
                                        echo '<li><a href="produit.php?produit=' . $tab_min_csv["reference"] . '&amp;code=' . $tab_produit_xml->code . '">' . $tab_produit_xml->nom . '</a></li>';
                                    }
                                }
                                echo '</ul></li>';
                                break;
                            }
                        }
                    }
                }
                ?>

                <li class="menu_categorie"><a href="contact.php">CONTACT</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="ensemble">
    <div class="main-menu">
        <ul>
            <section class="links">
                <li class="menu-item"><i class="fa fa-house"></i><a href="index.php">ACCUEIL</a></li>
                <?php
                foreach ($tab_xml as $tab_min_xml) {
                    foreach ($tab_csv as $tab_min_csv) {
                        if ($tab_min_csv['link'] !== '' && $tab_min_csv['name'] !== '') {
                            $tab_xml_attribute = (int)$tab_min_xml['id'];
                            if ($tab_min_csv['reference'] == $tab_xml_attribute) {
                                echo '<li class="menu-item">' . $tab_min_csv["icone"] . '<a href="' . $tab_min_csv["link"] . '">' . $tab_min_csv["name"] . '</a></li>';
                                break;
                            }
                        }
                    }
                }
                ?>
                <li class="menu-item"><i class="fa fa-address-book "></i><a href="contact.php">CONTACT</a></li>
            </section>
        </ul>
    </div>

    <!-- penser a fermer la div-->