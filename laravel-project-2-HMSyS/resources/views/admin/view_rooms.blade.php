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
            <table>
                <tr style="background-color: grey;">
                    <th style="padding: 20px;">Room Title</th>
                    <th style="padding: 20px;">Description</th>
                    <th style="padding: 20px;">Price</th>
                    <th style="padding: 20px;">Wifi</th>
                    <th style="padding: 20px;">Room Type</th>
                    <th style="padding: 20px;">Image</th>
                    
                </tr>
    
                @foreach($rooms as $room)
                <tr align="center" style="background-color: black;">
                    <td style="padding: 20px;">{{$room->room_title}}</td>
                    <td style="padding: 20px;">{{$room->description}}</td>
                    <td style="padding: 20px;">{{$room->price}}</td>
                    <td style="padding: 20px;">{{$room->wifi}}</td>
                    <td style="padding: 20px;">{{$room->room_type}}</td>
                    <td style="padding: 20px;"><img src="public/rooms/{{$room->image}}" style="width: 100px; height: 100px; object-fit: cover;"></td>
                    
                </tr>
                @endforeach
            </table>












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