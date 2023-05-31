 //funcoó per obrir un desplegable
 function toogleMenu(){
    let toggleBtn = document.getElementById("toggler");
    let navToggleBtn = document.getElementById("navbarToggler");

    if(toggleBtn.ariaExpanded == "false"){
        toggleBtn.className = "navbar-toggler bg-light";
        toggleBtn.ariaExpanded = "true";
        navToggleBtn.className = "navbar-collapse collapse show";
    }
    else if(toggleBtn.ariaExpanded == "true"){
        toggleBtn.className = "navbar-toggler collapsed bg-light";
        toggleBtn.ariaExpanded = "false";
        navToggleBtn.className = "navbar-collapse collapse";
    }
}

//funció per mostrar o amagar un fromulari
function hideShowForm(){
    let form = document.getElementById('formNewPassw');

    if(form.hidden == true){
        form.hidden = false;
    }else{
        form.hidden = true;
    }
}
 //funció per mostrar o amagar la contrasenya
function hideShowPassw(){
    let showPassw = document.getElementById('showPassw');
    let eyeIcon = document.getElementById('eye_ShowPassw');

    if(showPassw.type == "password"){
        showPassw.type = "text";
        eyeIcon.innerHTML = "<i class='bi bi-eye'></i>";
    }else{
        showPassw.type = "password";
        eyeIcon.innerHTML = "<i class='bi bi-eye-slash'></i>";
    }
}
//funció per mostrar o amagar la nova contrasenya
function hideShowNewPassw(){
    let newPassw = document.getElementById('newPassw');
    let eyeNewIcon = document.getElementById('eye_ShowNewPassw');

    if(newPassw.type == "password"){
        newPassw.type = "text";
        eyeNewIcon.innerHTML = "<i class='bi bi-eye'></i>";
    }else{
        newPassw.type = "password";
        eyeNewIcon.innerHTML = "<i class='bi bi-eye-slash fa-lg'></i>";
    }
}
//funció per mostrar o amagar la contrasenya de confirmació
function hideShowNewOkPassw(){
    let newOkPassw = document.getElementById('okNewPassw');
    let eyeNewOkIcon = document.getElementById('eye_ShowNewOkPassw');

    if(newOkPassw.type == "password"){
        newOkPassw.type = "text";
        eyeNewOkIcon.innerHTML = "<i class='bi bi-eye fa-lg'></i>";
    }else{
        newOkPassw.type = "password";
        eyeNewOkIcon.innerHTML = "<i class='bi bi-eye-slash fa-lg'></i>";
    }
}
//funció per generar una contrasenya random segura
function randomNewPassw(){
    let newPassw = document.getElementById('newPassw');
    let okNewPassw = document.getElementById('okNewPassw');
    var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()-_ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var passwordLength = 10;
    var password = "";
    for (var i = 0; i <= passwordLength; i++) {
        var randomNumber = Math.floor(Math.random() * chars.length);
        password += chars.substring(randomNumber, randomNumber +1);
    }
    newPassw.value = password;
    okNewPassw.value = password;

}


