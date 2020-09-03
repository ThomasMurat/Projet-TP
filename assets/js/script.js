//Function permettant de fixer la taille minimal de la div content de sorte que le contenue remplisse toujour la page
pageResize();
function pageResize() {
    var screenHeight = window.innerHeight;
    var headerHeight = document.getElementById('menu').clientHeight;
    var footerHeight = document.getElementById('footer').clientHeight;
    var content = document.getElementsByClassName('content')[0];
    content.style.minHeight = screenHeight - (headerHeight + 100) + 'px';
    content.style.marginTop = headerHeight + 'px';
}

//Function permettant de modifier les sources des images de fond de page d'accueil celon si l'affichage est de type portrait ou paysage
function welcomeAdapt(){
    var screenHeight = window.innerHeight;
    var screenWidth = window.innerWidth;
    if(screenHeight > screenWidth) {
        if(document.getElementById('mangaWelcomeImage')){
            document.getElementById('mangaWelcomeImage').src = '/assets/img/manga/fondPortrait.jpg';
        }else{
            document.getElementById('animeWelcomeImage').src = '/assets/img/anime/fondPortrait.jpg';
        }   
    }else {
        if(document.getElementById('mangaWelcomeImage')) {
            document.getElementById('mangaWelcomeImage').src = '/assets/img/manga/fond.jpg';
        }else{
            document.getElementById('animeWelcomeImage').src = '/assets/img/anime/fond.jpg';
        }   
    }
}

//Function gérant la connection et le message de retour dans la fenêtre modal de connexion
function sendLogin(){
    var xhttp = new XMLHttpRequest();
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('loginContent').innerHTML = this.responseText;
       }
    };
    xhttp.open('POST', 'controllers/indexController.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('login=&username=' + username + '&password=' + password); 
}

//Function permettant la fermeture et l'ouverture du menu d'administration
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $('#sidebarContent').toggleClass('fixed-top');
    });
});

//Function permettant de placer le contenue du menu admin pour qu'il ne soit pas cacher dérrière la barre de nav principale
follow();
function follow(){
    var headerHeight = document.getElementById('menu').clientHeight;
    document.getElementById('sidebarContent').style.marginTop = headerHeight + 'px';
}

function checkFieldValidity(input){
    //Instanciation de l'objet XMLHttpRequest permettant de faire de l'AJAX
    var request = new XMLHttpRequest();
    //Les données sont envoyés en POST et c'est le controlleur qui va les traiter
    request.open('POST', 'controllers/subscribController.php', true);
    //Au changement d'état de la demande d'AJAX
    request.onreadystatechange = function () {
        //Si on a bien fini de recevoir la réponse de PHP (4) et que le code retour HTTP est ok (200)
        if (request.readyState == 4 && request.status == 200) {
            document.getElementById(input.name + 'Error').innerHTML = this.responseText;
            if(this.responseText == ''){
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            };
        }      
    }
    // Pour dire au serveur qu'il y a des données en POST à lire dans le corps
    request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    //Les données envoyées en POST. Elles sont séparées par un &
    request.send('postSubscribe=&field='+ input.name + '&' + input.name + '=' + input.value);
}