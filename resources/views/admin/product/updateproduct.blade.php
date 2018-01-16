<!-- Update Product -->
  <div class="modal fade" id="update_product_model" role="dialog">
    <form method="post" action="{{ route('product.update.submit') }}" id="update_product_form" enctype="multipart/form-data">
      
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-success" >Update Product</h4>
            <h6 class="text-success" id="product_update_success"></h6>
            <h6 class="text-danger" id="product_update_fail"></h6>
          </div>
          <div class="modal-body">
             
            <div class="col-md-12">
              {{ csrf_field() }}
              <input type="hidden" name="product_id" id="update_product_id"/>                    
                 <div class="form-group">
                    <label for="productname">Product Name</label>
                    <input type="text" class="form-control" id="productname" name="productname" placeholder="Enter product name">
                  </div>
                  <div class="form-group">
                    <label for="productamount">Product Amount</label>
                    <input type="text" class="form-control" id="productamount" name="productamount" placeholder="Enter product amount">
                  </div>
                  <div class="form-group">
                    <label>Product Type</label>
                    <select class="form-control" name="producttype" id="producttype">
                      <option value="">--Select Type--</option>
                      <option value="simple">Simple</option>
                      <option value="virtual">Virtual</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="productimage">productimage</label>
                    <input type="file" id="productimage" name="productimage" class="form-control">
                  </div>
                  <div class="form-group" >
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Enter description"></textarea>
                  </div>
            </div>
                  
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="update_btn">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" id="close_product_update">Close</button>
          </div>
        </div>
      </div>
  </form>
</div>
@section('product-update-validation')
<script type="text/javascript">
  $.validator.setDefaults({
      errorClass:'help-block',
      highlight:function(element){
        $(element)
          .closest('.form-group')
          .addClass('has-error');
      },
      unhighlight:function(element){
        $(element)
          .closest('.form-group')
          .removeClass('has-error');
      }
  });
  $.validator.addMethod('filesize', function(value, element, param) {
    // param = size (in bytes) 
    // element = element to validate (<input>)
    // value = value of the element (file name)
    return this.optional(element) || (element.files[0].size <= param) 
 });
  $("#update_product_form").validate({
    rules: {
      productname: {
          required: true,
          minlength: 2
      },
      productamount: {
          required: true,
          number: true
      },
      producttype: {
          required: true
      },
      productimage: {
          required: false, 
          accept: "image/jpeg, image/pjpeg,image/png", 
          filesize: 1048576
      },
      description: {
          required: true
      }
    },
    messages: {
        productname: {
            required: "Product name must be required!",
        },
        productamount: {
            required: "Product mount must be required!",
            number:"Product amount must be numeric!"
        },
        producttype: {
            required: "Product type must be required!"
        },
        productimage: {
            required: "Product image must be required!"
        },
        description: {
            required: "Product description must be required!"
        }
    },
    submitHandler: function(form) {
      $('#update_product_form').on('submit',function(e){
        //var data = $(this).serialize()+"&profileimage="+$('#productimage').val();
        var data = new FormData($('#update_product_form')[0]);
        var url = $(this).attr('action');
        $.post({
          url:url,
          data:data,
          cache: false,
          contentType: false,
          processData: false,
          success:function(data){
            if(data.response_code == 1){
              $('#product_update_fail').hide();
              $('#product_update_success').text(data.response_message);
              $('#product_update_success').show();
            }else{
              $('#product_update_success').hide();
              $('#product_update_fail').text(data.response_message);
              $('#product_update_fail').show();
            }
          }
        })
     });
    }
  });
  $('#close_product_update').on('click',function(){
    location.reload();
  });
</script>
@stop
<!-- Update Product -->