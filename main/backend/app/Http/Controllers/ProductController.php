<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id){
        return Product::find($id);
    }

    public function store(Request $request){
        $product = Product::create($request->only('title', 'image'));
        return response($product, Response::HTTP_CREATED);
    }

    public function update($id, Request $request){
        return $product = Product::find($id);
        $product->update($request->only('title', 'image'));
        return response($product, Response::HTTP_CREATED);
    }

    public function destroy($id){
        Product::destroy($id);
        return response( null, Response::HTTP_NO_CONTENT);
    }

}
