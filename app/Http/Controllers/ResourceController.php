<?php

namespace App\Http\Controllers;

use App\Product;
use App\Resource;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $resource = \App\Resource::findOrFail($id);
        $stock = \App\Stock::findOrFail($id);
        $data['resource'] = $resource;
        $data['stock'] = $stock;
        return view('products/show', $data);
    }

    public function new_resource()
    {
        //
        return view('products/add');
    }

    public function add(Request $request)
    {
        if($_FILES['resource']['size'] != 0) {
            $resource = new resource;
            $stock = new stock;
            $file = $_FILES["resource"]["name"];
            $array = explode('.', $file);
            $fileName=$array[0];
            $fileExt=$array[1];
            $newfile=$fileName."_".time().".".$fileExt;
            $request->resource->move(public_path('images'), $newfile);
            $resource->type = $request->input('name');
            $resource->img = "$newfile";
            $stock->quantity = $request->input('quantity');
            $resource->Save();
            $stock->resource_id = $resource->id;
            $stock->Save();

        }
        return redirect('home');
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
        //
        if($_FILES['resource']['size'] != 0){
            $id = $_POST['id'];  
            $resource = \App\Resource::findOrFail($id);
            $request->resource->move(public_path('images'),"resource_$id._$resource->updated_at.jpg");
            $resource->img = "resource_$id._$resource->updated_at.jpg";
            $resource->Save();
        }
        elseif ($request->input('type') != null){
            $id = $_POST['id'];
            $resource = \App\Resource::findOrFail($id);
            $resource->type = $request->input('type');
            $resource->save();
        }
        elseif ($request->input('quantity') != null){
            $id = $_POST['id'];
            $stock = \App\Stock::findOrFail($id);
            $stock->quantity = $request->input('quantity');
            $stock->save();
        }
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        if(isset($_POST['delete'])) {
            $id = $_POST['id'];
            $resource = \App\Resource::findOrFail($id);
            $resource->delete();
        }
        return redirect('home');
    }
}
