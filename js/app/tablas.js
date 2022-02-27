$(document).ready(function() {

	$.extend( $.fn.dataTable.defaults, {
		"language": {
			"sProcessing":    "Procesando...",
			"sLengthMenu":    "Mostrar _MENU_ registros",
			"sZeroRecords":   "No se encontraron registros",
			"sEmptyTable":    "No se encontraron registros",
			"sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":   "",
			"sSearch":        "Buscar:",
			"sUrl":           "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":    "Último",
				"sNext":    "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});

	$.fn.dataTable.Responsive.defaults.details.renderer.tableClass = "table";

	if($("#tabla_productos").length) {
		$("#tabla_productos").DataTable({
			responsive: {
			    details: {

			        display: $.fn.dataTable.Responsive.display.modal({
			            header: function ( row ) {
			                var data = row.data();
			                return 'Detalles de ' + data[1];
			            }
			        }),

			        renderer: function ( api, rowIdx, columns ) {

			          var data = $.map( columns, function ( col, i ) {
			              return col.columnIndex != 0 ?
			                  '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
			                      '<td>'+col.title+':'+'</td> '+
			                      '<td>'+col.data+'</td>'+
			                  '</tr>' :
			                  '';
			          }).join('');

			          return data ?
			              $('<table class="table"/>').append( data ) :
			              false;
			         }
			    }
			},
			order: [ 1, 'asc' ],
		});
	}

	if($("#tabla_proveedores").length) {
		$("#tabla_proveedores").DataTable({
			responsive: {
			    details: {

			        display: $.fn.dataTable.Responsive.display.modal({
			            header: function ( row ) {
			                var data = row.data();
			                return 'Detalles de ' + data[1];
			            }
			        }),

			        renderer: function ( api, rowIdx, columns ) {

			          var data = $.map( columns, function ( col, i ) {
			              return col.columnIndex != 0 ?
			                  '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
			                      '<td>'+col.title+':'+'</td> '+
			                      '<td>'+col.data+'</td>'+
			                  '</tr>' :
			                  '';
			          }).join('');

			          return data ?
			              $('<table class="table"/>').append( data ) :
			              false;
			         }
			    }
			},
			order: [ 1, 'asc' ],
		});
	}

	if($("#tabla_usuarios").length) {
		$("#tabla_usuarios").DataTable({
			responsive: {
			    details: {

			        display: $.fn.dataTable.Responsive.display.modal({
			            header: function ( row ) {
			                var data = row.data();
			                return 'Detalles de ' + data[1];
			            }
			        }),

			        renderer: function ( api, rowIdx, columns ) {

			          var data = $.map( columns, function ( col, i ) {
			              return col.columnIndex != 0 ?
			                  '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
			                      '<td>'+col.title+':'+'</td> '+
			                      '<td>'+col.data+'</td>'+
			                  '</tr>' :
			                  '';
			          }).join('');

			          return data ?
			              $('<table class="table"/>').append( data ) :
			              false;
			         }
			    }
			},
			order: [ 1, 'asc' ],
		});
	}
			
});