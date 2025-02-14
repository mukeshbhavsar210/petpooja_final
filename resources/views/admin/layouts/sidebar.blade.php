<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @if ($logo = getTheme()->pluck('image')->implode(''))
        <img src="{{ asset('uploads/logo/'.$logo) }}" alt="avatar"  class="img-fluid mt-4 ml-4" style="width: 100px;"  />
    @else
        <img src="{{ asset('admin-assets/img/AdminLTELogo.png') }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 100px;">
    @endif 
    
    <!-- Sidebar -->
    <div class="sidebar">
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (\Request::route()->getName() == 'admin.dashboard') ? 'active' : '' }}">
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}" class="nav-link {{ (\Request::route()->getName() == 'categories.index') || (\Request::route()->getName() == 'menu.edit') ? 'active' : '' }}">
                        <p>Menu</p>
                    </a>
                </li>
                @can('create menus')
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link {{ (\Request::route()->getName() == 'products.index') || (\Request::route()->getName() == 'products.edit') ? 'active' : '' }}">
                            <p>Products</p>
                        </a>
                    </li>
                @endcan
                @can('create tables')
                    <li class="nav-item">
                        <a href="{{ route('areas.index') }}" class="nav-link {{ (\Request::route()->getName() == 'areas.index') ? 'active' : '' }}">
                            <p>Tables</p>
                        </a>
                    </li>
                @endcan
                @can('view orders')
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link {{ (\Request::route()->getName() == 'orders.index') ? 'active' : '' }}">
                            <p>Orders</p>
                        </a>
                    </li>
                @endcan
                @can('create permissions')
                    <li class="nav-item">
                        <a href="{{ route('permissions.index') }}" class="nav-link {{ (\Request::route()->getName() == 'permissions.index') || (\Request::route()->getName() == 'permissions.edit') ? 'active' : '' }}">
                            <p>Permissions</p>
                        </a>
                    </li>  
                @endcan
                @can('create roles')
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}" class="nav-link {{ (\Request::route()->getName() == 'roles.index') || (\Request::route()->getName() == 'roles.edit') ? 'active' : '' }}">
                            <p>Roles</p>
                        </a>
                    </li> 
                @endcan
                @can('view configurations')
                <li class="nav-item">
                    <a href="{{ route('configurations.index') }}" class="nav-link {{ (\Request::route()->getName() == 'configurations.index') ? 'active' : '' }}">
                        <p>Configuration</p>
                    </a>
                </li>                  
                @endcan                    
                @can('create users')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ (\Request::route()->getName() == 'users.index') ? 'active' : '' }}">
                            <p>Users</p>
                        </a>
                    </li> 
                @endcan         
                @can('create pages')
                    <li class="nav-item">
                        <a href="{{ route('pages.index') }}" class="nav-link {{ (\Request::route()->getName() == 'pages.index') ? 'active' : '' }}">
                            <p>Pages</p>
                        </a>
                    </li>
                @endcan         
            </ul>
        </nav>
    </div>
 </aside>