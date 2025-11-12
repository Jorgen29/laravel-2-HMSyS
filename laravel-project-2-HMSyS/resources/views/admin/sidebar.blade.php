<div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="admin/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Hi, {{ auth()->user()->name }}</h1>
            <p>{{ auth()->user()->usertype }}</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
                <li class="{{ request()->routeIs('dashboard', 'admin.index') ? 'active' : '' }}"><a href="{{ route('dashboard') }}"> <i class="icon-home"></i>Home </a></li>
              
                <li class="{{ request()->routeIs('create_room', 'view_room') ? 'active' : '' }}">
                  <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Rooms </a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled {{ request()->routeIs('create_room', 'view_room') ? 'show' : '' }}">
                    <li class="{{ request()->routeIs('create_room') ? 'active' : '' }}"><a href="{{ route('create_room') }}">Add Rooms</a></li>
                    <li class="{{ request()->routeIs('view_room') ? 'active' : '' }}"><a href="{{ route('view_room') }}">View Rooms</a></li>
                  </ul>
                </li>
                
        </ul>
        
      </nav>