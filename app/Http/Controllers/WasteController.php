<?php

namespace App\Http\Controllers;


use App\Waste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class WasteController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $wastes = \App\Waste::all($id);
        $data['wastes'] = $wastes;

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

        $waste = \App\Waste::findOrFail($id);
        $data['waste'] = $waste;
        return view('products/waste',$data);
    }

    public function addwaste(Request $request)
    {
        $waste = new waste;

        
        $waste->name = $request->input('wastesiloname');
        $waste->resource_id = Input::get('wasteresource');
        $waste->Save();
        
        return redirect('home');
    }
    
    public function update(Request $request)
    {

        if(isset($_POST['changewaste']) && $_POST['cwastesiloquantity'] <= 100 ) {

            if($_POST['cwastesiloname'] != null || $_POST['cwastesiloquantity'] !=null ) {
                
                $id = $_POST['id'];
                $waste = \App\Waste::findOrFail($id);
                $waste->name = $_POST['cwastesiloname'];
                $waste->quantity = $_POST['cwastesiloquantity'];
                $waste->Save();

            }

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
            $waste = \App\Waste::findOrFail($id);
            $waste->delete();

        }
        return redirect('home');
    }
}
