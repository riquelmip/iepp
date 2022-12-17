let tablePrivilegios;
let rowTable = "";
let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

    tablePrivilegios = $('#tablePrivilegios').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Privilegios/getPrivilegios",
            "dataSrc":""
        },
        "columns":[
            {"data":"idprivilegio"},
            {"data":"fecha"},
            {"data":"usuario"},
            {"data":"estado"},
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
    if (document.querySelector("#formPrivilegios")) {
        
    

    let formPrivilegios = document.querySelector("#formPrivilegios");
        formPrivilegios.onsubmit = function(e) {
            e.preventDefault();
            //console.log("jjjjjj");
            let selectrol = document.querySelector('#listRolid').value;
            let diasemana = document.querySelector('#listDiaS').value;
            let dateFecha = document.querySelector('#txtFecha').value;
            let strInicio = document.querySelector('#txtInicio').value;
            let strAlabanzas = document.querySelector('#txtAlabanzas').value;
            let strCorosav = document.querySelector('#txtCorosav').value;
            let strPresentacion = document.querySelector('#txtPresentacion').value;
            let strOfrenda = document.querySelector('#txtOfrenda').value;
            let strTalento = document.querySelector('#txtTalento').value;
            let strAlabanzaespecial = document.querySelector('#txtAlabanzaespecial').value;
            let strCorosad = document.querySelector('#txtCorosad').value;
            let strMensaje = document.querySelector('#txtMensaje').value;
            let strAseo = document.querySelector('#txtAseo').value;
           

            if(strInicio == '' || strAlabanzas == '' || strCorosav == '' || strPresentacion == '' || strOfrenda == '' || strTalento == '' || strAlabanzaespecial == '' || strCorosad == '' || strMensaje == '' || strAseo == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
         
            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) { 
                if(elementsValid[i].classList.contains('is-invalid')) { 
                    swal("Atención", "Por favor verifique los campos en rojo." , "error");
                    return false;
                } 
            } 
            

    
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Privilegios/setPrivilegios'; 
            let formData = new FormData(formPrivilegios);
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
                            tablePrivilegios.api().ajax.reload();
                        }else{
                            //si estamos actualizando un registro, entonces simularemos que pondremos todos los datos en esa fila, pero sin recargar la tabla
                            var objFecha = new Date(dateFecha);
                            var dia  = objFecha.getDate()+1;
                            var mes  = objFecha.getMonth();
                            var anio = objFecha.getFullYear();
                            let meses=["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];
                            rowTable.cells[1].textContent=dia + " de " + meses[(mes)] + " de " + anio;
                            rowTable="";
                        }
                        $('#modalformPrivilegios').modal("hide");
                        formPrivilegios.reset();
                        swal("Cancionero De Alabanzas", objData.msg ,"success");
                        
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
    document.querySelector('#idPrivilegios').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevos Privilegios";
    document.querySelector("#formPrivilegios").reset();

    let idusuario =  document.querySelector("#idUsuario").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Privilegios/getDatosUser/'+idusuario;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            console.log(request.responseText);
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                let urlS = "";
                if(objData.data.idrol == 1){
                    urlS = base_url+'/Privilegios/getSelectRoles';
                }else{
                    urlS = base_url+'/Privilegios/getSelectRol/'+objData.data.idrol;
                }
                let ajaxUrl = urlS;
                let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                request.open("GET",ajaxUrl,true);
                request.send();

                request.onreadystatechange = function(){
                    if(request.readyState == 4 && request.status == 200){
                        document.querySelector('#listRolid').innerHTML = request.responseText;
                        document.querySelector('#listRolid').value = objData.data.idrol;
                        
                        //$('#listRolid').selectpicker('render');
                    }
                }
               
               
            }
        }
    
        $('#modalformPrivilegios').modal('show');
    }
    //$('#modalformPrivilegios').modal('show');
}




function fntRolesUsuario(idrol){
if (document.querySelector('#listRolid')) {
    
    let idusuario =  document.querySelector("#idUsuario").value;
    let urlS = "";
    if(idrol == 1){
        urlS = base_url+'/Privilegios/getSelectRoles';
    }else{
        urlS = base_url+'/Privilegios/getSelectRol/'+idrol;
    }
    let ajaxUrl = urlS;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#listRolid').innerHTML = request.responseText;
            document.querySelector('#listRolid').value = idrol;
            
            
        }
    }
}
   
}


