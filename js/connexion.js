var toggleInscr_Connex = document.getElementById('toggleInscr_Connex');
var div_inscription = document.getElementById('div_inscription');
var div_connexion = document.getElementById('div_connexion');
var form_inscription = document.getElementById('form_inscription');
var form_connexion = document.getElementById('form_connexion');

$(document).ready(function () {
    $("#inscription").click(function (e) {
        e.preventDefault();
        document.getElementById('erreur').innerHTML = "";
        div_inscription.classList.add('notActive');
        div_connexion.classList.remove('notActive');
        form_inscription.classList.remove('notActive');
        form_connexion.classList.add('notActive');
    })
})

$(document).ready(function () {
    $("#connexion").click(function (e) {
        e.preventDefault();
        document.getElementById('erreur2').innerHTML = "";
        div_inscription.classList.remove('notActive');
        div_connexion.classList.add('notActive');
        form_inscription.classList.add('notActive');
        form_connexion.classList.remove('notActive');
    })
})



/*JS CODE CONNEXION */

/*VERIFICATION JS LIVE CONNEXION*/

$("#mail1").on('click', function () {
    var valeur = $(this).val();
    if (valeur == '') {
        $('#mail1').css('color', 'red');
    }
});
$("#mail1").on('keypress', function () {
    var valeur = $(this).val();
    var regexmail = /([\w-\.]+@[\w\.]+\.{1}[\w]+)/;
    if (regexmail.test(valeur) == false || valeur == '') {
        $('#mail1').css('color', 'red');
    } else {
        $('#mail1').css('color', 'green');
    }
});

$("#mdp").on('click', function () {
    var valeur = $(this).val();
    if (valeur === '') {
        $('#mdp').css('color', 'red');
    }
});
$("#mdp").on('keypress', function () {
    var valeur = $(this).val();
    if (valeur == '') {
        $('#mdp').css('color', 'red');
    } else {
        $('#mdp').css('color', 'black');
    }
});

/*VERIFICATION COTE SERVEUR AJAX PHP CONNEXION */

$(document).ready(function () {
    $('#form1').on('submit', function (e) {

        e.preventDefault();
        var $this = $(this);
        $.ajax({
            type: $this.attr('method'),
            url: $this.attr('action'),
            data: $this.serialize(),
            dataType: "json",
            success: function (json) {
                if (json.response === 'yes') {
                    window.location.href = 'index.php';
                } else {
                    document.getElementById('erreur').innerHTML = json.response;
                    return false;
                }
            }
        });
    });
});



/*JS CODE INSCRIPTION */


/*VERIFICATION LIVE JS INSCRIPTION*/
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
var annee18 = today.getFullYear() - 18;


if (dd < 10) {
    dd = '0' + dd;
}

if (mm < 10) {
    mm = '0' + mm;
}

var date18 = annee18 + '-' + mm + '-' + dd;
today = yyyy + '-' + mm + '-' + dd;
var datemin = '1905-01-01';

$(document).ready(function () {
    $("#naissance").attr({
        "max": date18,
        "min": datemin
    });
    $("#naissance_change").attr({
        "max": date18,
        "min": datemin
    });
})

$("#nom").on('click', function () {
    var valeur = $(this).val();
    if (valeur == '') {
        $("#nom").addClass('encadreRouge');
    }
});
$("#nom").on('keypress keyup keydown', function () {
    var valeur = $(this).val();
    var regex = /^[a-zA-ZÀ-ú\s]*$/g;
    if (regex.test(valeur) == false || valeur == '') {
        $("#nom").addClass('encadreRouge');
        $('#nom').removeClass('encadreVert');
    } else {
        $('#nom').removeClass('encadreRouge');
        $("#nom").addClass('encadreVert');
    }
});

$("#prenom").on('click', function () {
    var valeur = $(this).val();
    if (valeur == '') {
        $("#prenom").addClass('encadreRouge');
    }
});
$("#prenom").on('keypress keyup keydown', function () {
    var valeur = $(this).val();
    var regex = /^[a-zA-ZÀ-ú\s]*$/g;
    if (regex.test(valeur) == false || valeur == '') {
        $("#prenom").addClass('encadreRouge');
        $('#prenom').removeClass('encadreVert');
    } else {
        $('#prenom').removeClass('encadreRouge');
        $("#prenom").addClass('encadreVert');
    }
});

$("#mail").on('click', function () {
    var valeur = $(this).val();
    if (valeur == '') {
        $("#mail").addClass('encadreRouge');
    }
});
$("#mail").on('keypress keyup keydown', function () {
    var valeur = $(this).val();
    var regexmail = /([\w-\.]+@[\w\.]+\.{1}[\w]+)/;
    if (regexmail.test(valeur) == false || valeur == '') {
        $("#mail").addClass('encadreRouge');
        $('#mail').removeClass('encadreVert');
    } else {
        $('#mail').removeClass('encadreRouge');
        $("#mail").addClass('encadreVert');
    }
});

