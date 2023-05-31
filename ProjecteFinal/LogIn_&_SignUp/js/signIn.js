let userN_in = document.getElementById('userN_in');
let passw_in = document.getElementById('passw_in');

//funció que comprova el resultat de les altres funcions per enviar les dades o no
function validate(){
    noEmptyInput();
    isEmail();
    if(noEmptyInput() == false){
        return false;
    } else{
        return true;
    }

}

//funció per validar si el email introduit te el format adequat
function isEmail(){
    let pattern = /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;

    if(pattern.test(userN_in.value)){
        userN_in.name = 'email_in';
    } else{
        userN_in.name = 'userN_in';
    }
}
//funció per mostrar/ocultar el contingut de l'input password
function hideShowPassw(){
    let eyeIcon = document.getElementById('eye_inPassw');

    if(passw_in.type == "password"){
        passw_in.type = "text";
        eyeIcon.className = "bi bi-eye fa-lg";
    }else{
        passw_in.type = "password";
        eyeIcon.className = "bi bi-eye-slash fa-lg";
    }
}

//function per comprovar que no hi hagi cap camp buit
function noEmptyInput(){
    let user_inMesage = document.getElementById('user_inMesage');
    let passw_inMesage = document.getElementById('passw_inMesage');

    if(userN_in.value.length == 0){
        user_inMesage.hidden = false;
        user_inMesage.innerHTML = "*Enter a Username";
        userN_in.className = "form-control border border-danger";
    }else {
        user_inMesage.hidden = true;
        userN_in.className = "form-control";
    }	

    if(passw_in.value.length == 0){
        passw_inMesage.hidden = false;
        passw_inMesage.innerHTML = "*Enter a Password";
        passw_in.className = "form-control border border-danger";
    }else {
        passw_inMesage.hidden = true;
        passw_in.className = "form-control";
    }	

    if(user_inMesage.hidden == false || passw_inMesage.hidden == false){
        return false;
    } else if(user_inMesage.hidden == true && passw_inMesage.hidden == true){
        return true;
    }

}

