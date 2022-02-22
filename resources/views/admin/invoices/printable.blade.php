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
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img src="{{asset('dist/img/prime.png')}}" height="120" width="324">
                    <small class="float-right">Date: {{date('l')}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
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
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                  <strong>Invoiced To</strong><br>
                    {{$invoice->address}}<br>
                    ATTN: {{$invoice->name}}<br>
                   Company Name: {{$invoice->companyName}}
                    Tin#: {{$invoice->tinNo}}<br>
                    Address: {{$invoice->address}}<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice : {{$invoice->invoice_number}}</b><br>
                  <br>
                  <b>Payment Due:</b> {{$invoice->due_date}}<br>
                  <b>Account:</b> 968-34567
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
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
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
                      <td>{{number_format($invoice->total,2)}} ETB</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>Subtotal</b></td>
                      <td>{{number_format($invoice->subtotal,2)}} ETB</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>VAT</b></td>
                      <td>{{number_format($invoice->vat,2)}} ETB</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>Inc. VAT</b></td>
                      <td>{{number_format($invoice->incVat,2)}} ETB</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td><b>Credit</b></td>
                      <td>{{number_format($invoice->credit,2)}} ETB</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button onclick="window.addEventListener('load', window.print());" type="button" class="btn btn-success float-right">
                  <i class="far fa-credit-card"></i>Print </button>
                 <a href="{{url('download',$invoice->id)}}"> <button  type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button></a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


@endsection
