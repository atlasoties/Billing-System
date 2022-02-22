<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Service;
use App\Models\Sale;
class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr['customers'] = Customer::all();
        $arr['services'] = Service::all();
        return view('admin/customers/index')->with($arr);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['services'] = Service::all();
        return view('admin/customers/create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Customer $customer)
    {
        $request->validate([

            "name" => "required",
            "email" => "required",
            "phone" => "required"
        
        ]);
        

        //$customer->service_id = $request->service_id;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->companyName = $request->company;
        $customer->tinNo = $request->tin;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();
        return redirect('/customers'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arr["services"] = Service::all();
        $arr["customer"] = Customer::where('id',$id)->get();
        return view("admin.customers.add")->with($arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $arr['customer'] = $customer;
        $arr['services'] = Service::all();
        return view('admin/customers/edit')->with($arr);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Customer $customer)
    {
        $request->validate([

            "name" => "required",
            "email" => "required",
            "phone" => "required"
        
        ]);

       // $customer->service_id = $request->service_id;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->companyName = $request->company;
        $customer->tinNo = $request->tin;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();
        return redirect('/customers'); 
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
