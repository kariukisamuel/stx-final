<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiResponseController as ApiResponseController;
use App\Http\Resources\product as ProductResource;
use Illuminate\Support\Facades\Validator;
use App\Models\products as Product;
use Illuminate\Support\Facades\URL;

class ProductController extends ApiResponseController
{
    public function index()
    {
        $products = Product::all();
        return $this->handleResponse(ProductResource::collection($products), 'Products have been retrieved!');
    }

    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'product_description' => 'required',
            'product_price' => 'required|integer',
            'product_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_name' => 'required',
        ]);
        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }

        $file = $request->file('product_image');
        //save image
        $path = 'products';
        $image_uploaded_path = $file->store($path, 'public');
        $input['product_image'] = URL::to('').'/storage/'.$image_uploaded_path;
        $input['product_slug'] = str_replace(' ','-',$request->product_name).'-'.$request->product_price;
    
        $product = Product::create($input);
        

        return $this->handleResponse(new ProductResource($product), 'Product created!');

        
    }

   
    public function show($id)
    {
        
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->handleError('Product not found!');
        }
        return $this->handleResponse(new ProductResource($product), 'Product retrieved.');
    }
    

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'product_description' => 'required',
            'product_price' => 'required',
            'product_name' => 'required',
        ]);


        if($validator->fails()){
            return $this->handleError($validator->errors());       
        }

        $product = Product::find($id);

     
        if($product){
            if($request->file('product_image')){
             
                $file = $request->file('product_image');
                //save image
                $path = 'products';
                $image_uploaded_path = $file->store($path, 'public');
                $input['product_image'] = URL::to('').'/storage/'.$image_uploaded_path;

                $product->product_name = $input['product_name'];
                $product->product_price = $input['product_price'];
                $product->product_description = $input['product_description'];
                $product->product_slug = str_replace(' ','-',$request->product_name).'-'.$request->product_price;
                $product->save();

                return $this->handleResponse(new ProductResource($product), 'Product successfully updated!');

            }
            else{
                $product->product_name = $input['product_name'];
                $product->product_price = $input['product_price'];
                $product->product_description = $input['product_description'];
                $product->product_slug = str_replace(' ','-',$request->product_name).'-'.$request->product_price;
                $product->save();

                return $this->handleResponse(new ProductResource($product), 'Product successfully updated!');
            }
        }
        else{
            return $this->handleError($product, 'Product not found!');   
        }
    }
   
    public function destroy($id)
    {

        $product = Product::find($id);
        if($product){
            $product->delete();
            return $this->handleResponse($product, 'Product deleted!');
        }
        else{
            return $this->handleError($product, 'Product not found!');   
        }

    }
}
