<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use PDF;
class DownloadsController extends Controller
{
    public function PDFDownloader($id){
        $invoice = Invoice::find($id);
        $pdf = \PDF::loadView('admin.invoices.print',compact('invoice'))->setOptions(['defaultFont'=>'sans-serif']);
        return $pdf->download('invoice.pdf');
    }
}
