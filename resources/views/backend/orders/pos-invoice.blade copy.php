@extends('backend.master')
@section('title', 'Receipt_'.$order->id)
@section('content')
<div class="receipt-container" id="printable-section" style="max-width: 350px; margin: auto; font-size: 14px; font-family: 'Courier New', Courier, monospace;">
  <div class="text-center">
    @if(readConfig('is_show_logo_invoice'))
    <img src="{{ assetImage(readconfig('site_logo')) }}" height="50" alt="Logo">
    @endif
    @if(readConfig('is_show_site_invoice'))
    <h3>{{ readConfig('site_name') }}
    </h3>
    @endif
    @if(readConfig('is_show_address_invoice')){{ readConfig('contact_address') }}<br>@endif
    @if(readConfig('is_show_phone_invoice')){{ readConfig('contact_phone') }}<br>@endif
    @if(readConfig('is_show_email_invoice')){{ readConfig('contact_email') }}<br>@endif
  </div>
  {{ 'User: '.auth()->user()->name}}<br>
  {{ 'Order: #'.$order->id}}<br>
  <hr>
  <div class="row justify-content-between mx-auto">
    <div class="text-left">
      @if(readConfig('is_show_customer_invoice'))
      <address>
        Name: {{ $order->customer->name ?? 'N/A' }}<br>
        Address: {{ $order->customer->address ?? 'N/A' }}<br>
        Phone: {{ $order->customer->phone ?? 'N/A' }}
      </address>
      @endif
    </div>
    <div class="text-right">
      <address class="text-right">
        <p>{{ date('d-M-Y') }}</p>
        <p>{{ date('h:i:s A') }}</p>
      </address>
    </div>
  </div>
  <hr>
  <table style="width: 100%;">
    <thead>
      <tr>
        <th style="text-align: left;">Product</th>
        <th style="text-align: right;">Qty</th>
        <th style="text-align: right;">Price {{ currency()->symbol}}</th>
        <th style="text-align: right;">Total {{ currency()->symbol}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($order->products as $item)
      <tr>
        <td>{{ $item->product->name }}</td>
        <td class="text-right">{{ $item->quantity }}</td>
        <td class="text-right">{{ number_format($item->discounted_price, 2) }}</td>
        <td class="text-right">{{ number_format($item->total, 2) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <hr>
  <div class="summary">
    <table style="width: 100%;">
      <tr>
        <td>Subtotal:</td>
        <td class="text-right">{{ currency()->symbol . ' ' . number_format($order->sub_total, 2) }}</td>
      </tr>
      <tr>
        <td>Discount:</td>
        <td class="text-right">{{ currency()->symbol . ' ' . number_format($order->discount, 2) }}</td>
      </tr>
      <tr>
        <td><strong>Total:</strong></td>
        <td class="text-right"><strong>{{ currency()->symbol . ' ' . number_format($order->total, 2) }}</strong></td>
      </tr>
      <tr>
        <td>Paid:</td>
        <td class="text-right">{{ currency()->symbol . ' ' . number_format($order->paid, 2) }}</td>
      </tr>
      <tr>
        <td>Due:</td>
        <td class="text-right">{{ currency()->symbol . ' ' . number_format($order->due, 2) }}</td>
      </tr>
    </table>
  </div>
  <hr>
  <div class="text-center">
    <p class="text-muted" style="font-size: 12px;">@if(readConfig('is_show_note_invoice')){{ readConfig('note_to_customer_invoice') }}@endif</p>
  </div>
</div>

<!-- Print Button -->
<div class="text-center mt-3 no-print">
  <button type="button" onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Print</button>
</div>
@endsection

@push('style')
<style>
  .receipt-container {
    border: 1px solid #000;
    padding: 10px;
  }

  hr {
    border: none;
    border-top: 1px dashed #000;
    margin: 5px 0;
  }

  table {
    width: 100%;
  }

  td,
  th{
    padding: 2px 0;
  }

  .text-right {
    text-align: right;
  }

  @media print {
    body {
      font-family: 'Your Font', sans-serif;
      font-size: 12px;
      color: #000;
    }

    .invoice {
      width: 100%;
      /* Ensure the content is full width */
      padding: 10px;
    }

    .no-print {
      display: none;
      /* Hide elements like buttons that shouldn't appear in print */
    }

    /* Add more styles as needed to make the printed version look consistent */
  }
</style>
@endpush

@push('script')
<script>
</script>
@endpush