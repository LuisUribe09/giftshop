<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Products;
use Exception;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::with('category')->get();
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
            'idcategory' => 'required'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors()->toJson(),400);
        }

        $product = Products::create(array_merge(
            $validator->validate()
        ));
        return response()->json([
            'message' => 'successfully registered product',
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $product = Products::find($request->id);
        if(is_null($product)){

            return response()->json([
                'message' => 'product not found',
                'error' => 404
            ], 404);
        }

        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $product = Products::find($request->id);
            if(is_null($product)){

                return response()->json([
                    'message' => 'product not found',
                    'error' => 404
                ], 404);
            }
            $data = $request->all();
            $validator = Validator::make($data, [
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
                'image' => 'required',
                'idcategory' => 'required'
            ]);
            if($validator->fails()) {
                return response()->json($validator->errors()->toJson(),400);
            }
            $product->idcategory  = $data['idcategory'];
            $product->title       = $data['title'];
            $product->description = $data['description'];
            $product->price       = $data['price'];
            $product->image       = $data['image'];

            $product->save();
            return response()->json([
                'message' => 'product updated successfully',
                'product' => $product
            ], 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Products::destroy($request->id);
        if(is_null($product)){
            return response()->json([
                'message' => 'product not found',
                'error' => 404
            ], 404);
        }
        return response()->json([
            'message' => 'the product was removed successfully',
        ], 201);
    }
}
