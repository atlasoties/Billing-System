@extends('layouts.admin')
@section('active')
<li class="nav-item">
            <a href="{{url('/home')}}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('customers.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Customers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('services.index') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Services
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Invoice
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('invoices.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> All Invoices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('invoices/paid') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paid Invoices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('invoices/unpaid') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unpaid Invoices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('invoices/partial') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Partial Paid</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{url('show/reports')}}" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
@endsection
@section('content')
<div class ="row">
<div class ="col">
 <div class = "breadcrumb-header justify-content-between">
 <div class="my-auto" style="text-align:right">
                  <h5>PRIME SOFTWARE Plc</h5>
                  <address style="font-size:13px">
                    Mexico, K/KARE Building<br>
                    4<sup>th</sup> Floor Suite 48/2<br>
                    Addis Ababa<br>
                    Ethiopia<br><br>
                    Tel: 0115 575879<br>
                    Fax: 0115 575873<br>
                    Mob: 0913 798523<br><br>
                    Tin#: 0049521288
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                  <h6><b>Invoice {{$invoice->invoice_no}}</b></h6>
                  <span style="font-size:13px">
                  Invoice Date: {{$invoice->invoice_date}}<br>
                  Due Date: {{$invoice->due_date}}
                  <br><br>
                  </span>
                  
                  <address style="font-size:13px">
                    <strong>Invoiced To</strong><br>
                    {{$invoice->address}}<br>
                    ATTN: {{$invoice->name}}<br>
                    {{$invoice->companyName}}
                    Tin#: {{$invoice->tinNo}}<br>
                    {{$invoice->address}}<br>
                    Ethiopia
                  </address>
                  <br><br>
                </div>
                
                <!-- /.col -->
              </div>
              <div class="col-sm-4 invoice-col">
                  <br><br><br><br><br><br><br><br>
                  @if($invoice->status_value==1)
                    <h1 class="text-success"><b>{{$invoice->status}}</b></h1>
                  @elseif($invoice->status_value==2)
                    <h1 class="text-danger"><b>{{$invoice->status}}</b></h1>
                  @else
                   <h1 class="text-warning"><b>{{$invoice->status}}</b></h1>
                  @endif
                  
                </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table ">
                    <thead>
                    <tr style="text-align:center">
                      <th>Description</th>
                      <th></th>
                      <th>Value</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      @foreach($invoice->services as $service)
                      <td>{{$service->description}} - {{$invoice->companyName}} ({{$invoice->invoice_date}} - {{$invoice->due_date}})</td>
                      @endforeach
                      <td><b>Price</b></td>
                      <td>{{$invoice->total}} ETB</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>Subtotal</b></td>
                      <td>{{$invoice->subtotal}} ETB</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>VAT</b></td>
                      <td>{{$invoice->vat}}ETB</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>Inc. VAT</b></td>
                      <td>{{$invoice->incVat}} ETB</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>Credit</b></td>
                      <td>{{$invoice->credit}}ETB</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>Total</b></td>
                      <td>{{$invoice->total}}ETB</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="#" rel="noopener" target="_blank" class="btn btn-default" onclick="printInvoice()"><i class="fas fa-print"></i> Print</a>
              
                 <a > <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF</a>
                  </button>
                </div>
              </div>
            </div>
            </div>
       
  @endsection


    <style>
    @media print{
        #print_Button{
            display:none;
        }
    }
</style>

<script type='text/javascript'>

function printInvoice(){
    var printableContent = document.getElementById('print').innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printableContent;
    window.print();
    document.body.innerHTML = originalContent;
    location.reload();
}

</script>