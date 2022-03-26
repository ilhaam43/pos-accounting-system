<!-- Add Product Modal-->
<div class="modal fade" id="addProductCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('admin.product-categories.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name"><b>Category Name :</label></b>
          <input type="text" name="category_name" class="form-control" id="category_name" required>
        </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  
    <!-- End of Main Content -->