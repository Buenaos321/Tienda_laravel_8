<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
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
            $name = time().'.'.$image->getClientOriginalExtension();
            $url=public_path('images').'/'.$name;
            Image::make($image)->save($url);



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
        return view('store.show', compact($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view( 'store.edit', compact($id));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
