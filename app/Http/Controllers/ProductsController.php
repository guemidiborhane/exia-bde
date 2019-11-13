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
            'name'=>'required',
            'description'=>'required',
            'photo'=>'required',
            'price'=>'required',
            'category'=>'required',
        ]);

        $product = new Product([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'photo' => $request->get('photo'),
            'price' => $request->get('price'),
            'category'=>'request'->get('category'),
            
        ]);
        $product->save();
        return redirect('/products')->with('success', 'Contact saved!');
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
            'name'=>'required',
            'description'=>'required',
            'photo'=>'required',
            'price'=>'required',
            'category'=>'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $photoName = time().'.'.$request->photo->getClientOriginalExtension();
        $request->file('photo')->storeAs('products', $photoName, 'public');
        $product = Product::find($id);
        $product->name =  $request->get('name');
        $product->description = $request->get('description');
        $product->photo = $photoName;
        $product->price = $request->get('price');
        $product->category=$request->get('category');
        $product->save();

        return redirect('/products')->with('success', 'products updated!');
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

        return redirect('/products')->with('success', 'product deleted!');
    }
}