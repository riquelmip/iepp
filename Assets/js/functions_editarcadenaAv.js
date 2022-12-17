


var arrayIdCoros = [];
let tableDetallesCadenasAv;
let rowTable = "";
let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

    let idCadena = document.querySelector("#idCadena").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Cadenas/getCadena/'+idCadena;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            console.log(request.responseText);
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
               
                document.querySelector("#txtNombre").value = objData.data[0].nombrecadena;
                for (var i = 0; i < objData.data.length; i++) {
                    $("#divDetalles").append(

                        '<div class="row" style="padding:5px 15px">'+
                
                            '<!-- Descripción del coro -->'+
                            
                            '<div class="col-md-12" style="padding-right:0px">'+
                            
                            '<div class="input-group">'+
                                
                                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarCoro" idCoro="'+objData.data[i].idcoro+'"><i class="fa fa-times"></i></button></span>'+
                
                                '<input type="text" class="form-control nuevaDescripcionCoro" idCoro="'+objData.data[i].idcoro+'" name="agregarCoro" value="'+objData.data[i].nombrecoro+'" readonly required>'+
                
                            '</div>'+
                
                            '</div>'+
                
                        '</div>')

                         //agregamos el id del coro al array detalles
                       // arrayIdCoros.push(objData.data.idcoro);
                        
                       arrayIdCoros.push({ "id" : objData.data[i].idcoro, 
                       "coro" :objData.data[i].coro})
                        //revisamos si se inserto
                        console.log(arrayIdCoros);
                  }
                
            }
        }
    }

    tableDetallesCadenasAv = $('#tableDetallesCadenaAv').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Cadenas/getCorosAv",
            "dataSrc":""
        },
        "columns":[
            {"data":"idcoro"},
            {"data":"nombre"},
            {"data":"options"}
        ]
    });

    

    //NUEVO 
    if (document.querySelector("#formCadenaAv")) {
        
    

    let formCadenaAv = document.querySelector("#formCadenaAv");
        formCadenaAv.onsubmit = function(e) {
            e.preventDefault();
            //agrego al campo oculto un json de todos los coros que se gregaran a la cadena
            $("#listaCoros").val(JSON.stringify(arrayIdCoros)); 
            let strNombre = document.querySelector('#txtNombre').value;
        
            if(strNombre == '' || arrayIdCoros.length==0)
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
            let ajaxUrl = base_url+'/Cadenas/editCadenaAv/1';  //el primer 1 es de estado =1 es decir, activo
            let formData = new FormData(formCadenaAv);
            //formData.append("arrayCoros",arrayIdCoros);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){

                if(request.readyState == 4 && request.status == 200){
                    console.log(request.responseText);
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        formCadenaAv.reset();
                        //swal("Cadenas de Coros", objData.msg ,"success");
                        swal({
                            title: 'Cadenas de Coros',
                            text: objData.msg,
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok!'
                          }, 
                          function(){
                               window.location.href = base_url+"/Cadenas/CadenasAv";
                          });
                       
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



function fntAddCoroAv(idcoro){

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/Cadenas/getCoro/'+idcoro;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            console.log(request.responseText);
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                if(arrayIdCoros.length === 0){
                    $("#divDetalles").append(

                        '<div class="row" style="padding:5px 15px">'+
                
                            '<!-- Descripción del coro -->'+
                            
                            '<div class="col-md-12" style="padding-right:0px">'+
                            
                            '<div class="input-group">'+
                                
                                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarCoro" idCoro="'+objData.data.idcoro+'"><i class="fa fa-times"></i></button></span>'+
                
                                '<input type="text" class="form-control nuevaDescripcionCoro" idCoro="'+objData.data.idcoro+'" name="agregarCoro" value="'+objData.data.nombre+'" readonly required>'+
                
                            '</div>'+
                
                            '</div>'+
                
                        '</div>')
                        
                       //agregamos el id del coro al array detalles
                       // arrayIdCoros.push(objData.data.idcoro);
                        
                        arrayIdCoros.push({ "id" : objData.data.idcoro, 
                                        "coro" :objData.data.coro})
                        //revisamos si se inserto
                        console.log(arrayIdCoros);
                }else{

                    var existe=0;
                    for (var i = 0; i < arrayIdCoros.length; i++) {
                        if (arrayIdCoros[i].id == objData.data.idcoro) {
                            swal({
                                title: "Ese coro ya esta añadido!",
                                type: "error",
                                confirmButtonText: "¡Cerrar!"
                              });
                              existe=1;
                          break;
                        }
                      }

                    if(existe==0){ //si el coro ya existe en el array
                        $("#divDetalles").append(
    
                            '<div class="row" style="padding:5px 15px">'+
                    
                                '<!-- Descripción del coro -->'+
                                
                                '<div class="col-md-12" style="padding-right:0px">'+
                                
                                '<div class="input-group">'+
                                    
                                    '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarCoro" idCoro="'+objData.data.idcoro+'"><i class="fa fa-times"></i></button></span>'+
                    
                                    '<input type="text" class="form-control nuevaDescripcionCoro" idCoro="'+objData.data.idcoro+'" name="agregarCoro" value="'+objData.data.nombre+'" readonly required>'+
                    
                                '</div>'+
                    
                                '</div>'+
                    
                            '</div>')
                            
                        //agregamos el id del coro al array detalles
                        //arrayIdCoros.push(objData.data.idcoro);
                        arrayIdCoros.push({ "id" : objData.data.idcoro, 
                        "coro" :objData.data.coro})
                        //revisamos si se inserto
                        console.log(arrayIdCoros);
                    }
                }     
            }
        }
    }

}


/*=============================================
QUITAR CORO DE LA CADENA 
=============================================*/

$("#formCadenaAv").on("click", "button.quitarCoro", function(){
    var idCoro = $(this).attr("idCoro");
	$(this).parent().parent().parent().parent().remove();

    //buscamos ese idcoro en el array
    //var index = arrayIdCoros.idcoro.indexOf(idCoro);
	//quitamos ese coro del array detalles
   // if (index > -1) {
    //    arrayIdCoros.splice(index, 1);
    //}
    

    for (var i = 0; i < arrayIdCoros.length; i++) {
        if (arrayIdCoros[i].id == idCoro) {
          arrayIdCoros.splice(i, 1);
          break;
        }
      }
      console.log(arrayIdCoros);

})







