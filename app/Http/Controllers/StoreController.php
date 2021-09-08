<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('store.index' , compact('products', $products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('store.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new product;
        $request->validate([
            'name' => 'required|max:255',
            'price' =>  'required|numeric',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stok = $request->stok;
        $product->description = $request->description;
        $product->status = $request->status;
        if ($request->warranty == 'yes') {
            $product->warranty = true;
        } else {
            $product->warranty = false;
        }


        $product->save();


        // por cada imgen que va a llegar en el request
        foreach($request->image as $image){
            $name = $image->getClientOriginalName().'.'.$image->getClientOriginalExtension() ;
            $url = $image->getClientOriginalName().'.'.$image->getClientOriginalExtension();

            //los archivos se guardan en storage/app/public/images
            Image::make($image)->save(public_path('storage/images/'.$url));



            $newImage = new \App\Models\Images;

            $newImage->name = $name;
            $newImage->url = $url;
            $newImage->product_id = $product->id;

            $newImage->save();
        }

        return redirect()->route('store.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $images = Images::all()->where('product_id', '=', $product->id);
        return view('store.show', compact('product','images'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view( 'store.edit', compact('product',$product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stok = $request->stok;
        $product->description = $request->description;
        $product->status = $request->status;

        if ($request->warranty == "yes") {
            $product->warranty = true;
        } else {
            $product->warranty = false;
        }

        $product->update();

        if(count($request->files) > 0) {
            $images = Images::all()->where('product_id', '=', $product->id);

            foreach ($images as $image) {
                //$exists = Storage::disk('local')->exists(public_path('storage/images/'.$image->url));
                //if ($exists) {
                    //Storage::delete(public_path('storage/images/'.$image->url));
                    Images::destroy($image->id);
                //}
            }

            // por cada imgen que va a llegar en el request
            foreach($request->image as $image){
                $name = $image->getClientOriginalName().'.'.$image->getClientOriginalExtension() ;
                $url = $image->getClientOriginalName().'.'.$image->getClientOriginalExtension();

                //los archivos se guardan en storage/app/public/images
                Image::make($image)->save(public_path('storage/images/'.$url));



                $newImage = new \App\Models\Images;

                $newImage->name = $name;
                $newImage->url = $url;
                $newImage->product_id = $product->id;

                $newImage->save();
            }
            return redirect()->route('store.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $images = Images::all()->where('product_id', '=', $product->id);
        //eliminar imagenes de forma fisica
        foreach ($images as $image) {
            //$exists = Storage::disk('local')->exists(public_path('storage/images/'.$image->url));
            //if ($exists) {
                //Storage::delete(public_path('storage/images/'.$image->url));
                Images::destroy($image->id);
                //los archivos se guardan en storage/app/public/images
                //Image::make($image)->save(public_path('storage/images/'.$url));
            //}
        }
        //el destroy elimina el registro en la base de datos de manera simbolica a travez de softdeletes
        Product::destroy($product->id);
        
        return redirect()->route('store.index');
        
    }
}
