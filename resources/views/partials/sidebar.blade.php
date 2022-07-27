<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-header">MENU</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Inbox</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/services" class="nav-link">
            <i class="fas fa-circle nav-icon"></i>
            <p>Services</p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              Level 1
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Level 2</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Level 2
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Level 3</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Level 3</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-dot-circle nav-icon"></i>
                    <p>Level 3</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Level 2</p>
              </a>
            </li>
          </ul>
        </li> --}}
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
              <a href="/users_portal" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
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
              <a href="/sop" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>SOP</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/faqs" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>FAQs</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/contacts" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Contacts</p>
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
        @endcan
        <li class="nav-item">
          <a href="#" class="nav-link">
            {{-- <i class="nav-icon far fa-circle text-danger"></i> --}}
            <form action="/logout" method="post">
              @csrf
              <button class="btn btn-danger" type="submit">Logout</button>
            </form>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>