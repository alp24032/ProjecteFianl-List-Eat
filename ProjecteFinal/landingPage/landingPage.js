let navFilter = document.getElementById('navFilter');
let ulFilter = document.getElementById('ulFilter');

let hide = document.getElementsByName('hide');

//variable per accedir a un element de bootstarp
let formProduct = new bootstrap.Modal(document.getElementById('formProduct'));
//funcio que quan és cridada mostra el popUp(modal)
function showAddProduct(){
    formProduct.show();
}
//funcio que quan és cridada amaga el popUp(modal)
function hideAddProduct(){
    formProduct.hide();
}

//variable per accedir a un element de bootstarp
let formEdit = new bootstrap.Modal(document.getElementById('formEdit'));
//funcio que quan és cridada mostra el popUp(modal)
function showEditProduct(){
    formEdit.show();
}
//funcio que quan és cridada amaga ael popUp(modal)
function hideEditProduct(){
    formEdit.hide();
}

//funció per capturar l'id d'una etiqueta específica per poder activar el popUp(modal)
function modalID(id){
    let x = id;
    let modal = new bootstrap.Modal(document.getElementById('modalCaducity_'+x));

    showCaducity(modal);

}
//funcio que quan és cridada mostr ael popUp(modal)
function showCaducity(modal){
    modal.show();
}

//funcio que quan és cridada mostra el popUp(ul) dels filtres
function filterToggle(){
    if(navFilter.ariaExpanded == 'false'){
        navFilter.className = 'av-link dropdown-toggle show';
        navFilter.ariaExpanded = 'true';
        ulFilter.className = 'dropdown-menu show';
    }else{
        navFilter.className = 'av-link dropdown-toggle';
        navFilter.ariaExpanded = 'false';
        ulFilter.className = 'dropdown-menu';
    }
}

//funcio que quan és cridada amaga o mostra tots els productes
function hideProduct(){
    console.log(hide);

    hide.forEach(element => {
        if(element.hidden == true){
            element.hidden = false;
        } else{
            element.hidden = true;
        }
    });
}

//variable per accedir a un element de bootstarp
let formPlace = new bootstrap.Modal(document.getElementById('formPlace'));
//funcio que quan és cridada mostra el popUp(modal)
function showAddPlace(){
    formPlace.show();
}
//funcio que quan és cridada amaga el popUp(modal)
function hideAddPlace(){
    formPlace.hide();
}

let createPlaceInput = document.getElementById('createPlace');
//funció per evitar que es pugui enviar el camp Place buit 
function noEmptyPlace(){
    if(createPlaceInput.value.length == 0){
        placeMessage.hidden = false;
        placeMessage.innerHTML = "*Enter a Place";
        createPlaceInput.className = "form-control border border-danger";
        console.log(createPlaceInput.value.length);


    }else{
        placeMessage.hidden = true;
        createPlaceInput.className = "form-control";
        console.log(createPlaceInput.value.length);

    }

    if(placeMessage.hidden == false){
        return false;
    } else{
        return true;
    }
}