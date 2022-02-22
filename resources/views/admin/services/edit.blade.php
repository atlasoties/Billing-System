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
          <li class="nav-item menu-open">
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
    <section class="content">
    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
        <div class="container-fluid">
            <form action="{{ route('services.update',$service->id) }}" method='post'>
            @csrf
            @method('put')
                <div class='form-groups'>
                    <div class="row">
                        <label class="col-md-3">Service Name</label>
                        <div class="col-md-6"><input type="text" name="name" value="{{$service->name}}" class="form-control" >
                        </div>
                    </div><br>
                    <div class='form-groups'>
                    <div class="row">
                        <label class="col-md-3">Service Price</label>
                        <div class="col-md-6"><input type="number" name="price" value="{{$service->price}}"  class="form-control">
                        </div>
                    </div>
                </div><br>
                <div class='form-groups'>
                    <div class="row">
                        <label class="col-md-3">Service Description</label>
                        <div class="col-md-6"><input type="text" name="description" value="{{$service->description}}"  class="form-control">
                        </div>
                    </div>
                </div><br>
                <div class="form-groups">
                <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </section>
    @endsection