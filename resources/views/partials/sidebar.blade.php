<div class="sidebar">
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-bars"></i>
            <p>
              MENU
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.html" class="nav-link">
                <i class="fas fa-inbox nav-icon"></i>
                <p>Surat Masuk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index2.html" class="nav-link">
                <i class="fas fa-mail-bulk nav-icon"></i>
                <p>Surat Keluar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index3.html" class="nav-link">
                <i class="fas fa-notes-medical nav-icon"></i>
                <p>Disposisi</p>
              </a>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan Kinerja
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="reports" class="nav-link">
                  <i class="fas fa-file nav-icon"></i>
                  <p>Management Laporan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-check nav-icon"></i>
                  <p>Approval Laporan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-file-excel nav-icon"></i>
                  <p>Summary Laporan</p>
                </a>
              </li>
            </ul>
          </li>
          </ul>
        </li>
      {{-- @foreach ($menu as $item=>$value)
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                {{ $value->menu_name }}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @foreach ($submenu as $key)
              @if ($value->menu_id == $key->menu_id)
              <li class="nav-item">
                <a href="/permissions" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>{{ $key->sub_name }}</p>
                </a>
              </li>
              @endif
              @endforeach
            </ul>
          </li>
      @endforeach --}}
      @can('admin-list')
      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="nav-icon fas fa-wrench"></i>
          <p>
            Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="/users" class="nav-link">
              <i class="fas fa-users nav-icon"></i>
              <p>Pegawai</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/roles" class="nav-link">
              <i class="fas fa-user-tag nav-icon"></i>
              <p>Roles</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/permissions" class="nav-link">
              <i class="fas fa-layer-group nav-icon"></i>
              <p>Permissions</p>
            </a>
          </li>
        </ul>
      </li>
      @endcan
      
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
  </div>