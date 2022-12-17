
//TEXT AREA PLUGIN
$(document).on('focusin', function(e) {
    if ($(e.target).closest(".tox-dialog").length) {
        e.stopImmediatePropagation();
    }
});

tinymce.init({
	selector: '#txtCoroAd',
	width: "100%",
    height: 400,    
    statubar: true,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "sAde table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
});

////

let tableCorosAd;
let rowTable = "";
let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

    tableCorosAd = $('#tableCorosAd').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Coros/getCorosAd",
            "dataSrc":""
        },
        "columns":[
            {"data":"idcoro"},
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

    //NUEVO 
    if (document.querySelector("#formCoroAd")) {
        
    

    let formCoroAd = document.querySelector("#formCoroAd");
        formCoroAd.onsubmit = function(e) {
            e.preventDefault();
            let strNombre = document.querySelector('#txtNombre').value;


            if(strNombre == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
            tinyMCE.triggerSave();//guardar lo que hay en el editor guardarlo en el txtcoro

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) { 
                if(elementsValid[i].classList.contains('is-invalid')) { 
                    swal("Atención", "Por fAdor verifique los campos en rojo." , "error");
                    return false;
                } 
            } 

    
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Coros/setCoroAd/2';  //el primer 1 es de estado =1 es decir, Adivamiento
            let formData = new FormData(formCoroAd);
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
                            tableCorosAd.api().ajax.reload();
                        }else{
                            //si estamos actualizando un registro, entonces simularemos que pondremos todos los datos en esa fila, pero sin recargar la tabla
                          
                            rowTable.cells[1].textContent=strNombre;
                            rowTable="";
                        }
                        $('#modalFormCoroAd').modal("hide");
                        formCoroAd.reset();
                        swal("Coros de Adoracion", objData.msg ,"success");
                        
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


function openModalAd()
{
    rowTable="";
    document.querySelector('#idCoro').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Coro";
    document.querySelector("#formCoroAd").reset();
    $('#modalFormCoroAd').modal('show');
}


function fntViewCoroAd(idcoro){
    //let idpersona = idpersona;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Coros/getCoro/'+idcoro;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#titleModalV").innerHTML = "<div class='text-center'><b>"+objData.data.nombre+"</b></div>";
                document.querySelector("#modalViewBody").innerHTML = "<div class='text-center'>"+objData.data.coro+"</div>";
                
                $('#modalViewCoroAd').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function fntEditCoroAd(element, idcoro){
    rowTable=element.parentNode.parentNode.parentNode;//dirigiendose al elemento padre, 3 elementos padre para dirgirse a la fila
    //rowTable.cells[1].textContent="julio";
    console.log(rowTable);
    document.querySelector('#titleModal').innerHTML ="Actualizar Coro";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    //let idpersona =idpersona;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Coros/getCoro/'+idcoro;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            console.log(request.responseText);
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#idCoro").value = objData.data.idcoro;
                document.querySelector("#txtNombre").value = objData.data.nombre;
                tinyMCE.activeEditor.setContent(objData.data.coro);
                
            }
        }
    
        $('#modalFormCoroAd').modal('show');
    }
}

function fntDelCoroAd(idcoro){

    swal({
        title: "Eliminar Coro de Adivamiento",
        text: "¿Realmente quiere eliminar el coro?",
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
            let ajaxUrl = base_url+'/Coros/delCoro';
            let strData = "idCoro="+idcoro;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableCorosAd.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

}