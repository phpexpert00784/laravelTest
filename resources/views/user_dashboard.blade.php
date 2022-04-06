@extends('layouts.main')
  
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Products Listing</h1> -->
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
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Pick Products</h2>
                </div>
                
            </div>
        </div>
           
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
         @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
         @endif
        <form action="{{ route('userproducts.store') }}" method="POST">
            @csrf
          
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Products:</strong>
                        <select class="form-control" name="product_id" >
                               @foreach ($products as $product)
                               	<option value="{{$product->id}}">{{$product->title}}</option>   
                               @endforeach
                        </select> 
                    </div>
                </div>
                
                <div class="form-row col-md-12">
                    <div class="col-md-6">
                    	<div class="form-group">
	                        <strong>Quantity:</strong>
	                        <select class="form-control" name="quantity" >
	                            <option value="1">1</option>   
	                            <option value="2">2</option>   
	                            <option value="3">3</option>   
	                            <option value="4">4</option>   
	                            <option value="5">5</option>   
	                            <option value="6">6</option>   
	                            <option value="7">7</option>   
	                            <option value="8">8</option>   
	                            <option value="9">9</option>   
	                            <option value="10">10</option>   
	                             
	                        </select> 
	                    </div>
                	</div>
                	<div class="col-md-6">
                    	<div class="form-group">
	                        <strong>Price per quantity:</strong>
	                        <input type="number" name="price"  required class="form-control" placeholder="Enter Price">
	                    </div>
                	</div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
           
        </form>
 	</div><!-- /.container-fluid -->
   </section>
<hr/>

       <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Picked Products</h2>
                </div>
                
            </div>
        </div>
        <table class="table table-bordered">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
               
               @if($userproducts)
                    @foreach ($userproducts as $pro)
               		<tr>
                		<td>{{$pro->product->title}}</td>
	                    <td>{{$pro->quantity}}</td>
	                    <td>{{$pro->price}}</td>
	                    <td>{{$pro->quantity * $pro->price}}</td>
                	</tr>
                 	@endforeach
                @endif
                
            </table>
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection