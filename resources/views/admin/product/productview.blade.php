@extends('layouts/admin')

{{-- Page title --}}
@section('title')
Product View
@parent
@stop

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small>Product List </small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Product List</h3>
         <button class="btn btn-info"><a href="{{ route('product.create.view')}}">Add Product</a></button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                 <tr>
                    <th>Product Id</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Product Type</th>
                    <th>Product Image</th>
                    <th>Description</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Update | Delete</th>
                  </tr>
                </thead>
                <tbody id="product_details">
                  @if (is_array($products) || is_object($products))
                      @foreach ($products as $product)
                        <tr>
                          <td>{{ $product->product_id }}</td>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->amount }}</td>
                          <td>{{ $product->product_type }}</td>
                          <td class="text-center"><img src="{{ asset('productimages\/'.$product->product_image) }}" class="product_list_img"/></td>
                          <td>{{ $product->description }}</td>
                          <td>{{ $product->created_at }}</td>
                          <td>{{ $product->updated_at }}</td>
                          <td>
                            <a href="" class="btn-success btn-xs"  
                              onclick="editProduct(event,{{ $product->product_id }})">Update</a> 
                              @include('admin.product.updateproduct')
                            <a href="" class="btn-danger btn-xs" id="product_delete" 
                              onclick="deleteProduct(event,{{ $product->product_id }})">Delete</a> 
                              @include('admin.product.deleteproduct')
                          </td>
                        </tr>
                      @endforeach
                  @endif
                    
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
@stop
@section('page-script')
<script type="text/javascript">
    function deleteProduct(e,product_id){
      e.preventDefault();
      $('#delete_product_model').modal('show');
      $('#delete_product_id').val('');
      $('#delete_product_id').val(product_id);
    }
    function editProduct(e,product_id){
      $('#product_update_success').text('');
      $('#product_update_fail').text('');
      e.preventDefault();
      $('#update_product_model').modal('show');
      $('#update_product_id').val('');
      $('#update_product_id').val(product_id);
      $.get( 
          "{{ route('product.edit') }}",
           {product_id:product_id},
          function(data){
            $("#productname").val(data[0].name);
            $("#productamount").val(data[0].amount);
            $("#producttype").val(data[0].product_type);
            $("#description").val(data[0].description);
          }
        )
    }
</script>
@stop