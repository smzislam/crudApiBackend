<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use  App\Models\Pimage;

class ImageController extends Controller
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
     * Create product.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $file = $request->hasFile('pimage_link');
        // return response()->json($file);
       
        try {
            
            if($request->hasFile('pimage_link')){
                $allowedfileExtension=['jpg','png','gif'];
                $file = $request->file('pimage_link');
            
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                $newFilename= time().$filename;

                $destinationPath = public_path('upload');

                $check=in_array($extension,$allowedfileExtension);
                if($check){
                    
                    $path=$file->move( $destinationPath, $newFilename);
    
                    $imageurl= "public/upload/".$newFilename;
                   
                }
            }else{
                $imageurl=$request->image;
            }
            $pimage = new Pimage();
            $pimage->pimage_link = $imageurl;
            $pimage->save();

            //return successful response
            return response()->json(['pimage' => $pimage, 'message' => 'A new product Image added.'], 201);   
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'Failed to add a new product Image!'], 409);
        }

    }

    

}