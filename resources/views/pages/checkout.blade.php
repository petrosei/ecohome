@extends('layouts.app')

{{-- @section('css-extra')
<script src="https://js.stripe.com/v3/"></script>
@endsection --}}

@section('content')

<div class="container">
    @if(session()->has('success_message'))
      <div class="spacer"></div>
      <div class="alert alert-success">
        {{session()->get('success_message')}}
      </div>
    @endif
    <div class="checkout_container">
        <div class="checkout-form">
                

                <form action="{{route('checkout.charge')}}" method="POST" id="payment-form">
                    {{ csrf_field() }}
                  <div class="form-group">
                    <label for="card-element">
                      Credit or debit card
                    </label>
                    <div id="card-element">
                      <!-- A Stripe Element will be inserted here. -->
                    </div>
                
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                  </div>
                
                  <button type="submit">Submit Payment</button>
                </form>
        </div>
        <div class="checkout_cart">
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
                                    <p class="quantity"> {{$quantity[$product->slug]}} </p>
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
                </div>
            @else
                <div class="empty_cart">
                    <img class="img-fluid" src="{{asset('img/cart.png')}}">
                    <p>Your cart is empty.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js-extra')

<script>
    (function(){
        // Create a Stripe client.
var stripe = Stripe('pk_test_fNEKQhv6fHUIeidziG92SgcM004wf3SiRZ');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
        
    })();
</script>
@endsection