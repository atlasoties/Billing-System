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
          <li class="nav-item menu-open">
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
          <li class="nav-item">
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
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Customers</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active">Customers</li>
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
      <p><a href="{{ route('customers.create')}}" class="btn btn-primary">Add New Customer</a></p>
      @if(count($customers))
      <table class="table table-bordered table-striped">
       <tr>
            <th>#</th>
            <th>Name</th>
            <th>email</th>
            <th>address</th>
            <th>company</th>
            <th>tin no</th>
            <th>phone</th>
            <th>Operation</th>
        </tr>
       <?php $i=0;?>
        @foreach($customers as $c)
        <?php $i++;?>
            <tr>
                <td>{{$i}}</td>
                <td>{{$c->name}}</td>
                <td>{{$c->email}}</td>
                <td>{{$c->address}}</td>
                <td>{{$c->phone}}</td>
                <td>{{$c->companyName}}</td>
                <td>{{$c->tinNo}}</td>
                
                <td><button type="button" class="btn btn-info dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                    <a class="dropdown-item" href="{{route('customers.show',$c->id)}}">Add new invoice</a>
                    <a class="dropdown-item" href="{{route('invoices.show',$c->id)}}">See invoice</a>
                    <a class="dropdown-item" href="{{route('customers.edit',$c->id)}}">Edit</a>
                    <a class="dropdown-item" href="javascript:void(0)" onclick="$(this).parent().find('form').submit()">Delete</a>
                <form action="{{ route('customers.destroy',$c->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                </form>
                </td>
            </tr>
        @endforeach
       
      </table>
       @else
        <p class="breadcrumb-item active">No Customer Records Found</p>
      @endif
    </section>
    </div>
@endsection