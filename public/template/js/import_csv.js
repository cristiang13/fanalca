/*$.extend( true, $.fn.dataTable.defaults, {
    "ordering": false
} );*/

$(document).ready(function(){

  $("#content").load("/progviaje table");


});



$(document).ready(function(){
 $('#table_progViaje, #table_inventario').DataTable( {
     "order": [[ 0, "desc" ]],
     "language": {
         "lengthMenu": "Mostrar _MENU_ registros por página",
         "zeroRecords": "No se encontro nada - lo siento",
         "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
         "infoEmpty": "No hay registros disponibles",
         "emptyTable":"Ningún dato disponible en esta tabla",
         "search":"Buscar:",
         "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
        },
         "infoFiltered": "(filtered from _MAX_ total records)"
     }
 } );

});


$(document).ready(function(){
  $('#table_cupo').dataTable( {
    "order": [[ 0, "desc" ]],
       "language": {
          "decimal": ",",
          "thousands": ".",
          "lengthMenu": "Mostrar _MENU_ registros por página",
          "zeroRecords": "No se encontro nada - lo siento",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "No hay registros disponibles",
          "emptyTable":"Ningún dato disponible en esta tabla",
          "search":"Buscar:",
          "paginate": {
         "first":      "Primero",
         "last":       "Último",
         "next":       "Siguiente",
         "previous":   "Anterior"
         },
          "infoFiltered": "(filtered from _MAX_ total records)"
        }
      } );

});
// para ocultar columnas de la tabla
$(document).ready(function() {
    var table = $('#example').DataTable( {

      "columnDefs": [
            {
                "targets": [ 2 ],
                "visible": false,

            },
            {
                "targets": [ 3 ],
                "visible": false
            },
            {
                "targets": [ 8],
                "visible": false
            }
        ],

         "order": [[ 1, "asc" ]],

         "language": {
             "lengthMenu": "Mostrar _MENU_ registros por página",
             "zeroRecords": "No se encontro nada - lo siento",
             "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
             "infoEmpty": "No hay registros disponibles",
             "emptyTable":"Ningún dato disponible en esta tabla",
             "search":"Buscar:",
             "paginate": {
            "first":      "Primero",
            "last":       "Último",
            "next":       "Siguiente",
            "previous":   "Anterior"
            },
             "infoFiltered": "(filtered from _MAX_ total records)"
         }





    } );

} );



// para enlazar input del form editar de la tabla detpedidos
$(document).ready(function(e){

  $("input[name$='cant_prog']").keyup(function() {

     var value = $( this ).val();
     var id=$(this).attr('clave');
     var aux_clave_cost='cost_proga'+id;
     var aux_clave_precio='precio'+id;
     var precio=$('#'+aux_clave_precio+'').val();
     var inputs=$( ":input" ).serialize();

    /* jQuery.each( inputs, function( i, val ) {
        //$('input[name=cant_prog]').val('')

             alert(i+"/"+val.name+"/"+val.value);});
       var precio= $("#precio").val();*/
       //alert(inputs);

       $("#"+aux_clave_cost+"").val(value*precio);


   })
   .keyup();

e.preventDefault();
});



//selecciona el formulario del metodo detpedidos.actualizar

$(document).on("submit",".form_entrada",function(e){

//funcion para atrapar los formularios y enviar los datos
  //var table = $('#form').DataTable();
      e.preventDefault();
       var formu= $(this);
     var inputs=$( ":input" );


    //  var cantidad= $('input[name=cant_prog]').val();

        var varurl='actualizar';
        var divresul="notificacion_resul_update";



        // var cantidad= $('input[name=cant_prog]').val('');



    //   $("#"+divresul+"").html($("#cargador_empresa").html());

        $.ajax({

                   type: "POST",
                   url : varurl,

                   data : formu.serialize(),
                   //datatype:'json',
                   success : function(d){

                     var x=typeof d.msg;
                     var id=d.articulo_id;
                     $("#"+id+"").text(d.msg);
                     $("#content").load("/progviaje table");


                     if (x==='number') {
                       $.smkAlert({
                         text: 'Programación exitosa, quedan  '+d.msg+' und. disponibles.',
                         type: 'success',

                       });



                     }else {
                       $.smkAlert({
                         text: d.msg,
                         type: 'danger',
                         position:'top-center',
                         icon: 'glyphicon-time',
                         permanent: true
                       });

                        $('input[name=cant_prog]').val('');
                     }


                 },
                   error: function(data){
                      alert("no se pueden ingresar los datos") ;

                   }

               });




});



// para subir el archivo excel
  $(document).on("submit",".formarchivo",function(e){


        e.preventDefault();
        var formu=$(this);
        var nombreform=$(this).attr("id");

        //if(nombreform=="f_subir_imagen" ){ var miurl="subir_imagen_usuario";  var divresul="notificacion_resul_fci"}
        if(nombreform=="cargar_file_dispo" ){ var miurl="cargar_file_dispo";  var divresul="notificacion_resul_fcdu"}

        //información del formulario
       var formData = new FormData($("#"+nombreform+"")[0]);

        //hacemos la petición ajax
        $.ajax({
            url: miurl,
           type: 'POST',

            // Form data
            //datos del formulario
           data: formData,
        //    //necesario para subir archivos via ajax
           cache: false,
          contentType: false,
         processData: false,
            //mientras enviamos el archivo
						beforeSend: function(){
               $("#"+divresul+"").html($("#cargador_empresa").html());
             },
             //una vez finalizado correctamente
             success: function(data){
               $("#"+divresul+"").html(data);//.fadeOut(1500);
               document.getElementById("carga_archivo").value = "";

             },
            //si ha ocurrido un error
            error: function(data){
               alert("ha ocurrido un error") ;

            }
        });
    });
  // para crear filas hijas.
		/* Formatting function for row details - modify as you need */

function format ( d ) {
    // `d` is the original data object for the row
    return '<table class="display" style="padding-left:50px;">'+
        '<tr "border: none">'+
            '<td style=>Cantidad pedida:</td>'+
            '<td style="border: none">'+d[2]+'</td>'+
            '<td>desc_Cantidad pendiente:</td>'+
            '<td>'+d[3]+'</td>'+
        '</tr>'+
        '<tr>'+
        '<td>disponibilidad real:</td>'+
        '<td>'+d[8]+'</td>'+
        '</tr>'+
    '</table>';
}

$(document).ready(function($datos) {


    var table = $('#example').DataTable();
  //  var row = table.row( tr );

    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

} );


function formato ( d ) {
    // `d` is the original data object for the row
    return '<table class="display" style="padding-left:50px;">'+
        '<tr "border: none">'+
            '<td style=>Cantidad pedida:</td>'+
            '<td style="border: none">'+d[5]+'</td>'+
            '<td>Cantidad pendiente:</td>'+
            '<td>'+d[6]+'</td>'+
        '</tr>'+
        '<tr>'+
    '</table>';
}

$(document).ready(function($datos){

  var table = $('#table_programacion').DataTable({
    "columnDefs": [
          {
              "targets": [ 5 ],
              "visible": false
          },
          {
              "targets": [ 6 ],
              "visible": false

          }
      ]
  });
  // Add event listener for opening and closing details
  $('#table_programacion tbody').on('click', 'td.details-control', function () {
      var tr = $(this).closest('tr');
      var row = table.row(tr);

      if ( row.child.isShown() ) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
      }
      else {
          // Open this row
          row.child( formato(row.data()) ).show();
          tr.addClass('shown');
      }
  } );


});
