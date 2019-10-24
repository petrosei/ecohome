<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

        <!-- Styles -->
 

    </head>
    <body>
        
        <div>
                
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{route("cart")}}"><img class="img-fluid" src="{{asset('img/cart.png')}}"></a>
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        
        </div>

        <div class="container">

            <div class="nav-bar">
                <div class="nav-text">
                    <a href="{{route("products.show")}}"><p> all products </p></a>
                </div>
                <div class="logo">
                    <a href="{{ url('/') }}"><img class="img-fluid" src="{{asset('img/logo.png')}}" alt="EcoHome"></a>
                </div>
                <div class="nav-text">
                    <a href="/about"><p> all about us </p></a>
                </div>
            </div>  <!-- End of nav bar -->



            <div class="menu-hr">
                <a href="#"><hr><hr><hr></a>
                {{-- <div class="menu-grid">
                        <div class="product-menu-1">
                                <a href="#"><img class="img-fluid" src="{{asset('img/products/kitchen/product1.jpg')}}" alt="EcoHome1"></a>
                            </div>
                            <div class="product-menu-2">
                                <a href="#"><img class="img-fluid" src="{{asset('img/products/bathroom/product1.jpg')}}" alt="EcoHome2"></a>
                            </div>
                            <div class="product-menu-3">
                                <a href="#"><img class="img-fluid" src="{{asset('img/products/makeup/product1.jpg')}}" alt="EcoHome3"></a>
                            </div>
                            <div class="product-menu-4">
                                <a href="#"><img class="img-fluid" src="{{asset('img/products/kitchen/product2.jpg')}}" alt="EcoHome4"></a>
                            </div>
                            <div class="product-menu-5">
                                <a href="#"><img class="img-fluid" src="{{asset('img/products/bathroom/product2.jpg')}}" alt="EcoHome5"></a>
                            </div>
                            <div class="product-menu-6">
                                <a href="#"><img class="img-fluid" src="{{asset('img/products/makeup/product2.jpg')}}" alt="EcoHome6"></a>
                            </div>
                            <div class="product-menu-7">
                                <a href="#"><img class="img-fluid" src="{{asset('img/products/kitchen/product3.jpg')}}" alt="EcoHome7"></a>
                            </div>
                            <div class="product-menu-8">
                                <a href="#"><img class="img-fluid" src="{{asset('img/products/bathroom/product3.jpg')}}" alt="EcoHome8"></a>
                            </div>
                            <div class="product-menu-9">
                                <a href="#"><img class="img-fluid" src="{{asset('img/products/makeup/product3.jpg')}}" alt="EcoHome9"></a>
                            </div>
                </div> --}}
            </div>
            
                
        
        
            <div class="products-gallery">
                @for ($i=1;$i<=9;$i++)
                    <div class="{{"product-gal-".$i}}">
                        @foreach ($products[$i-1]->categories as $category)
                        <a href="{{route('product',$products[$i-1]->slug)}}"><img class="img-fluid" src="{{ asset('img/products/'.$category->slug.'/'.$products[$i-1]->slug.'.jpg') }}" alt="EcoHome1"></a>
                        @endforeach
                    </div>
                @endfor
            </div> <!-- End of product gallery -->
        
        </div> <!-- End of container -->
    </body>
</html>
