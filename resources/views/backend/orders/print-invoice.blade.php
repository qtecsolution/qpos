@extends('backend.master')
@section('title', 'Invoice_'.$order->id)
@section('content')
<div class="card">
  <div class="card-body">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row mb-4">
        <div class="col-4">
          <h2 class="page-header">
            @if(readConfig('is_show_logo_invoice'))
            <img src="{{ assetImage(readconfig('site_logo')) }}" height="40" width="40" alt="Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
            @endif
            @if(readConfig('is_show_site_invoice')){{ readConfig('site_name') }} @endif
          </h2>
        </div>
        <div class="col-4">
          <h4 class="page-header">Invoice</h4>
        </div>
        <div class="col-4">
          <small class="float-right text-small">Date: {{date('d/m/Y')}}</small>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-5 invoice-col">
          @if(readConfig('is_show_customer_invoice'))
          To
          <address>
            <strong>Name: {{$order->customer->name??"N/A"}}</strong><br>
            Address: {{$order->customer->address??"N/A"}}<br>
            Phone: {{$order->customer->phone??"N/A"}}<br>
          </address>
          @endif
        </div>
        <div class="col-sm-4 invoice-col">
          From
          <address>
            @if(readConfig('is_show_site_invoice'))<strong>Name:{{ readConfig('site_name') }}</strong><br> @endif
            @if(readConfig('is_show_address_invoice'))Address: {{ readConfig('contact_address') }}<br>@endif
            @if(readConfig('is_show_phone_invoice'))Phone: {{ readConfig('contact_phone') }}<br>@endif
            @if(readConfig('is_show_email_invoice'))Email: {{ readConfig('contact_email') }}<br>@endif
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-3 invoice-col">
          Info <br>
          Sale ID #{{$order->id}}<br>
          Sale Date: {{date('d/m/Y', strtotime($order->created_at))}}<br>
          <!-- <br>
          <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567 -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>SN</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price {{currency()->symbol??''}}</th>
                <th>Subtotal {{currency()->symbol??''}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->products as $item )
              <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$item->product->name}}</td>
                <td>{{$item->quantity}} {{optional($item->product->unit)->short_name}}</td>
                <td>
                  {{$item->discounted_price }}
                  @if ($item->price>$item->discounted_price)
                  <br><del>{{ $item->price }}</del>
                  @endif
                </td>
                <td>{{$item->total}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
          <!-- <p class="lead">Payment:Cash Paid</p> -->
          <!-- <small class="lead text-small text-bold">Payment:Cash Paid</small> -->
          <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            @if(readConfig('is_show_note_invoice')){{ readConfig('note_to_customer_invoice') }}@endif
          </p>
        </div>
        <!-- /.col -->
        <div class="col-6">
          <!-- <p class="lead">Amount Due 2/22/2014</p> -->

          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td class="text-right">{{currency()->symbol.' '.number_format($order->sub_total,2,'.',',')}}</td>
              </tr>
              <tr>
                <th>Discount:</th>
                <td class="text-right">{{currency()->symbol.' '.number_format($order->discount,2,'.',',')}}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td class="text-right">{{currency()->symbol.' '.number_format($order->total,2,'.',',')}}</td>
              </tr>
              <tr>
                <th>Paid:</th>
                <td class="text-right">{{currency()->symbol.' '.number_format($order->paid,2,'.',',')}}</td>
              </tr>
              <tr>
                <th>Due:</th>
                <td class="text-right">{{currency()->symbol.' '.number_format($order->due,2,'.',',')}}</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <div class="row no-print">
        <div class="col-12">
          <button type="button" onclick="window.print()" class="btn btn-success float-right"><i class="fas fa-print"></i> Print</a>
          </button>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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
  window.addEventListener("load", window.print());
</script>
@endpush