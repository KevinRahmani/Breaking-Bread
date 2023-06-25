//Requete AJAX pour annuler entièrement la commande
$(document).ready(function () {
    $("#annuler").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "php/annul_commande.php",
            dataType: "json",
            success: function (response) {
                if (response.statue == 'ok') {
                    window.location.href = "panier.php";
                }
            }
        });
    })
})

//Requete AJAX pour vérifier si le client est connecté
$(document).ready(function () {
    $("#valider").click(function (e) {
        e.preventDefault();
        idErreur = document.getElementsByClassName("erreur");

        $.ajax({
            type: "GET",
            url: "php/verif_utilisateur_panier.php",
            dataType: "json",
            success: function (response) {
                if (response.xd == 'ok') {
                    window.location.href = "facture.php";
                }
                if (response.xd == 'rate') {
                    $("#erreur").html("Vous n'êtes pas connecté, veuillez le faire <a href='connexion.php'>ici</a> pour poursuivre votre achat.");
                }
            }
        });
    })
})

//Requete AJAX pour supprimer une ligne du panier
$(document).ready(function () {
    $(".bg_none > button").click(function (e) {
        e.preventDefault();
        var Button = $(this).attr('id');


        $.ajax({
            type: "GET",
            url: "php/suppLignePanier.php",
            data: {
                "id": Button
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 'ok') {
                    location.reload();
                }
            }
        });
    })
})

//Requete AJAX pour incrementer ou décrémenter la quantité voulu
$(document).ready(function () {
    $(".change_quantity > button").click(function (e) {
        e.preventDefault();

        idButton = this.getAttribute('id');
        TrucId = document.getElementById(idButton).parentElement;
        Pinput = TrucId.children[1];
        tableau = TrucId.parentElement.parentElement;

        $.ajax({
            type: "GET",
            url: "php/incrementer.php",
            data: {
                "id": idButton,
                "pinput": parseInt(Pinput.value)
            },
            dataType: "json",
            success: function (response) {
                if (response.stat == 'ok') {
                    if (response.stat2 == 'plus') {
                        if ((parseInt(response.stat4)) == 1) {
                            Pinput.value = parseInt(Pinput.value) + 1;
                            this.disabled = true;

                        } else {
                            this.disabled = false;
                            Pinput.value = parseInt(Pinput.value) + 1;
                        }
                    }
                    if (response.stat2 == 'minus') {
                        if (parseInt(Pinput.value) == 1) {
                            tableau.remove();
                            location.reload();
                        }
                        this.disabled = false;
                        Pinput.value = parseInt(Pinput.value) - 1;

                    }
                }
            }
        });
    })
})