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
            <h2 class="h5 no-margin-bottom">Room Management</h2>
          </div>
        </div>
        <section class="no-padding-bottom">
          <div class="container-fluid">
            <div class="table-responsive block">
              <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th style="padding: 15px;">Room Title</th>
                        <th style="padding: 15px;">Description</th>
                        <th style="padding: 15px;">Price</th>
                        <th style="padding: 15px;">Wifi</th>
                        <th style="padding: 15px;">Room Type</th>
                        <th style="padding: 15px;">Image</th>
                        <th style="padding: 15px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                    <tr>
                        <td style="padding: 15px; vertical-align: middle;">
                            <strong>{{$room->room_title}}</strong>
                        </td>
                        <td style="padding: 15px; vertical-align: middle;">
                            {{substr($room->description, 0, 50)}}{{ strlen($room->description) > 50 ? '...' : '' }}
                        </td>
                        <td style="padding: 15px; vertical-align: middle;">
                            <span class="badge dashbg-1">${{$room->price}}</span>
                        </td>
                        <td style="padding: 15px; vertical-align: middle;">
                            <span class="badge {{ $room->wifi == 'yes' ? 'dashbg-3' : 'dashbg-4' }}">
                                {{ ucfirst($room->wifi) }}
                            </span>
                        </td>
                        <td style="padding: 15px; vertical-align: middle;">
                            {{$room->room_type}}
                        </td>
                        <td style="padding: 15px; vertical-align: middle;">
                            <img src="public/rooms/{{$room->image}}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; border: 1px solid #444; cursor: pointer;" data-toggle="modal" data-target="#imageModal" onclick="openImageModal('public/rooms/{{$room->image}}', '{{$room->room_title}}');" title="Click to view full image">
                        </td>
                        <td style="padding: 15px; vertical-align: middle;">
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editRoomModal" onclick="loadRoomData({{ $room->id }});" title="Edit Room">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('delete_room', $room->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete Room">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
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

    <!-- Edit Room Modal -->
    <div class="modal fade" id="editRoomModal" tabindex="-1" role="dialog" aria-labelledby="editRoomModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editRoomModalLabel">Edit Room</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="editRoomForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal-body">
              <!-- Row 1: Room Title and Room Price -->
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label">Room Title</label>
                    <input type="text" placeholder="Enter room title" id="roomTitle" name="title" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label">Room Price</label>
                    <input type="number" placeholder="Enter room price" id="roomPrice" name="price" class="form-control" step="0.01" required>
                  </div>
                </div>
              </div>

              <!-- Row 2: Room Type, Free Wifi, and Room Image -->
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Room Type</label>
                    <select id="roomType" name="type" class="form-control" required>
                      <option value="Regular">Regular</option>
                      <option value="Premium">Premium</option>
                      <option value="Deluxe">Deluxe</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Free Wifi</label>
                    <select id="roomWifi" name="wifi" class="form-control" required>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Room Image</label>
                    <input type="file" id="roomImage" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Leave empty to keep current image</small>
                  </div>
                </div>
              </div>

              <!-- Row 3: Current Image Preview -->
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label">Current Image</label><br>
                    <img id="currentImage" src="" style="width: 150px; height: 150px; object-fit: cover; border-radius: 5px; border: 2px solid #444; cursor: pointer;" data-toggle="modal" data-target="#imageModal" onclick="openImageModal(this.src, document.getElementById('roomTitle').value);">
                  </div>
                </div>
              </div>

              <!-- Row 4: Description -->
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label">Room Description</label>
                    <textarea placeholder="Enter room description" id="roomDescription" name="description" class="form-control" rows="5" required></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Update Room</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      function loadRoomData(roomId) {
        // Fetch room data via AJAX
        $.ajax({
          url: '/get_room/' + roomId,
          type: 'GET',
          success: function(data) {
            // Populate form with room data
            $('#roomTitle').val(data.room_title);
            $('#roomPrice').val(data.price);
            $('#roomType').val(data.room_type);
            $('#roomWifi').val(data.wifi);
            $('#roomDescription').val(data.description);
            $('#currentImage').attr('src', 'public/rooms/' + data.image);
            
            // Update form action to update route
            $('#editRoomForm').attr('action', '/update_room/' + roomId);
          },
          error: function() {
            alert('Error loading room data');
          }
        });
      }

      function openImageModal(imageSrc, roomTitle) {
        $('#fullImage').attr('src', imageSrc);
        $('#imageModalTitle').text(roomTitle);
      }

      function searchRooms() {
        const searchInput = $('#searchInput').val().toLowerCase().trim();
        
        if (searchInput === '') {
          // Show all rows if search is empty
          $('table tbody tr').show();
          return;
        }

        // Hide all rows first
        $('table tbody tr').hide();

        // Show only matching rows
        $('table tbody tr').each(function() {
          const roomTitle = $(this).find('td:nth-child(1)').text().toLowerCase();
          const roomType = $(this).find('td:nth-child(5)').text().toLowerCase();
          const roomWifi = $(this).find('td:nth-child(4)').text().toLowerCase();

          if (roomTitle.includes(searchInput) || roomType.includes(searchInput) || roomWifi.includes(searchInput)) {
            $(this).show();
          }
        });
      }

      // Search on Enter key press
      $('#searchInput').on('keypress', function(e) {
        if (e.which === 13) {
          searchRooms();
        }
      });

      // Real-time search as you type
      $('#searchInput').on('input', function() {
        searchRooms();
      });
    </script>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="imageModalTitle">Room Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <img id="fullImage" src="" style="max-width: 100%; max-height: 600px; object-fit: contain; border-radius: 5px;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
