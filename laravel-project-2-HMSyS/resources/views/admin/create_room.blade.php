<!DOCTYPE html>
<html>
  <head> 
    @include("admin.admincss")
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
     <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

<div>
    <form action="{{url('/add_room')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Room Title</label>
            <input type="text" placeholder="Enter room title" name="title">
        </div>
        <div>
            <label>Room Description</label>
            <textarea type="text" placeholder="Enter room description" name="description"></textarea>
        </div>
        <div>
            <label>Room Price</label>
            <input type="number" placeholder="Enter room price" name="price">
        </div>
        <div>
            <label>Room Type</label>
            <select name="type" >
                <option selected value="Regular">Regular</option>
                <option value="Premium">Premium</option>
                <option value="Deluxe">Deluxe</option>
            </select>
        </div>

        <div>
            <label>Free Wifi</label>
            <select name="wifi" >
                <option selected value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div>
            <label>Room Image</label>
            <input type="file" name="image">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>

    </form>
</div>

          </div>
        </div>
     </div>
        @include('admin.footer')
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="admin/vendor/chart.js/Chart.min.js"></script>
    <script src="admin/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="admin/js/charts-home.js"></script>
    <script src="admin/js/front.js"></script>
  </body>
</html>