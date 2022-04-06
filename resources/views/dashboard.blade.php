@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$data['verifiedUsers']}}</h3>

                <p>Active and Verified users</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$data['verifiedUsersActiveProducts']}}</h3>

                <p>Active and verified users who have attached active products</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$data['activeProducts']}}</h3>

                <p>All active products</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$data['activeProductsNoUserBelongs']}}</h3>

                <p>Active products which don't belong to any user</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

           <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$data['activeAttachedProductCount']['count']}}</h3>

                <p>Count of all active attached products</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

             <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$data['activeAttachedProductCount']['price']}}</h3>

                <p>Summarized price of all active attached products</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<hr/>
      <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Summarized prices of all active products per user</h2>
                </div>
                
            </div>
        </div>
        <table class="table table-bordered">
                <tr>
                    <th>User</th>
                    <th>Summarized prices of all active products per user</th>
                  
                </tr>
               
               @if($data['activeAttachedProductCount']['priceProductsPerUser'])
                    @foreach ($data['activeAttachedProductCount']['priceProductsPerUser'] as $key => $value)
                  <tr>
                    <td>{{$key}}</td>
                      <td>{{$value}}</td>
                      
                  </tr>
                  @endforeach
                @endif
                
            </table>
    </div><!-- /.container-fluid -->
    </section>

  <hr/>
      <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Exchange rates for USD and RON based on Euro using https://exchangeratesapi.io/ .</h2>
                </div>
                
            </div>
        </div>
        <table class="table table-bordered">
                <tr>
                    <th>User</th>
                    <th>Summarized prices of all active products per user</th>
                  
                </tr>
               
               @if($data['fetchExchangeRateAPI'])
                    @foreach ($data['fetchExchangeRateAPI'] as $key => $value)
                  <tr>
                    <td>{{$key}}</td>
                      <td>{{$value}}</td>
                      
                  </tr>
                  @endforeach
                @endif
                
            </table>
    </div><!-- /.container-fluid -->
    </section>

  </div>
@endsection
