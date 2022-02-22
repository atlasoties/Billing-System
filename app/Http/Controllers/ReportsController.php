<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Service;

class ReportsController extends Controller
{
    public function index(){

     return view('admin.reports.search');
        
    }

    public function search(Request $request){

    $rdio = $request->rdio;

    
    if ($rdio == 1) {
       
       
        if ($request->type && $request->start_at =='' && $request->end_at =='') {
           if($request->type=='ALL')
            $invoices = Invoice::all();
           else 
           $invoices = Invoice::select('*')->where('status',[$request->type])->get();
           $type = $request->type;
           return view('admin.reports.search',compact('type'))->withDetails($invoices);
        }
        
        else {
           
          $start_at = date($request->start_at);
          $end_at = date($request->end_at);
          $type = $request->type;
          if($request->type=='ALL')
            $invoices = Invoice::select('*')->whereBetween('invoice_date',[$start_at,$end_at])->get();
          else
            $invoices = Invoice::whereBetween('invoice_date',[$start_at,$end_at])->where('status','=',$request->type)->get();
          
          
      return view('admin.reports.search',compact('type','start_at','end_at'))->withDetails($invoices);
          
        }

    } 
    
    elseif ($rdio == 2) {
       # code...
     
        
        $invoices = Invoice::select('*')->where('invoice_number','=',$request->invoice_number)->get();
        return view('admin.reports.search')->withDetails($invoices);
        
    }

    
  
    }
    
}