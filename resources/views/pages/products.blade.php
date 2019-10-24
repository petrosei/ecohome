@extends('layouts.app')

@section('content')
<div class="container">
    <div class="products-head">
        <div class="path">
            <a href="{{route("home")}}">home</a>
        </div>
        <div class="sort">
            <a href="{{route('products.show',['sort'=>$sort[1]])}}" >{{$sort[1]}} <i class="down"></i></a>
            <div class="other-sort">
                <a href="{{route('products.show',['sort'=>$sort[2]])}}">{{$sort[2]}}</a>
                <br>
                <a href="{{route('products.show',['sort'=>$sort[3]])}}">{{$sort[3]}}</a>
            </div>
        </div>
        
    </div>
    
    
    <div class="products-flex">

        <div class="categories">
            <h2> categories </h2>
            <ul>
                <hr>
                <li><a href="{{route("products.show",['category'=> 'all'])}}" >all products</a></li>
                @foreach ($categories as $category)
                <li><a href="{{route("products.show",['category'=> $category->slug])}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="products-show-cont">
            
            {{-- <div class="empty"></div>
            <div class="empty"></div> --}}
                @for ($i=1;$i<=sizeOf($products);$i++)
                    <div class="product-show">
                        @foreach ($products[$i-1]->categories as $category)
                        <a href="{{route('product',$products[$i-1]->slug)}}"><img class="img-fluid" src="{{ asset('img/products/'.$category->slug.'/'.$products[$i-1]->slug.'.jpg') }}" alt="EcoHome1"></a>
                        <a href="{{route('product',$products[$i-1]->slug)}}"><p>{{$products[$i-1]->details}}</p><hr><p> &euro;{{$products[$i-1]->presentAmount()}}</p></a>     
                        @endforeach
                    </div>
                @endfor
                
        </div>

        <div class="pagination" id="load">
            <a href="{{route("products.show",['load'=> sizeOf($products)])}}#load">
                <div class="load">Load More</div>
                <div class="arrow">
                    <i class="down"></i>
                </div>
                </a>
            
        </div>
    </div>  
    
    

</div>

@endsection

@section('js-extra')

<script >
$(document).ready(function(){
    
});

</script>

@endsection