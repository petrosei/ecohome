@extends('layouts.app')

@section('content')
<div class="container">
    @if($money['subtotal']!=0)
        <p>{{$items}} item(s) in cart </p>
        <hr>
        <div class="cart-items">
            @foreach ($products as $product)
                <div class="cart-item">
                    @foreach ($product->categories as $category)
                    <div class="item-info">
                            <img class="img-fluid" src="{{ asset('img/products/'.$category->slug.'/'.$product->slug.'.jpg') }}" alt="EcoHome1">
                        </div>
            
                        <div class="item-info">
                            <h3>{{$product->name}}</h3><br> <p> {{$product->details}} </p>
                        </div>
            
                        <div class="item-info">
                            <form action="{{route('cart.remove')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="slug" value="{{$product->slug}}">
                                <button type="submit"> Remove </button> 
                            </form>
                        </div>
            
                        <div class="item-info">
                            <form action="{{route('cart.update')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="slug" value="{{$product->slug}}">
                                    <input type="submit" class="change" name="change" value="-">
                                    {{-- <input data-min="1" data-max="0" type="text" name="quantity" value="1" readonly="true"> --}}
                                    <p class="quantity"> {{$quantity[$product->slug]}} </p>
                                    <input type="submit" class="change" name="change" value="+">
                            </form>

                            {{-- <input data-min="1" data-max="0" type="text" name="quantity" value="1" readonly="true"> --}}

                        </div>
                        <div id="price" class="item-info">
                            <p>&euro; {{$product->presentAmount()}}</p>
                        </div>     
                    @endforeach
                </div>
            @endforeach
            
            
        </div>
        <hr>
        
        <div class="total">
            <div class="Subtotal">
                <div class="subtotal-text">
                    <p> Subtotal</p>
                </div>
                <div class="subtotal-price">
                    <p>&euro; {{$money['subtotal']}}</p>
                </div>
            </div>
            <div class="Courier">
                <div class="subtotal-text">
                    <p> Courier</p>
                </div>
                <div class="subtotal-price">
                    <p>&euro; {{$money['courier']}}</p>
                </div>
            </div>
            <hr>
            <div class="Total">
                <div class="subtotal-text">
                    <p> Total</p>
                </div>
                <div class="subtotal-price">
                    <p>&euro; {{$money['total']}}</p>
                </div>
            </div>
            <div class="checkout">
                <form action="{{route('checkout')}}" method="GET">
                        {{ csrf_field() }}
                        <button type="submit"> Checkout </button> 
                </form>
            </div>
        </div>
    @else
        <div class="empty_cart">
            <img class="img-fluid" src="{{asset('img/cart.png')}}">
            <p>Your cart is empty.</p>
        </div>
    @endif
</div>
@endsection