$("#password").on('click keypress keyup keydown', function () {
    var valeur = $(this).val();
    if (valeur === '') {
        $("#password").addClass('encadreRouge');
        $("#password").removeClass('encadreVert');
    } else {
        $("#password").addClass('encadreVert');
        $("#password").removeClass('encadreRouge');
    }
});

$("#sexe").on('click', function () {
    var valeur = $(this).val();
    if (valeur == '') {
        $("#sexe").addClass('encadreRouge');
    }
});

$("#naissance").on('click change', function () {
    var valeur = $(this).val();
    if (valeur == '') {
        $("#naissance").addClass('encadreRouge');
        $("#naissance").removeClass('encadreVert');
    } else {
        $("#naissance").addClass('encadreVert');
        $("#naissance").removeClass('encadreRouge');
    }
});

$("#adresse").on('click', function () {
    var valeur = $(this).val();
    if (valeur == '') {
        $("#adresse").addClass('encadreRouge');
    }
});
$("#adresse").on('keypress', function () {
    var valeur = $(this).val();

    if (valeur == '') {
        $("#adresse").addClass('encadreRouge');
        $('#adresse').removeClass('encadreVert');
    } else {
        $('#adresse').removeClass('encadreRouge');
        $("#adresse").addClass('encadreVert');
    }
});

$("#metier").on('click', function () {
    var valeur = $(this).val();
    if (valeur == '') {
        $("#metier").addClass('encadreRouge');
    }
});
$("#metier").on('keypress keyup keydown', function () {
    var valeur = $(this).val();
    var regex = /^[a-zA-ZÀ-ú\s]*$/g;
    if (regex.test(valeur) == false || valeur == '') {
        $("#metier").addClass('encadreRouge');
        $('#metier').removeClass('encadreVert');
    } else {
        $('#metier').removeClass('encadreRouge');
        $("#metier").addClass('encadreVert');
    }
});


/*VERIFICATION COTE SERVEUR AJAX PHP INSCRIPTION */
$(document).ready(function () {
    $('#form_inscription').on('submit', function (e) {

        e.preventDefault();
        var $this = $(this);
        $.ajax({
            type: $this.attr('method'),
            url: $this.attr('action'),
            data: $this.serialize(),
            dataType: "json",
            success: function (json) {
                if (json.response === 'ok') {
                    window.location.href = 'index.php';
                } else {
                    document.getElementById('erreur2').innerHTML = json.response;
                    return false;
                }
            }
        });
    });
});


$(document).ready(function () {
    $("#affiche_coord").click(function (e) {
        e.preventDefault();
        $('.change_coord').toggleClass('notActive');
    })
})

$(document).ready(function () {
    $("#mail_all").click(function (e) {
        e.preventDefault();
        $(".accuse").html("Les mails publicitaires ont été envoyés");
        $.ajax({
            type: "GET",
            url: "php/mail_all.php",
            dataType: "json",
        });
    })
})


$(document).ready(function () {
    $("#form_change").on("submit", function (e) {
        e.preventDefault();

        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr("action"),
            data: form.serialize(),
            dataType: "json",
            success: function (response) {
                if (response.info == 'ok') {
                    location.reload();
                } else {
                    $(".resultat_change").html(response.info);
                }
            }
        });
    })
})
$(document).ready(function () {
    $('#categorie_supprimer').change(function (e) {
        e.preventDefault();
        $("#submit_bo").removeClass("notActive");
    })
})

$(document).ready(function () {
    $("#form_supp_bo").on("submit", function (e) {
        e.preventDefault();
        var form_bo = $(this);
        $.ajax({
            type: form_bo.attr("method"),
            url: form_bo.attr("action"),
            data: form_bo.serialize(),
            dataType: "json",
            success: function (response) {
                if (response.bo == 'ok') {
                    location.reload();
                } else {
                    $(".erreur_categorie").html("Veuillez sélectionner une catégorie");
                }
            }
        });
    })
})

$(document).ready(function () {
    $("#produit_supprimer").change(function (e) {
        e.preventDefault();
        $("#submit_produit").removeClass("notActive");
    })
})

$(document).ready(function () {
    $("#form_supp_produit").on("submit", function (e) {
        e.preventDefault();
        var form_supp = $(this);
        $.ajax({
            type: form_supp.attr("method"),
            url: form_supp.attr("action"),
            data: form_supp.serialize(),
            dataType: "json",
            success: function (response) {
                if (response.val == 'ok') {
                    location.reload();
                } else {
                    $(".erreur_prod").html("Veuillez rentrer un produit");
                }
            }
        });
    })
})