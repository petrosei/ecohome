<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use Cartalyst\Stripe\Stripe;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = session()->get('cart');
        $products = collect();
        $money = ['subtotal'=>0,'courier'=>0,'total'=>0];
        if($cart) {
            
            foreach (array_keys($cart) as $key){
                $products->push(Products::where('slug',$key)->get());
            }
            $products = $products->flatten();
            foreach ($products as $product){
                $money['subtotal'] += ($product->amount / 10)*$cart[$product->slug];
                $quantity[$product->slug] = $cart[$product->slug];
            }
            $money['courier'] = 5;
            $money['total'] = $money['subtotal'] + $money['courier'];
            $items = sizeof($cart);
            
        }
        else{
            $items = 0;
            $products = [];
            $quantity = [];
        }
        return view('pages.checkout')->with(['products'=>$products,'items'=>$items,'money'=>$money,'quantity'=>$quantity]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Charge credit card
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function charge(Request $request)
    {
        try {
            $money = session()->get('money');
            $stripe = Stripe::make();
            $charge = $stripe->charges()->create([
                'amount' => $money['total'],
                'currency' => 'EUR',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => 'test@test.com',
                'metdata' => [

                ],
            ]);
            return back()->with('success_message','Thank you');
        } catch (Exception $e) {
            return back()->with('success_message','Something Bad Happened');
        }
        
        // dd($request->all());
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
