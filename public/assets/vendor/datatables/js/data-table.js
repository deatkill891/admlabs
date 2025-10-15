jQuery(document).ready(function ($) {
  'use strict'

  // Inicializar DataTable 'first' solo una vez
  if ($('table.first').length && !$.fn.DataTable.isDataTable('table.first')) {
    $('table.first').DataTable()
  }

  // Inicializar DataTable 'second' solo si no está inicializada
  if ($('table.second').length && !$.fn.DataTable.isDataTable('table.second')) {
    var tableKey = 'datatable_colvis_second'
    var savedVisibility = localStorage.getItem(tableKey)
    var colVis = savedVisibility ? JSON.parse(savedVisibility) : null

    var table = $('table.second').DataTable({
      lengthChange: false,
      dom: 'Bfrtip',
      buttons: [
        'copy',
        'excel',
        {
          extend: 'pdfHtml5',
          orientation: 'landscape',
          pageSize: 'A4',
          title: 'Cumplimiento Quimico ADM Calidad Central',
          exportOptions: { columns: ':visible' },
        },
        {
          extend: 'print',
          orientation: 'landscape',
          title: 'Cumplimiento_Quimico',
          customize: function (win) {
            $(win.document.body).css('font-size', '10pt')
            $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit')
          },
        },
        { extend: 'colvis', text: 'Columnas visibles' },
      ],
      columnDefs: colVis
        ? colVis.map(function (visible, index) {
            return { targets: index, visible: visible }
          })
        : [],
    })

    table.on('column-visibility.dt', function () {
      var visibility = []
      table.columns().every(function () {
        visibility.push(this.visible())
      })
      localStorage.setItem(tableKey, JSON.stringify(visibility))
    })

    // Mover los botones solo si no existen aún
    var container = $('#example_wrapper .col-md-6:eq(0) .dt-buttons')
    if (container.length === 0) {
      table.buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)')
    }
  }

  // Función genérica para actualizar DataTable con AJAX sin duplicar botones
  function actualizarTabla(targetTbody, tableSelector) {
    var idMaterial = $('#IdMaterial').val()
    if (!idMaterial) {
      $(targetTbody).html('')
      return
    }

    $.ajax({
      url: '../php/con-filtro-materiales-all.php',
      method: 'POST',
      data: { IdMaterial: idMaterial },
      success: function (response) {
        // Destruir DataTable si ya existía
        if ($.fn.DataTable.isDataTable(tableSelector)) {
          $(tableSelector).DataTable().destroy()
        }

        // Reemplazar contenido
        var newTable = $('<table>').html(response)
        $(tableSelector + ' thead').html(newTable.find('thead').html())
        $(targetTbody).html(newTable.find('tbody').html())

        // Inicializar DataTable solo si aún no existe
        if (!$.fn.DataTable.isDataTable(tableSelector)) {
          $(tableSelector)
            .DataTable({
              lengthChange: false,
              dom: 'Bfrtip',
              buttons: ['copy', 'excel', 'print'],
            })
            .buttons()
            .container()
            .appendTo($(tableSelector + '_wrapper .col-md-6:eq(0)'))
        }
      },
      error: function (xhr, status, error) {
        console.error('Error en la solicitud AJAX:', status, error)
      },
    })
  }

  // Evento único para #IdMaterial
  $('#IdMaterial').off('change').on('change', function () {
    actualizarTabla('#table-body', '#example')
    actualizarTabla('#table-body-2', '#example-2')
  })
})
