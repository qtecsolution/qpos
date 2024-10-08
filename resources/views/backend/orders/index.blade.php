@extends('backend.master')

@section('title', 'Sell')

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
                <th>SellId</th>
                <th>Customer</th>
                <th>Total</th>
                <th data-orderable="false">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($orders as $index => $order)
              <tr>
                <td>{{ $index + 1  + ($orders->perPage() * ($orders->currentPage() - 1))}}</td>
                <td>#{{$order->id}}</td>
                <td>{{ $order->customer->name ?? '-' }}</td>
                <td>{{$order->total}}</td>
                <td>
                  <a class="btn btn-success btn-sm" href="{{route('backend.admin.orders.invoice',$order->id)}}">Invoice</a>
                  <!-- <form action="{{ route('backend.admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                  </form> -->
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center">No sells found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <!-- Pagination Links -->
          <div class="d-flex justify-content-center mt-3">
            {{ $orders->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
@endpush