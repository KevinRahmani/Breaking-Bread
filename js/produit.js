const image = document.querySelector('.image');

//Fait un zoom sur l'image selon l'emplacement du curseur 
image.addEventListener('mousemove', function (e) {
    let width = image.offsetWidth;
    let mouseX = e.offsetX;
    let mouseY = e.offsetY;

    let bgPosX = (mouseX / width * 100);
    let bgPosY = (mouseY / width * 100);

    image.style.backgroundPosition = `${bgPosX}% ${bgPosY}%`;
    image.addEventListener('mouseleave', function () {
        image.backgroundPosition = "center";
    });
})

var panier_produit = document.getElementById('panier_quantite');

//Requete AJAX pour modiier le stock xml
$(document).ready(function () {
    $('button').click(function (e) {
        e.preventDefault();

        var idButton = $(this).attr('id');
        var parent = $(this).parent()
        var kids = parent.children();
        var inputId = kids[3].getAttribute('id');


        if (idButton == 'plus') {
            kids[3].value = parseInt(kids[3].value) + 1;
        }

        if (idButton == 'minus') {
            if (parseInt(kids[3].value) > 0) {
                kids[3].value = parseInt(kids[3].value) - 1;
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
                        } else {
                            kids[3].value = parseInt(response.stock);
                        }
                    }
                });
            }
        }
    })
})

//Requete AJAX pour voir le stock xml seulement pour l'admin
$(document).ready(function(){
    $("#button_admin").click(function(e){
        e.preventDefault();

        var idProd=$(this).attr("value");

        if(this.className == 'display_stock'){
            $.ajax({
                type: "get",
                url: "php/admin_stock_produit.php",
                dataType: "json",
                data: {"id":idProd},
                success: function (response) {
                        $("#button_admin").html(response.git);
                        $("#button_admin").removeClass("display_stock");
                        $("#button_admin").addClass("display_name");
                    
                }
            });
        }
        if(this.className == "display_name"){
            $("#button_admin").html("Veuillez appuyer pour connaitre le stock")
            $("#button_admin").removeClass("display_name");
            $("#button_admin").addClass("display_stock");
        }
    })
})