<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductsController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show(Product $product)
    {
        // Log::debug($product->category);
        $product->category;
        return $product;
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'image' => 'required|image:jpeg,png,jpg|max:10000'
        // ]);
        // if ($validator->fails()) {
        //     return response()->json($validator->messages()->first(), 400);
        // }

        // return response()->json($request, 201);


        if ($request->hasFile('photo')) {
            $image = $request->photo;

            if ($image->getClientOriginalExtension() != 'jpg' && $image->getClientOriginalExtension() != 'jpeg' && $image->getClientOriginalExtension() != 'png') {
                return response()->json("Image type is not correct", 400);
            }

            $uploadFolder = 'products_images';
            $fileNameToStore = $image->store($uploadFolder, 'public');
            // return response()->json($fileNameToStore, 201);


            //     $Name = time() . '.' . $image->getClientOriginalExtension();

            //     $destinationPath = public_path('storage/products_images');
            //     $img = Image::make($image->getRealPath());
            //     $img->resize(300, 550, function ($constraint) {
            //         $constraint->aspectRatio();
            //     })->save($destinationPath . '/' . time() . $image->getClientOriginalName());

            //     /*$user->profileImg = time().$image->getClientOriginalName();*/
            //     $fileNameToStore = time() . $image->getClientOriginalName();

            //     // $destinationPath = public_path('/storage/images');
            //     //$image->move($destinationPath, $Name);


        } else {
            return response()->json("Please provide an image", 400);
        }
        $request->image = $fileNameToStore;
        $request['image'] = $fileNameToStore;

        // $request->image = Storage::disk('public')->url($fileNameToStore);
        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('photo')) {
            $image = $request->photo;
            if ($image->getClientOriginalExtension() != 'jpg' && $image->getClientOriginalExtension() != 'jpeg' && $image->getClientOriginalExtension() != 'png') {
                return response()->json("Image type is not correct", 400);
            }
            $uploadFolder = 'products_images';
            $fileNameToStore = $image->store($uploadFolder, 'public');
            $request->image = $fileNameToStore;
            $request['image'] = $fileNameToStore;
        }
        $product->update($request->all());

        return response()->json($product, 200);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }

    public function getByNumber(Request $request, $number){
        return Product::orderBy('rating')
        ->take($number)
        ->get();
    }

}
