<!-- Delete Product -->
  <div class="modal fade" id="delete_product_model" role="dialog">
    <form method="post" action="{{ route('product.delete') }}" >
      {{ csrf_field() }}
      <input type="hidden" name="product_id" id="delete_product_id"/> 
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-danger">Delete Product</h4>
          </div>
          <div class="modal-body">
            <p class="text-danger">Are you sure want to delete this product?</p>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
  </form>
</div>
<!-- Delete Product -->