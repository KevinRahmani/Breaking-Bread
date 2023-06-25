/*AJAX DU STOCK */

var panier_produit = document.getElementById('panier_quantite');

$(document).ready(function () {
    $('button').click(function (e) {
        e.preventDefault();

        var idButton = $(this).attr('id');
        var parent = $(this).parent()
        var kids = parent.children();
        var inputId = kids[3].getAttribute('id');


        if (idButton == 'plus') {
            $(kids[3]).removeClass('button_red');
            $(kids[3]).addClass('button_rose');
            kids[3].value = parseInt(kids[3].value) + 1;
        }

        if (idButton == 'minus') {
            if (parseInt(kids[3].value) > 0) {
                $(kids[3]).removeClass('button_red');
                kids[3].value = parseInt(kids[3].value) - 1;
            } else {
                $(kids[3]).removeClass('button_rose');
                $(kids[3]).addClass('button_red');
            }
        }
        if (idButton == 'submit') {
            if (parseInt(kids[3].value) > 0) {
                $.ajax({
                    type: "GET",
                    url: "php/modif_stock.php",
                    data: {
                        'quantity': kids[3].value,
                        'id': kids[3].getAttribute('id')
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 'ok') {
                            kids[3].value = 0;
                            $(kids[3]).removeClass('button_red');
                            $(kids[3]).addClass('button_rose');


                        } else {
                            kids[3].value = parseInt(response.stock);
                            $(kids[3]).addClass('button_red');
                            $(kids[3]).removeClass('button_rose');

                        }
                    }
                });
            }
        }
    })
})