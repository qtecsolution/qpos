@extends('backend.master')

@section('title', 'Transactions Sale #'.$order->id)

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
                <th>TransactionId</th>
                <th>Amount {{currency()->symbol??''}}</th>
                <th>Paid By</th>
                <th>Created</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @forelse($order->transactions as $index => $transaction)
              <tr>
                <td>{{ $index + 1}}</td>
                <td>#{{$transaction->id}}</td>
                <td>{{number_format($transaction->amount,2,'.',',')}}</td>
                <td>{{$transaction->paid_by}}</td>
                <td>{{ $transaction->created_at->format('M-d Y, h:i A') }}</td>
                <td>
                  <a class="btn btn-success btn-sm" href="{{route('backend.admin.collectionInvoice',$transaction->id)}}">Invoice</a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center">No transaction found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
@endpush