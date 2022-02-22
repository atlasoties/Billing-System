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
    <!--- Internal Select2 css-->

    @if (session()->has('Add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        <div class="row">
    
                                <div class="col">
                                    <label for="inputName" class="control-label">Client Name</label>
                                    <input type="text" id="client" name="name" class="form-control" value="{{old('name')}}" required >
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">Client Email</label>
                                    <input type="text" name="email" class="form-control"  value="{{old('email')}}">
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">Phone No</label>
                                    <input type="text" id="client" name="phone" class="form-control"  value="{{old('phone')}}">
                                </div>

                        </div>

                            <div class="row">
                                <div class="col">
                                    <label for="inputName" class="control-label">Company Name</label>
                                    <input type="text" id="client" name="companyName" class="form-control" value="{{old('companyName')}}">
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">Tin No</label>
                                    <input type="text" id="client" name="tinNo" class="form-control" value="{{old('tinNo')}}">
                                </div>
                                <div class="col">
                                    <label for="inputName" class="control-label">Address</label>
                                    <input type="text" id="client" name="address" class="form-control" value="{{old('address')}}">
                                </div>
                            </div>

                         <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Service</label>
                                <select name="service_id" multiple ="multiple" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" required>
                                    <!--placeholder-->
                                    <option value="" selected disabled>Choose One</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"> {{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                                <div class="col">
                                    <label>Invoice Date</label>
                                    <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                        type="text" value="{{ date('Y-m-d') }}" value="{{old('invoice_date')}}" required>
                                </div>
                                <div class="col">
                                    <label>Due Date</label>
                                    <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                        type="date" value="{{old('due_date')}}" required>
                                </div>
                        </div>
            


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">Total</label>
                                <input type="number" class="form-control form-control-lg" id="total"
                                    name="total" value="{{old('total')}}" required>

                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">Paid</label>
                                <input type="number"  class="form-control form-control-lg" id="total"
                                    name="paid" value="{{old('paid')}}" required>
                            </div>
                            <div class="col">
                                <label for="inputName" class="control-label">Status</label>
                                <select name="status" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')" required>
                                     <option value=1>PAID</option>
                                      <option value=2>UNPAID</option>
                                      <option value=3>PARTIAL</option>      
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Finish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection