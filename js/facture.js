//renvoie vers le panier si la validation est annulé
$(document).ready(function () {
    $("#annuler").click(function (e) {
        e.preventDefault();

        window.location.href = 'panier.php';
    })
})

//envoie le mail de confirmation de commande si validé 
$(document).ready(function () {
    $("#envoyer").click(function (e) {
        e.preventDefault();
        function index(){
            window.location.href = 'index.php';
        }

        $.ajax({
            type: "GET",
            url: "php/envoyerMail.php",
            dataType: "json",
            success: function (response) {
                if (response.succes == 'ok') {
                    $(".message_info").html("Votre facture vous a été envoyé par mail, vous allez être redirigé vers la page d'accueil.Merci pour votre commande");
                    setTimeout(index, 4000);
                }
            }
        });
    })
})