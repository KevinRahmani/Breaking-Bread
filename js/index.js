/* SLIDER 1 */

let img_slider = document.getElementsByClassName('img_slider');
let etape = 0;
let nbr_img = img_slider.length;
let precedent = document.querySelector('.precedent');
let suivant = document.querySelector('.suivant');

function EnleverClassActive() {
    for (let i = 0; i < nbr_img; i++) {
        img_slider[i].classList.remove('active');
    }
}

//Passe à la seconde image
suivant.addEventListener("click", function () {
    etape++;
    if (etape >= nbr_img) {
        etape = 0;
    }
    EnleverClassActive();
    img_slider[etape].classList.add("active");
})

//Reviens à l'image d'avant
precedent.addEventListener('click', function () {
    etape--;
    if (etape < 0) {
        etape = nbr_img - 1;
    }
    EnleverClassActive();
    img_slider[etape].classList.add('active');
})

// change d'image automatiquement avec un interval
setInterval(function () {
    etape++;
    if (etape >= nbr_img) {
        etape = 0;
    }
    EnleverClassActive();
    img_slider[etape].classList.add("active");
}, 5000)

//ainsi de suite pour les autres sliders
/* SLIDER 2 */
let img_slider2 = document.getElementsByClassName('img_slider2');
let etape2 = 0;
let nbr_img2 = img_slider2.length;
let precedent2 = document.querySelector('.precedent2');
let suivant2 = document.querySelector('.suivant2');

function EnleverClassActive2() {
    for (let i = 0; i < nbr_img2; i++) {
        img_slider2[i].classList.remove('active2');
    }
}

suivant2.addEventListener("click", function () {
    etape2++;
    if (etape2 >= nbr_img2) {
        etape2 = 0;
    }
    EnleverClassActive2();
    img_slider2[etape2].classList.add("active2");
})

precedent2.addEventListener('click', function () {
    etape2--;
    if (etape2 < 0) {
        etape2 = nbr_img2 - 1;
    }
    EnleverClassActive2();
    img_slider2[etape2].classList.add('active2');
})

setInterval(function () {
    etape2++;
    if (etape2 >= nbr_img2) {
        etape2 = 0;
    }
    EnleverClassActive2();
    img_slider2[etape2].classList.add("active2");
}, 6000)


/* SLIDER 3 */
let img_slider3 = document.getElementsByClassName('img_slider3');
let etape3 = 0;
let nbr_img3 = img_slider3.length;
let precedent3 = document.querySelector('.precedent3');
let suivant3 = document.querySelector('.suivant3');

function EnleverClassActive3() {
    for (let i = 0; i < nbr_img3; i++) {
        img_slider3[i].classList.remove('active3');
    }
}

suivant3.addEventListener("click", function () {
    etape3++;
    if (etape3 >= nbr_img3) {
        etape3 = 0;
    }
    EnleverClassActive3();
    img_slider3[etape3].classList.add("active3");
})

precedent3.addEventListener('click', function () {
    etape3--;
    if (etape3 < 0) {
        etape3 = nbr_img3 - 1;
    }
    EnleverClassActive3();
    img_slider3[etape3].classList.add('active3');
})

setInterval(function () {
    etape3++;
    if (etape3 >= nbr_img3) {
        etape3 = 0;
    }
    EnleverClassActive3();
    img_slider3[etape3].classList.add("active3");
}, 4000)