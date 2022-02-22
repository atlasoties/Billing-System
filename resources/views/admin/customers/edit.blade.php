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
            <h1 class="m-0">Edit Services</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit Services</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('customers.update',$customer->id) }}" method='post'>
            @csrf
            @method('put')
                <div class='form-groups'>
                    <div class="row">
                        <label class="col-md-3">Name</label>
                        <div class="col-md-6"><input type="text" name="name" value="{{$customer->name}}" class="form-control">
                        </div>
                    </div>
                    <div class='form-groups'>
                    <div class="row">
                        <label class="col-md-3">Email</label>
                        <div class="col-md-6"><input type="email" name="email" value="{{$customer->email}}"  class="form-control">
                        </div>
                    </div>
                    <div class='form-groups'>
                    <div class="row">
                        <label class="col-md-3">Company Name</label>
                        <div class="col-md-6"><input type="text" name="companyName" value="{{$customer->companyName}}"  class="form-control">
                        </div>
                    </div>
                    <div class='form-groups'>
                    <div class="row">
                        <label class="col-md-3">Tin No</label>
                        <div class="col-md-6"><input type="text" name="tinNo" value="{{$customer->tinNo}}"  class="form-control">
                        </div>
                    </div>
                    <div class='form-groups'>
                    <div class="row">
                        <label class="col-md-3">Address</label>
                        <div class="col-md-6"><input type="text" name="address" value="{{$customer->address}}"  class="form-control">
                        </div>
                    </div>
                    <div class='form-groups'>
                    <div class="row">
                        <label class="col-md-3">Phone</label>
                        <div class="col-md-6"><input type="text" name="phone" value="{{$customer->phone}}"  class="form-control">
                        </div>
                    </div>
                </div>
                <div class='form-groups'>
                    <div class="row">
                        <label class="col-md-3">Service</label>
                        <div class="col-md-6">
                        <select name="service_id" multiple class="form-control">
                        <option value="">Choose Service</option>
                        
                          @foreach($services as $s)
                          <option value="{{$s->id}}"
                          @if($s->id == $customer->service_id)
                            selected
                          @endif
                          >{{$s->name}}</option>
                          @endforeach
                        </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="form-groups">
                <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </section>
    @endsection