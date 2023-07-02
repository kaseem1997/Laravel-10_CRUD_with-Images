<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sortField = $request->query('sort_field', 'name');
        $sortDirection = $request->query('sort_direction', 'asc');

        $products = Product::orderBy($sortField, $sortDirection)->paginate(5);

        return view('products.index', [
            'products' => $products,
            'sortField' => $sortField,
            'sortDirection' => $sortDirection,
        ]);
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        // Validate data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        // Upload image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('products'), $imageName);
        // Create a new product
        $product = new Product;
        $product->image = $imageName;
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->save();
        $homeUrl = URL::route('products.index');
        $response = Redirect::to($homeUrl)->withSuccess('Product Created!');
        // Redirect with delay
        $response->header('Refresh', '1;url=' . $homeUrl);

        return $response;
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();

        return view('products.edit', ['product' => $product]);
    }
    public function update(Request $request, $id)
    {
        // validate data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        $product = Product::findOrFail($id);

        if (isset($request->image)) {
            // upload image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        return redirect()->route('products.index')->withSuccess('Product updated successfully!');
    }


    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();

        return back()->withSuccess('Product deleted !!!!!');
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->first();

        return view('products.show', ['product' => $product]);
    }
}
