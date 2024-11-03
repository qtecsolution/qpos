@extends('backend.master')

@section('title', 'Collection')

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('backend.admin.due.collection',$order->id) }}" method="post" class="accountForm">
      @csrf
      <div class="card-body">
        <div class="row">
          <div class="mb-3 col-md-3">
            <label for="title" class="form-label">
              Name
            </label>
            <p>{{$order->customer->name}}</p>
          </div>
          <div class="mb-3 col-md-3">
            <label for="title" class="form-label">
              Order
            </label>
            <p># {{$order->id}}</p>
          </div>
          <div class="mb-3 col-md-3">
            <label for="title" class="form-label">
              Total
            </label>
            <p>{{$order->total}}</p>
          </div>
          <div class="mb-3 col-md-3">
            <label for="title" class="form-label">
              Due
            </label>
            <p>{{$order->due}}</p>
          </div>
          <div class="mb-3 col-md-6">
            <label for="title" class="form-label">
              Collection Amount <span class="text-danger">*</span>
            </label>
            <input type="number" class="form-control" placeholder="Enter amount" value="{{$order->due}}" name="amount" required min="1" max="{{$order->due}}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <button type="submit" class="btn bg-gradient-primary">Submit</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
@push('script')
<script>
</script>
@endpush