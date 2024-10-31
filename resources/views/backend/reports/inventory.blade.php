@extends('backend.master')

@section('title', 'Inventory Report')

@section('content')
<div class="card">
  <div class="card-body p-2 p-md-4 pt-0">
    <div class="row g-4">
      <div class="col-md-12">
        <div class="card-body table-responsive p-0" id="table_data">
          <table id="datatables" class="table table-hover">
            <thead>
              <tr>
                <th data-orderable="false">#</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Stock</th>
              </tr>
            </thead>
          </table>
          <!-- Pagination Links -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('style')
<style>
  .dataTables_length select {
    margin-right: 6px;
    height: 37px !important;
    border: 1px solid rgba(0, 0, 0, 0.3);
  }

  .dataTables_length label {
    display: flex;
    align-items: center;
  }
</style>
@endpush
@push('script')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script type="text/javascript">
  $(function() {
    let table = $('#datatables').DataTable({
      processing: true,
      serverSide: true,
      ordering: true,
      order: [
        [1, 'desc']
      ],
      lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
      ],
      ajax: {
        url: "{{ route('backend.admin.inventory.report') }}"
      },
      lengthChange: true,
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'sku',
          name: 'sku'
        }, {
          data: 'price',
          name: 'price'
        },
        {
          data: 'quantity',
          name: 'quantity'
        },
      ],
      dom: 'lBfrtip', // Enables the buttons
      buttons: [{
          extend: 'excel',
          text: 'Export to Excel',
          className: 'btn'
        },
        {
          extend: 'pdf',
          text: 'Export to PDF',
          className: 'btn'
        },
        {
          extend: 'print',
          text: 'Print',
          className: 'btn'
        }
      ],
      initComplete: function() {
        // Hide the "entries" text length changes button
        $('.dataTables_length label').contents().filter(function() {
          return this.nodeType === 3;
        }).remove();
      }
    });
  });
</script>
@endpush