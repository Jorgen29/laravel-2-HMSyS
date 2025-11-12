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
            <h2 class="h5 no-margin-bottom">Edit Room</h2>
          </div>
        </div>
        <section class="no-padding-bottom">
          <div class="container-fluid">
            <div class="col-lg-8">
              <div class="form-box block">
                <form action="{{ route('update_room', $room->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  
                  <!-- Row 1: Room Title and Room Price -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">Room Title</label>
                        <input type="text" placeholder="Enter room title" name="title" class="form-control" value="{{ $room->room_title }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label">Room Price</label>
                        <input type="number" placeholder="Enter room price" name="price" class="form-control" step="0.01" value="{{ $room->price }}" required>
                      </div>
                    </div>
                  </div>

                  <!-- Row 2: Room Type, Free Wifi, and Room Image -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-control-label">Room Type</label>
                        <select name="type" class="form-control" required>
                          <option value="Regular" {{ $room->room_type == 'Regular' ? 'selected' : '' }}>Regular</option>
                          <option value="Premium" {{ $room->room_type == 'Premium' ? 'selected' : '' }}>Premium</option>
                          <option value="Deluxe" {{ $room->room_type == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-control-label">Free Wifi</label>
                        <select name="wifi" class="form-control" required>
                          <option value="yes" {{ $room->wifi == 'yes' ? 'selected' : '' }}>Yes</option>
                          <option value="no" {{ $room->wifi == 'no' ? 'selected' : '' }}>No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-control-label">Room Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image</small>
                      </div>
                    </div>
                  </div>

                  <!-- Row 3: Current Image Preview -->
                  @if($room->image)
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label">Current Image</label><br>
                        <img src="/rooms/{{ $room->image }}" style="width: 150px; height: 150px; object-fit: cover; border-radius: 5px; border: 2px solid #444;">
                      </div>
                    </div>
                  </div>
                  @endif

                  <!-- Row 4: Description -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label">Room Description</label>
                        <textarea placeholder="Enter room description" name="description" class="form-control" rows="5" required>{{ $room->description }}</textarea>
                      </div>
                    </div>
                  </div>

                  <!-- Row 5: Buttons (Submit bottom right, Cancel) -->
                  <div class="row">
                    <div class="col-md-12 text-right">
                      <div class="form-group">
                        <a href="{{ route('view_room') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
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
