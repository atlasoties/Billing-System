 @extends('layouts.admin2')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@if(count($invoices))
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <span class="input-group-append">
         <button type="button" class="btn btn-primary">Send</button>
      </span>
      <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> {{App\Models\Invoice::where('status','PAID')->count()/App\Models\Invoice::count()*100}}%</span>
                      <h5 class="description-header">{{number_format(App\Models\Invoice::where('status','PAID')->sum('total'),2)}} ETB</h5>
                      <span class="description-text">TOTAL PAID {{App\Models\Invoice::where('status','PAID')->count()}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-warning"><i class="fas fa-caret-right"></i> {{App\Models\Invoice::where('status','PARTIAL')->count()/App\Models\Invoice::count()*100}}%</span>
                      <h5 class="description-header">{{number_format(App\Models\Invoice::where('status','PARTIAL')->sum('total'),2)}} ETB</h5>
                      <span class="description-text">TOTAL PARTIAL PAID {{App\Models\Invoice::where('status','PARTIAL')->count()}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>{{App\Models\Invoice::where('status','UNPAID')->count()/App\Models\Invoice::count()*100}}%</span>
                      <h5 class="description-header">{{number_format(App\Models\Invoice::where('status','UNPAID')->sum('total'),2)}} ETB</h5>
                      <span class="description-text">TOTAL UNPAID {{App\Models\Invoice::where('status','UNPAID')->count()}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-info"> 100%</span>
                      <h5 class="description-header">{{number_format(App\Models\Invoice::sum('total'),2)}} ETB</h5>
                      <span class="description-text">TOTAL SALES {{App\Models\Invoice::count()}} </span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
<div class="col-md-8">
     <!-- TABLE: LATEST ORDERS -->
     <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Sales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>#</th>
                      <th>Item Name</th>
                      <th>Client name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;?>
                    @foreach($invoices as $invoice)
                      <tr>
                      <td>#{{$invoice->invoice_number}}</td>
                      <td>
                          @foreach($invoice->services as $service)
                             {{$service->name}}
                           @endforeach
                      </td>
                      <td>{{$invoice->name}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
        
                </div>
                </div>
                <!-- /.table-responsive -->
              </div>
      </div>
            @else
            <p>No Datas Found</p>
            @endif
              </div>
      </section>
      @endsection