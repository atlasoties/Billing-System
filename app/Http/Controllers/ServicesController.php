<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $arr['services'] = Service::orderBy('created_at','desc')->get();
        return view('admin/services/index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/services/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            "name" => "required|unique:services",
            "price" => "required|integer|min:0",
        ],[
            "name.required"=> "Oops!It seems that you didn't name your product" ,
            "name.unique"=> "The name of the product has already been taken" ,
            "price.required"=> "Oops!It seems that you didn't insert the price of your product" ,
            "price.integer"=> "Oops!It seems that you didn't insert a number on the price field" ,

        ]);

    
      
            Service::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);
            session()->flash('Add','The Service is added succesfully');
            return redirect('/services');
        
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $arr['service'] = $service;
        return view('admin/services/edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service )
    {
        $this->validate($request,[

            "name" => "required|unique:services",
            "price" => "required|integer|min:0",
        ],[
            "name.required"=> "Oops!It seems that you didn't name your product" ,
            "name.unique"=> "You didn't edit the name of the product" ,
            "price.required"=> "Oops!It seems that you didn't insert the price of your product" ,
            "price.integer"=> "Oops!It seems that you didn't insert a number on the price field" ,

        ]);
        
        $service->name = $request->name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->save();
        session()->flash('Add','The Service is Edited succesfully');
        return redirect('/services'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect('/services');
    }
}
