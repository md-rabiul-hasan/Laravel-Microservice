<?php

namespace App\Http\Controllers;

use App\Jobs\LikedJob;
use App\Models\Product;
use App\Models\ProductUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(){
        return Product::all();
    }

    public function like(Request $request, $id){
        $user_id = mt_rand(1,5);
        try{
            $product_like = ProductUser::create([
                "product_id" => $id,
                "user_id" => $user_id
            ]);

            $product = Product::find($id);
            $product->likes++;
            $product->save();

            LikedJob::dispatch($product_like->toArray())->onQueue('backend_queue');

            return response([
                "message" => "success"
            ]);
        }catch(Exception $e){
            return response([
                "message" => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
