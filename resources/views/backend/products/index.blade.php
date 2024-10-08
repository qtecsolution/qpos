@extends('backend.master')

@section('title', 'Products')

@section('content')
<div class="card">
  <div class="mt-n5 mb-3 d-flex justify-content-end">
    <a href="{{ route('backend.admin.products.create') }}" class="btn bg-gradient-primary">
      <i class="fas fa-plus-circle"></i>
      Add New
    </a>
  </div>
  <div class="card-body p-2 p-md-4 pt-0">
    <div class="row g-4">
      <div class="col-md-12">
        <div class="card-body table-responsive p-0" id="table_data">
          <table id="datatables" class="table table-hover">
            <thead>
              <tr>
                <th data-orderable="false">#</th>
                <th></th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created</th>
                <th>Status</th>
                <th data-orderable="false">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($products as $index => $product)
              <tr>
                <td>{{ $index + 1  + ($products->perPage() * ($products->currentPage() - 1))}}</td>
                <td>
                  <img
                    src="{{ asset('storage/' . $product->image) }}"
                    loading="lazy"
                    alt="{{ $product->name }}"
                    class="img-thumb img-fluid"
                    onerror="this.onerror=null; this.src='{{ asset('assets/images/no-image.png') }}'"
                    height="80"
                    width="60" />

                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product }}
                  <br>
                  <del>{{ $product->price }}</del>
                </td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                <td>
                  @if($product->status)
                  <span class="badge bg-primary">Active</span>
                  @else
                  <span class="badge bg-danger">Inactive</span>
                  @endif
                </td>
                <td>
                  <!-- Add your action buttons here, e.g., edit, delete -->
                  <a class="btn btn-warning btn-sm" href="{{ route('backend.admin.products.edit', $product->id) }}">Edit</a>
                  <form action="{{ route('backend.admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center">No products found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
          <!-- Pagination Links -->
          <div class="d-flex justify-content-center mt-3">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
@endpush