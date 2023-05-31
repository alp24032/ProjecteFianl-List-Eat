let navFilter = document.getElementById('navFilter');
let ulFilter = document.getElementById('ulFilter');

let hide = document.getElementsByName('hide');

//variable per accedir a un element de bootstarp
let formList = new bootstrap.Modal(document.getElementById('formList'));
//funcio que quan és cridada mostra el popUp(modal)
function showAddList(){
    formList.show();
}
//funcio que quan és cridada amaga el popUp(modal)
function hideAddList(){
    formList.hide();
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

let formProduct = new bootstrap.Modal(document.getElementById('formProduct'));
//funcio que quan és cridada mostra el popUp(modal)
function showAddProduct(){
    formProduct.show();
}
//funcio que quan és cridada amaga el popUp(modal)
function hideAddProduct(){
    formProduct.hide();
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


function addProd(id){
    var x = document.getElementById(id).id;
    console.log(x);

    var name = document.getElementById('name_'+x).innerHTML;
    console.log(name);
    var nameAdd = document.getElementById('nameProd');
    console.log(nameAdd);
    nameAdd.value = name;

    var type = document.getElementById('type_'+x).getAttribute('data_value');
    document.getElementById('typeProd').value = type;

    var place = document.getElementById('place_'+x).getAttribute('data_value');
    document.getElementById('place').value = place;

    var cal = document.getElementById('cal_'+x).getAttribute('data_value');
    var calAdd = document.getElementById('cal');
    calAdd.value = cal;

}

function addNewProdList(){
    let name = document.getElementById("nameProdList").value;
    let type = document.getElementById("typeProdList").value;
    let place = document.getElementById("placeList").value;
    let cal = document.getElementById("calList").value;

    $.ajax({
        url: "../ShoppingList/addProductList.php",
        type: 'POST',
        data: $( "#addProductList" ).serialize(),      
        success: function(response){
            if(response!=""){
                hideAddList();
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  
                $("#mainBody").append(`
                    <div id='${response}' class='container d-flex justify-content-center align-items-center list-group-item' style='padding-block: 5px;' >   
                    <div id='goodNote'>
                        <div>
                            <h1 id='name_${response}'  class='d-flex justify-content-center flex-wrap'>${name}</h1>
                            <div name='hide'>
                                <hr>
                                <div class='d-flex'>
                                    <b class='infoProd'>- Type Product:</b>
                                    <p id='type_${response}' class='badge bg-light text-wrap fs-5 text-dark' data_value='${type}'>${type}</p>
                                </div> 
                                <div class='d-flex'>
                                    <b class='infoProd'>- Calories:</b>
                                    <p id='cal_${response}' class='badge bg-light text-wrap fs-5 text-dark' data_value='${cal}'>${cal} kcal / 100g</p>
                                </div>
                                <div class='d-flex'>
                                    <b class='infoProd'>- Place:</b>
                                    <p id='place_${response}' class='badge bg-light text-wrap fs-5 text-dark' data_value='${place}'>${place}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <nav class='d-flex flex-row justify-content-around'>
                            <div onclick='editID(${response})'>
                                <button id='editProduct' type='submit' class='btn btn-outline-primary px-2' onclick='showEditProduct()'>Edit</button>
                            </div>
                            <div onclick='showAddProduct()'>
                                <button id='editProduct' type='submit' class='btn btn-outline-secondary px-2' onclick='addProd(${response})'>Food List</button>
                            </div>
                            <form id='deleteID_${response}' onsubmit='deleteProd(${response}); return false'>
                                <input id='deleteProdList' name='deleteProdList' type='hidden' value='${response}'>
                                <input type='submit' class='btn btn-outline-danger px-2' value='Delete'>
                            </form>
                        </nav>               
                    </div>
                </div>
                `);

            }else{
                alert('error');
            };
        },

    });
}

function addProdFood(){
    $.ajax({
        url: "../landingPage/postProducts.php",
        type: 'POST',
        data: $( "#setProduct" ).serialize(),      
        success: function(response){
            if(response!=""){
                let nom = $("#nameProd").val();
                console.log(nom);
                hideAddProduct();
                Swal.fire({
                    icon: 'success',
                    title: `Your product <b>${nom}</b> has been added to food list`,
                    showConfirmButton: false,
                    timer: 2000
                  })
            }else{
                alert('error1');
            };
        },

    });
}

function editID(id){
    var x = document.getElementById(id).id;
    console.log(x);

    var idEdit = document.getElementById('idEditList');
    idEdit.value = x;

    var name = document.getElementById('name_'+x).innerHTML;
    var nameEdit = document.getElementById('nameListEdit');
    nameEdit.value = name;

    var type = document.getElementById('type_'+x).getAttribute('data_value');
    document.getElementById('typeListEdit').value = type;

    var place = document.getElementById('place_'+x).getAttribute('data_value');
    document.getElementById('placeListEdit').value = place;

    var cal = document.getElementById('cal_'+x).getAttribute('data_value');
    var calEdit = document.getElementById('calListEdit');
    calEdit.value = cal;

}

function editProdList(){
    $.ajax({
        url: "../ShoppingList/editList.php",
        type: 'POST',
        data: $( "#editListForm" ).serialize(),      
        success: function(response){
            console.log(`ajax res:`, response);
            if(response!=""){
                $("#name_"+response).text($("#nameListEdit").val());

                $("#type_"+response).attr("data_value", $("#typeListEdit").val());
                $("#type_"+response).text($("#typeListEdit").val());

                $("#place_"+response).attr("data_value", $("#placeListEdit").val());
                $("#place_"+response).text($("#placeListEdit").val());

                $("#cal_"+response).attr("data_value", $("#calListEdit").val());
                $("#cal_"+response).text($("#calListEdit").val()+"kcal / 100g");

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

function deleteProd(id){
    var deleteID = document.getElementById(id).id;
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
            url: "../ShoppingList/deleteList.php",
            type: 'POST',
            data: $( "#deleteID_"+deleteID ).serialize(),      
            success: function(response){
                if(response!=""){
                    $( "#"+deleteID ).remove();
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
            console.log(response);
            console.log(typeof(response));
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
                });
                $("#placeListEdit").append(`<option value="${value}">${value}</option>`);
                $("#placeList").append(`<option value="${value}">${value}</option>`);
                hideAddPlace();

            }
            else{
                alert('error2');
                hideAddPlace();

            };
        }     
    });
}
