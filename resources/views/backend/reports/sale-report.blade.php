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
              <div class="col-sm-4 invoice-col">
              </div>
              <!-- /.col -->
              <div class="col-sm-5 invoice-col">
                <address>
                  <strong>Sale Report</strong><br>
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-3 invoice-col">
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->

            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Subtotal:</th>
                      <td>12000</td>
                    </tr>
                    <tr>
                      <th>Total Discount:</th>
                      <td>500</td>
                    </tr>
                    <tr>
                      <th>Total Sale:</th>
                      <td>11500</td>
                    </tr>
                  </table>
                </div>
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
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
  })
</script>
@endpush