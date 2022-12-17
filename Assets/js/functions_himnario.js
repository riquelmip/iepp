
//TEXT AREA PLUGIN
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

tinymce.init({
	selector: '#txtAlabanza',
	width: "100%",
    height: 400,    
    statubar: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});

////

let tableHimnario;
let rowTable = "";
let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

    tableHimnario = $('#tableHimnario').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Himnario/getHimnario",
            "dataSrc":""
        },
        "columns":[
            {"data":"idalabanza"},
            {"data":"numhimnario"},
            {"data":"nombre"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr":"Copiar",
                "className": "btn btn-secondary"
            },{
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr":"Exportar a Excel",
                "className": "btn btn-success"
            },{
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr":"Exportar a PDF",
                "className": "btn btn-danger"
            },{
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr":"Exportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });

    //NUEVO USUARIO
    if (document.querySelector("#formHimnario")) {
        
    

    let formHimnario = document.querySelector("#formHimnario");
        formHimnario.onsubmit = function(e) {
            e.preventDefault();
            let numHimnario = document.querySelector('#txtNumhimnario').value;
            let strNombre = document.querySelector('#txtNombre').value;
           // let strAlabanza = document.querySelector('#txtAlabanza').value;

            if(numHimnario == '' || strNombre == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
           tinyMCE.triggerSave();//guardar lo que hay en el editor guardarlo en el txtalabanza

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) { 
                if(elementsValid[i].classList.contains('is-invalid')) { 
                    swal("Atención", "Por favor verifique los campos en rojo." , "error");
                    return false;
                } 
            } 

    
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Himnario/setHimnario'; 
            let formData = new FormData(formHimnario);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){

                if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText);
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        //si la fila esta vacia o no existe, es porque estamos creando nuevo registro
                        if (rowTable == "") {
                            //entonces vamos a actualizar la tabla
                            tableHimnario.api().ajax.reload();
                        }else{
                            //si estamos actualizando un registro, entonces simularemos que pondremos todos los datos en esa fila, pero sin recargar la tabla
                          
                            rowTable.cells[1].textContent=numHimnario;
                            rowTable.cells[2].textContent=strNombre;
                            rowTable="";
                        }
                        $('#modalFormHimnario').modal("hide");
                        formHimnario.reset();
                        swal("Himnario De Alabanzas", objData.msg ,"success");
                        
                    }else{
                        swal("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }

        }
    }

}, false);


function openModal()
{
    rowTable="";
    document.querySelector('#idAlabanza').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nueva Alabanza";
    document.querySelector("#formHimnario").reset();
    $('#modalFormHimnario').modal('show');
}
function fntViewHimnario(idalabanza){
    //let idpersona = idpersona;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Himnario/getAlabanza/'+idalabanza;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#titleModalV").innerHTML = "<div class='text-center'><b>"+objData.data.nombre+"</b></div>";
                document.querySelector("#modalViewBody").innerHTML = "<div class='text-center'>"+objData.data.alabanza+"</div>";
                
                $('#modalViewHimnario').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function fntEditHimnario(element, idalabanza){
    rowTable=element.parentNode.parentNode.parentNode;//dirigiendose al elemento padre, 3 elementos padre para dirgirse a la fila
    //rowTable.cells[1].textContent="julio";
    console.log(rowTable);
    document.querySelector('#titleModal').innerHTML ="Actualizar Alabanza";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    //let idpersona =idpersona;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Himnario/getAlabanza/'+idalabanza;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            console.log(request.responseText);
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#idAlabanza").value = objData.data.idalabanza;
                document.querySelector("#txtNumhimnario").value = objData.data.numhimnario;
                document.querySelector("#txtNombre").value = objData.data.nombre;
               // document.querySelector("#txtAlabanza").value = objData.data.alabanza;
                tinyMCE.activeEditor.setContent(objData.data.alabanza);
            }
        }
    
        $('#modalFormHimnario').modal('show');
    }
}

function fntDelHimnario(idalabanza){

    swal({
        title: "Eliminar Alabanza",
        text: "¿Realmente quiere eliminar la Alabanza?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Himnario/delAlabanza';
            let strData = "idAlabanza="+idalabanza;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableHimnario.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}