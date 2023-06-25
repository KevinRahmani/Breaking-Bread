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
    <title>Breaking Bread</title>
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="stylesheet" href="css/header2.css">
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include('php/header2.php');
    ?>

    <?php
    if ($_SESSION['connecte'] != 0) {
        $file_name = 'data/connexion.json';
        if (file_exists($file_name)) {
            $current_data = file_get_contents($file_name);
            $tab = json_decode($current_data, true);

    ?>
            <div class="info_client">
                <h2> Vos informations personnelles :</h2>
                <div class="info_json">
                    <table>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Date de naissance</th>
                            <th>Mail</th>
                            <th>Code client</th>
                        </tr>
                        <tr>
                            <?php
                            foreach ($tab as $tab_min) {
                                if ($tab_min['Mail'] == $_SESSION['utilisateur']) {
                                    echo '<td>' . $tab_min["Nom"] . '</td>';
                                    echo '<td>' . $tab_min["Prenom"] . '</td>';
                                    echo '<td>' . $tab_min["Naissance"] . '</td>';
                                    echo '<td>' . $tab_min["Mail"] . '</td>';
                                    echo '<td>' . $tab_min["code_client"] . '</td>';
                                    break;
                                }
                            }


                            ?>
                        </tr>

                    </table>

                </div>
                <?php
                if ($_SESSION['connecte'] == 1) {
                ?>
                    <div class="histo_change">

                        <div class="historique_commande">
                            <h2>Mes précédentes commandes :</h2>
                            <div class="precedente_commande">

                                <?php

                                $file_name = 'data/connexion' . '.json';
                                if (file_exists($file_name)) {
                                    $current_data = file_get_contents($file_name);
                                    $array_data = json_decode($current_data, true);
                                }
                                foreach ($array_data as $array_min) {
                                    if ((string)$array_min["Mail"] == (string)$_SESSION["utilisateur"]) {
                                        if ($array_min["historique"] != "") {
                                            $tab_commande = explode('_', $array_min["historique"]);
                                            $length = count($tab_commande);
                                            for ($i = 0; $i < $length; $i++) {
                                                echo $tab_commande[$i];
                                                echo '<br>';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="right_part">
                            <button id="affiche_coord">Modifier mes coordonnées</button>
                            <div class="change_coord notActive">
                                <?php
                                foreach ($tab as $tab_min) {
                                    if ($tab_min['Mail'] == $_SESSION['utilisateur']) {
                                ?>
                                        <form action="php/modif_coord.php" method="POST" id="form_change">
                                            <div id="terme" class="nom_user">
                                                <label id="label" for="nom">Nom :</label><input type="text" name="nom_change" value="<?php echo $tab_min["Nom"] ?>">
                                            </div>
                                            <div id="terme" class="prenom_user">
                                                <label id="label" for="nom">Prénom :</label><input type="text" name="prenom_change" value="<?php echo $tab_min["Prenom"] ?>">
                                            </div>
                                            <div id="terme" class="mail_user">
                                                <label id="label" for="nom">Mail :</label><input type="text" name="mail_change" value="<?php echo $tab_min["Mail"] ?>">
                                            </div>
                                            <div id="terme" class="password_user">
                                                <label id="label" for="nom">Mot de passe :</label><input type="password" name="password_change" value="<?php echo $tab_min["Password"] ?>">
                                            </div>
                                            <div id="terme" class="sexe_user">
                                                <label for="sexe" id="label">Sexe :</label>
                                                <select id="coord_sexe" name="sexe_change">
                                                    <option value="Homme" <?php if ($tab_min['Sexe'] == "Homme") echo 'selected="selected"'; ?>>Homme </option>
                                                    <option value="Femme" <?php if ($tab_min['Sexe'] == "Femme") echo 'selected="selected"'; ?>>Femme</option>
                                                </select>
                                            </div>
                                            <div id="terme" class="naissance_user">
                                                <label id="label" for="nom">Date de Naissance :</label><input type="date" name="naissance_change" id="naissance_change" value="<?php echo $tab_min["Naissance"] ?>">
                                            </div>
                                            <div id="terme" class="adresse_user">
                                                <label id="label" for="nom">Adresse :</label><input type="text" name="adresse_change" value="<?php echo $tab_min["Adresse"] ?>">
                                            </div>
                                            <div id="terme" class="metier_user">
                                                <label id="label" for="nom">Metier :</label><input type="text" name="metier_change" value="<?php echo $tab_min["Metier"] ?>">
                                            </div>
                                            <div id="terme" class="code_user">
                                                <label id="label" for="nom">Code client</label><input type="text" readonly="readonly" value="<?php echo $tab_min["code_client"] ?>">
                                            </div>
                                            <div class="choice">
                                                <input type="reset" id="annuler"></input>
                                                <input type="submit" id="valider"></input>
                                            </div>
                                            <div class="resultat_change"></div>
                                        </form>
                                <?php
                                        break;
                                    }
                                }


                                ?>
                            </div>
                        </div>
                    <?php
                } elseif ($_SESSION['connecte'] == 2) {
                    ?>
                        <div class="salutation">Droits d'Administrateur</div>
                        <div class="envoyer_mail">
                            <div class="description_mail">Envoi mail publicitaire à tous les clients : </div>
                            <button id="mail_all">Envoyer</button>
                            <div class="accuse"></div>
                        </div>
                        <h3 class="jsp">Back Office</h3>
                        <div class="back_office">
                            <?php
                            if (file_exists('data/categorie.csv')) {
                                $tab_csv = csv_to_array('data/categorie.csv', ',');
                            }
                            if (file_exists('data/stock.xml')) {
                                $tab_xml = simplexml_load_file('data/stock.xml');
                            }
                            ?>
                            <div class="flex_mettre">
                                <div class="titre_BO">Veuillez sélectionner la catégorie à supprimer</div>
                                <form action="php/supp_BO.php" method="post" id="form_supp_bo">
                                    <select name="categorie_supp" id="categorie_supprimer">
                                        <option value="">Catégorie</option>
                                        <?php
                                        foreach ($tab_csv as $tab_min_csv) {
                                            echo '<option value="' . $tab_min_csv["name"] . '">' . $tab_min_csv["name"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <input type="submit" id="submit_bo" class="notActive" value="Valider">
                                </form>
                                <div class="erreur_categorie"></div>
                            </div>
                            <div class="flex_mettre2">
                                <div class="titre_produit">Veuillez sélectionner le produit à supprimer</div>
                                <form action="php/supp_BO_produit.php" method="post" id="form_supp_produit">
                                    <select name="produit_supp" id="produit_supprimer">
                                        <option value="">Produit</option>
                                        <?php
                                        foreach ($tab_xml as $tab_min_xml) {
                                            foreach ($tab_min_xml as $tab_produit) {
                                                echo '<option value="' . $tab_produit->nom . '">' . $tab_produit->nom . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="submit" id="submit_produit" class="notActive" value="Valider">
                                </form>
                                <div class="erreur_prod"></div>
                            </div>
                        </div>
                    <?php
                }
                    ?>
                    </div>
            </div>

        <?php
            echo '</div>';
        }
        ?>


    <?php
    } else {
    ?>
        <div class="encadre">
            <div class="toggleInscr_Connex" id="toggleInscr_Connex">
                <div class="form_connexion" id="form_connexion">
                    <div class="logo">
                        <i class="fas fa-user"></i>
                        <div class="titre_connexion">Connexion</div>
                    </div>
                    <div class="tab-body">
                        <form id="form1" action="php/verif_connexion.php" method="post">
                            <div class="row">
                                <i class="far fa-user"></i>
                                <input type="text" name="email" class="input" placeholder="Adresse Mail" id="mail1">
                            </div>
                            <div class="row">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Mot de Passe" name="mdp" class="input" id="mdp">
                            </div>
                            <input class="btn" type="submit" value="Connexion"></input>
                        </form>
                    </div>
                </div>
                <form action="php/verif_inscription.php" method="post" id="form_inscription" class="notActive">
                    <div class="logo2">
                        <i class="fas fa-user"></i>
                        <div class="titre_inscription">Inscription</div>
                    </div>
                    <div class="inscription">
                        <div class="annonce">Remplissez tous les champs afin de créer votre nouveau compte !</div>
                        <div class="info_perso">Informations personnelles :</div>
                        <div class="nom_co">
                            <input type="text" name="nom" size="10" placeholder="Nom" id="nom">
                            <input type="text" name="prenom" size="10" placeholder="Prénom" id="prenom">
                        </div>
                        <div class="mail">
                            <label for="mail">Adresse mail :</label>
                            <input type="text" name="mail" placeholder="Adresse mail" size="12" id="mail">
                        </div>
                        <div class="mdp">
                            <label for="mdp">Mot de passe :</label>
                            <input type="password" name="mot_de_passe" placeholder="Mot de passe" size="11" id="password">
                        </div>
                        <div class="sexe">
                            <label for="sexe">Sexe :</label>
                            <input type="radio" name="sexe" value="Homme" id="homme"><label for="homme">Homme</label>
                            <input type="radio" name="sexe" value="Femme" id="femme"><label for="femme">Femme</label>
                        </div>
                        <div class="date_naissance">
                            <label for="naissance">Date de naissance :</label>
                            <input type="date" name="naissance" size="7" id="naissance">
                        </div>
                        <div class="adresse">
                            <label for="adresse">Adresse :</label>
                            <input type="text" name="adresse" id="adresse" placeholder="Adresse physique" size="16">
                        </div>
                        <div class="metier">
                            <label for="metier">Metier :</label>
                            <input type="text" name="metier" placeholder="Profession" size="16" id="metier">
                        </div>
                    </div>
                    <input type="submit" value="Créer mon compte" class="btn-submit">
                </form>
            </div>
            <div class="erreur" id="erreur"></div>
            <div class="erreur2" id="erreur2"></div>
            <div class="tab-link" id="div_inscription">Vous n'êtes pas encore inscris ?<a href="#" id="inscription"> cliquez ici</a></div>
            <div class="tab-link2 notActive" id="div_connexion">Vous êtes déjà inscris ?<a href="#" id="connexion"> cliquez ici</a></div>
        </div>
        </div>
    <?php
    }
    ?>


    <?php
    include('php/footer.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/connexion.js"></script>
</body>

</html>