@extends('layouts.app')

@section('content')
<div class="container">
    <div class="path">
        <a href="{{route("home")}}">home <span class='arrow'> > </span> </a>
        <a href="{{route("products.show")}}">all products</a>
    </div>
    <div class="single-product">
        <div class="sp-image">
            @foreach ($product->categories as $category)
            <img class="img-fluid" src="{{ asset('img/products/'.$category->slug.'/'.$product->slug.'.jpg') }}" alt="EcoHome1">
            @endforeach
        </div>
        <div class="sp-info">
            <h2>{{$product->name}}</h2>
            <p class="price">&euro; {{$product->presentAmount()}} </p>
            <p> {{$product->description}}
            </p>
            <form action="{{route('cart.add')}}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="slug" value="{{$product->slug}}">
                <button type="submit"> Add to Cart </button> 
            </form>
        </div>
    </div>

</div>
@endsection