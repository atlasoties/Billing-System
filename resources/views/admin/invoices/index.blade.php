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
              <li style="background-color:rgba(255,255,255,.1)">
                <a href="{{ route('invoices.index') }}" class="nav-link" style="color:white">
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
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Invoices</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Invoices</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
    @if(session()->has('Add'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session()->get('Add')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    @if(session()->has('Edit'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session()->get('Edit')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
      <div class="container-fluid">
      <p><a href="{{ route('invoices.create')}}" class="btn btn-primary">Create New Invoice</a></p>
      @if(count($invoices))
      <table id="example1" class="table table-bordered table-striped">
      <thead>
       <tr>
            <th class="border-bottom-0">#</th>
            <th class="border-bottom-0">INVOICE#</th>
            <th class="border-bottom-0">CREATED</th>
            <th class="border-bottom-0">EXPIRES</th>
            <th class="border-bottom-0">FULL NAME</th>
            <th class="border-bottom-0">SERVICE</th>
            <th class="border-bottom-0">STATUS</th>
            <th class="border-bottom-0">TOTAL</th>
            <th class="border-bottom-0">ACTION</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=0; ?>
        @foreach($invoices as $invoice)
       <tr>
        <?php $i++; ?>
            <td>{{$i}}</td>
            <td>{{$invoice->invoice_number}}</td>
            <td>{{$invoice->invoice_date}}</td>
            <td>{{$invoice->due_date}}</td>
            <td>{{$invoice->name}}</td>
            <td>
            @foreach($invoice->services as $service)
               {{$service->name}}
            @endforeach
            </td> 
            <td>
            @if($invoice->status_value==1)
              <span class="badge badge-success">{{$invoice->status}}</span>
            @elseif($invoice->status_value==2)
              <span class="badge badge-danger">{{$invoice->status}}</span>
            @else
               <span class="badge badge-warning">{{$invoice->status}}</span>
            @endif
            </td> 


            <td>{{$invoice->total}}</td>
                
                <td> <button type="button" class="btn btn-info dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="{{route('invoices.edit',$invoice->id)}}">Edit</a>
                      <a class="dropdown-item" href="{{route('invoices.show',$invoice->id)}}">Show</a>
                      <a class="dropdown-item" href="{{url('download',$invoice->id)}}">Download</a>
                      <a class="dropdown-item" href="{{url('invoices/print',$invoice->id)}}">Print</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </td>
            </tr>
        @endforeach
      </tbody>
      </table>
      @else
        <p>No Invoice Records</p>
      @endif
    </section>
    </div>
@endsection