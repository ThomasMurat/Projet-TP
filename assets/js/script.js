pageResize();
function pageResize() {
    var screenHeight = window.innerHeight;
    var screenWidth = window.innerWidth;
    var headerHeight = document.getElementById('menu').clientHeight;
    var content = document.getElementsByClassName('content')[0];
    content.style.minHeight = screenHeight - (headerHeight + 100) + 'px';


    if(screenHeight > screenWidth) {
        if(document.getElementById('MUwelcomeImage')){
            document.getElementById('MUwelcomeImage').src = '/assets/img/MU/fondPortrait.png';
        }else{
            document.getElementById('AUwelcomeImage').src = '/assets/img/AU/fondPortrait.jpg';
        }   
    }else {
        if(document.getElementById('MUwelcomeImage')) {
            document.getElementById('MUwelcomeImage').src = '/assets/img/MU/fond.png';
        }else{
            document.getElementById('AUwelcomeImage').src = '/assets/img/AU/fond.jpg';
        }   
    }
}
