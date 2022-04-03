@extends('layouts.main')
 
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products Listing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                    
                    <div class="text-right mb-2">
                        <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                    </div>
                </div>
            </div>
           
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
           
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                        <form action="{{ route('products.destroy',$product->id) }}" method="POST">
           
                            <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
            
                            <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
           
                            @csrf
                            @method('DELETE')
              
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
          
            {!! $products->links() !!}
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



   
      
@endsection