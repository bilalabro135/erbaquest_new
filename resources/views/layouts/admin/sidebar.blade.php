        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ ($globalsettings->getValue( 'site_name')) ? $globalsettings->getValue('site_name') : config('app.name', 'Laravel') }}</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{(request()->is('admin')) ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">

            @if ( Bouncer::can('viewBlogs') || Bouncer::can('addBlogs') || Bouncer::can('viewCategories') || Bouncer::can('addCategories') )
                <div class="sidebar-heading">
                    Blogs & Categories
                </div>
                @if (Bouncer::can('viewBlogs') || Bouncer::can('addBlogs'))
                <li class="nav-item {{(request()->is('admin/blogs/*') || request()->is('admin/blogs') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/blogs/*') || request()->is('admin/blogs') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#blogs"
                        aria-expanded="true" aria-controls="blogs">
                        <i class="fas fa-sticky-note"></i>
                        <span>Blogs</span>
                    </a>
                    <div id="blogs" class="collapse {{(request()->is('admin/blogs/*') || request()->is('admin/blogs') ) ? 'show' : ''}}" aria-labelledby="All Blogs" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewBlogs')
                            <a class="collapse-item text-light" href="{{route('blogs')}}">All Blogs</a>
                            @endcan
                            @can('addBlogs')
                            <a class="collapse-item text-light" href="{{route('blogs.add')}}">Add Blog</a>
                            @endcan
                        </div>
                    </div>
                </li>
                @endif
                @if (Bouncer::can('viewCategories') || Bouncer::can('addCategories'))
                <li class="nav-item {{(request()->is('admin/categories/*') || request()->is('admin/categories') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/categories/*') || request()->is('admin/categories') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#categories"
                        aria-expanded="true" aria-controls="categories">
                       <i class="far fa-sticky-note"></i>
                        <span>Categories</span>
                    </a>
                    <div id="categories" class="collapse {{(request()->is('admin/categories/*') || request()->is('admin/categories') ) ? 'show' : ''}}" aria-labelledby="All Categories" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                          
                            <a class="collapse-item text-light" href="{{route('categories')}}">All Categories</a>
                        </div>
                    </div>
                </li>
                @endif
                <hr class="sidebar-divider">
            @endif



            @if ( Bouncer::can('viewPages') || Bouncer::can('addPages') )
                <div class="sidebar-heading">
                    Pages
                </div>
                <li class="nav-item {{(request()->is('admin/pages/*') || request()->is('admin/pages') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/pages/*') || request()->is('admin/pages') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#pages"
                        aria-expanded="true" aria-controls="pages">
                        <i class="fas fa-file"></i>
                        <span>Pages</span>
                    </a>
                    <div id="pages" class="collapse {{(request()->is('admin/pages/*') || request()->is('admin/pages') ) ? 'show' : ''}}" aria-labelledby="All Pages" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewPages')
                            <a class="collapse-item text-light" href="{{route('pages')}}">All Pages</a>
                            @endcan
                            @can('addPages')
                            <a class="collapse-item text-light" href="{{route('pages.add')}}">Add Page</a>
                            @endcan
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider">
            @endif
            @if ( Bouncer::can('viewMenus') )
                <div class="sidebar-heading">
                    Menus
                </div>


                <li class="nav-item {{(request()->is('admin/menus/*') || request()->is('admin/menus') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/menus/*') || request()->is('admin/menus') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#menus"
                        aria-expanded="true" aria-controls="menus">
                        <i class="fas fa-bars"></i>
                        <span>Menus</span>
                    </a>
                    <div id="menus" class="collapse {{(request()->is('admin/menus/*') || request()->is('admin/menus') ) ? 'show' : ''}}" aria-labelledby="All Menus" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewMenus')
                                @foreach(config('settings.menus') as $menu_name => $menu)
                                    <a class="collapse-item text-light" href="{{route('menus', ['type' => $menu])}}">{{$menu_name}}</a>
                                @endforeach
                            @endcan
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider">
            @endif

             @if (Bouncer::can('viewUsers') || Bouncer::can('addUsers') || Bouncer::can('viewRoles') || Bouncer::can('addRoles') )
                <div class="sidebar-heading">
                    Users & Roles
                </div>
                 @if (Bouncer::can('viewUsers') || Bouncer::can('addUsers') )
                <li class="nav-item {{(request()->is('admin/users/*') || request()->is('admin/users') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/users/*') || request()->is('admin/users') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#users"
                        aria-expanded="true" aria-controls="users">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <div id="users" class="collapse {{(request()->is('admin/users/*') || request()->is('admin/users') ) ? 'show' : ''}}" aria-labelledby="All Users" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewUsers')
                            <a class="collapse-item text-light" href="{{route('users')}}">All Users</a>
                            @endcan
                            @can('addUsers')
                            <a class="collapse-item text-light" href="{{route('users.add')}}">Add User</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endif
            @if ( Bouncer::can('viewRoles') || Bouncer::can('addRoles') )
                <li class="nav-item {{(request()->is('admin/roles/*') || request()->is('admin/roles') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/roles/*') || request()->is('admin/roles') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#roles"
                        aria-expanded="true" aria-controls="roles">
                        <i class="fas fa-users"></i>
                        <span>Roles</span>
                    </a>
                    <div id="roles" class="collapse {{(request()->is('admin/roles/*') || request()->is('admin/roles') ) ? 'show' : ''}}" aria-labelledby="All Roles" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewRoles')
                            <a class="collapse-item text-light" href="{{route('roles')}}">All Roles</a>
                            @endcan
                            @can('addRoles')
                            <a class="collapse-item text-light" href="{{route('roles.add')}}">Add Role</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endif
            <hr class="sidebar-divider">
            @endif

            @can('accessSettings')
                <div class="sidebar-heading">
                    Site Settings
                </div>
                <li class="nav-item {{(request()->is('admin/settings')) ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('settings', ['type' => 'general']) }}">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Settings</span></a>
                </li><!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
            @endcan


            

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>