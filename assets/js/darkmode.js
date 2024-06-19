var dark_icon = document.getElementById("icon-dark-mode");
var light_icon = document.getElementById("icon-light-mode");

var dark_iconmobile = document.getElementById("icon-dark-mode-mobile");
var light_iconmobile = document.getElementById("icon-light-mode-mobile");


//DARK MODE//
dark_icon.onclick = function() {
    document.body.classList.toggle("dark-theme")
    localStorage.setItem("dark-theme", 1);
   
}

//DARK MODE//
dark_iconmobile.onclick = function() {
    document.body.classList.toggle("dark-theme")
    localStorage.setItem("dark-theme", 1);
   
}



//LIGHT MODE//
light_icon.onclick = function() {
document.body.classList.remove('dark-theme')
localStorage.removeItem("dark-theme")
}

//LIGHT MODE//
light_iconmobile.onclick = function() {
    document.body.classList.remove('dark-theme')
    localStorage.removeItem("dark-theme")
    }
    



loadTheme();



// carregar preferencia do usuario//


function loadTheme(){
    const darkMode = localStorage.getItem("dark-theme")
    if(darkMode) {
        dark_icon.onclick();
}
}


