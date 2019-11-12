<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Product;
 
class ProductsController extends Controller
{
 
   
    public function index($category = null)
    {   
        if ($category === null) {
            $products = Product::all();
        } else {
            $products = Product::where('category', $category)->get();
        }
        return view('products.index', compact('products'));
    }
}