@extends('layouts/admin')

{{-- Page title --}}
@section('title')
Product Create
@parent
@stop

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Create
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Product Create</h3>
            </div>
            @if(Session('fail'))  
              <div class="row"> 
                <div class="col-md-6 col-sm-12 col-md-offset-2 col-sm-offset-3" >
                 <span class="text-danger"> {{ Session('fail') }} </span>
                </div>
              </div>
            @endif
            @if(Session('success'))  
              <div class="row">
                <div class="col-md-6 col-sm-12 col-md-offset-2 col-sm-offset-3" >
                 <span class="text-success"> {{ Session('success') }}</span> 
                </div>
              </div>
            @endif
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                <form role="form" action="{{ route('product.create.submit')}}" method="post" enctype="multipart/form-data">
                   {{ csrf_field() }}
                  <div class="box-body">
                    <div class="form-group{{ $errors->has('productname') ? ' has-error' : '' }}">
                      <label for="productname">Product Name</label>
                      <input type="text" class="form-control" id="productname" name="productname" placeholder="Enter product name" value="{{ old('productname') }}">
                      @if ($errors->has('productname'))
                          <span class="help-block">
                              <strong>{{ $errors->first('productname') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('productamount') ? ' has-error' : '' }}">
                      <label for="productamount">Product Amount</label>
                      <input type="text" class="form-control" id="productamount" name="productamount" placeholder="Enter product amount" value="{{ old('productamount') }}">
                      @if ($errors->has('productamount'))
                          <span class="help-block">
                              <strong>{{ $errors->first('productamount') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('producttype') ? ' has-error' : '' }}">
                      <label>Product Type</label>
                      <select class="form-control" name="producttype" value="{{ old('producttype') }}">
                        <option value="">--Select Type--</option>
                        <option value="simple">Simple</option>
                        <option value="virtual">Virtual</option>
                      </select>
                      @if ($errors->has('producttype'))
                          <span class="help-block">
                              <strong>{{ $errors->first('producttype') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('productimage') ? ' has-error' : '' }}">
                      <label for="productimage">productimage</label>
                      <input type="file" id="productimage" name="productimage" value="{{ old('productimage') }}">
                      @if ($errors->has('productimage'))
                          <span class="help-block">
                              <strong>{{ $errors->first('productimage') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                      <label>Description</label>
                      <textarea class="form-control" rows="3" name="description" id="description" placeholder="Enter description" value="{{ old('description') }}"></textarea>
                      @if ($errors->has('description'))
                          <span class="help-block">
                              <strong>{{ $errors->first('description') }}</strong>
                          </span>
                      @endif
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

  </div>
@stop