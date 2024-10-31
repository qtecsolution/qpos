@extends('backend.master')

@section('title', 'Sale Report')

@section('content')
<div class="card">
  <div class="mt-n5 mb-3 d-flex justify-content-end">
    <div class="form-group">
      <div class="input-group">
        <button type="button" class="btn btn-default float-right" id="daterange-btn">
          <i class="far fa-calendar-alt"></i> Filter by date
          <i class="fas fa-caret-down"></i>
        </button>
      </div>
    </div>
  </div>
  <div class="card-body p-2 p-md-4 pt-0">
    <div class="row g-4">
      <div class="col-md-12">
        <div class="card-body p-0">
          <section class="invoice">
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4">
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <address>
                  <strong>Sale Report ({{$start_date}} - {{$end_date}})</strong><br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-2">
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row justify-content-center">
              <div class="col-12">
                <table id="datatables" class="table table-hover">
                  <thead>
                    <tr>
                      <th data-orderable="false">#</th>
                      <th>SaleId</th>
                      <th>Customer</th>
                      <th>Date</th>
                      <th>Item</th>
                      <th>Sub Total {{currency()->symbol??''}}</th>
                      <th>Discount {{currency()->symbol??''}}</th>
                      <th>Total {{currency()->symbol??''}}</th>
                      <th>Paid {{currency()->symbol??''}}</th>
                      <th>Due {{currency()->symbol??''}}</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($orders as $index => $order)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>#{{$order->id}}</td>
                      <td>{{ $order->customer->name ?? '-' }}</td>
                      <td>{{ $order->created_at->format('d-m-Y') }}</td>
                      <td>{{$order->total_item}}</td>
                      <td>{{number_format($order->sub_total,2,'.',',')}}</td>
                      <td>{{number_format($order->discount,2,'.',',')}}</td>
                      <td>{{number_format($order->total,2,'.',',')}}</td>
                      <td>{{number_format($order->paid,2,'.',',')}}</td>
                      <td>{{number_format($order->due,2,'.',',')}}</td>
                      <td>
                        @if ($order->status)
                        Paid
                        @else
                        Due
                        @endif
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="7" class="text-center">No sells found.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row no-print">
              <div class="col-12">
                <button type="button" onclick="window.print()" class="btn btn-success float-right"><i class="fas fa-print"></i> Print</a>
                </button>
              </div>
            </div>
            <!-- /.row -->
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('style')
<style>
  .invoice {
    border: none !important;
  }
</style>
@endpush
@push('script')
<script>
  $(function() {
    // Extract start and end dates from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const startDate = urlParams.get('start_date') || moment().subtract(29, 'days').format('YYYY-MM-DD'); // Default to last 30 days if not present
    const endDate = urlParams.get('end_date') || moment().format('YYYY-MM-DD'); // Default to today if not present

    // Initialize the date range picker
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(startDate, "YYYY-MM-DD"),
        endDate: moment(endDate, "YYYY-MM-DD")
      },
      function(start, end) {
        // Update the button text with the selected range
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

        // Redirect with selected start and end dates
        window.location.href = '{{ route("backend.admin.sale.report") }}?start_date=' + start.format('YYYY-MM-DD') + '&end_date=' + end.format('YYYY-MM-DD');
      }
    );

    // Set the initial display text for the date range button
    $('#daterange-btn span').html(moment(startDate, "YYYY-MM-DD").format('MMMM D, YYYY') + ' - ' + moment(endDate, "YYYY-MM-DD").format('MMMM D, YYYY'));
  });
</script>
@endpush