<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">

        <span class="brand-text font-weight-light"> لوحة التحكم</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend-assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                {{-- <a href="#" class="d-block">{{ auth()->user()->name }}</a> --}}
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->route() === 'home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            لوحة التحكم

                        </p>
                    </a>

                </li>
                @can('users-index')
                <li class="nav-item ">
                    <a href="{{ route('backend.users.index') }}" class="nav-link {{ request()->segment(2) === 'users' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>

                            المدراء
                        </p>
                    </a>
                </li>
                @endcan
                @can('roles-index')
                <li class="nav-item">
                    <a href="{{ route('backend.roles.index') }}" class="nav-link {{ request()->segment(2) === 'roles' ? 'active' : ''}}">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>

                            الصلاحيات
                        </p>
                    </a>
                </li>
                @endcan
                {{--

                <li class="nav-item">
                    <a href="#" class="nav-link {{ active('sliders') }}">
                        <i class="nav-icon fa fa-slideshare"></i>
                        <p>

                            السلايدر
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link {{ active('products') }}">
                        <i class="nav-icon 	fa fa-pinterest-p"></i>
                        <p>

                            المنتجات
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link {{ active('propereties') }}">
                        <i class="nav-icon fas fa-poll-h"></i>
                        <p>

                            الخصائص
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link {{ active('abouts') }}">
                        <i class="nav-icon fa fa-info-circle"></i>
                        <p>

                            من نحن
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link {{ active('join_us') }}">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>

                             الانضمام إلينا
                        </p>
                    </a>
                </li> --}}


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
