@extends('layouts.app')

@section('title', 'Cart Review')

@section('head_assets')

    <script type="text/javascript" src="{{URL::asset('assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/cart.js')}}"></script>

@endsection


@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Cart</span> - Review</h4>

                    <ul class="breadcrumb position-right">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li class="active">Cart Review</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="panel panel-white">
                <div class="table-responsive">
                    <table class="table table-lg">
                        <thead>
                        <tr>
                            <th>Car</th>
                            <th class="col-sm-1">Price</th>
                            <th class="col-sm-4">Quantity</th>
                            <th class="col-sm-1">Total</th>
                            <th class="col-sm-1">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    <h6 class="no-margin">{{$product->brand}} {{$product->model}}</h6>
                                    <input type="hidden" class="clientval" value="{{$product->id}}">
                                </td>
                                <td class="cart_price">
                                    <p class="price_jq">{{$product->price}}</p>
                                </td>
                                <td class="cart_quantity">
                                    <input type='button' value='-' class='qtyminus btn btn-danger' field='quantity' />
                                    <input type='text' name='quantity'
                                           value='{{$product->quantity}}'
                                           disabled
                                           class='qty form-control'
                                           style="width: 150px;display: inline; text-align: center"/>
                                    <input type='button' value='+' class='qtyplus btn btn-success' field='quantity' />
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price"></p>
                                </td>
                                <td class="text-center" id="myButtonRow">
                                    <a
                                        href="{{url('/delete_cart', $product->id)}}"
                                        class="btn btn-default"
                                        title="Edit"
                                        type="button">
                                        <i class="icon-bin2"></i>
                                    </a>

                                </td>
                            </tr>
                        @empty

                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="panel-body">
                    <div class="row invoice-payment">
                        <div class="col-sm-7">

                        </div>

                        <div class="col-sm-5">
                            <div class="content-group">
                                <div class="table-responsive no-border">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Total:</th>
                                            <td id="total" class="text-right text-primary"><h5 class="text-semibold"></h5></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-right">
                                    <a type="button" href="{{route('home')}}" class="btn btn-warning btn-labeled"><b><i class="icon-cart"></i></b>Continue Shopping</a>
                                    <a type="button" href="{{route('submit_cart')}}" class="btn btn-primary btn-labeled"><b><i class="icon-paperplane"></i></b> Purchase</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
