<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{

    public function index(Request $request, $category = null)
    {
        $query = $request->input('q');
        if ($query) {
            $products = Product::where('name', 'like', "%{$query}%")->orWhere('description', 'like', "%{$query}%")->get();
        } else {
            if ($category === null) {
                $products = Product::all();
            } else {
                $products = Product::where('category', $category)->get();
            }
        }

        return view('products.index', compact('products', 'query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Product::getPossibleEnumValues('category');
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required',
            'price' => 'required',
            'category' => 'required',
        ]);

        $photoName = time().'.'.$request->photo->getClientOriginalExtension();
        $request->file('photo')->storeAs('products', $photoName, 'public');
        
        $product = new Product([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'photo' => $request->get('photo'),
            'price' => $request->get('price'),
            'category' => 'request'->get('category'),
            'photo' => $photoName
        ]);
        $product->save();

        return redirect()->route('products.index')->with('success', 'Contact saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Product::getPossibleEnumValues('category');

        return view('products.edit', compact('product', 'categories'));
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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required'
        ]);

        $product = Product::find($id);
        if ($request->file('photo')) {
            $photoName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->file('photo')->storeAs('products', $photoName, 'public');
            $product->photo = $photoName;
        }

        $product->name =  $request->get('name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->category = $request->get('category');
        $product->save();

        return redirect()->route('products.index', ['category' => $product->category])->with('success', 'products updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::find($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'product deleted!');
    }
}
