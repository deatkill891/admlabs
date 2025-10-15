jQuery(document).ready(function($) {
    'use strict';

    // DataTable para tabla con clase 'first'
    if ($("table.first").length) {
        $('table.first').DataTable();
    }

    // DataTable para tabla con clase 'second' (con botones de exportación)
    if ($("table.second").length) {
        var table = $('table.second').DataTable({
            lengthChange: false,
            buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');
    }

    // DataTable para tabla con id 'example2' (con agrupamiento)
    if ($("#example2").length) {
        var groupColumn = 2;
        var table = $('#example2').DataTable({
            columnDefs: [
                { visible: false, targets: groupColumn }
            ],
            order: [
                [groupColumn, 'asc']
            ],
            displayLength: 25,
            drawCallback: function(settings) {
                var api = this.api();
                var rows = api.rows({ page: 'current' }).nodes();
                var last = null;

                api.column(groupColumn, { page: 'current' }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                            '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                        );

                        last = group;
                    }
                });
            }
        });

        // Ordenar por el grupo al hacer clic en una fila de grupo
        $('#example2 tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                table.order([groupColumn, 'desc']).draw();
            } else {
                table.order([groupColumn, 'asc']).draw();
            }
        });
    }

    // DataTable con selección múltiple para tabla con id 'example3'
    if ($("#example3").length) {
        $('#example3').DataTable({
            select: {
                style: 'multi'
            }
        });
    }

    // DataTable con encabezado fijo para tabla con id 'example4'
    if ($("#example4").length) {
        $('#example4').DataTable({
            fixedHeader: true
        });
    }

    // Función para manejar la carga dinámica de datos por cambio en #IdMaterial
    $('#IdMaterial').change(function() {
        var idMaterial = $(this).val();

        if (idMaterial) {
            $.ajax({
                url: '../php/con-filtro-materiales.php',
                method: 'POST',
                data: { IdMaterial: idMaterial },
                success: function(response) {
                    // Destruir y reconfigurar DataTables con los nuevos datos recibidos
                    $('#example').DataTable().destroy();
                    var newTable = $('<table>').html(response);
                    $('#example thead').html(newTable.find('thead').html());
                    $('#table-body').html(newTable.find('tbody').html());

                    // Inicializar DataTables después de actualizar los datos
                    $('#example').DataTable({
                        lengthChange: false,
                        buttons: ['copy', 'excel', 'pdf', 'print']
                    }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', status, error);
                }
            });
        } else {
            $('#table-body').html('');
        }
    });


});
