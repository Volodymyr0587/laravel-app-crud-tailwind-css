<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'products' => Product::all()
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:products|min:3|max:255',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable'
        ]);

        Product::create($data);

        session()->flash('create-product', 'Product successfully created.');

        return redirect(route('product.index'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0,2',
            'description' => 'nullable'
        ]);

        $product->update($data);

        session()->flash('update-product', 'Product successfully updated.');

        return redirect(route('product.index'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('delete-product', 'Product successfully deleted.');

        return redirect(route('product.index'));
    }
}