function fntViewPrivilegios(id){
    //let idpersona = idpersona;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Privilegios/getPrivilegio/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
            let meses=["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ];
           // let d = new Date(objData.data.fecha);
           // let dia=d.getDate()+1;
            //let mes= d.getMonth();
           // //let anio=d.getFullYear();
            let fecha_formateada=objData.data.dia+' de '+meses[(objData.data.mes)-1] + ' de ' + objData.data.anio;
            let options = { year:'numeric', month: 'long', day: 'numeric'};
                document.querySelector("#titleModalVC").innerHTML = "Privilegios: " + objData.data.diasemana + " " + fecha_formateada;
                document.querySelector("#celInicio").innerHTML = objData.data.inicio;
                document.querySelector("#celAlabanzas").innerHTML = objData.data.alabanzas;
                document.querySelector("#celCorosav").innerHTML = objData.data.avivamiento;
                document.querySelector("#celPresentacion").innerHTML = objData.data.presentacion;
                document.querySelector("#celOfrenda").innerHTML = objData.data.ofrenda;
                document.querySelector("#celTalento").innerHTML = objData.data.talento;
                document.querySelector("#celAlabanzaespecial").innerHTML = objData.data.alabanzaespecial;
                document.querySelector("#celCorosad").innerHTML = objData.data.adoracion;
                document.querySelector("#celMensaje").innerHTML = objData.data.mensaje;
                document.querySelector("#celAseo").innerHTML = objData.data.aseo;
                
                $('#modalViewPrivilegios').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}

function fntEditPrivilegios(element, id){
    rowTable=element.parentNode.parentNode.parentNode;//dirigiendose al elemento padre, 3 elementos padre para dirgirse a la fila
    //rowTable.cells[1].textContent="julio";
    console.log(rowTable);
    document.querySelector('#titleModal').innerHTML ="Actualizar Privilegios";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    //let idpersona =idpersona;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Privilegios/getPrivilegio/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            console.log(request.responseText);
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                let iddiasemana=0;
                if(objData.data.diasemana == "Domingo"){
                    iddiasemana = 1;
                } else if(objData.data.diasemana == "Lunes"){
                    iddiasemana = 2;
                }else if(objData.data.diasemana == "Martes"){
                    iddiasemana = 3;
                }else if(objData.data.diasemana == "Miércoles"){
                    iddiasemana = 4;
                }else if(objData.data.diasemana == "Jueves"){
                    iddiasemana = 5;
                }else if(objData.data.diasemana == "Viernes"){
                    iddiasemana = 6;
                }else if(objData.data.diasemana == "Sábado"){
                    iddiasemana = 7;
                }

               let diaa = "";
                if(objData.data.dia < 9){
                    diaa = "0"+objData.data.dia;
                }else{
                    diaa = objData.data.dia;
                }
                let mess = "";
                if(objData.data.mes < 9){
                    mess = "0"+objData.data.mes;
                }else{
                    mess = objData.data.mes;
                }
                let fec = objData.data.anio + "-" + mess + "-" + diaa;
               
                console.log(fec);
                document.querySelector("#idPrivilegios").value = objData.data.idprivilegio;
                document.querySelector('#listDiaS').value = iddiasemana;
                document.querySelector("#txtFecha").value = fec;
                document.querySelector("#txtInicio").value = objData.data.inicio;
                document.querySelector("#txtAlabanzas").value = objData.data.alabanzas;
                document.querySelector("#txtCorosav").value = objData.data.avivamiento;
                document.querySelector("#txtPresentacion").value = objData.data.presentacion;
                document.querySelector("#txtOfrenda").value = objData.data.ofrenda;
                document.querySelector("#txtTalento").value = objData.data.talento;
                document.querySelector("#txtAlabanzaespecial").value = objData.data.alabanzaespecial;
                document.querySelector("#txtCorosad").value = objData.data.adoracion;
                document.querySelector("#txtMensaje").value = objData.data.mensaje;
                document.querySelector("#txtAseo").value = objData.data.aseo;
               
               fntRolesUsuario(objData.data.idrol);
            }
        }
    
        $('#modalformPrivilegios').modal('show');
    }
}

function fntDelPrivilegios(id){

    swal({
        title: "Eliminar Privilegios",
        text: "¿Realmente quiere eliminar los Privilegios?",
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
            let ajaxUrl = base_url+'/Privilegios/delPrivilegio';
            let strData = "idPrivilegio="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tablePrivilegios.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

    

}

function fntActivarPrivilegios(id, idrol){

    swal({
        title: "Activar Privilegios",
        text: "¿Realmente quiere activar estos Privilegios?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, activar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Privilegios/activarPrivilegio/'+idrol;
            let strData = "idPrivilegio="+id;
            
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Activar!", objData.msg , "success");
                        tablePrivilegios.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });

    

}
