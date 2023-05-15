let userN_up = document.getElementById('userN_up');
let email_up = document.getElementById('email_up');
let passw_up = document.getElementById('passw_up');
let okPassw_up = document.getElementById('okPassw_up');

//funció que comprova el resultat de les altres funcions per enviar les dades o no
function validate(){
    validateEmail();
    confirmPassw();
    noEmptyInput();
    if(confirmPassw() == false || noEmptyInput() == false || validateEmail() == false){
        return false;
    }else if(confirmPassw() == true && noEmptyInput() == true && validateEmail() == true){
        return true;
    }
}
//funció per validar si el email introduit te el format adequat
function validateEmail(){
    let pattern = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

    if(pattern.test(email_up.value)){
        email_upMesage.hidden = true;
        email_up.className = "form-control";
        return true;
    } else{
        email_upMesage.hidden = false;
        email_up.style.backgroundColor = "#FFA08D";
        email_upMesage.innerHTML = "*Enter a valid E-Mail";
        email_up.className = "form-control border border-danger";
        return false;
    }
}

//funció que comprova si la password  i la password de confirmació son iguals
function confirmPassw(){
    let message1 = document.getElementById('okPassw_upMesage');
    let confirm = false;
    if(passw_up.value == okPassw_up.value){
        confirm = true;
        message1.hidden = true;
        okPassw_up.className = "form-control";
        return confirm;
    }else{
        confirm = false;
        message1.hidden = false;
        passw_up.style.backgroundColor = "#FFA08D";
        message1.innerHTML = "*Confirm Password and Password do not match";
        okPassw_up.className = "form-control border border-danger";
        return confirm;
    }
}

//funció per mostrar/ocultar el contingut de l'input password
function hideShowPassw(){
    let eyeIcon = document.getElementById('eye_upPassw');

    if(passw_up.type == "password"){
        passw_up.type = "text";
        eyeIcon.className = "bi bi-eye fa-lg";
    }else{
        passw_up.type = "password";
        eyeIcon.className = "bi bi-eye-slash fa-lg";
    }
}

//funció per fer visible el contingut de l'input confirm password
function hideShowOkPassw(){
    let eyeIconOk = document.getElementById('eye_upOkPassw');

    if(okPassw_up.type == "password"){
        okPassw_up.type = "text";
        eyeIconOk.className = "bi bi-eye fa-lg";
    }else{
        okPassw_up.type = "password";
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
    passw_up.value = password;
    okPassw_up.value = password;

 }

//function per comprovar que no hi hagi cap camp buit
function noEmptyInput(){
    let user_upMesage = document.getElementById('user_upMesage');
    let passw_upMesage = document.getElementById('passw_upMesage');

    if(userN_up.value.length == 0){
        user_upMesage.hidden = false;
        user_upMesage.innerHTML = "*Enter a Username";
        userN_up.className = "form-control border border-danger";
        userN_up.style.backgroundColor = "#FFA08D";
    }else {
        user_upMesage.hidden = true;
        userN_up.className = "form-control";
    }

    if(email_up.value.length == 0){
        email_upMesage.hidden = false;
        email_upMesage.innerHTML = "*Enter a E-Mail";
        email_up.className = "form-control border border-danger";
        email_up.style.backgroundColor = "#FFA08D";
    }else {
        email_upMesage.hidden = true;
        email_up.className = "form-control";
    }

    if(passw_up.value.length == 0){
        passw_upMesage.hidden = false;
        passw_upMesage.innerHTML = "*Enter a Password";
        passw_up.className = "form-control border border-danger";
        passw_up.style.backgroundColor = "#FFA08D";
    }else {
        passw_upMesage.hidden = true;
        passw_up.className = "form-control";
    }
    
    if(user_upMesage.hidden == false || email_upMesage.hidden == false || passw_upMesage.hidden == false){
        return false;
    } else if(user_upMesage.hidden == true && email_upMesage.hidden == true && passw_upMesage.hidden == true){
        return true;
    }
}

//funció per validar si la password es segura o no
function strengthPassw(){

    if(passw_up.value.length <= 6){
        
            passw_upMesage.hidden = false;
            passw_upMesage.innerHTML = "Weak";
            passw_upMesage.className = "text-center text-danger h6 rounded-pill";
            passw_up.style.backgroundColor = "#FFA08D";
        

    } else if(passw_up.value.length <= 8){
        // if(regex1.test(passw_up.value) && regex2.test(passw_up.value) && regex3.test(passw_up.value)){
            passw_upMesage.hidden = false;
            passw_upMesage.innerHTML = "Medium";
            passw_upMesage.className = "text-center text-warning h6 rounded-pill";
            passw_up.style.backgroundColor = "#FFED8D";
        // }

    } else if(passw_up.value.length <= 10){
        // if(regex1.test(passw_up.value) && regex2.test(passw_up.value) && regex3.test(passw_up.value) && regex4.test(passw_up.value)){
            passw_upMesage.hidden = false;
            passw_upMesage.innerHTML = "Strong";
            passw_upMesage.className = "text-center text-success h6 rounded-pill";
            passw_up.style.backgroundColor = "#B3FF8D";
        }
    // }
}

