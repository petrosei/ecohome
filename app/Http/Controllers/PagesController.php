<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Products;
use App\Categories;

class PagesController extends Controller
{
    public function index(){
        $products = Products::inRandomOrder()->take(9)->get();
        return view('pages.index')->with('products',$products);
    }
    public function about(){
        return view('pages.about');
    }


    public function products(){
        
        $sort = session()->get('sort');
        if(!$sort || request()->sort=='Random'){
            $sort[1] = 'Random';
            $sort[2] = 'Low->High';
            $sort[3] = 'High->Low';
        }
        elseif(request()->sort=='Low->High'){
            $sort[1] = 'Low->High';
            $sort[2] = 'High->Low';
            $sort[3] = 'Random';
        }
        elseif(request()->sort=='High->Low'){
            $sort[1] = 'High->Low';
            $sort[2] = 'Low->High';
            $sort[3] = 'Random';
        }
        session()->put('sort', $sort);
        
        $cat = session()->get('cat');
        if(!$cat || request()->category=='all'){
            $cat = 'all';
        }
        elseif(request()->category=='kitchen'){
            $cat='kitchen';
        }
        elseif(request()->category=='bathroom'){
            $cat='bathroom';
        }
        elseif(request()->category=='makeup'){
            $cat='makeup';
        }
        session()->put('cat', $cat);
        
        if($sort[1] == 'Random'){
            if($cat!='all'){
                $products = Products::with('categories')->whereHas('categories',function($query){
                    $query->where('slug',session()->get('cat'));
                })->inRandomOrder();
            }
            else{
               $products = Products::inRandomOrder();
            }
        }
        elseif($sort[1] == 'Low->High'){
            if($cat!='all'){
                $products = Products::with('categories')->whereHas('categories',function($query){
                    $query->where('slug',session()->get('cat'));
                })->orderBy('amount','asc');
            }
            else{
               $products = Products::orderBy('amount','asc');
            }
        }
        elseif($sort[1] == 'High->Low'){
            if($cat!='all'){
                $products = Products::with('categories')->whereHas('categories',function($query){
                    $query->where('slug',session()->get('cat'));
                })->orderBy('amount','desc');
            }
            else{
               $products = Products::orderBy('amount','desc');
            }
        }
        
        
        if(request()->load){
            $products = $products->paginate(request()->load+3);
        }
        else{
            $products = $products->paginate(6);
        }
        

        $categories = Categories::all();
        return view('pages.products')->with(['products' => $products,'categories'=>$categories,'sort'=>$sort]);
    }


    public function product($slug){
        $product=Products::where('slug',$slug)->firstOrFail();
        return view('pages.product')->with(['product'=>$product]);
    }
}
