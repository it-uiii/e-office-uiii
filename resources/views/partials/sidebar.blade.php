<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="/profile/{{ auth()->user()->id }}/index" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-header">MENU</li>
        <li class="nav-item">
          <a href="/demo" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Demo</p>
          </a>
        </li>
        @can('admin-list')
        <li class="nav-header">ADMINISTRATOR</li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              IT Portal
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/abouts" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>About</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/visi_misi" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Visi & Misi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/faqs" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>FAQs</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="/users" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Users</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/roles" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Roles</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/permissions" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Permission</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/category" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Category</p>
          </a>
        </li>
        @endcan
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>