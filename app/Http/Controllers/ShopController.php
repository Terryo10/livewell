<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $category = Categories::all();
        $subcategories =  SubCategories::all();
        $products = Products::all();
        return view('shop.shop')
            ->with('category', $category)
            ->with('product', $products)
            ->with('subcategories', $subcategories);
    }

    public function product($id){
        $category = Categories::all();
        $subcategories =  SubCategories::all();
        $products = Products::where('id', $id)->first();
        $productImages= ProductImages::where('product_id', $id)->get();
        return view('shop.product')
            ->with('category', $category)
            ->with('product', $products)
            ->with('subcategories', $subcategories)
            ->with('productImages', $productImages);
    }

    public  function category($id){
        $category = Categories::all();
        $subcategories =  SubCategories::all();
        $products = Products::where('sub_category_id', $id)->get();
        return view('shop.shop')
            ->with('category', $category)
            ->with('product', $products)
            ->with('subcategories', $subcategories);
    }
}
