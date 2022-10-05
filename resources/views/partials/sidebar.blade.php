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
                    @can('outgoing-letter-list')
                        <li class="nav-item">
                            <a href="{{ route('outgoing-letters.index') }}" class="nav-link">
                                <i class="fas fa-mail-bulk nav-icon"></i>
                                <p>Surat Keluar</p>
                            </a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a href="{{ route('entry-letters.index') }}" class="nav-link">
                            <i class="fas fa-notes-medical nav-icon"></i>
                            <p>Disposisi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Laporan Kinerja
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/reports" class="nav-link">
                                    <i class="fas fa-file nav-icon"></i>
                                    <p>Management Laporan</p>
                                </a>
                            </li>
                            @can('summary')
                                <li class="nav-item">
                                    <a href="/summary" class="nav-link">
                                        <i class="fas fa-file-excel nav-icon"></i>
                                        <p>Summary</p>
                                    </a>
                                </li>
                            @elsecan('report')
                                <li class="nav-item">
                                    <a href="/report" class="nav-link">
                                        <i class="fas fa-file-excel nav-icon"></i>
                                        <p>Reports</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            </li>
            {{-- @foreach ($menu as $item => $value)
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
                        @can('user-list')
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="fas fa-users nav-icon"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        @endcan
                        @can('position-list')
                            <li class="nav-item">
                                <a href="{{ route('positions.index') }}" class="nav-link">
                                    <i class="fas fa-user-tie nav-icon"></i>
                                    <p>Jabatan</p>
                                </a>
                            </li>
                        @endcan
                        @can('role-list')
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="fas fa-user-tag nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                        @endcan
                        @can('permission-list')
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}" class="nav-link">
                                    <i class="fas fa-user-lock nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
