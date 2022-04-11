<!-- Add Product Modal-->
<div class="modal fade" id="addProductCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="{{route('admin.products.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="product_category"><b>Product Category :</label></b>
          <select class="form-control" name="product_category_id">
            @foreach($productCategory as $categories)
              <option value="{{$categories->id}}">{{$categories->category_name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="name"><b>Product Code :</label></b>
          <input type="text" name="product_code" class="form-control" id="product_code" required>
        </div>
        <div class="form-group">
          <label for="name"><b>Product Name :</label></b>
          <input type="text" name="product_name" class="form-control" id="product_name" required>
        </div>
        <div class="form-group">
          <label for="name"><b>Buy Price :</label></b>
          <input type="text" name="buy_price" class="form-control" id="buy_price" required>
        </div>
        <div class="form-group">
          <label for="name"><b>Sell Price :</label></b>
          <input type="text" name="sell_price" class="form-control" id="sell_price" required>
        </div>
        <div class="form-group">
          <label for="name"><b>Discount :</label></b>
          <input type="text" name="discount" class="form-control" id="discount" required>
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