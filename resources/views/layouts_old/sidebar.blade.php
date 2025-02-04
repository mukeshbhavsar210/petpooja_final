<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('admin-assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LARAVEL SHOP</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ (\Request::route()->getName() == 'admin.dashboard') ? 'active' : '' }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link {{ (\Request::route()->getName() == 'categories.index') ? 'active' : '' }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <p>Menu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link {{ (\Request::route()->getName() == 'products.index') ? 'active' : '' }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <p>Menu Item</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('areas.index') }}" class="nav-link {{ (\Request::route()->getName() == 'areas.index') ? 'active' : '' }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <p>Tables</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link {{ (\Request::route()->getName() == 'orders.index') ? 'active' : '' }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <p>Orders</p>
                        </a>
                    </li>
                    <a href="{{ route('articles.index') }}" class="nav-link">
                        <i class="nav-icon  far fa-file-alt"></i>
                        <p>Article</p>
                    </a>
                </li>
                @can('create permissions')
                    <li class="nav-item">
                        <a href="{{ route('permissions.index') }}" class="nav-link">
                            <i class="nav-icon  far fa-file-alt"></i>
                            <p>Permission</p>
                        </a>
                    </li>
                @endcan                   
                @can('edit roles')
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link">
                            <i class="nav-icon  far fa-file-alt"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                @endcan
                @can('create users')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link">
                            <i class="nav-icon  far fa-file-alt"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('settings.index') }}" class="nav-link">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                        <p>Settings</p>
                    </a>
                </li>  
                <a href="{{ route('pages.index') }}" class="nav-link">
                    <i class="fa fa-cog" aria-hidden="true"></i>
                    <p>Pages</p>
                </a>
            </ul>
        </nav>
    </div>
 </aside>
