<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
class CartController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = session()->get('cart');
        $money = session()->get('money');
        $products = collect();
        // $money = ['subtotal'=>0,'courier'=>0,'total'=>0];
        if($cart) {
            
            foreach (array_keys($cart) as $key){
                $products->push(Products::where('slug',$key)->get());
            }
            $products = $products->flatten();
            foreach ($products as $product){
                // $money['subtotal'] += ($product->amount / 10)*$cart[$product->slug];
                $quantity[$product->slug] = $cart[$product->slug];
            }
            // $money['courier'] = 5;
            // $money['total'] = $money['subtotal'] + $money['courier'];
            $items = sizeof($cart);
            
        }
        else{
            $items = 0;
            $products = [];
            $quantity = [];
        }
        return view('pages.cart')->with(['products'=>$products,'items'=>$items,'money'=>$money,'quantity'=>$quantity]);
    }

    

    /**
     * Add a new item in cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        if($request->slug){
            $product = Products::where('slug',$request->slug)->first();
            //dd($product);
        }
        else{
            abort(404);
        }
        $cart = session()->get('cart');
        $money = session()->get('money');
        if(!$cart){
            $cart = [
                $request->slug => 1
            ];
            $money = [
                'subtotal'=>$product->amount/10,
                'courier'=>5,
                'total'=>$product->amount/10 + 5
            ];
        }
        elseif(isset($cart[$request->slug])){
            $cart[$request->slug]++;
            $money['subtotal'] += $product->amount/10;
            $money['total'] = $money['subtotal'] + $money['courier'];
        }
        else{
            $cart[$request->slug] = 1;
            $money['subtotal'] += $product->amount/10;
            $money['total'] = $money['subtotal'] + $money['courier'];
        }
        
        session()->put('cart', $cart);
        session()->put('money', $money);
        return redirect()->route('cart');//back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Remove an item from cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        if($request->slug){
            $product = Products::where('slug',$request->slug)->first();
        }
        else{
            abort(404);
        }
        $cart = session()->get('cart');
        $money = session()->get('money');

         $money['subtotal'] -= $cart[$request->slug]*$product->amount/10; 
         $money['total'] = $money['subtotal'] + $money['courier'];

        unset($cart[$request->slug]);
        
        session()->put('cart', $cart);
        session()->put('money', $money);
        return redirect()->route('cart');//back()->with('success', 'Product removed to cart successfully!');
    }

    /**
     * Update the quantity of an item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->slug){
            $product = Products::where('slug',$request->slug)->first();
        }
        else{
            abort(404);
        }
        $cart = session()->get('cart');
        $money = session()->get('money');
        
        if($request->change=="+"){
            $cart[$request->slug]++;
            $money['subtotal'] += $product->amount/10;
        }
        elseif($request->change=="-"){
            $cart[$request->slug]--;
            $money['subtotal'] -= $product->amount/10;
        }
        $money['total'] = $money['subtotal'] + $money['courier'];
        if($cart[$request->slug]==0){
            unset($cart[$request->slug]);
        }
        
        session()->put('cart', $cart);
        session()->put('money', $money);
        return redirect()->route('cart');//back()->with('success', 'Product removed to cart successfully!');
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
