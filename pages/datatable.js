var type_form = <?php echo $json_type_form; ?>;
console.log(type_form)
$(document).ready( function () {
    var dataTable = $('#Table_Offre').DataTable({
      columnDefs: [
                              {targets: -1 }
                            ],
      responsive: true
      ,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search..."
    }
    });
    
    
    //dataTable.columns(1).search('ALTEN').draw();

    $('#Table_Offre tfoot tr th').each(function () {
    var title = $('#Table_Offre thead tr th').eq($(this).index()).text();
    if(title != "")
    {
      switch (title) {
        case 'N':
          switch (type_form) {
            case 1 :
              $(this).html('<select  id="table-filter1" class="form-select select" ><option value="">Choix de N</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select>');
              break;
            case 2 :
              $(this).html('<select  id="table-filter1" class="form-select select" ><option value="">Choix de N</option><option value="1">1</option><option value="2">2</option></select>');
              break;
          }
          break;
        case 'Statu':
          $(this).html('<select  id="table-filter1" class="form-select select" ><option value="">Choix de STATU</option><option value="Nouveau">Nouveau</option><option value="Closed">Closed</option><option value="Completée">Completée</option></select>');
          break;
        default:
        $(this).html('<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" placeholder="Search ' + title + '" />');
          break;
      }
      
      
    }

    });

    console.log($('thead tr th').length)

    
      
      // dataTable.column(0).every( function () {
      //   var dataTableColumn = this;
      //   //console.log(dataTableColumn);
      //   $('#search_filter').on('keyup change', function () {
      //       // console.log(this.value);
      //         dataTableColumn.search(this.value).draw();
      //     });
      // })

      
      
    

    dataTable.columns().every(function () {
        var dataTableColumn = this;

        $(this.footer()).find('select').on('change', function () {
            dataTableColumn.search(this.value).draw();
        });

        $(this.footer()).find('input').on('keyup change', function () {
            dataTableColumn.search(this.value).draw();
        });

        

    });

    
    $('.dataTables_filter').addClass('rounded search_custom');
    
    }
    )