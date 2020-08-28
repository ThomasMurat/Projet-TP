pageResize();
function pageResize() {
    var screenHeight = window.innerHeight;
    var headerHeight = document.getElementById('menu').clientHeight;
    var footerHeight = document.getElementById('footer').clientHeight;
    var content = document.getElementsByClassName('content')[0];
    content.style.minHeight = screenHeight - (headerHeight + 100) + 'px';
    content.style.marginTop = headerHeight + 'px';
}
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
//teste pour la modal de connexion
function sendLogin(){
    var xhttp = new XMLHttpRequest();
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('loginContent').innerHTML = this.responseText;
       }
    };
    xhttp.open('POST', '../../controllers/indexController.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('login=&username=' + username + '&password=' + password); 
}
