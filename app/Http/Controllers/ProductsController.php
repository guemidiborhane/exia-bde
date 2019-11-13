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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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

        $product = new Product([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'photo' => $request->get('photo'),
            'price' => $request->get('price'),
            'category' => 'request'->get('category')
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
        $product = Product::find($id);
        return view('products.edit', compact('product'));
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
