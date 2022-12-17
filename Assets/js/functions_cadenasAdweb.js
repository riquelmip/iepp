let tableIndiceCadenasAd;
//let rowTable = "";
//let divLoading = document.querySelector('#divLoading');
document.addEventListener('DOMContentLoaded', function(){

    tableIndiceCadenasAd = $('#tableIndiceCadenasAd').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Cadenasweb/getCadenasAd",
            "dataSrc":""
        },
        "columns":[
            {"data":"idcadena"},
            {"data":"link"}
        ],
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"asc"]]  
    });

}, false);
