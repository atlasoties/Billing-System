<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\User;
use App\Exports\InvoicesExport;
use App\Notifications\PaidInvoice;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('services')->get();
        return view('admin.invoices.index')->with('invoices',$invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arr['services'] = Service::all();
        return view('admin.invoices.create')->with($arr);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Invoice $invoices,Service $services)
    {
      $validatedData = $request->validate([

            "name" => "required",
            "total" => "required|integer",
            "paid" => "required|integer",
            "invoice_date" => "required",
            "due_date" => "required",
        ],[
            "name.required"=> "You should insert the clients name" ,
            "total.required"=> "You should insert the price of the product" ,
            "total.integer" => "The total price field should only be filled with number",
            "paid.required"=> "You should insert the price of the product" ,
            "paid.integer" => "The total price field should only be filled with number",
            "invoice_date.required"=> "You should specify the starting date" ,
            "due_date.required"=> "You should specify the ending date" ,

        ]);

        $service = collect($request->service_id)->implode(',');
    
        $unique = Invoice::orderBy('id','desc')->pluck('id')->first();
        if($unique == null or $unique == ""){
            $unique = 1000;
        }else{
            $unique = $unique+1000;
        }
        $sendable = $request->email;
        $totalPrice = $request->total;  
        $paid = $request->paid;
        $vat = $totalPrice*0.015;
        $subtotal = $totalPrice - $vat;
        $incVat = $subtotal + $vat;
        $remaining = $totalPrice - $paid ;
        $STATUS_VALUE = $request->status;
        $STATUS = " ";
        if($STATUS_VALUE == 1 && $paid == $totalPrice){
            $STATUS = "PAID";
        }
        elseif($STATUS_VALUE == 2){
            $STATUS = "UNPAID";
        }elseif($STATUS_VALUE == 3){
            $STATUS = "PARTIAL";
        }


        $invoices->total = $totalPrice;
        $invoices->paid = $paid;
        $invoices->remaining = $remaining;
        $invoices->invoice_number = $unique;
        $invoices->subtotal =  $subtotal;
        $invoices->vat = $vat;
        $invoices->incVat = $incVat;
        $invoices->name = $request->name;
        $invoices->companyName = $request->companyName;
        $invoices->address = $request->address;
        $invoices->tinNo = $request->tinNo;
        $invoices->due_date = $request->due_date;
        $invoices->invoice_date = $request->invoice_date;
        $invoices->email = $sendable;
        $invoices->phone = $request->phone;
        $invoices->status = $STATUS;
        $invoices->status_value = $STATUS_VALUE;
        $invoices->save();
        $invoices->services()->attach($service);
        $invoice_id = Invoice::latest()->first()->id;
        /*if(!empty($sendable)){
            Notification::send($sendable, new PaidInvoice($invoice_id));
        }
        $user = User::first();
        Notification::send($user, new PaidInvoice($invoice_id));
        */
        session()->flash('Add','The Invoice has been created successfully');
        return back();
        
    }
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $services,$id)
    {
        $invoice = Invoice::where('id',$id)->with('services')->first();
        return view('admin.invoices.printable',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service,Invoice $invoice)
    {

        $arr['invoice'] = $invoice;
        return view('admin.invoices.edit')->with($arr);
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
        $invoices = Invoice::findOrFail($id);
        $totalPrice = $request->total;  
        $paid = $request->paid;
        $vat = $totalPrice*0.015;
        $subtotal = $totalPrice - $vat;
        $incVat = $subtotal + $vat;
        $remaining = $totalPrice - $paid ;
        $STATUS_VALUE = $request->status;
        $STATUS = "";
        if($STATUS_VALUE == 1){
            $STATUS = "PAID";
        }
        elseif($STATUS_VALUE == 2){
            $STATUS = "UNPAID";
        }elseif($STATUS_VALUE == 3){
            $STATUS = "PARTIAL";
        }
        $invoices->paid = $paid;
        $invoices->remaining = $remaining;
        $invoices->status = $STATUS;
        $invoices->status_value = $STATUS_VALUE;
        $invoices->save();
        session()->flash('Edit','The Invoice has been edited succesfully');
        return redirect()->back();
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
    public function paid()
    {
        $services = Service::all();
        $invoices = Invoice::where('status_value',1)->get();
        return view('admin.invoices.paid',compact('invoices','services'));

    }
    public function unpaid()
    {
        $invoices = Invoice::where('status_value',2)->get();
        $services = Service::all();
        return view('admin.invoices.unpaid',compact('invoices','services'));

    }
    public function partial()
    {
        $services = Service::all();
        $invoices = Invoice::where('status_value',3)->get();
        return view('admin.invoices.partial',compact('invoices','services'));
    }

    
    public function print($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('admin.invoices.print',compact('invoices'));
    }

    public function export()
    {
        ob_end_clean();

        return \Excel::download(new InvoicesExport, 'invoices.xlsx');

    }


    public function MarkAsRead_all (Request $request)
    {

        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }


    }


    public function unreadNotifications_count()

    {
        return auth()->user()->unreadNotifications->count();
    }

    public function unreadNotifications()

    {
        foreach (auth()->user()->unreadNotifications as $notification){

return $notification->data['title'];

        }

    }
}
