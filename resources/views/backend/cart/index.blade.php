@extends('backend.master')
@section('title', 'Order')
@section('content')

<div id="cart"></div>
<div class="card">
    <div class="card-body p-2 p-md-4 pt-0">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="row mb-2">
                    <!-- <div class="col-6">
                        <form class="form">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search Product">
                        </form>
                    </div> -->
                    <div class="col-6">
                        <select class="form-control">
                            <option>Walking Customer</option>
                            <option>Customer 1</option>
                            <option>Customer 2</option>
                        </select>
                    </div>
                </div>
                <div class="user-cart">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th class="text-right">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Product1</td>
                                        <td class="d-flex align-items-center">
                                            <input type="text" class="form-control form-control-sm qty mr-2" value="5" />
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                        <td class="text-right">500</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">Total:</div>
                    <div class="col text-right">500</div>
                </div>
                <div class="row">
                    <div class="col">
                        <button
                            type="button"
                            class="btn btn-danger btn-block">
                            Cancel
                        </button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary btn-block">Checkout</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-8">
                <div class="mb-2">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Enter Product Name" />
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                        <div class="">
                            <img src="{{ auth()->user()->pro_pic }}" alt="" class="mr-2" />
                            <h5 class="mb-0">Product 1 (100)</h5>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                        <div class="">
                            <img src="{{ auth()->user()->pro_pic }}" alt="" class="mr-2" />
                            <h5 class="mb-0">Product 2 (100)</h5>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                        <div class="">
                            <img src="{{ auth()->user()->pro_pic }}" alt="" class="mr-2" />
                            <h5 class="mb-0">Product 3 (100)</h5>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                        <div class="">
                            <img src="{{ auth()->user()->pro_pic }}" alt="" class="mr-2" />
                            <h5 class="mb-0">Product 4 (100)</h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection