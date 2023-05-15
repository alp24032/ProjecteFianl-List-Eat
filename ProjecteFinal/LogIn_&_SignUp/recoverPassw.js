let recoverPassw = document.getElementById('recoverPassw');
let recoverPasswConf = document.getElementById('recoverPasswConf');


//funció que comprova el resultat de les altres funcions per enviar les dades o no
function validate(){
    confirmPassw();
    noEmptyInput();
    if(confirmPassw() == false || noEmptyInput() == false){
        return false;
    }else if(confirmPassw() == true && noEmptyInput() == true){
        return true;
    }
}

//funció que comprova si la password  i la password de confirmació son iguals
function confirmPassw(){
    let message1 = document.getElementById('recoverPasswOk_upMesage');
    let confirm = false;
    if(recoverPassw.value == okrecoverPassw.value){
        confirm = true;
        message1.hidden = true;
        recoverPasswConf.className = "form-control";
        return confirm;
    }else{
        confirm = false;
        message1.hidden = false;
        recoverPassw.style.backgroundColor = "#FFA08D";
        message1.innerHTML = "*Confirm Password and Password do not match";
        recoverPasswConf.className = "form-control border border-danger";
        return confirm;
    }
}

//funció per mostrar/ocultar el contingut de l'input password
function hideShowPassw(){
    let eyeIcon = document.getElementById('eye_upPassw');

    if(recoverPassw.type == "password"){
        recoverPassw.type = "text";
        eyeIcon.className = "bi bi-eye fa-lg";
    }else{
        recoverPassw.type = "password";
        eyeIcon.className = "bi bi-eye-slash fa-lg";
    }
}

//funció per fer visible el contingut de l'input confirm password
function hideShowOkPassw(){
    let eyeIconOk = document.getElementById('eye_upOkPassw');

    if(recoverPasswConf.type == "password"){
        recoverPasswConf.type = "text";
        eyeIconOk.className = "bi bi-eye fa-lg";
    }else{
        recoverPasswConf.type = "password";
        eyeIconOk.className = "bi bi-eye-slash fa-lg";
    }
}

//funció per generar una password segura a l'input password
function randomPassw(){
    var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()-_ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var passwordLength = 10;
    var password = "";
    for (var i = 0; i <= passwordLength; i++) {
        var randomNumber = Math.floor(Math.random() * chars.length);
        password += chars.substring(randomNumber, randomNumber +1);
    }
    recoverPassw.value = password;
    recoverPasswConf.value = password;

 }

//function per comprovar que no hi hagi cap camp buit
function noEmptyInput(){
    let recoverPasswMesage = document.getElementById('recoverPasswMesage');

    if(recoverPassw.value.length == 0){
        recoverPasswMesage.hidden = false;
        recoverPasswMesage.innerHTML = "*Enter a Password";
        recoverPassw.className = "form-control border border-danger";
        recoverPassw.style.backgroundColor = "#FFA08D";
    }else {
        recoverPasswMesage.hidden = true;
        recoverPassw.className = "form-control";
    }
    
    if(recoverPasswMesage.hidden == false){
        return false;
    } else if(recoverPasswMesage.hidden == true){
        return true;
    }
}