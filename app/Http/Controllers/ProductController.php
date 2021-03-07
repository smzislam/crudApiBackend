<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use  App\Models\Product;

class ProductController extends Controller
{
     /**
     * Instantiate a new ProductController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    /**
     * Get all Products.
     *
     * @return Response
     */
    public function allProducts()
    {
         return response()->json(['products' =>  Product::all()], 200);
    }

    /**
     * Get one product.
     *
     * @return Response
     */
    public function singleProduct($id)
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json(['product' => $product], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'Product not found!'], 404);
        }

    }

    /**
     * Create product.
     *
     * @return Response
     */
    public function insertProduct(Request $request)
    {
        

        //validate incoming request 
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
        ]);

       
        try {
            
            if($request->hasFile('image')){
                $allowedfileExtension=['jpg','png','gif'];
                $file = $request->file('image');
            
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                $newFilename= time().$filename;

                $destinationPath = public_path('upload');

                $check=in_array($extension,$allowedfileExtension);
                if($check){
                    
                    $path=$file->move( $destinationPath, $newFilename);
    
                    $imageurl= "upload/".$newFilename;
                   
                }
            }else{
                $imageurl=$request->image;
            }
            $product = new Product();
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->image = $imageurl;

            $product->save();

            //return successful response
            return response()->json(['product' => $product, 'message' => 'A new product added.'], 201);   
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Failed to add a new product!'], 409);
        }

    }

    /**
     * Update product.
     *
     * @return Response
     */
    public function updateProduct(Request $request, $id){

        try {
            $product= Product::find($id);
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->image = $request->image;
            $product->save();
            //return successful response
            return response()->json(['product' => $product, 'message' => 'Product updated successfully.'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Failed to update product!'], 409);
        }

    }

     /**
     * Delete product.
     *
     * @return Response
     */
    public function deleteProduct($id){

        try {
            $product= Product::find($id);
            $product->delete();
            //return successful response
            return response()->json(['message' => 'Product successfully deleted.'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Failed to delete product!'], 409);
        }

    }

}