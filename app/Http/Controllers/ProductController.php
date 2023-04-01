<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $products = Product::latest()->get();
        return view("products", [
            "products" => $products
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required',
            'stock' => 'required',
        ]);
        $input = $request->only('product_name', 'price', 'stock');
        Product::create($input);
        return redirect('products');
    }
    public function delete($id)
    {
        try {
            Product::find($id)->delete();
            return redirect('products');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function showOneProduct($id)
    {
        $product = Product::find($id);
        return view('edit-product', [
            "product" => $product
        ]);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required',
            'stock' => 'required',
        ]);
        $input = $request->only('product_name', 'price', 'stock');
        Product::find($id)->update($input);
        return redirect('products');
    }
}
