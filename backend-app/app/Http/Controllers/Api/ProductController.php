<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {   
        $respuesta = [];
        $validar = $this->validar($request->all());
        if(!is_array($validar)){
            $product = new Product();
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->save();
            array_push($respuesta, ['status' => 'success']);
            return response()->json($respuesta);
        }else{
            return response()->json($validar);
        }

    }

    public function show(string $id)
    {   
        $product = Product::find($id);
        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
/*
        $product = Product::findOrFail($request->id);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return $product;
*/
        $respuesta = [];
        $product = Product::find($id);

        if(!$product){
            array_push($respuesta, ['status' => 'error']);
            array_push($respuesta, ['errors' => 'No existe el ID']);
        }else{
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->save();
            //return $product;
            array_push($respuesta, ['status' => 'success']);
        }
        return response()->json($respuesta);
    }

    public function destroy(string $id)
    {
        $respuesta = [];
        $product = Product::find($id);
        if($product){
            $product = Product::destroy($id);
            array_push($respuesta, ['status' => 'success']);
        }else{
            array_push($respuesta, ['status' => 'error']);
            array_push($respuesta, ['errors' => 'No existe el ID']);
        }
        return response()->json($respuesta);
        /*

        $product = Product::destroy($id);
        return $product;
        */
    }
    public function validar($parametros){
        $respuesta = [];
        $messages = [
            'max' => 'El campo :attribute NO debe de contener más de :max caracteres',
            'required' => 'El campo :attribute NO debe estar vacío',
            'price.numeric' => 'El precio debe de ser númerico'
        ];
        $atributtes = [
            'description' => 'descripción',
            'price' => 'precio',
            'stock' => 'stock',
        ];
        $validacion = Validator::make($parametros,
        [
            'description' => 'required|max:150',
            'price' => 'required|numeric|max:999999',
            'stock' => 'required|numeric|max:999'
        ], $messages, $atributtes);
        if($validacion->fails()){
            array_push($respuesta, ['status'=>'error']);
            array_push($respuesta, ['errors'=>$validacion->errors()]);
            return $respuesta;
        }else{
            return true;
        }
    }
}
