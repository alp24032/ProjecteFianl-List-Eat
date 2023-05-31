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


function editID(id){
    var x = document.getElementById(id).id;
    console.log(x);

    var idEdit = document.getElementById('idEdit');
    idEdit.value = x;

    var name = document.getElementById('name_'+x).innerHTML;
    var nameEdit = document.getElementById('nameProdEdit');
    nameEdit.value = name;

    var type = document.getElementById('type_'+x).getAttribute('data_value');
    document.getElementById('typeProdEdit').value = type;

    var buyDate = document.getElementById('compra_'+x).innerHTML;
    var buyDateEdit = document.getElementById('buyDateEdit');
    buyDateEdit.value = buyDate;

    var expDate = document.getElementById('caducitat_'+x).innerHTML;
    var expDateEdit = document.getElementById('expDateEdit');
    expDateEdit.value = expDate;

    var place = document.getElementById('place_'+x).getAttribute('data_value');
    document.getElementById('placeEdit').value = place;

    var opneOrNot = document.getElementById('obert_'+x).innerHTML;
    // var opneOrNotAttr = document.getElementById('obert_'+x).getAttribute('data_value');
    var opneOrNotEdit = document.getElementById('opneOrNotEdit');
    console.log(opneOrNot);
    if(opneOrNot == 'SI'){
        opneOrNotEdit.checked = true;
        // opneOrNotAttr = '1';
    }else if(opneOrNot == 'NO'){
        opneOrNotEdit.checked = false;
        // opneOrNotAttr = '0';
    }

    var cal = document.getElementById('cal_'+x).getAttribute('data_value');
    var calEdit = document.getElementById('calEdit');
    calEdit.value = cal;

    var unit = document.getElementById('unit_'+x).innerHTML;
    var unitsEdit = document.getElementById('unitsEdit');
    unitsEdit.value = unit;
}

function editProdFood(){
    $.ajax({
        url: "../landingPage/editProduct.php",
        type: 'POST',
        data: $( "#editProdForm" ).serialize(),      
        success: function(response){
            console.log(`ajax res:`, response);
            if(response!=""){
                $("#name_"+response).text($("#nameProdEdit").val());

                $("#compra_"+response).text($("#buyDateEdit").val());

                $("#caducitat_"+response).text($("#expDateEdit").val());

                $("#type_"+response).attr("data_value", $("#typeProdEdit").val());
                $("#type_"+response).text($("#typeProdEdit").val());
                
                if($('#opneOrNotEdit')[0].checked){
                    $("#obert_"+response).text("SI");
                } else {
                    $("#obert_"+response).text("NO");
                }
                // console.log('>>>>', $('#opneOrNotEdit').checked, $('#opneOrNotEdit')[0].checked);
                $("#place_"+response).attr("data_value", $("#placeEdit").val());
                $("#place_"+response).text($("#placeEdit").val());

                $("#cal_"+response).attr("data_value", $("#calEdit").val());
                $("#cal_"+response).text($("#calEdit").val()+"kcal / 100g");

                $("#unit_"+response).text($("#unitsEdit").val());

                hideEditProduct();
                Swal.fire({
                    icon: 'success',
                    title: 'Product Updated',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }else{
                alert('error')
            };
        },
    });
}

function getProdInfo(id){
    var listID = document.getElementById(id).id;
    var name = document.getElementById('nameProdList_'+listID).value;
    $.ajax({
        url: "../ShoppingList/shoppingList.php",
        type: 'POST',
        data: $( "#formID_"+listID ).serialize(),      
        success: function(response){
            if(response!=""){
                Swal.fire({
                    icon: 'success',
                    title: `<b>${name}</b> has been added to Favorites`,
                    showConfirmButton: false,
                    timer: 2000
                  })
                // console.log(response);
            }else{
                alert('error');
                // console.log(response);
            };
        }     
    });
}

function deleteProd(id){
    var listID = document.getElementById(id).id;

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      });

      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your product has been deleted.',
            'success'
          )

            $.ajax({
                url: "../landingPage/deleteProduct.php",
                type: 'POST',
                data: $( "#deleteID_"+listID ).serialize(),      
                success: function(response){
                    if(response!=""){
                        $( "#"+listID ).remove();
                    }else{
                        alert('error');
                    };
                }     
            });

        } else if (
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your product is safe :)',
            'error'
          )
        }
      })
}

function sendEditInfo(){
    let value = $( "#newPlace").serialize().split('=')[1];

    $.ajax({
        url: "../landingPage/addPlace.php",
        type: 'POST',
        data: $( "#newPlace" ).serialize(),      
        success: function(response){
            if(response == ""){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })
                  
                  Toast.fire({
                    icon: 'success',
                    title: 'New Place Added'
                  })
                $("#placeEdit").append(`<option value="${value}">${value}</option>`);
                $("#place").append(`<option value="${value}">${value}</option>`);
                hideAddPlace();
            }else{
                alert('error');
            };
        }     
    });
}